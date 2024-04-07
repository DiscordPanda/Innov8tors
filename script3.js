// Beginning of ToDo.html file
document.addEventListener('DOMContentLoaded', function () {
    const taskInput = document.getElementById('input-task');
    const addButton = document.getElementById('submitTask');
    const clearButton = document.getElementById('clearTask');
    const timeSelect = document.getElementById('time');
    const taskList = document.getElementById('task-items');
    
    // Object to store timer IDs for each task
    const timers = {};

    // Enter key to add task
    

    // // Add Task
    // addButton.addEventListener('click', addTask);

    // // Delete Task and Stop Timer
 //    taskList.addEventListener('click', function (e) {
   //      if (e.target.classList.contains('delete-button')) {
  //           const taskItem = e.target.parentElement;
  //           const taskId = taskItem.dataset.taskId;
  //           clearTimeout(timers[taskId]);
  //           taskItem.remove();
  //           delete timers[taskId];
  //       } else if (e.target.tagName === 'LI') {
  //           const taskItem = e.target;
  //           const taskId = taskItem.dataset.taskId;
  //           taskItem.classList.toggle('checked');
  //           // Pause or resume timer based on task checked status
 //            if (taskItem.classList.contains('checked')) {
 //                clearTimeout(timers[taskId]);
 //            } else {
 //                const taskText = taskItem.textContent.trim();
 //                const timeValue = timeSelect.value;
 //                startTimer(taskText, timeValue, taskId);
 //            }
 //        }
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
        if (event.key === 'Enter') { // Check if Enter key is pressed
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
    }    
    // This line will now call addTask() directly when Enter key is pressed
    document.onkeypress = addTask;

    // Handling click event without event listeners
    document.onclick = function (event) {
        const clickedElement = event.target;

    // Check if the clicked element is a delete button
        if (clickedElement.classList.contains('delete-button')) {
            const taskItem = clickedElement.parentElement;
            const taskId = taskItem.dataset.taskId;
            clearTimeout(timers[taskId]);
            taskItem.remove();
            delete timers[taskId];
        } else if (clickedElement.tagName === 'LI') {
            const taskItem = clickedElement;
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
    };

  /*  function deleteTask(button) {
        const taskId = button.parentElement.querySelector('input[name="taskId"]').value;
        const userId = "<?php echo $_SESSION['userid']; ?>";
        const formData = new FormData();
        formData.append('taskId', taskId);
        formData.append('userId', userId);

        fetch('ToDo.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                console.log("Task deleted successfully");
            } else {
                throw new Error('Error deleting task');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }*/


    function logout() {
        alert('User successfully logged out');
        window.location.href = 'https://codd.cs.gsu.edu/~eokobiah1/login.php'; // Redirect to login page
    }