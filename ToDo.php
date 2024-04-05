<?php
    session_start();
    // Remember to change to your own database
        define('DB_USER', 'nvu24');
        define('DB_PASS', 'nvu24');
        define('DB_NAME', 'nvu24');
        define('DB_HOST', 'localhost');
        
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>To-Do App</title> 
        <link rel="stylesheet" type="text/css" href="styles.css" />
    </head>
    <header>
        <img id = logo
        src="./Images/logo3.jpg "  style="width: 150px; height:150px;" >
        <img id = banner
        src="./Images/banner.jpg "  style="width: 1000px; height:150px;" >
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
        <!-- class "container" is the large white box on the page -->
        <div class="container">
            <?php      
                if (isset($_SESSION['userid'])) {
                    echo "Welcome User: " . $_SESSION['userid'];
                } 
                else {
                    echo "Userid not found in session";
                }
            ?>
            <!-- class "task" is the container -->
            <div class="task">
                <h3>Tasks to be done:</h3>
                <!-- class "input" is where the user inputs the task. It's the textbox -->
                <!-- <form> -->
                    <div class="input">
                        <form id = "tasks" method="POST" action="ToDo.php"> <!--Error Here -->
                            <input type="text" id="input-task" class="input-task" name="taskDescription" placeholder="Enter a task" title="Input task">
                            <select name="time" id="time" title="Select period of notifications for the task" required>
                                <option selected value="none">Do Not Notify (Forget about it)</option>
                                <option value="demo">30 seconds (Demo)</option> <!-- TODO: add this into the notification list in js -->
                                <option value="30m">30 minutes (URGENT)</option>
                                <option value="1h">1 hour (Important)</option>
                                <option value="2h">2 hours (Normal)</option>
                                <option value="3h">3 hours (Not Important)</option>
                            </select>
                            <button id="submitTask" name="submitTask" type="submit">Add Task</button>
                            <button type="clear" id="clearTask" name="clearTask">Clear All Task</button>
                        </form>
                    </div>
                <ul id="task-items">
                    <?php 
                        // echo "Request_Method" . $_SERVER["REQUEST_METHOD"];
                        $taskDescription = $_POST['taskDescription'];
                        $userID = $_SESSION['userid'];
                        if(($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['submitTask']))) {
                            // echo " inside first if statement";
                            if ($_POST['taskDescription'] !== ""){
                                $sql = "INSERT INTO tasks (description, userid) VALUES ('$taskDescription', '$userID')"; 
                            }
                            if (mysqli_query($conn, $sql)) { // Prints the all the tasks in the db
                                $result = mysqli_query($conn, "SELECT * FROM tasks WHERE userid = $userID");
                                // echo " Successfully added";
                                if(mysqli_num_rows($result) > 0) {
                                    echo "<ul>";
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo "<li>" . $row['description'] . "</li>";
                                    }
                                    echo "</ul>";
                                    // echo " Successfully done";
                                } 
                                else {
                                    // echo "No tasks available.";
                                }
                            } 
                            else {
                                echo "Error inserting task: " . mysqli_error($conn);
                            }
                            // echo "outside of all first set of if statements";
                        }
                        else if (isset($_POST['clearTask'])) {
                            $sql = "DELETE FROM tasks WHERE userid = $userID";

                            if (($_SERVER["REQUEST_METHOD"] == "POST") && (mysqli_query($conn, $sql))) {
                                // alert("All tasks deleted successfully"); Do this in js
                            } else {
                                echo "Error deleting tasks: " . mysqli_error($conn) . "<br>";
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
        <script src="script3.js"></script> <!--To use the javascript, we CANNOT run more than 1 addEventListeners in the JS file-->
    </body>
    <footer>
        <p>&copy; 2024 Innov8tors, All Rights Reserved</p>
        <p>Designed by Innov8tors</p>
    </footer>
</html>