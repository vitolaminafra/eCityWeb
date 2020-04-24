$( document ).ready(function() {
    var email = document.getElementById("email");
    var password = document.getElementById("password")

    $("#login").click(function() {
        if(password.value.length > 6 && email.value != 0) {
            


            
        } else {
            password.classList.add("is-danger");
            email.classList.add("is-danger");
            
        }
    });


});

