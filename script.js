
// Beginning of the login.html animation(s)
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


// Beginning of ToDo.html 
document.addEventListener('DOMContentLoaded', function () {
    const taskBox = document.getElementById('task-box');
    const addButton = document.querySelector('.input button');
    const taskList = document.getElementById('task-items');

    addButton.addEventListener('click', function () {
        const taskName = taskBox.value.trim();
        if (taskName === '') {
            alert('Please enter a task.');
            return;
        }

        const newTask = document.createElement('li');
        newTask.textContent = taskName;

        const deleteButton = document.createElement('button');
        deleteButton.textContent = "\u2715";
        deleteButton.classList.add('delete-button');
        deleteButton.addEventListener('click', function () {
            taskList.removeChild(newTask);
        });

        newTask.appendChild(deleteButton);
        taskList.appendChild(newTask);
        taskBox.value = '';
    });

    taskList.addEventListener('click', function (event) {
        if (event.target.tagName === 'LI') {
            event.target.classList.toggle('checked');
            event.target.classList.toggle('unchecked');
        }
    });

    taskList.addEventListener('click', function (event) {
        if (event.target.tagName === 'BUTTON' && event.target.classList.contains('delete-button')) {
            taskList.removeChild(event.target.parentElement);
        }
    });
});

