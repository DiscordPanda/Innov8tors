// Beginning of the login.html file
var Login = document.getElementById('login');
var Register = document.getElementById('register');
var LoginBubble = document.getElementById('button-color');

function register() {
    Login.style.left = "-400px";
    Register.style.left = "0px";
    LoginBubble.style.left = "150px";
}
function login() {
    Login.style.left = "0px";
    Register.style.left = "400px";
    LoginBubble.style.left = "0px";
}
