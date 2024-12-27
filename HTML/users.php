<?php
include('../components/db_utils.php');
$conn = connectDB();
if (validateToken($conn)) {

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