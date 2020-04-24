$( document ).ready(function() {
    var email = document.getElementById("email");
    var password = document.getElementById("password")
    var remain = document.getElementById("remain");

    $("#login").click(function() {
        if(password.value.length >= 6 && email.value != 0) {
            if(remain.checked == true) {
                $.redirect('/php/login.php', {'email': email.value, 'password': password.value, 'remain': "true"})
            } else {
                $.redirect('/php/login.php', {'email': email.value, 'password': password.value, 'remain': "false"})
            }
            
        } else {
            password.classList.add("is-danger");
            email.classList.add("is-danger");
            
        }
    });


});

