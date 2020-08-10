<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <title>Личный кабинет</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/user.js"></script>

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
    <a class="navbar-brand" href="/">Ворк</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <?php if (\App\System\Session::userIsLoggedIn()) : ?>
        <div class="collapse navbar-collapse" id="navbarsExample09">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="#"
                       id="dropdown09"
                       data-toggle="dropdown"
                       aria-haspopup="true"
                       aria-expanded="false">Привет, <?= \App\System\Session::get('user_full_name'); ?></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown09">
                        <a class="dropdown-item" href="/user/profile">Профиль</a>
                        <a class="dropdown-item" href="/user/logout">Выйти</a>
                    </div>
                </li>
            </ul>
        </div>
    <?php endif; ?>
</nav>

<div class="container">
    <?php if (isset($errors) && count($errors) > 0) : ?>
        <?php foreach ($errors as $error) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $error; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (isset($messages) && count($messages) > 0) : ?>
        <?php foreach ($messages as $message) : ?>
            <div class="alert alert-info" role="alert">
                <?= $message; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (isset($_GET['message'])) : ?>
        <div class="alert alert-info" role="alert">
                <?= $_GET['message']; ?>
        </div>
    <?php endif; ?>
    <?php require_once $template; ?>
</div>
</body>
</html>