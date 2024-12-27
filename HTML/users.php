<!-- ADMIN USER MANAGEMENT (USER OVERVIEW) -->
<?php
include('../components/header.php');
include('../components/nav.php');
if ($logged) {
    require_once('../components/db_utils.php');
    $conn = connectDB();
    if (validateToken($conn)) {
        if (isPermitted($conn, Permission::ADMIN)) {
            //user passes all authentication and authorization checks
            //execute code
            $sql = "SELECT * FROM";
        } else {
            header('Location: /index.php');
            die();
        }
    } else {
        header('Location: /index.php');
        die();
    }
} else {
    header('Location: /index.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <?php include(__DIR__ . '/../components/main_style.php'); ?>
</head>

<body>
    <main class="d-flex">

    </main>
</body>

</html>