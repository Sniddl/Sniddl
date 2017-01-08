


<?php for ($i=1; $i < 100; $i++): ?>
  <?php if ($i % 5 == 0 && $i % 3 == 0): ?>
    <p>Fizzbuzz</p>
  <?php elseif ($i % 3 == 0): ?>
    <p>Fizz</p>
  <?php elseif ($i % 5 == 0): ?>
    <p>Buzz</p>
  <?php else: ?>
    <p><?php echo $i ?></p>
  <?php endif; ?>
<?php endfor; ?>
