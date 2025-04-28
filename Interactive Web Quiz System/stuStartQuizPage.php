<?php
    include('session.php');
    if (isset($_GET['class_quiz_id'])) {
        $con = mysqli_connect("localhost","root","","rwdd_assignment");

        if(mysqli_connect_errno()){
            echo "Failed to connect to MySQL:".mysqli_connect_error();
        } 
        $nclass_quiz_id = intval($_GET['class_quiz_id']);
        $result = mysqli_query($con, "SELECT q.quiz_id, q.quiz_name FROM quiz q INNER JOIN class_quiz cq on q.quiz_id = cq.quiz_id WHERE cq.class_quiz_id=$nclass_quiz_id");
        $row = mysqli_fetch_array($result);
        $nquiz_id_selected = $row['quiz_id'];
    } else {
        echo "<script>alert('Please choose a quiz');window.location.href='stuViewAllUnattemptedQuizzes.php';</script>";
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
        }
        
        @media only screen and (max-width: 767px) {
            .sqImageMobile{
                width: 100%; 
            }

            .container-right{
                padding-top:100px;
                float:center; 
                text-align:center; 
                background-color:white;
                padding-bottom:50px;
            }
            .sqImageWebsite{
                display:none;
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

            .sqImageMobile{
                display:none;
            }

            .sqImageWebsite{
                width:100%; 
                float:left;
            }

            .container-right{
                float:left; 
                text-align:center; 
                padding-top:300px;
                background-color:white;
                height:500px;
                flex: 1 1 100%;
            }

            .startQuizImageDiv{
                background-color:white;
                height: 800px;
                float:left;
                width: 50%;
                display:flex;
                align-items:center;
            }
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
            padding-left:50px;
            padding-bottom:20px;
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
        `width: 50px;
        height`:50px;
        }

        .dropdown-content a:hover {
            background-color: #fff2e5;
        }

        .show {
            display:block;
        }

        .startQuizBtn {
            font-size: 20px; 
            color:white;
            background-color:#d81b60;
            border-radius:25px;
            border: none;
            padding: 10px 40px;
        }

        .startQuizBtn:hover{
            opacity:0.8;
        }
        
    </style>
</head>
<body>
<div style="position:sticky; top:0; z-index:1; height: 73px;background-color:#FBF8F5;">
        <div style="float:left; padding:10px 10px 10px 30px;">
            <img src="logo.png" style="width:150px;" onclick="stuHP()">
        </div>
        <div style="float:right; padding-right:40px;">
            <button type="button" class="notificationProfileBtn" onclick="window.location.href='stuViewAnnouncementPage.php?user_id=<?php echo $_SESSION['user_id']; ?>&page_before_announcement=stuStartQuizPage.php?class_quiz_id=<?php echo $nclass_quiz_id; ?>&'">
                <img src="notificationbtn.png" style="width:55px;">
            </button>
            <div class="dropdown">
                <button class="dropbtn" id="dropbtn" type="button" onclick="profileDropDown()">
                    <img src="stuprofilebtn.png" style="width:50px;">
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="stuProfilePage.php?page_before_profile=stuStartQuizPage.php?class_quiz_id=<?php echo $nclass_quiz_id; ?>&"> 
                        <img src="profileIcon.png">Profile
                    </a>
                    <a href="logoutPage.php?page_before_logout=stuStartQuizPage.php?class_quiz_id=<?php echo $nclass_quiz_id; ?>&"> 
                        <img src="logoutIcon.png"> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <br>
    <button class="back" type="submit" name="back" onclick="window.location.href='stuViewAllUnattemptedQuizzes.php?user_id=<?php echo $_SESSION['user_id']; ?>'">< Back</button>
    <div>
        <div class="col-7 startQuizImageDiv" >
            <img src="StartQuizMobile.png" class="sqImageMobile">
            <img src="StartQuizWebsite1.png" class="sqImageWebsite">
        </div>
        <div class="col-5 container-right">
            <h1><?php echo $row['quiz_name'];?></h1>
            <br>
            <button type="button" class="startQuizBtn" onclick="window.location.href='stuQuestionPage.php?startquizQuizID=<?php echo $nquiz_id_selected; ?>&class_quiz_id=<?php echo $nclass_quiz_id;?>'">Start Quiz</button>
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

        function stuHP(){
            window.location.href="stuMainPage.php?user_id=<?php echo $_SESSION['user_id']; ?>";
        }
    </script>
</body>
</html>