// Beginning of ToDo.html file
document.addEventListener('DOMContentLoaded', function () {
    const taskInput = document.getElementById('input-task');
    const addButton = document.getElementById('submitTask');
    const clearButton = document.getElementById('clearTask');
    const timeSelect = document.getElementById('time');
    const taskList = document.getElementById('task-items');
    
    // Object to store timer IDs for each task
    const timers = {};

    // // Add Task
    // addButton.addEventListener('click', addTask);

    // // Delete Task and Stop Timer
    // taskList.addEventListener('click', function (e) {
    //     if (e.target.classList.contains('delete-button')) {
    //         const taskItem = e.target.parentElement;
    //         const taskId = taskItem.dataset.taskId;
    //         clearTimeout(timers[taskId]);
    //         taskItem.remove();
    //         delete timers[taskId];
    //     } else if (e.target.tagName === 'LI') {
    //         const taskItem = e.target;
    //         const taskId = taskItem.dataset.taskId;
    //         taskItem.classList.toggle('checked');
    //         // Pause or resume timer based on task checked status
    //         if (taskItem.classList.contains('checked')) {
    //             clearTimeout(timers[taskId]);
    //         } else {
    //             const taskText = taskItem.textContent.trim();
    //             const timeValue = timeSelect.value;
    //             startTimer(taskText, timeValue, taskId);
    //         }
        // }
    });

    // Notification Logic
    audio1 = new Audio('https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3');
    function notifyTask(task, time) {
        // Convert time to milliseconds
        let notificationTime = 0;
        switch (time) {
            case '30m':
                notificationTime = 30 * 60 * 1000;
                audio1.play();
                break;
            case '1h':
                notificationTime = 60 * 60 * 1000;
                audio1.play();
                break;
            case '2h':
                notificationTime = 2 * 60 * 60 * 1000;
                audio1.play();
                break;
            case '3h':
                notificationTime = 3 * 60 * 60 * 1000;
                audio1.play();
                break;
            default:
                return; // If time is 'none' or invalid, do not set notification
        }
        return setTimeout(() => {
            alert(`Reminder: ${task}`);
        }, notificationTime);
    }

    // Start Timer for Task
    function startTimer(task, time, taskId) {
        timers[taskId] = notifyTask(task, time);
    }

    // Add Task
    function addTask() {
        const taskText = taskInput.value.trim();
        if (taskText !== '') {
            const taskItem = document.createElement('li');
            taskItem.textContent = taskText;
            const taskId = Date.now().toString(); // Unique ID for the task
            taskItem.dataset.taskId = taskId;
            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'X';
            deleteButton.className = 'delete-button';
            taskItem.appendChild(deleteButton);
            taskList.appendChild(taskItem);
            const timeValue = timeSelect.value;
            startTimer(taskText, timeValue, taskId);
            taskInput.value = ''; // Clear input box after adding task
            console.log("task added");
        } else {
            alert('Please enter a task.');
        }
    }
