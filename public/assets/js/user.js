
var User = {
    compare: function () {
        console.log('enter');
        console.log($("#inputPassword").val());
        console.log($("#inputPassword2").val());
        if ($("#inputPassword2").val() !== $("#inputPassword").val()) {
            alert('Пароли не совпадают');
            console.log('false');
            return false;
        } else {
            console.log('true');
            return true;
        }
    }
}