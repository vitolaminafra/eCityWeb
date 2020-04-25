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

    $("#signup").click(function() {
        if(password.value.length >= 6 && email.value != 0) {
            document.getElementById("modal").classList.add("is-active");

        } else {
            password.classList.add("is-danger");
            email.classList.add("is-danger");
            
        }
    });

    $("#close").click(function() {
        document.getElementById("modal").classList.remove("is-active");
    });

    $("#fullsignup").click(function() {
        var nome = document.getElementById("nome");
        var cognome = document.getElementById("cognome")
        if(nome.value != 0 && cognome.value != 0) {
            if(remain.checked == true) {
                $.redirect('/php/signup.php', {'email': email.value, 'password': password.value, 'nome': nome.value, 'cognome': cognome.value, 'remain': "true"})
            } else {
                $.redirect('/php/signup.php', {'email': email.value, 'password': password.value, 'nome': nome.value, 'cognome': cognome.value, 'remain': "false"})
            } 
        } else {
            nome.classList.add("is-danger");
            cognome.classList.add("is-danger");
        }
    });

    $("#closenoti").click(function() {
        document.getElementById("noti").style.display = "none";
    });

});

