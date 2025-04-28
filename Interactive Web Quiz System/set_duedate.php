<?php
include('session.php');
$class_id = $_GET['class_id'];
$quiz_id = $_GET['quiz_id'];
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
            
            .bottom-part{
                display:flex;
                flex-direction:column;
                gap:10px;
                position:sticky;
                bottom:0;
                width:100%;
            
            }

            .bottom-part button{
                display: block;
                width: 100%;         
                margin: 10px auto; 
                width:100%;
                box-sizing:border-box;
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

        .input-field {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom:100px;
        }

        .skip-btn{
            background-color:white;
            border:1px solid black;
            padding:12px 30px 12px 30px;
            text-align:center;
            display:inline-block;
            font-size:16px;
            margin:50px;
            cursor:pointer;
            color:black;
            border-radius:5px;
            cursor:pointer;
        }

        .confirm-btn{
            background-color:orange;
            border:none;
            padding:12px 30px 12px 30px;
            text-align:center;
            display:inline-block;
            font-size:16px;
            cursor:pointer;
            color:white;
            border-radius:5px;
        }

        .bottom-part{
            display:flex;
            justify-content:right;
            position:sticky;
            bottom:0;
        }
    </style>
</head>
<body>
<div style="position:sticky; top:0; z-index:1; height: 73px;background-color:#FBF8F5;">
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
        $quiz_id = mysqli_real_escape_string($con,$_GET['quiz_id']);
    ?>
    <button class="back" type="submit" name="back" onclick="window.location.href='send_quiz.php?class_id=<?php echo $class_id; ?>'">< Back</button>

    <div class="announcementmainPage">
        <h2>Select due date</h2>
        <br>
        <input type="hidden" name="class_id" value="<?php echo $class_id;?>">
        <label for="due_date">Due Date:</label>
        <input type="date" id="due_date" name="due_date" class="input-field"><br>
        <label for="due-time">Due Time:</label>
        <input type="time" id="due_time" name="due_time" class="input-field"><br>
        <div class="bottom-part">
            <div>
                <button type="button" class="skip-btn" value="Skip" onclick="SkipBtn()">Skip</button>
                <button type="submit" class="confirm-btn" value="Confirm" onclick="ConfirmBtn()">Confirm</button>
            </div>
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

        function SkipBtn(){
            window.location.href="send_quiz_confirmation.php?class_id=<?php echo $class_id; ?>&selected_quiz=<?php echo $quiz_id; ?>&due_date=" + null + "&due_time=" + null;
        }

        function ConfirmBtn(){
            const due_date = document.getElementById('due_date').value;
            const due_time = document.getElementById('due_time').value;
            const now = new Date();
            const current_date = String(now.getFullYear())  +'-' +  String(now.getMonth()+ 1).padStart(2, '0') +'-'+ String (now.getDate()).padStart(2,'0') ;
            const current_time = String(now.getHours()).padStart(2,'0') + ':' + String(now.getMinutes()).padStart(2,'0');

            if (due_date == "" || due_time == ""){
                alert('Please input all fields.');
            }else {
                if (due_date > current_date){
                    window.location.href="send_quiz_confirmation.php?class_id=<?php echo $class_id; ?>&selected_quiz=<?php echo $quiz_id; ?>&due_date=" + due_date + "&due_time=" + due_time;
                }else{
                    if (due_date == current_date){
                        if (due_time <= current_time){
                            alert('Please select a future time.');
                        }else{
                            window.location.href="send_quiz_confirmation.php?class_id=<?php echo $class_id; ?>&selected_quiz=<?php echo $quiz_id; ?>&due_date=" + due_date + "&due_time=" + due_time;
                        }
                    }else{
                        alert('Please select a future date.');
                    }
                }
            }
        }
        
    </script>
    
</body>
</html>