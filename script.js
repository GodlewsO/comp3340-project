
window.onclick = function(event) {
    if (event.target == document.getElementById('login-window')) {
        closeLogin();
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
