// Beginning of ToDo.html file
document.addEventListener('DOMContentLoaded', function () {
    const taskInput = document.getElementById('input-task');
    const addButton = document.getElementById('submitTask');
    const clearButton = document.getElementById('clearTask');
    const timeSelect = document.getElementById('time');
    const taskList = document.getElementById('task-items');
    
    // Object to store timer IDs for each task
    const timers = {};

    addButton.addEventListener('click', addTask);

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
});
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
    //     }
    // });


    // Notification Logic
    audio1 = new Audio('https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3');
    function notifyTask(task, time) {
        // Convert time to milliseconds
        let notificationTime = 0;
        switch (time) {
            case '5s':
                notificationTime = 5 * 1000;
                audio1.play();
                alert("5s passed");
                break;
            case '30s':
                notificationTime = 30 * 1000;
                audio1.play();
                alert("30s passed");
                break;
            case '1800':
                notificationTime = 30 * 60 * 1000;
                audio1.play();
                break;
            case '3600':
                notificationTime = 60 * 60 * 1000;
                audio1.play();
                break;
            case '7200':
                notificationTime = 2 * 60 * 60 * 1000;
                audio1.play();
                break;
            case '10800':
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
