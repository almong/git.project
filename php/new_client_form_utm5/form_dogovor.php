<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Портал "ISP i-Net"</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style/main.css" />
    <script src="scrypt/main.js"></script>
</head>
<body>
    <header class="page-header">
        <nav class="main-menu">
            <ul>
                <li><a href="form_dogovor.php">Создать договор</a></li>
                <li><a href="form_genconf_r01.php">Генератор конфига</a></li>
            </ul>
        </nav>
    </header>
    <main>
      <?php include('blocks/form.php');?>
    </main>
    <footer class="page-footer">
        <p>&#169 Ай-Нет 2018г </p>
    </footer>
</body>
</html>