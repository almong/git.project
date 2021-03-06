<?php
//Соединение с БД
    require "includes/db.php";
// Проверяем введены ли данные в форму
    if (!empty($_POST)){
        $errors = array();
//Проверка на не пустой логин
        if (trim($_POST['login']) == ''){
            $errors[] = 'Введите логин!';
        } 
//Проверка на не пустой email
        if (trim($_POST['email']) == ''){
            $errors[] = 'Введите email!';
        }
//Проверка на не пустой пароль
        if ($_POST['password'] == ''){
            $errors[] = 'Введите пароль!';
        } 
//Проверяем на уникальность логина и email
        if ( R::count('users', "login = ?", array($_POST['login'])) > 0 ){
            $errors[] = 'Пользователь с таким логином уже существует';
        }
        if ( R::count('users', "email = ?", array($_POST['email'])) > 0 ){
            $errors[] = 'Пользователь с таким Email уже существует';
        }
// Если ошибок нет то добавляем в БД запись о пользователе.
        if (empty($errors)){
            $user = R::dispense('users');
            $user->login = $_POST['login'];
            $user->email = $_POST['email'];
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            R::store($user);
            echo '<div style="color: green; text-align: center;">Вы успешно зарегистрированны!</div><hr>';
        } else {
            echo '<div style="color: red; text-align: center;">'.array_shift($errors).'</div><hr>';
        }
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="auth">
<!-- Добавляем форму регистрации -->
    <form action="signup.php" method="post">
        <p>Регистрация</p>
        <p>Введите логин: <input type="text" name="login" value ="<?echo @$_POST['login']?>"></p>
        <p>Введите e-mail: <input type="email" name="email" value ="<?echo @$_POST['email']?>"></p>
        <p>Введите пароль: <input type="password" name="password"></p>
        <p><button type="submit">Отправить</button></p>
    </form>  
</div>
</body>
</html>