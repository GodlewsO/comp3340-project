

function validateRegistration() {
    const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    let foundError = false;

    const email = document.getElementById("reg-email").value;
    if(!email.match(emailRegex)) {
        makeError("reg-email", "! Please enter a valid email");
        foundError = true;
    }

    const pw = document.getElementById("reg-pw").value;
    if(pw.length < 8) {
        makeError("reg-pw", "! Minimum 8 characters required");
        foundError = true;
    }

    const pwRepeat = document.getElementById("reg-pw-repeat").value;
    if(pw != pwRepeat) {
        makeError("reg-pw-repeat", "! Passwords must match");
        foundError = true;
    }

    if (foundError) {
        return false;
    }
    return true;
}

function makeError(element, message) {
    document.getElementById(element + "-err").innerHTML = message;
    document.getElementById(element).classList.add('error');
}

function removeError(element) {
    document.getElementById(element + "-err").innerHTML = "";
    document.getElementById(element).classList.remove('error');
}


document.getElementById("reg-email").addEventListener("input", function() {
    removeError("reg-email");
});

document.getElementById("reg-pw").addEventListener("input", function() {
    removeError("reg-pw");
});

document.getElementById("reg-pw-repeat").addEventListener("input", function() {
    removeError("reg-pw-repeat");
});

