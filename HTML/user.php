<!-- ADMIN USER MANAGEMENT (SIGNLE USER) -->
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

            $sql = "SELECT * FROM users
                    WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $_GET['user']);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
            }
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
    <title>User Management | <?= $user['username'] ?></title>
    <?php include(__DIR__ . '/../components/main_style.php'); ?>
</head>

<body>
    <main class="flex-column">
        <h1 class="text-center">User-Daten Management</h1>
        <h2 class="text-center">User: <?= $user['username']; ?></h2>
        <section class="flex-column">
            <label>Name</label>
            <input type="text" value="<?= $user['name'] ?>"></input>
        </section>
        <section class="flex-column">
            <label>Nachname</label>
            <input type="text" value="<?= $user['nachname'] ?>"></input>
        </section>
        <section class="flex-column">
            <label>E-mail</label>
            <input type="text" value="<?= $user['email'] ?>"></input>
        </section>
        <section class="flex-column">
            <label>Geschlecht</label>
            <input type="text" value="<?= $user['anrede'] ?>"></input>
        </section>
        </form>
    </main>
</body>

</html>