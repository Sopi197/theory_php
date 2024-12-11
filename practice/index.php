<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Регистрация</title>
</head>

<body>
    <h1>Форма регистрации на чистом PHP</h1>
    <div class="form">
        <form action="/reg.php" method="post">
            <input type="text" name="login" placeholder="Введите логин" required>
            <br>
            <br>
            <input type="email" name="email" placeholder="Введите email" required>
            <br>
            <br>
            <input type="submit" value="Зарегистрироваться">
        </form>

    </div>
</body>

</html>