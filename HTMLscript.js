document.addEventListener('DOMContentLoaded', function () {
    const taskInput = document.getElementById('task-box');
    const addButton = document.querySelector('button[title="Add task"]');
    const clearButton = document.querySelector('button[title="Clear task"]');
    const timeSelect = document.getElementById('time');
    const taskList = document.getElementById('task-items');

    // Object to store timer IDs for each task
    const timers = {};

    // Add Task
    addButton.addEventListener('click', function () {
        addTask();
    });

    // Enter key to add task
    taskInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            addTask();
        }
    });

    // Clear All Tasks
    clearButton.addEventListener('click', function () {
        taskList.innerHTML = '';
        // Clear all timers when tasks are cleared
        for (const taskId in timers) {
            clearTimeout(timers[taskId]);
        }
        // Reset timers object
        Object.keys(timers).forEach(taskId => delete timers[taskId]);
    });

    // Delete Task and Stop Timer
    taskList.addEventListener('click', function (e) {
        if (e.target.classList.contains('delete-button')) {
            const taskItem = e.target.parentElement;
            const taskId = taskItem.dataset.taskId;
            clearTimeout(timers[taskId]);
            taskItem.remove();
            delete timers[taskId];
        } else if (e.target.tagName === 'LI') {
            const taskItem = e.target;
            const taskId = taskItem.dataset.taskId;
            taskItem.classList.toggle('checked');
            // Pause or resume timer based on task checked status
            if (taskItem.classList.contains('checked')) {
                clearTimeout(timers[taskId]);
            } else {
                const taskText = taskItem.textContent.trim();
                const timeValue = timeSelect.value;
                startTimer(taskText, timeValue, taskId);
            }
        }
    });

    sound = new Audio('https://commondatastorage.googleapis.com/codeskulptor-assets/week7-brrring.m4a');

    // Notification Logic
    function notifyTask(task, time) {
        // Convert time to milliseconds
        let notificationTime = 0;
        switch (time) {
            case '5s':
                notificationTime = 5 * 1000;
                break;
            case '30m':
                notificationTime = 30 * 60 * 1000;
                break;
            case '1h':
                notificationTime = 60 * 60 * 1000;
                break;
            case '2h':
                notificationTime = 2 * 60 * 60 * 1000;
                break;
            case '3h':
                notificationTime = 3 * 60 * 60 * 1000;
                break;
            default:
                return; // If time is 'none' or invalid, do not set notification
        }
        return setTimeout(() => {
            sound.play();
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
        } else {
            alert('Please enter a task.');
        }
    }
});