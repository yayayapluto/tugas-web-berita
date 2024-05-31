<?php if (isset($_SESSION['success_msg']) && !empty($_SESSION['success_msg'])) : ?>
  <div class="bg-blue-100 border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
    <span class="block sm:inline-block">
      <?php echo $_SESSION['success_msg']; ?>
    </span>
  </div>
  <?php unset($_SESSION['success_msg']); endif; ?>

  <?php if (isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg'])) : ?>
  <div class="bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
    <span class="block sm:inline-block">
      <?php echo $_SESSION['error_msg']; ?>
    </span>
  </div>
<?php unset($_SESSION['error_msg']); endif; ?>