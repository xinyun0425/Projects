<?php
    include('session.php');
    $con = mysqli_connect("localhost","root","","rwdd_assignment");

    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL:".mysqli_connect_error();
    } 
    if (isset($_GET['stuQuizID'])) {
        
        $stu_quiz_id = intval($_GET['stuQuizID']);
        $quizIDScore = mysqli_query($con, 
        "SELECT stq.stu_quiz_id, stq.class_quiz_id, stq.score, q.quiz_name, q.quiz_description, SUM(ques.question_score) AS TotalQuizScore FROM student_take_quiz stq 
        INNER JOIN class_quiz cq on stq.class_quiz_id = cq.class_quiz_id
        INNER JOIN quiz q ON cq.quiz_id = q.quiz_id 
        INNER JOIN question ques ON q.quiz_id = ques.quiz_id 
        WHERE stq.stu_quiz_id = $stu_quiz_id
        GROUP BY stq.stu_quiz_id, stq.class_quiz_id, stq.score, q.quiz_name, q.quiz_description");
        $QID_Score = mysqli_fetch_array($quizIDScore);
    } else {
        echo "<script>alert('Please choose a quiz.');window.location.href='stuViewAllUnattemptedQuizzes.php';</script>";
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
        *{
            font-family: "Open Sans", sans-serif;
            box-sizing:border-box;
        }
        @media only screen and (min-width: 320px) and (max-width:767px){
            
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
            height`:50px;
        }

        .dropdown-content a:hover {
            background-color: #fff2e5;
        }

        .show {
            display:block;
        }

        .content-div{
            padding:40px 80px;
        }
        
        .btn-div{
            text-align:center;
            padding-top:80px;
        }
        .reviewquizbtn{
            padding:10px 100px;
            border-radius:40px;
            background-color:#d81b60;
            color:white;
            border:none;
            font-size:20px;
            margin-top:20px;
            margin-bottom:20px;
        }

        .reviewquizbtn:hover{
            transform:scale(1.1);
        }

        .backtomainpage:hover{
            color:#D81B60;
        }
    </style>
</head>
<body>
    <div style="position:sticky; z-index:1; top:0; height: 73px;background-color:#FBF8F5">
        <div style="float:left; padding:10px 10px 10px 30px;">
            <img src="logo.png" style="width:150px;" onclick="stuHP()">
        </div>
        <div style="float:right; padding-right:40px;">
            <button type="button" class="notificationProfileBtn" onclick="window.location.href='stuViewAnnouncementPage.php?user_id=<?php echo $_SESSION['user_id']; ?>&page_before_announcement=stuViewResultPage.php'">
                <img src="notificationbtn.png" style="width:55px;">
            </button>
            <div class="dropdown">
                <button class="dropbtn" id="dropbtn" type="button" onclick="profileDropDown()">
                    <img src="stuprofilebtn.png" style="width:50px;">
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="StuProfilePage.php?page_before_profile=stuViewResultPage.php?"> 
                        <img src="profileIcon.png">Profile
                    </a>
                    <a href="logoutPage.php?page_before_logout=stuViewResultPage.php?"> 
                        <img src="logoutIcon.png"> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="content-div">
        <br>
        <h1 style="font-size:40px;"><?php echo $QID_Score['quiz_name'];?></h1>
        <p style="font-size:20px;"><?php echo $QID_Score['quiz_description'];?></p>
        <br>
     </div>
     <div class="col-11" style="background-color:#FBF8F5; margin-left:auto; margin-right:auto; padding:20px 40px; text-align:center;">    
        <p style="font-size:25px; padding-top:20px;">Thanks for submitting.</p>
        <p style="font-size:25px;">Score: &nbsp;<?php echo $QID_Score['score']; ?> / <?php echo $QID_Score['TotalQuizScore'];?></p>
    </div>
    <div class="btn-div">
        <button type="button" onclick="window.location.href='stuReviewQuizPage.php?stuTakeQuizID=<?php echo $QID_Score['stu_quiz_id'];?> '" class="reviewquizbtn">Review Quiz</button>
        <br>
        <a href="StuMainPage.php?user_id=<?php echo $_SESSION['user_id']; ?>" class="backtomainpage">< Back to Main Page</a>
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

        function stuHP(){
            window.location.href="StuMainPage.php?user_id=<?php echo $_SESSION['user_id']; ?>";
        }


    </script>
</body>
</html>