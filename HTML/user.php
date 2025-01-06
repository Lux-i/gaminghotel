<!-- ADMIN USER MANAGEMENT (SIGNLE USER) -->
<?php
include('../components/header.php');
include('../components/nav.php');

if (!isset($_GET['user'])) {
    header('Location: /index.php');
    die();
}

if ($logged) {
    require_once('../components/db_utils.php');
    $conn = connectDB();
    if (validateToken($conn)) {
        if (
            isPermitted(
                $conn,
                Permission::ADMIN
            )
        ) {
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
    <link rel="stylesheet" href="/CSS/login-register.css" />
</head>

<body>
    <main class="flex-column container">
        <h1 class="text-center">User-Daten Management</h1>
        <h2 class="text-center">User: <?= $user['username']; ?></h2>
        <section class="data-splitter"></section>
        <form class="flex-column" action="/actions/changeData.php?user=<?= $_GET['user'] ?>" method="POST">
            <h3 class="text-center">PERSONENDATEN ÄNDERN</h3>
            <section class="flex-column input_group container form-floating">
                <input class="inputfield container-md form-control" type="text" id="username" name="username"
                    value="<?= $user['username'] ?>"></input>
                <label for="username">Username</label>
            </section>
            <section class="flex-column input_group container form-floating">
                <input class="inputfield container-md form-control" type="text" id="vorname" name="vorname"
                    value="<?= $user['name'] ?>"></input>
                <label for="vorname">Name</label>
            </section>
            <section class="flex-column input_group container form-floating">
                <input class="inputfield container-md form-control" type="text" id="nachname" name="nachname"
                    value="<?= $user['nachname'] ?>"></input>
                <label for="nachname">Nachname</label>
            </section>
            <section class="flex-column input_group container form-floating">
                <input class="inputfield container-md form-control" type="text" id="email" name="email"
                    value="<?= $user['email'] ?>"></input>
                <label for="email">E-mail</label>
            </section>
            <section class="container">
                <select class="container-md form-control" name="anrede" id="anrede">
                    <option value="herr" <?= ($user['anrede'] == 'herr') ? 'selected' : '' ?>>
                        Herr
                    </option>
                    <option value="frau" <?= ($user['anrede'] == 'frau') ? 'selected' : '' ?>>
                        Frau
                    </option>
                    <option value="divers" <?= ($user['anrede'] == 'divers') ? 'selected' : '' ?>>
                        Divers
                    </option>
                </select>
            </section>
            <input class="submit_button" type="submit" value="Bestätigen" />
        </form>
        <form class="flex-column" action="changeData.php?user=<?= $_GET['user'] ?>" method="POST">
            <h3 class="text-center">PASSWORT ÄNDERN</h3>
            <section class="flex-column input_group container form-floating">
                <input class="inputfield container-md form-control" type="password" id="new_pwd" name="new_pwd" required
                    aria-label="Neues Passwort"></input>
                <label for="new_pwd">Neues Passwort</label>
            </section>
            <section class="flex-column input_group container form-floating">
                <input class="inputfield container-md form-control" type="password" id="new_pwd_again"
                    name="new_pwd_again" required aria-label="Neues Passwort wiederholen"></input>
                <label for="new_pwd_again">Passwort Wiederholen</label>
            </section>
            <input class="inputfield container-md form-control" type="hidden" id="pwd" name="pwd" required
                aria-label="Neues Passwort wiederholen" value="0"></input>
            <input class="submit_button" type="submit" value="Bestätigen" />
        </form>
    </main>
</body>

</html>