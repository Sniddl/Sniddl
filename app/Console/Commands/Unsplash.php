<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\JSON;
use Intervention\Image\Facades\Image as Image;

class Unsplash extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:potd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the picture of the day.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $json='{"client_id":"'. env('UNSPLASH_APP_ID', false) .'"}';
      $added_JSON = json_decode($json, true);
      $url = 'https://api.unsplash.com/photos/random?'.http_build_query($added_JSON);
      $requested_JSON = file_get_contents($url);
      $this->info('API Successful');

      $unsplash = JSON::withTrashed()->firstOrCreate([
        'site' => 'unsplash_random'
      ]);
      $unsplash->json = $requested_JSON;
      $unsplash->save();
      $this->info('Cached in Database');

      // $unsplash = JSON::create('unsplash_random', 'https://api.unsplash.com/photos/random', $requested_JSON);
      $result = json_decode($unsplash->json);
      $path = $result->urls->raw;
      Image::make($path)->save(public_path('uploads/images/resources/potd.jpg'));
      $this->info('Image cached in public storage');
    }
}
