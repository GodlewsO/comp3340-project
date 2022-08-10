
window.onclick = function(event) {
    if (event.target == document.getElementById('login-window')) {
        closeLogin();
    }
    if (event.target == document.getElementById('signout-window')) {
        closeSignout();
    }
}


function closeLogin() {
    document.getElementById('login-window').style.display = "none";
    document.getElementById('un-input').value = "";
    document.getElementById('pw-input').value = "";
}

function showLogin() {
    document.getElementById('login-window').style.display = "block";
}

function showSignout() {
    document.getElementById('signout-window').style.display = "block";
}

function closeSignout() {
    document.getElementById('signout-window').style.display = "none";
}