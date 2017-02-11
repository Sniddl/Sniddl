@include('layouts.head')

<style media="screen">
body{
  overflow: hidden;
  padding: 20px 0px;
}
pre {
    display: block;
    padding: 9.5px;
    font-size: 13px;
    line-height: 1.42857143;
    color: #333;
    word-break: break-all;
    word-wrap: break-word;
    background-color: #f5f5f5;
    border: 1px solid #ccc;
    border-radius: 4px;
    max-height: 150px;
    overflow: auto;
}.tab{
  margin-bottom: 10px !important;
}
.iframe-wrapper{
  position: fixed;
  top: 0px;
  left: 0;
  height: 100vh;
  width: 100vw;
  z-index: 99999;
  background: #e66f6f;
  color: white !important;
  display: none;
}.iframe-wrapper .fa-close{
  position: absolute;
  top: 20px;
  left: auto;
  right: 0;
  padding: 8px;
  font-size: 20px;
  z-index: 2;
  cursor: pointer;
}
iframe#error-output {
  border: none;
  height: calc(100% - 40px);
  width: 100%;
  margin-top: 40px;
  overflow: auto;
  background-color: white;
}
</style>

<div id="vue-app">

  <div class="iframe-wrapper">
      <i class="fa fa-close"><span style="font-family: monospace"> Close</span></i>
      <iframe src="/error-url" id="error-output"></iframe>
  </div>


  <div class="col col-lg-8 offset-lg-2">

    <div class="ui top attached tabular menu">
      <a class="item active" data-tab="#first">Sent</a>
      <a class="item" data-tab="#second">Result</a>
    </div>
    <div class="ui bottom attached tab segment active" id="first">
      <pre id="sent">
$.ajax({
  type: "@{{request}}",
  url: "@{{action}}",
  headers: {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'AJAX': true
  },
  data: @{{json}},
  success: function s(data) {
    window.data = data;
    console.log(window.data);
  },
  error: function e(data){
    window.data = data;
    console.log(window.data);
  }
});
      </pre>
    </div>
    <div class="ui bottom attached tab segment" id="second">
      <pre id="result">@{{ result }}</pre>
      <button v-on:click="view" style="width: 100%; box-sizing: border-box; margin:0">View in Window</button>
    </div>



    <form class="ui form">
      {{csrf_field()}}
      <div class="field">
        <label>Action</label>
        <input v-model="action" type="text" name="action" placeholder="/post/create">
      </div>


      <div class="field">
        <label>Request</label>
        <select v-model="request">
          <option value="">-</option>
          <option value="GET">GET</option>
          <option value="POST">POST</option>
        </select>
      </div>


      <div class="field">
        <label>JSON</label>
        <textarea name="json" v-model="json" rows="4"></textarea>
      </div>


    </form>
    <button v-on:click="ajax" style="width: 100%; box-sizing: border-box; margin:0">Test Request</button>

  </div>

</div>

<script type="text/javascript">


  window.app = new Vue({
    el: '#vue-app',
    data: {
      result: '...',
      action: null,
      request: null,
      json: null
    },
    methods: {
      ajax: function () {
        $.ajax({
          type: app.request,
          url: app.action,
          headers: {
            'X-CSRF-TOKEN': window.Laravel.csrfToken,
            'AJAX': true
          },
          data: JSON.parse(app.json),
          success: function s(ajax_response) {
            app.result = ajax_response;
            window.data = ajax_response;
            console.log(window.data);
          },
          error: function e(ajax_response){
            //app.result.responseText
            var doc = document.getElementById('error-output').contentWindow.document;
                doc.open();
                doc.write(ajax_response.responseText);
                doc.close();
            $('.iframe-wrapper').show();
            app.result = ajax_response;
            window.data = ajax_response;
            console.log(window.data);
          }
        });
      },
      view: function(){
        app.ajax();
        var doc = document.getElementById('error-output').contentWindow.document;
            doc.open();
            doc.write(app.result);
            doc.close();
        $('.iframe-wrapper').css('background','#6f8ce6').show();
      }
    }
  })
</script>

@include('layouts.foot')
