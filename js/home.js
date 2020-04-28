$( document ).ready(function() {
    // TRASFORMAZIONE DEL PULSANTE "BURGER" NEL CASO DI DISPOSITIVI MOBILE
    $(".navbar-burger").click(function() {
        $(".navbar-burger").toggleClass("is-active");
        $(".navbar-menu").toggleClass("is-active");
    });

    // MODAL PER IL CAMBIO DEI DATI
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

    // MODAL PER IL CAMBIO DELLA PASSWORD
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

    // MODAL PER USCIRE DALL'ACCOUNT
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

    //  RICARICARE LA PARINA QUANDO SI CHIUDE UNA NOTIFICA
    $("#closenoti").click(function() {
        window.location.replace("/home.php");
    });

    // CAMBIO COLORE DEI MARKER QUANDO IL MOUSE PASSA SU UN PULSANTE
    $(".btn").mouseenter(function() {
        var id = $(this).attr("id");
        for(var i = 2; i < 23; i++) {
            if(id != i) {
                var sid = i;
                var marker = ".marker#" + sid; 
                var elem = $(marker).children().children().children()[1];
                var prevColor = $(elem).attr("fill");
                var newColor = prevColor + "35";
                $(elem).attr("fill", newColor);
            }
        }    
    });

    $(".btn").mouseleave(function() {
        var id = $(this).attr("id");
        for(var i = 2; i < 23; i++) {
            if(id != i) {
                var sid = i;
                var marker = ".marker#" + sid; 
                var elem = $(marker).children().children().children()[1];
                var prevColor = $(elem).attr("fill");
                var newColor = prevColor.substring(0, 7);
                $(elem).attr("fill", newColor);
            }
        }    
    });

    $(".btn").click(function() {
        var serModal = document.getElementById("serModal");
        serModal.classList.add("is-active");

        
    });

    $("#closeSer").click(function() {
        document.getElementById("serModal").classList.remove("is-active");
    });

});