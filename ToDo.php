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
        src="./Images/logo.jpg "  style="width: 150px; height:150px;" >
        <img id = banner
        src="./Images/banner.jpg "  style="width: 1000px; height:150px;" >
    </header>
        <!-- Attributes for links to other pages -->
        <div class="topnav"><!--Navigation bar style-->
            <nav>
                <div class="navbar">
                    <a class="log-out" href="login.php" target="_blank" title="Log out of the application">
                        Log Out
                    </a>
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
                    <div class="input">
                        <form id = "tasks" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <input type="text" id="input-task" class="input-task" name="taskDescription" placeholder="Enter a task" title="Input task">
                            <select name="time" id="time" title="Select period of notifications for the task" required>
                                <option selected value="0">Do Not Notify (Forget about it)</option>
                                <option value="5s">5 seconds (testing)</option>
                                <option value="30s">30 seconds (Demo)</option> <!-- TODO: add this into the notification list in js -->
                                <option value="1800">30 minutes (URGENT)</option>
                                <option value="3600">1 hour (Important)</option>
                                <option value="7200">2 hours (Normal)</option>
                                <option value="10800">3 hours (Not Important)</option>
                            </select>
                            <button id="submitTask" name="submitTask" type="submit">Add Task</button>
                            <button type="clear" id="clearTask" name="clearTask">Clear All Task</button>
                        </form>
                    </div>
                <ul id="task-items">
                        <?php
                            $taskDescription = $_POST['taskDescription'];
                            $userID = $_SESSION['userid'];

                            
                            if(isset($_GET['taskid'])){
                                $del_id = $_GET['taskid'];
                                $delete = mysqli_query($conn, "DELETE FROM tasks WHERE taskid = $del_id AND userid = $userID");
                                header('location: ToDo.php');
                                exit();
                            }
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitTask'])) {
                                if ($taskDescription !== "") { # Does not add empty task description
                                    $sql = "INSERT INTO tasks (description, userid) VALUES ('$taskDescription', '$userID')";
                                    mysqli_query($conn, $sql);
                                    header('location: ToDo.php');
                                    exit();

                                }
                                else if ($taskDescription == ""){
                                    echo "Please enter a task";
                                }
                            }
                            else if (isset($_POST['clearTask'])) { # Clear all tasks from database
                                $sql = "DELETE FROM tasks WHERE userid = $userID";
                                if (mysqli_query($conn, $sql)) {
                                    echo "<script>alert('All tasks deleted successfully'); window.location.href = 'ToDo.php' </script>";
                                } 
                                else {
                                    echo "Error deleting tasks: " . mysqli_error($conn) . "<br>";
                                }
                            }
                            $load_sql = "SELECT * FROM tasks WHERE userid = $userID";
                            if (mysqli_query($conn, $load_sql)) {
                                        
                                $result = mysqli_query($conn, "SELECT * FROM tasks WHERE userid = $userID ORDER BY taskid DESC"); # Tasks are now added to the top of the list instead of the bottom
                                if (mysqli_num_rows($result) > 0) { # TODO: We need to create a form here to retrieve REQUEST_METHOD
                                    while ($row = mysqli_fetch_assoc($result)) { # Creates a li element with a class and a name and to add the "X" button at the end of task description
                                        $isChecked = $row['done'] == 1 ? 'checked' : 'notchecked'; # could add this to css to "check"
                                        echo "<li class='$isChecked'>" . $row['description'] . "<a href='ToDo.php?taskid=".$row['taskid']."' class='delete-button' >X</a></li>";
                                    }
                                }
                            }
                            else {
                                echo "Error inserting task: " . mysqli_error($conn);
                            }
                            // header('location: ToDo.php');
                        ?>
                </ul>
            </div>
        </div>
        <script src="script3.js"></script> <!--To use the javascript, we CANNOT run more than 1 addEventListeners in the JS file-->`
    </body>
    <footer>
        <p>&copy; 2024 Innov8tors, All Rights Reserved</p>
        <p>Designed by Innov8tors</p>
    </footer>
</html>