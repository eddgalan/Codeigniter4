<!DOCTYPE html>
<html>
<head>
    <title>Admin | Login</title>
</head>
<body>
    <div>
        <h2>Login Form</h2>
        <?= session()->getFlashdata('error') ?>
        <?= validation_list_errors() ?>
        <form method="POST" action="/admin/login">
            <?= csrf_field() ?>
            <div>
                <label for="user">User: </label>
                <input type="text" name="user" placeholder="Username" required>
            </div><br>
            <div>
                <label for="password">Password: </label>
                <input type="password" name="password" placeholder="********" required>
            </div>
            <div>
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>