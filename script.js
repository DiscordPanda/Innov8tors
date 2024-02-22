
// Beginning of the login.html animation(s)
var x = document.getElementById('login');
var y = document.getElementById('register');
var z = document.getElementById('button-color');
function register() {
    x.style.left = "-400px";
    y.style.left = "0px";
    z.style.left = "110px";
}
function login() {
    x.style.left = "0";
    y.style.left = "400px";
    z.style.left = "0px";
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

