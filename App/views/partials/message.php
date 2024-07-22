<?php
use Framework\Session;
?>


<?php $successMessage = Session::getFlashMessage('success_message'); ?>
<?php if ($successMessage !== null) : ?>
    <div class="messagee bg-green-100 p-3 my-4">
        <?= $successMessage ?>
    </div>
<?php endif; ?>

<?php $errorMessage = Session::getFlashMessage('error_message'); ?>
<?php if ($errorMessage !== null) : ?>
    <div class="messagee bg-red-100 p-3 my-4">
        <?= $errorMessage ?>
    </div>
<?php endif; ?>