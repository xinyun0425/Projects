<?php
include('session.php');
if (isset($_GET['class_id'])) {
    $class_id =$_GET['class_id'];
}
date_default_timezone_set('Asia/Kuala_Lumpur');
$con=mysqli_connect("localhost","root","","rwdd_assignment");
$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send-btn'])) {
    $class_id = mysqli_real_escape_string($con, $_POST['class_id']);
    $quiz_id = mysqli_real_escape_string($con, $_POST['quiz_id']);
    $due_date = mysqli_real_escape_string($con, $_POST['due_date']);
    $due_time = mysqli_real_escape_string($con, $_POST['due_time']);
    $post_date = date('Y-m-d H:i:s');

    // Handle null due date/time
    $due_date = ($due_date === '-') ? NULL : $due_date;
    $due_time = ($due_time === '-') ? NULL : $due_time;

    // Insert the quiz details into the database
    $class_quiz_query = "INSERT INTO class_quiz (post_date, due_date, due_time, class_id, quiz_id) 
                         VALUES ('$post_date', " . ($due_date ? "'$due_date'" : "NULL") . ", 
                                 " . ($due_time ? "'$due_time'" : "NULL") . ", 
                                 '$class_id', '$quiz_id')";

    if (mysqli_query($con, $class_quiz_query)) {
        $success = true;  // Set success flag if insertion is successful
    } else {
        $error_message = mysqli_error($con);
    }
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
            .modal-content {
                background-color: #fefefe;
                margin: 5% auto 15% auto; 
                border: 1px solid #888;
                width: 50%;
            }

            table {
                width: 100%; 
                border-spacing: 10px 10px; 
                margin-left:25px;
            }

            td {
                display: block; 
                width: 100%; 
                text-align: left;
                padding: 10px; 
                
            }

            td:first-child {
                font-weight: bold; 
                width: auto; 
                
            }

            td:nth-child(2) {
                display: none; 
            }

            td:nth-child(3) {
                background-color: #ddd; 
                border-radius: 5px; 
                padding: 10px; 
                margin-bottom: 15px; 
            }

            .button-container {
                text-align: left; 
                bottom: 20px;      
                left: 0;
                right: 0;
                background-color: white; 
                padding: 5px 0px;  
            }
        
            .button-container button {
                display: block;
                width: 100%;         
                margin: 10px auto;  
            }
            
            .container {
                padding-left: 50px;
                padding-right: 100px;
                padding-bottom: 50px;
                padding-top: 25px;
                text-align:center;
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
            .modal-content {
                background-color: #fefefe;
                margin: 11% auto 15% auto; 
                border: 1px solid #888;
                width: 40%;
                height:45%;
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
            background-color: #ddd;
        }
  
        .show {
            display:block;
        }

        .class_name{
            background-color:#d9d9d9;
        }

        table{
            border-collapse: collapse;
            width:100%;
            font-size:16px;
        }

        td{
            padding:20px;
            text-align:left;
        }

        td:first-child{
            width:10%;
        }

        td:nth-child(2){
            width:5%;
            
        }

        td:nth-child(3){
            width:85%;
            background-color:#ddd;
            border-radius:5px;
            padding:10px;
            margin-top:5px;
            margin-bottom:5px;
            display:inline-block;

        }

       
        .button-container{
            text-align:right;
            padding:25px;
        }

        .cancel-btn{
            background-color:white;
            border:1px solid black;
            padding:12px 30px 12px 30px;
            text-align:center;
            display:inline-block;
            font-size:16px;
            margin-right:15px;
            cursor:pointer;
            color:black;
            border-radius:5px;
        }

        .send-btn{
            background-color:#d81b60;
            border:none;
            padding:12px 35px 12px 35px;
            text-align:center;
            display:inline-block;
            font-size:16px;
            margin:0;
            cursor:pointer;
            color:white;
            border-radius:5px;
            cursor:pointer;
        }

        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px;
        }

        .animate {
            -webkit-animation: animatezoom 0.6s;
            animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom {
            from {-webkit-transform: scale(0)} 
            to {-webkit-transform: scale(1)}
        }
            
        @keyframes animatezoom {
            from {transform: scale(0)} 
            to {transform: scale(1)}
        }

        .container {
            padding-left: 50px;
            padding-right: 50px;
            padding-bottom: 50px;
            padding-top: 50px;
            text-align:center;
            font-size:25px;
        }

        .back_to_class{
            color:#5271ff;
            text-decoration: underline;
            cursor:pointer;
            border:none;
            background-color:white;
            font-size:20px;
        }

        .back_to_class:hover{
            color:#d81b60;
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
                <a href="teaProfilePage.php?page_before_profile=TeaMainPage.php?"> 
                    <img src="profileIcon.png">Profile
                </a>
                <a href="logoutPage.php?page_before_logout=TeaMainPage.php?"> 
                    <img src="logoutIcon.png"> Logout
                </a>
            </div>
        </div>
    </div>
</div>
<br>
    <?php 
        $con=mysqli_connect("localhost","root","","rwdd_assignment");
        $class_id = mysqli_real_escape_string($con, $_GET['class_id']);
        $quiz_id = mysqli_real_escape_string($con,$_GET['selected_quiz']);
    ?>
    <button class="back" type="submit" name="back" onclick="window.location.href='set_duedate.php?class_id=<?php echo $class_id; ?>&quiz_id=<?php echo $quiz_id; ?>'">< Back</button>

    <div class="announcementmainPage">
        <?php
            $con = mysqli_connect("localhost", "root", "", "rwdd_assignment");
            
            if (mysqli_connect_errno()) {
                die("Failed to connect to MySQL: " . mysqli_connect_error());
            }

            // Check if class_id is provided
            if (isset($_GET['class_id'])) {
                $class_id = mysqli_real_escape_string($con, $_GET['class_id']);
                
    
                
                // Fetch class details
                $class_query = "SELECT class_name FROM class WHERE class_id = '$class_id'";
                $class_result = mysqli_query($con, $class_query);
    
                if ($class_row = mysqli_fetch_assoc($class_result)) {
                    $class_name = $class_row['class_name'];
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
            
        <?php
         date_default_timezone_set('Asia/Kuala_Lumpur');
            $con=mysqli_connect("localhost","root","","rwdd_assignment");
            $class_id = mysqli_real_escape_string($con, $_GET['class_id']);

            if(mysqli_connect_errno()){
                echo "Failed to connect to MySQL:".mysqli_connect_error();
            }

            if (isset($_GET['class_id'],$_GET['due_date'],$_GET['due_time'],$_GET['selected_quiz'])){
                $class_id = mysqli_real_escape_string($con, $_GET['class_id']);
                $quiz_id = mysqli_real_escape_string($con,$_GET['selected_quiz']);
                $due_date = mysqli_real_escape_string($con, $_GET['due_date']);
                $due_time = mysqli_real_escape_string($con, $_GET['due_time']); 

                $class_query = "SELECT class_name FROM class WHERE class_id = '$class_id'";
                $class_result = mysqli_query($con, $class_query);

                $quizName_query = "SELECT quiz_name FROM quiz WHERE quiz_id = '$quiz_id'";
                $quizName_result = mysqli_query($con, $quizName_query);
                $quiz_row = mysqli_fetch_assoc($quizName_result);
                $quiz_name = $quiz_row['quiz_name'];

                if ($due_date == 'null'){
                    $due_date = '-';
                }

                if ($due_time == 'null'){
                    $due_time = '-';
                }

                if ($class_row = mysqli_fetch_assoc($class_result)) {
                    $class_name = $class_row['class_name'];
                } else {
                    echo "<script>alert('Class not found.'); window.location.href = 'view_class_main_page.php';</script>";
                    exit();
                }
            } else {
                echo "<script>alert('Required data not provided!'); window.location.href = 'set_duedate.php';</script>";
                exit();           
            }
            
            
        ?>

        <h2>Confirmation</h2>

        <table id="confirmation">
        <tr>
            <td><strong>Class Name</strong></td>
            <td>:</td>
            <td class="class_name"><?php echo htmlspecialchars($class_name); ?></td>
        </tr>
        <tr>
            <td><strong>Quiz Name</strong></td>
            <td>:</td>
            <td class="class_name"><?php echo htmlspecialchars($quiz_name); ?></td>
        </tr>
        <tr>
            <td><strong>Due Date</strong></td>
            <td>:</td>
            <td class="class_name"><?php echo htmlspecialchars($due_date); ?></td>
        </tr>
        <tr>
            <td><strong>Due Time</strong></td>
            <td>:</td>
            <td class="class_name"><?php echo htmlspecialchars($due_time); ?></td>
        </tr>
        </table>
        <div class="button-container">
        <!-- Cancel Button -->
            <button class="cancel-btn" type="button" onclick="cancelQuiz()">Cancel</button>
                
                <!-- Send Button -->
            <button style="border:none; background-color:transparent;">
            <form method="post" action="">
                <input type="hidden" name="class_id" value="<?php echo htmlspecialchars($class_id); ?>">
                <input type="hidden" name="quiz_id" value="<?php echo htmlspecialchars($quiz_id); ?>">
                <input type="hidden" name="due_date" value="<?php echo htmlspecialchars($due_date); ?>">
                <input type="hidden" name="due_time" value="<?php echo htmlspecialchars($due_time); ?>">
                <button type="submit" class="send-btn" name="send-btn">Send</button>
            </form>
        </button>
        </div>
        
        <div id="send_pop_out" class="modal">
            <div class="modal-content">
                <div class="container">
                    <img src="successful_icon1.png" width=150>
                    <p>Quiz sent successfully!</p>
                    <button class="back_to_class" type="button"  onclick="window.location.href='view_class_main_page.php?class_id=<?php echo $class_id; ?>&quiz_id=<?php echo $quiz_id;?>'">Back to Class</button>
                </div>
            </div>
        </div>
    </div>
    <?php if ($success) { ?>
    <script>
        // Ensure the modal is shown after successful form submission
        window.onload = function() {
            document.getElementById('send_pop_out').style.display = 'block';
        };
    </script>
<?php } ?>
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
   



        function cancelQuiz() {
    const class_id = <?php echo json_encode($class_id); ?>;
    window.location.href = 'view_class_main_page.php?class_id=' + class_id;
}
        
</script>
    
</body>
</html>