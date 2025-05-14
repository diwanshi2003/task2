<?php
if (isset($_SESSION['errors'])):
    foreach ($_SESSION['errors'] as $error):
?>
    <div class="error"><?php echo $error; ?></div>
<?php
    endforeach;
    unset($_SESSION['errors']);
endif;
?>




