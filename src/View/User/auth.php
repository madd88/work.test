<style>


    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }
    .form-signin .checkbox {
        font-weight: 400;
    }
    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

</style>
<form class="form-signin" method="post">
    <img class="mb-4" src="/assets/img/logo.png" alt="">
    <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
    <label for="inputLogin" class="sr-only">Логин</label>
    <input type="text" id="inputLogin" class="form-control" name="login" placeholder="Логин" required autofocus>
    <label for="inputPassword" class="sr-only">Пароль</label>
    <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Пароль" required>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
    <div class="nav-link mb-3">
        <a href="/user/registration">Зарегистрироваться</a>
    </div>

</form>