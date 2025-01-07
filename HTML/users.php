<!-- ADMIN USER MANAGEMENT (USER OVERVIEW) -->
<?php
if ($logged) {
    require_once __DIR__ . '/../components/db_utils.php';
    $conn = connectDB();
    if (validateToken($conn)) {
        if (isPermitted($conn, Permission::ADMIN)) {
            //user passes all authentication and authorization checks
            //execute code

            //injecting filter directly because binding it as param doesn't work
            $allowedFilters = ["username", "id"];
            isset($_GET['filter']) && in_array($_GET['filter'], $allowedFilters) ? $filterType = $_GET['filter'] : $filterType = 'username';

            $users = [];
            $sql = "SELECT username, email, id, status FROM users
                    ORDER BY $filterType ASC";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                    $users[$count++] = $row;
                }
            }
        } else {
            header('Location: /');
            die();
        }
    } else {
        header('Location: /');
        die();
    }
} else {
    header('Location: /');
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
    <main class="flex-column">
        <h1 class="text-center">Users</h1>
        <section class="flex-row w-100 jstfy-space-around">
            <a href="/users?filter=username"
                class="btn btn-light <?= ($filterType == 'username') ? 'text-primary' : 'text-secondary' ?>">Sortieren
                nach username</a>
            <a href="/users?filter=id"
                class="btn btn-light <?= ($filterType == 'id') ? 'text-primary' : 'text-secondary' ?>">Sortieren nach
                id</a>
        </section>
        <ul class="flex-column w-100">
            <?php foreach ($users as $user): ?>
                <li class="flex-column justify-content-center border-bottom-cream mb-3">
                    <h2>User: <?= $user['username']; ?></h2>
                    <h3>ID: <?= $user['id']; ?></h3>
                    <p>Email: <?php echo $user['email']; ?></p>
                    <?php if ($user['status'] == 'inactive'): ?>
                        <p class="text-danger">Inaktiver Benutzer</p>
                    <?php endif; ?>

                    <section>
                        <a href="/user?user=<?= $user['id'] ?>" class="btn btn-light">Edit</a>
                        <a href="/reservierungen?id=<?= $user['id'] ?>" class="btn btn-light">Reservierungen</a>
                        <?php if ($user['status'] == 'active'): ?>
                            <a href="/actions/userstatus.php?status=inactive&user=<?= $user['id'] ?>" class="text-danger">Konto
                                deaktivieren</a>
                        <?php else: ?>
                            <a href="/actions/userstatus.php?status=active&user=<?= $user['id'] ?>" class="text-success">Konto
                                aktivieren</a>
                        <?php endif; ?>
                    </section>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>
</body>

</html>