<?php 
    include('session.php');
    if (isset($_GET['class_id'])&&isset($_GET['user_id'])){
        $class_id = $_GET['class_id'];
        $teacher_id = $_GET['user_id'];
    }else if (isset($_GET['class_id'])&&isset($_SESSION['user_id'])){
        $class_id = $_GET['class_id'];
        $teacher_id = $_SESSION['user_id'];
    }

    $con=mysqli_connect("localhost","root","","rwdd_assignment");

    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL:".mysqli_connect_error();
    }

    $sql="SELECT q.quiz_id, q.quiz_name, q.creation_time FROM quiz q 
    WHERE q.quiz_id NOT IN (SELECT quiz_id FROM class_quiz WHERE class_id = '$class_id') 
    AND q.teacher_id = '$teacher_id'
    GROUP BY q.quiz_name, q.creation_time
    ORDER BY q.quiz_name
    ";

    $result=mysqli_query($con,$sql);
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

            .next-btn{
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
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #7d7979;
        }
        
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .row_hover:hover {
            background-color: #FBF8F5;
            cursor: pointer;
        }

        .bottom-part{
            justify-content:right;
            position:sticky;
            bottom:40px;
            height: 73px;
            float:right;
        }

        .next-btn{
            background-color:#d81b60;
            border:none;
            padding:12px 30px 12px 30px;
            text-align:center;
            font-size:16px;
            cursor:pointer;
            color:white;
            border-radius:5px;
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
                <a href="teaProfilePage.php?page_before_profile=TeaMainPage.php"> 
                    <img src="profileIcon.png">Profile
                </a>
                <a href="logoutPage.php?page_before_logout=TeaMainPage.php"> 
                    <img src="logoutIcon.png"> Logout
                </a>
            </div>
        </div>
    </div>
</div>
    <br>
    
    <button class="back" type="button" name="back" onclick=" window.location.href='view_class_main_page.php?class_id=<?php echo $class_id; ?>'">< Back</button>

    <div class="announcementmainPage">
        <h1>All Created Quizzes</hi>
        <h3>Please select a quiz to send<h3>
    <div>
        <?php
           
        ?>
        <table id="quiz table">
            <tr>
                <th style="width:10%"></th>
                <th style="width:70%">Quiz Name</th>
                <th style="width:20%">Date Created</th>
            </tr>
            
            <?php
                if (mysqli_num_rows($result) <= 0){
            ?>
                <tr>
                    <td></td>
                    <td>All quizzes are sent to this class</td>
                    <td></td>
                </tr>
            <?php 
                }else{
                    while ($row=mysqli_fetch_array($result)){
                        $quiz_name=$row['quiz_name'];
            ?>
                <tr class="row_hover">
                    <td><input type="radio" name="selected_quiz" value="" <?php echo $quiz_name;?> data-quiz-id ="<?php echo $row['quiz_id'];?>"  onclick="selectQuiz(this)" required ></td>
                    <td><?php echo $row['quiz_name'];?></td>
                    <td><?php echo $row['creation_time'];?></td>
                </tr>
            <?php                
                    }
                }
            ?>
        </table>
    </div>   
    </div>
    <div class="announcementmainPage bottom-part">
        <div class="bottom-part">
            <button type="submit" class="next-btn" value="Next" onclick="validateSelection()">Next</button>
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
        let selectedQuizId = null;
        const class_id_selected = <?php echo $class_id; ?>;
        function selectQuiz(row){
            const rows = document.querySelectorAll('.row_hover');
            rows.forEach(r => r.classList.remove('selected'));
            row.classList.add('selected'); 
            selectedQuizId = row.getAttribute('data-quiz-id');
            console.log("Selected Quiz ID:", selectedQuizId);
        }

        function validateSelection() {
            if (selectedQuizId) {        
                window.location.href = 'set_duedate.php?class_id=' + class_id_selected +'&quiz_id=' + selectedQuizId;
            } else {
                alert('Please select a quiz before proceeding.');
            }
        }
    </script>

</body>
</html>