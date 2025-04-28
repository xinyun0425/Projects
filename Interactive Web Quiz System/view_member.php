<?php 
include('session.php');
if (isset($_GET['class_id'])) {
    $class_id = $_GET['class_id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>+  Math</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Nanum+Myeongjo&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Sour+Gummy:wdth,wght@101.8,500&display=swap'); 
        
        /* For mobile phones: */
        @media only screen and (max-width:767px) {
            .announcementmainPage{
                padding: 20px 60px;
            }
        }

        @media only screen and (min-width: 768px) {
            /* For desktop: */
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

            .announcementmainPage{
                padding: 20px 80px;
            }
        }

        * {
            box-sizing:border-box;
            font-family: "Open Sans", sans-serif;
        }
        
        .notificationProfileBtn {
            border-style:none; 
            background-color:transparent;
            padding:10px;
            cursor: pointer;
        }
  
        .notificationProfileBtn:hover {
            background-color: #f7e3c8;
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
            bbackground-color: #f7e3c8;
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
            background-color: #ddd;
        }
  
        .show {
            display:block;
        }

        .header {
            background-color: #D81B60; 
            color: white; 
            padding: 2px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px; /* To add rounded corners */
            max-width: 1500px; /* Adjust to your preference */
            margin-left:0px;
            margin-right:0px;
            margin-top:20px;
        }

        .postbutton{
            border:black;
            background-color:pink;
            padding:4px 20px;
            text-align:center;
            font-size: 16px;
            margin:10px 2px 10px 0px;
            cursor:pointer;
            border-radius:8px;
        }

        .postbutton:hover{
            opacity: 70%;
        }

        .membersbutton{
            border:2px solid black;
            background-color:pink;
            padding:4px 20px;
            text-align:center;
            font-size: 16px;
            margin:10px 0px 10px 2px;
            cursor:pointer;
            border-radius: 8px;
        }

        .membersbutton:hover{
            opacity: 70%;
        }

        .announcement-frame{
            padding:4px ;
            margin:10px 0px;
            height:auto;
            max-width:100%;
            overflow-y:auto;
        }

        .announcement_header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            font-size:16px;
            margin-bottom:20px;
        }

        .teacher_info{
            display:flex;
            align-items:center;
        }

        .teacher_name{
            margin-left:20px;
            background-color:pink;
            padding:5px 5px 5px 5px;
        }

        .announcement_text{
            font-size:16px;

        }

        .messageframe{
            display:flex;
            align-items:center;
            border:1px solid black;
            padding:3px 10px;
            margin-top:10px;
            margin-right:3px;
            border-radius:8px;
            width: 1260px;
        }

        .message_input{
            flex:1;
            border:none;
            outline:none;
            font-size:16px;
            padding:5px;
            border-radius:20px;
            margin-right:10px;
            background-color:transparent;
            box-shadow:none; 
        }

        .message_button{
            background: url('submitBtn.png') no-repeat center;
            background-size: contain;
            width: 40px; /* Slightly larger button */
            height: 40px; /* Slightly larger button */
            border: none;
            cursor: pointer;
            margin-left:auto;
        }

        .view_all_quizzes_button{
            background: url('ViewAllQuizzesButton.png') no-repeat center;
            background-size: contain;
            width: 40px; /* Slightly larger button */
            height: 40px; /* Slightly larger button */
            border: none;
            cursor: pointer;
            margin-top:10px;
        }

        .message_header{
            display:flex;
            position:sticky;
            bottom:10px;
            align-items:center;
            font-size:16px;
            margin-bottom:20px;
            margin:10px 100px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 16px;
        }

        table.center {
            margin-left: auto; 
            margin-right: auto;
        }

        th {
            padding: 15px ;
            text-align: left;
            border-bottom: 2px solid #7d7979;
        }
        
        td {
            padding: 20px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .row_hover:hover {
            background-color: #FBF8F5;
            cursor: pointer;
        }              
    </style>  
</head>
<body>
<div style="position:sticky; z-index:1; top:0; height: 73px;background-color:#FBF8F5;">
    <div style="float:left; padding:10px 10px 10px 30px; cursor: pointer">
        <img src="logo.png" style="width:150px;" onclick="window.location.href='TeaMainPage.php'">
    </div>
    <div style="float:right; padding-right:40px;">
        <div class="dropdown">
            <button class="dropbtn" id="dropbtn" type="button" onclick="profileDropDown()">
                <img src="stuprofilebtn.png" style="width:50px;">
            </button>
            <div id="myDropdown" class="dropdown-content">
                <a href="teaProfilePage.php?page_before_profile=view_member.php?class_id=<?php echo $class_id; ?>&"> 
                    <img src="profileIcon.png">Profile
                </a>
                <a href="logoutPage.php?page_before_logout=view_member.php?class_id=<?php echo $class_id; ?>&"> 
                    <img src="logoutIcon.png"> Logout
                </a>
            </div>
        </div>
    </div>
</div>
    <br>
    <button class="back" type="submit" name="back" onclick="window.location.href='view_all_class.php'">< Back</button>
    <div class="announcementmainPage">
        <?php
            $con = mysqli_connect("localhost", "root", "", "rwdd_assignment");

            if (mysqli_connect_errno()) {
                die("Failed to connect to MySQL: " . mysqli_connect_error());
            }

            if (isset($_GET['class_id'])) {
                $class_id = mysqli_real_escape_string($con, $_GET['class_id']);

                $class_query = "SELECT class_name FROM class WHERE class_id = '$class_id'";
                $class_result = mysqli_query($con, $class_query);
    
                if ($class_row = mysqli_fetch_assoc($class_result)) {
                    $class_name = $class_row['class_name'];
    
                    $student_query = "SELECT student_id, student_name FROM student WHERE class_id = '$class_id' ORDER BY student_name";
                    $student_result = mysqli_query($con, $student_query);

                    $teacher_query = "SELECT class.class_id, teacher.teacher_name FROM class INNER JOIN teacher ON class.teacher_id = teacher.teacher_id WHERE class.class_id = '$class_id'";
                    $teacher_result = mysqli_query($con, $teacher_query);
                } else {
                    echo "<script>
                            alert('Class not found.');
                            window.location.href = 'view_class_main_page.php';
                          </script>";
                    exit();
                }
            } else {
                echo "<script>
                        alert('No class selected.');
                        window.location.href = 'view_class_main_page.php';
                      </script>";
                exit();
            }

            
        ?>

    
        <div class="header">
            <h2><?php echo $class_name; ?></h2>
        </div>
        <div>
            <button class="postbutton" type="submit" name="post" onclick="window.location.href='view_class_main_page.php?class_id=<?php echo $class_id; ?>'">Posts</button>
            <button class="membersbutton" >Members</button>
        </div>

        <div class="announcement-frame">
            <h3>Teacher</h3>
        <table>
            <tr>
                <th style="width:70%;">Name</th>
                <th style="width:30%;">Role</th>
            </tr>
            <?php 
                if (mysqli_num_rows($teacher_result) > 0) {
                    while ($teacher = mysqli_fetch_assoc($teacher_result)) { ?>
                        <tr class="row_hover">
                            <td><?php echo htmlspecialchars($teacher['teacher_name']); ?></td>
                            <td>Teacher</td>
                        </tr>
                    <?php 
                    }
                } else { ?>
                    <tr>
                        <td colspan="2">No teacher in this class.</td>
                    </tr>
                <?php 
                } 
                ?>
        </table>

        <br><br>

        <table id="student_table">
            <h3>Student</h3>
            <tr>
                <th style="width:70%;">Name</th>
                <th> Role </th>
            </tr>
            
            <?php 
                if (mysqli_num_rows($student_result) > 0) {
                    while ($student = mysqli_fetch_assoc($student_result)) { ?>
                        <tr class="row_hover">
                            <td><?php echo htmlspecialchars($student['student_name']); ?></td>
                            <td>Student</td>
                        </tr>
                    <?php 
                    }
                } else { ?>
                    <tr>
                        <td colspan="2">No student in this class.</td>
                    </tr>
                <?php 
                } 
            ?>
        </table>
   
    </div>
    </div>
        
    <script>
        function profileDropDown() {
            document.getElementById("myDropdown").classList.toggle("show");
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

    <script>
            const ann_date="<?php echo $announcement_date;?>";
            const date = new Date(ann_date);
            let hours = date.getHours();
            const minutes = date.getMinutes().toString().padStart(2, '0');
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12 || 12; 
            const formattedTime = ${hours}:${minutes} ${ampm};
    </script>    
    
</body>
</html>