$( document ).ready(function() {
    $(".navbar-burger").click(function() {
        $(".navbar-burger").toggleClass("is-active");
        $(".navbar-menu").toggleClass("is-active");
    });

    $("#changeDataBtn").click(function() {
        document.getElementById("changeDataModal").classList.add("is-active");
    });

    $("#closeData").click(function() {
        document.getElementById("changeDataModal").classList.remove("is-active");
    });

    $("#closeDataBtn").click(function() {
        document.getElementById("changeDataModal").classList.remove("is-active");
    });

    $("#changeData").click(function() {
        var nome = document.getElementById("nome")
        var cognome = document.getElementById("cognome");

        if(nome.value != 0 && cognome.value != 0) {
            $.redirect('/php/changeData.php', {'nome': nome.value, 'cognome': cognome.value});
        }
    });



    $("#changePswBtn").click(function() {
        document.getElementById("changePswModal").classList.add("is-active");
    });

    $("#closePsw").click(function() {
        document.getElementById("changePswModal").classList.remove("is-active");
    });

    $("#closePswBtn").click(function() {
        document.getElementById("changePswModal").classList.remove("is-active");
    });

    $("#changePsw").click(function() {
        var oldPsw = document.getElementById("oldPsw");
        var newPsw = document.getElementById("newPsw");

        if(oldPsw.value != 0 && newPsw.value.length >= 6) {
            $.redirect('/php/changePsw.php', {'old': oldPsw.value, 'new': newPsw.value});
        }
    });



    $("#logoutBtn").click(function() {
        document.getElementById("logoutModal").classList.add("is-active");
    });

    $("#closeLogout").click(function() {
        document.getElementById("logoutModal").classList.remove("is-active");
    });

    $("#closeLogoutBtn").click(function() {
        document.getElementById("logoutModal").classList.remove("is-active");
    });

    $("#logout").click(function() {
        $.redirect('/php/logout.php');
    });


    $("#closenoti").click(function() {
        window.location.replace("/home.php");
    });

});