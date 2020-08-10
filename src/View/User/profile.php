<script>
    $(document).ready(function () {
        $('#profile_submit').click(function (el) {
            return User.compare()
        }) ;
    });
</script>

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

<form class="form-signin" action="/user/profile" method="POST">
    <h1 class="h3 mb-3 font-weight-normal">Личный кабинет</h1>
    <label for="inputFIO" class="sr-only">ФИО</label>
    <input type="text" id="inputFIO" name="full_name" class="form-control" minlength="1" maxlength="250" value="<?= $full_name ?>" placeholder="ФИО" required autofocus>
    <label for="inputLogin" class="sr-only">Логин</label>
    <input type="text" id="inputLogin" name="login" class="form-control" minlength="5" maxlength="55" placeholder="Логин" value="<?= $login ?>" disabled>
    <label for="inputEmail" class="sr-only">Email</label>
    <input type="email" id="inputEmail" name="email" class="form-control" minlength="5" maxlength="55" placeholder="Email" value="<?= $email ?>" disabled>
    <label for="inputPassword" class="sr-only">Пароль</label>
    <input type="password" id="inputPassword" name="password" class="form-control" minlength="5" maxlength="55" placeholder="Пароль" >
    <label for="inputPassword2" class="sr-only">Повторите пароль</label>
    <input type="password" id="inputPassword2" class="form-control" minlength="5" maxlength="55" placeholder="Повторите пароль"  >

    <input class="btn btn-lg btn-primary btn-block" type="submit" id="profile_submit" value="Сохранить">
</form>