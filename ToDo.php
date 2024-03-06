<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>To-Do App</title> 
        <link rel="stylesheet" type="text/css" href="styles.css" />
    </head>
    <header>
    <h1 class="GroupName">Innov8tors</h1>
    </header>
        <!-- Attributes for links to other pages -->
        <div class="topnav"><!--Navigation bar style-->
            <nav>
                <div class="navbar">
                    <a class="header-links" href="https://icollege.gsu.edu/" target="_blank" title="Open up GSU's iCollege website">
                        iCollege(GSU)
                    </a>
                    <a class="header-links" href="https://outlook.office365.com/mail/" target="_blank" title="Open up Outlook">
                        Outlook
                    </a>
                    <a class="header-links" href="https://onedrive.live.com/login/" target="_blank" title="Open up OneDrive">
                        OneDrive
                    </a>
                    <a class="header-links" href="https://www.dropbox.com/" target="_blank" title="Open up Dropbox">
                        Dropbox
                    </a>
                </div> 
            </nav>
        </div>

    <body>
        
    <?php
    session_start(); 
    if (!isset($_SESSION['userid'])) {
    header("Location: ToDo.php");
} else {
    echo "Welcome User: {$_SESSION['userid']}<br>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Redirect to the registration page
    header("Location: ToDo.php");
    exit();
}
?>


        <!-- class "container" is the large white box on the page -->
        <div class="container">
            <!-- class "task" is the container -->
            <div class="task">
                <h3>Tasks to be done:</h3>
                <!-- class "input" is where the user inputs the task. It's the textbox -->
                <div class="input">
                    <input type="text" class="input-task" id="task-box" placeholder="Enter a task" title="Input task">
                    <button title="Add task">Add Task</button>
                    <button title="Clear task">Clear All Task</button>
                    <select name="time" id="time" title="Select period of notifications for the task" required>
                        <option hidden disabled selected value>Notify Every</object>
                        <option disabled value>--Notify Every--</option>
                        <option value="30m">30 minutes (URGENT)</option>
                        <option value="1h">1 hour (Important)</option>
                        <option value="2h">2 hours (Normal)</option>
                        <option value="3h">3 hours (Not Important)</option>
                        <option value="none">Do Not Notify (Forget about it)</option>
                    </select>
                    <!-- <select name="priority" id="priority" title="Select the priority of the task">
                        <option hidden disabled selected value>Choose Priority</object>
                        <option disabled value>--Choose Priority--</option>
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select> -->
                </div>
                <!-- id "task-items" is the list of tasks that are added. checked class = completed. unchecked class = incomplete -->
                <ul id="task-items">
                    <!-- These are example of completed and incomplete tasks -->
                    <li class="checked">Task 1</li>
                    <li class ="unchecked">Task 2</li>
                    <li class ="unchecked">Task 3</li>
                    <!-- TODO:JavaScript Comes here -->
                </ul>
            </div>
        </div>
        <script src="script.js"></script>
    </body>
    <footer>
        <p>&copy; 2024 Innov8tors, All Rights Reserved</p>
        <p>Designed by Innov8tors</p>
    </footer>
</html>