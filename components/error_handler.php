<?php
//a component to display error messages retrieved via the GET array
if (!empty($_GET['error'])): ?>

    <div class="error-message alert alert-danger text-center mt-2" role="alert">
        <h4 class="m-1"><?= $_GET['error'] ?></h4>
    </div>

<?php endif; ?>