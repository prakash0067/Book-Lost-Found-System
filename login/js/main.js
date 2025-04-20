
// to hide and show password 

var passwordInput = document.getElementById("password");
var eyeIcon = document.getElementById("eyeIcon");

eyeIcon.addEventListener("click", function () {
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove("zmdi-eye");
        eyeIcon.classList.add("zmdi-eye-off");
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove("zmdi-eye-off");
        eyeIcon.classList.add("zmdi-eye");
    }
});

// login form validation using js

// function to validate email id 

function validateEmailId() {
    var email = document.getElementById("emailid").value;
    var emailMessage = document.getElementById("emailErrorMssg");

    if (email == "") {
        emailMessage.innerHTML = '<i class="zmdi zmdi-info-outline"></i> Enter email id';
        return false;
    }
    else {
        var regex = /^(?!.*\.{2})[a-zA-Z0-9!#$%&'*+\-/=?^_`{|}~]+(?:\.[a-zA-Z0-9!#$%&'*+\-/=?^_`{|}~]+)*@(?!.*\.{2})[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
        if (!regex.test(email)) {
            emailMessage.innerHTML = '<i class="zmdi zmdi-info-outline"></i> Enter valid email id';
            return false;
        }
        else {
            emailMessage.innerHTML = "";
            return true;
        }
    }
}


// function to validate email id 

function validatePassword() {
    var password = document.getElementById("password").value;
    var passMessage = document.getElementById("passwordErrorMssg");

    if (password == "") {
        passMessage.innerHTML = '<i class="zmdi zmdi-info-outline"></i> Enter password';
        return false;
    }
    else {
        var regex = /^[a-zA-Z0-9]{8,10}$/
        if (!regex.test(password)) {
            passMessage.innerHTML = '<i class="zmdi zmdi-info-outline"></i> Enter valid password';
            return false;
        }
        else {
            passMessage.innerHTML = "";
            return true;
        }
    }
}


// common function

function validateLogin() {
    var email = validateEmailId();
    var password = validatePassword();

    if (email && password) {
        return true;
    }
    else {
        return false;
    }
}
