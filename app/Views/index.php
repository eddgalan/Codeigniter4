<?php /** @var Array $userLogged */ ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin | Index</title>
</head>
<body>
    <h2>Welcome <?= $userLogged['name'] . " " . $userLogged['lastname'] ?></h2>
    <a href="<?= base_url('admin/logout') ?>">logout</a>
</body>
</html>
