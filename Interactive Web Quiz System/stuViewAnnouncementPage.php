<?php
    include('session.php');

    if(isset($_GET['page_before_announcement'])){
        $PageBeforeAnnouncement =$_GET['page_before_announcement'];
    }

    if (isset($_GET['user_id'])) {
        $loginID = $_GET['user_id'];
        
        // Database credentials
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "rwdd_assignment";

        // Create a connection to the database
        $conn = new mysqli($host, $username, $password, $dbname);

        // Check for connection errors
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get the class_id of the logged-in student
        $sql_student = "
            SELECT class_id 
            FROM student 
            WHERE student_id = ?
        ";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>+  Math</title>
</head>
    <style>       
        @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Nanum+Myeongjo&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Sour+Gummy:wdth,wght@101.8,500&display=swap');
        *{
            font-family: "Open Sans", sans-serif;
            box-sizing:border-box;
        }
        
        .col-1 { width: 8.33%; }
        .col-2 { width: 16.66%; }
        .col-3 { width: 25%; }
        .col-4 { width: 33.33%; }
        .col-5 { width: 41.66%; }
        .col-6 { width: 50%; }
        .col-7 { width: 58.33%; }
        .col-8 { width: 66.66%; }
        .col-9 { width: 75%; }
        .col-10 { width: 83.33%; }
        .col-11 { width: 91.66%; }
        .col-12 { width: 100%; }

        .notificationProfileBtn {
            border-style:none; 
            background-color:transparent;
            padding:10px;
            cursor: pointer;
        }

        .notificationProfileBtn:hover {
            background-color:#f7e3c8;
        }

       .back{
            font-size: 16px; 
            background-color:white; 
            border-style:none; 
            padding-left:40px;
        }

        .back:hover{
            color:#D81B60;
        }

        .dropbtn {
            border-style:none; 
            background-color:transparent;
            padding: 10px;
            cursor: pointer;
        }

        .dropbtn:hover, .dropbtn:focus {
            background-color: #f7e3c8;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            margin-top:5px;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            left: -50px;
        }

        .dropdown-content a {
            color: black;
            padding: 0px 10px;
            text-decoration: none;
            display: flex;
            text-align:center;
            align-items:center;
            font-size: 14px;
            gap: 10px;
        }

        .dropdown-content a img{
            width: 50px;
            height:50px;
        }

        .dropdown-content a:hover {
            background-color: #f7e3c8;
        }

        .show {
            display:block;
        }
        @media only screen and (min-width: 768px) {

            .header {
                background-color: #D81B60; 
                color: white;
                text-align: center;
                padding: 20px;
                font-size: 24px;
                font-weight: bold;
                margin-top: 40px;
                margin-left:40px;
                margin-right:40px;
            }
            .announcement-container {
                width: 80%;
                margin: 20px auto;
                display: flex;
                flex-direction: column;
                gap: 20px;
            }

            .announcement-card {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 8px;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                background-color: #fffbf7;
                height: auto;
                margin-top:10px;
                margin-left:40px;
                margin-right:40px;
            }

            .profile {
                display: flex;
                align-items:center;
                width:75%;
            }

            .profile img {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                border: 3px solid black;
                object-fit: cover;
            }

            .teacher-name {
                font-weight: bold;
                font-size: 24px;
                padding-left:15px;
            }

            .class-name {
                font-size: 16px;
                color: gray;
            }

            .context {
                margin-top: 10px;
                font-size: 18px;
                display:flex;
            }

            .date-time {
                font-size: 12px;
                color: gray;
                text-align: right;
            }

            .date-time-div{
                width:25%;
            }
        }
        @media only screen and (min-width: 320px) and (max-width: 767px) {
            .header {
                background-color: #D81B60; 
                color: white;
                text-align: center;
                padding: 20px;
                font-size: 24px;
                font-weight: bold;
                margin-top: 40px;
                margin-left:40px;
                margin-right:40px;
            }
            .announcement-card {
                display: flex;
                flex-direction: column;  /* Stack items vertically */
                justify-content: flex-start;
                align-items: flex-start;
                padding: 15px;
                border: 1px solid #ccc;
                border-radius: 8px;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                background-color: #fffbf7;
                gap: 10px;
                margin-left:40px;
                margin-right:40px;
                margin-top:10px;
            }

            .profile {
                display: flex;
                align-items: center;  /* Vertically center-align the items */
                width:60%;
            }

            .profile img {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                border: 3px solid black;
                object-fit: cover;
            }

            .teacher-name {
                font-weight: bold;
                font-size: 18px;
                padding-left:15px;
            }

            .class-name {
                font-size: 16px;
                color: gray;
            }

            .context {
                margin-top: 10px;
                font-size: 18px;
                display:flex;
            }

            .date-time {
                font-size: 12px;
                color: gray;
                text-align: left; /* Align left on mobile */
                
            }

            .date-time-div{
                width:40%;
            }
        }
                
    </style>
    <body>

    <div style="position:sticky; z-index:1; top:0; height: 73px;background-color:#FBF8F5;">
        <div style="float:left; padding:10px 10px 10px 30px;">
            <img src="logo.png" style="width:150px;cursor:pointer;" onclick="stuHP()">
        </div>
        <div style="float:right; padding-right:40px;">
            <button type="button" class="notificationProfileBtn" onclick="window.location.href='stuViewAnnouncementPage.php?user_id=<?php echo $_SESSION['user_id']; ?>&page_before_announcement=StuMainPage.php'">
                <img src="notificationbtn.png" style="width:55px;">
            </button>
            <div class="dropdown">
                <button class="dropbtn" id="dropbtn" type="button" onclick="profileDropDown()">
                    <img src="stuprofilebtn.png" style="width:50px;">
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="stuProfilePage.php?page_before_profile=stuViewAnnouncementPage.php?"> 
                        <img src="profileIcon.png">Profile
                    </a>
                    <a href="logoutPage.php?page_before_logout=stuViewAnnouncementPage.php?"> 
                        <img src="logoutIcon.png"> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <button class="back" type="submit" name="back" onclick="window.location.href='<?php echo $PageBeforeAnnouncement; ?>?user_id=<?php echo $_SESSION['user_id']; ?>'">< Back</button>
    <div style="margin: 0px 40px;">
        <div class="header">
            Announcement Board
        </div>
        <?php
            if ($stmt = $conn->prepare($sql_student)) {
                $stmt->bind_param("i", $loginID); // Bind the student_id
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($class_id);
                $stmt->fetch();
                $stmt->close();
            
                // Check if the class_id exists
                if ($class_id) {
                    $sql_announcement = "
                        SELECT a.announcement_text, a.announcement_date, t.teacher_name, c.class_name
                        FROM announcement a
                        JOIN teacher t ON a.teacher_id = t.teacher_id
                        JOIN class c ON a.class_id = c.class_id
                        WHERE a.class_id = ?
                        ORDER BY a.announcement_date DESC
                    ";

                    if ($stmt_announcement = $conn->prepare($sql_announcement)) {
                        $stmt_announcement->bind_param("i", $class_id); // Bind the class_id
                        $stmt_announcement->execute();
                        $stmt_announcement->store_result();
                        $stmt_announcement->bind_result($announcement_text, $announcement_date, $teacher_name, $class_name);
                            
                        // Check if there are any announcements
                        if ($stmt_announcement->num_rows > 0) {
                            // Output announcements
                            while ($stmt_announcement->fetch()) {
                                echo '<div class="announcement-card" style="display:block;">';
                                    echo '<div class="col-12" style="display:flex; padding-left:20px;">';
                                        echo '<div class="profile" style="justify-items:left; display:flex;">';
                                            echo '<img src="teachericon.png" alt="Teacher Profile">';
                                            echo '<p class="teacher-name">' . htmlspecialchars($teacher_name) . '</p>';
                                        echo '</div>';
                                        echo '<div class="date-time-div" style="justify-items:right; padding-right:20px;">';
                                            echo '<p class="date-times">' . date("F j, Y, g:i a", strtotime($announcement_date)) . '</p>';
                                        echo '</div>';
                                        
                                    echo '</div>';
                                    echo '<div class="col-12" style="display:flex; flex-direction: column; padding:0px 20px;">';
                                        echo '<p class="context">' . htmlspecialchars($announcement_text) . '</p>';
                                    echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<div class="announcement-card" style="display:block;">';
                            echo '<p style="text-align:center; padding-top:70px; padding-bottom:70px; font-weight:bold; font-size:18px;">No announcements available for your class.</p>';
                            echo '</div>';
                        }
                        $stmt_announcement->close();
                    } else {
                        echo "<p>Error fetching announcements: " . $conn->error . "</p>";
                    }
                } else {
                    echo "<p>Your class information is missing or you are not assigned to a class.</p>";
                }
            } else {
                echo "<p>Error fetching your information: " . $conn->error . "</p>";
            }

        ?>
    </div>
<script>
    function profileDropDown() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    function stuHP(){
        window.location.href="StuMainPage.php?user_id=<?php echo $_SESSION['user_id']; ?>";
    }
    
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn') && !event.target.closest('.dropdown')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    };
</script>
</body>
</html>
