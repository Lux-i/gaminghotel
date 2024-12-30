<!--a component to display error messages retrieved via the GET array-->

<?php if (!empty($_GET['error'])): ?>

    <div class="error-message alert alert-danger text-center" role="alert">
        <h4><?= $_GET['error'] ?></h4>
    </div>

<?php endif; ?>