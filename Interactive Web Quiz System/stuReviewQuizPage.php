<?php
    include('session.php');
    $con = mysqli_connect("localhost","root","","rwdd_assignment");
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL:".mysqli_connect_error();
    } 
    if (isset($_GET['stuTakeQuizID'])) {
        $stqQuizID = intval($_GET['stuTakeQuizID']);
        $quizID = mysqli_query($con, "SELECT q.quiz_name, q.quiz_description FROM student_take_quiz stq 
        INNER JOIN class_quiz cq on stq.class_quiz_id = cq.class_quiz_id
        INNER JOIN quiz q ON cq.quiz_id = q.quiz_id WHERE stq.stu_quiz_id=$stqQuizID");
        $quizNameDescription = mysqli_fetch_array($quizID);
    } else {
        echo "<script>alert('Please choose a quiz.');window.location.href='stuViewAllSubmittedQuizzes.php';</script>";
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
            .score-div-mobile{
                width:100%;
                border:1px solid black;
            }

            .score-div-website{
                display:none;
            }

            .question-div{
                width:100%;
                height: auto;
                padding: 10px 20px;
                background-color:#fffbf7;
                margin-top:0px;
            }

            .container-div{
                display:block; 
                padding:40px 80px 0px 80px;
            }

            .questionNo{
                width:100%; 
                background-color:#faf1e7; 
                margin-top:20px; 
                margin-bottom:0px; 
                padding:10px 20px; 
                font-weight:bold;
            }

            .donebtn{
                padding:15px 70px;
                background-color:#d81b60;
                color:white;
                border:none;
                display:block;
                margin-left:auto;
                margin-right:auto;
                margin-bottom:20px;
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
            
            .score-div-mobile{
                display:none;
            }

            .score-div-website{
                border:1px solid black;
                width:150px;
                height: 120px;
            }

            .question-div{
                width:100%;
                height: auto;
                margin-left:15px;
                padding: 10px 20px;
                background-color:#fffbf7;
                margin-top:0px;
            }

            .container-div{
                display:flex; 
                padding:40px 80px 0px 80px;
            }
            
            .questionNo{
                width:100%; 
                background-color:#faf1e7; 
                margin-left:15px; 
                margin-top:0px; 
                margin-bottom:0px; 
                padding:10px 20px; 
                font-weight:bold;
            }

            .donebtn{
                padding:15px 70px;
                background-color:#d81b60;
                color:white;
                border:none;
                float:right;
                margin-right:50px;
                margin-top:10px;
                margin-bottom:20px;
            }
        }

        .donebtn:hover{
            transform:scale(1.06);
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
    </style>
</head>
<body>
    <div style="position:sticky; z-index:1; top:0; height: 73px;background-color:#FBF8F5">
        <div style="float:left; padding:10px 10px 10px 30px;">
            <img src="logo.png" style="width:150px;" onclick="stuHP()">
        </div>
        <div style="float:right; padding-right:40px;">
            <button type="button" class="notificationProfileBtn" onclick="window.location.href='stuViewAnnouncementPage.php?user_id=<?php echo $_SESSION['user_id']; ?>&page_before_announcement=stuReviewQuizPage.php?stuTakeQuizID=<?php echo $stqQuizID; ?>&'">
                <img src="notificationbtn.png" style="width:55px;">
            </button>
            <div class="dropdown">
                <button class="dropbtn" id="dropbtn" type="button" onclick="profileDropDown()">
                    <img src="stuprofilebtn.png" style="width:50px;">
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="stuProfilePage.php?page_before_profile=stuReviewQuizPage.php?stuTakeQuizID=<?php echo $stqQuizID; ?>&"> 
                        <img src="profileIcon.png">Profile
                    </a>
                    <a href="logoutPage.php?page_before_logout=stuReviewQuizPage.php?stuTakeQuizID=<?php echo $stqQuizID; ?>&"> 
                        <img src="logoutIcon.png"> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div style="padding:60px 80px 50px 80px;">
        <span style="font-weight:bold; font-size:18px;">Quiz Name: </span>
        <span style="font-size:18px;"> <?php echo $quizNameDescription['quiz_name'];?></span>
        <br><br>
        <span style="font-weight:bold; font-size:18px;">Description: </span> 
        <span style="font-size:18px;"> <?php echo $quizNameDescription['quiz_description'];?></span>
    </div>
    
    <?php
        $reviewquizsql = mysqli_query($con, "SELECT sa.stu_ques_score, q.question_id ,q.question_text, q.question_score, q.question_type FROM question q INNER JOIN student_answer sa ON q.question_id = sa.question_id WHERE stu_quiz_id=$stqQuizID"); 
        $loop = 1;
        while($reviewquiz = mysqli_fetch_array($reviewquizsql)){
            $questionID = $reviewquiz['question_id'];
            if ($reviewquiz['question_type'] == "Multiple Choice Question"){
                $answerforquestionsql = mysqli_query($con,"SELECT mcq_answer_text, is_ques_ans_correct FROM mcq_answer WHERE question_id=$questionID");
                $studentansforquestionsql=mysqli_query($con,"SELECT is_stu_ans_correct,stu_ans FROM student_answer WHERE question_id=$questionID AND stu_quiz_id = $stqQuizID");
                $studentansforquestion = mysqli_fetch_array($studentansforquestionsql);
                echo '<div class="col-12 container-div">';
                    if ($reviewquiz['stu_ques_score'] == $reviewquiz['question_score']){
                        echo '<div class="score-div-website" style="background-color:#b0e1b4;">';
                        echo '<p style="padding-left:10px; padding-top:0px;">Score:</p>';
                        echo '<p style="text-align:center; padding-bottom:10px; font-size:20px;">' .$reviewquiz['stu_ques_score']. '/' .$reviewquiz['question_score']. '</p>';
                        echo '</div>';
                        echo '<div class="score-div-mobile" style="background-color:#b0e1b4;">';
                        echo '<p style="padding-left:10px; padding-top:0px;">Score: '.$reviewquiz['stu_ques_score']. '/' .$reviewquiz['question_score']. '</p>';
                        echo '</div>';
                    }else{
                        echo '<div class="score-div-website" style="background-color:#e1b4b0;">';
                        echo '<p style="padding-left:10px; padding-top:0px;">Score:</p>';
                        echo '<p style="text-align:center; padding-bottom:10px; font-size:20px;">' .$reviewquiz['stu_ques_score']. '/' .$reviewquiz['question_score']. '</p>';
                        echo '</div>';

                        echo '<div class="score-div-mobile" style="background-color:#e1b4b0;">';
                        echo '<p style="padding-left:10px; padding-top:0px;">Score:'.$reviewquiz['stu_ques_score']. '/' .$reviewquiz['question_score']. '</p>';
                        echo '</div>';
                    }
                    
                    echo '<div class="col-12">';
                        echo '<p class="questionNo">Question '.$loop. '</p>';
                        echo '<div class="question-div" style="padding: 5px 40px 0px 30px;">';
                            echo '<p>'. $reviewquiz['question_text']. '</p>';
                            while($answerforquestion = mysqli_fetch_array($answerforquestionsql)){
                                if ($answerforquestion['is_ques_ans_correct'] == '1'){
                                    echo '<input type="radio" style="accent-color:rgb(23, 92, 23);" checked>'.$answerforquestion['mcq_answer_text'];
                                }else if ($studentansforquestion['is_stu_ans_correct'] == '0' && $answerforquestion['mcq_answer_text'] == $studentansforquestion['stu_ans']){
                                    echo '<input type="radio" style="accent-color:#FF0000;" checked>'.$answerforquestion['mcq_answer_text'];
                                }else{
                                    echo '<input type="radio" disabled>'.$answerforquestion['mcq_answer_text'];
                                }
                                echo '<br>';
                            }
                            echo '<br>';
                        echo '</div>';//accent-color:rgb(176, 225, 180); rgb(225, 180, 176);
                    echo '</div>';
                echo '</div>';
            }else{
                $answerforquestionsql = mysqli_query($con,"SELECT struc_answer_text FROM structure_answer WHERE question_id=$questionID");
                $answerforquestion = mysqli_fetch_array($answerforquestionsql);
                $studentansforquestionsql=mysqli_query($con,"SELECT stu_ans, is_stu_ans_correct FROM student_answer WHERE question_id=$questionID AND stu_quiz_id = $stqQuizID");
                $studentansforquestion = mysqli_fetch_array($studentansforquestionsql);
                echo '<div class="col-12 container-div">';
                if ($reviewquiz['stu_ques_score'] == $reviewquiz['question_score']){
                    echo '<div class="score-div-website" style="background-color:#b0e1b4;">';
                    echo '<p style="padding-left:10px; padding-top:0px;">Score:</p>';
                    echo '<p style="text-align:center; padding-bottom:10px; font-size:20px;">' .$reviewquiz['stu_ques_score']. '/' .$reviewquiz['question_score']. '</p>';
                    echo '</div>';
                    echo '<div class="score-div-mobile" style="background-color:#b0e1b4;">';
                    echo '<p style="padding-left:10px; padding-top:0px;">Score: '.$reviewquiz['stu_ques_score']. '/' .$reviewquiz['question_score']. '</p>';
                    echo '</div>';
                }else{
                    echo '<div class="score-div-website" style="background-color:#e1b4b0;">';
                    echo '<p style="padding-left:10px; padding-top:0px;">Score:</p>';
                    echo '<p style="text-align:center; padding-bottom:10px; font-size:20px;">' .$reviewquiz['stu_ques_score']. '/' .$reviewquiz['question_score']. '</p>';
                    echo '</div>';

                    echo '<div class="score-div-mobile" style="background-color:#e1b4b0;">';
                    echo '<p style="padding-left:10px; padding-top:0px;">Score:'.$reviewquiz['stu_ques_score']. '/' .$reviewquiz['question_score']. '</p>';
                    echo '</div>';
                }
                echo '<div class="col-12">';
                echo '<p class="questionNo">Question '.$loop. '</p>';
                echo '<div class="question-div" style="padding: 5px 40px 0px 30px;">';
                echo '<p>'. $reviewquiz['question_text']. '</p>';
                if ($studentansforquestion['is_stu_ans_correct'] == '1'){
                    echo '<input type="text" placeholder="'.$studentansforquestion['stu_ans'].'" style="background-color:white; border: 1px solid black; padding:10px 20px; margin-bottom:20px; width:100%;" disabled>';
                }else{
                    echo '<input type="text" placeholder="'.$studentansforquestion['stu_ans'].'" style="background-color:#fcdede; border: 1px solid black; padding:10px 20px; width:100%;" disabled>';
                    echo '<br>';
                    echo '<p style="font-size:14px;">Correct Answer:</p>';
                    echo '<input type="text" placeholder="'.$answerforquestion['struc_answer_text'].'" style="background-color:#c9f0d7; border: 1px solid black; margin-bottom:20px; padding:10px 20px; width:100%;" disabled>';
                }
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            echo '<br>';
            $loop +=1;

        }
    ?>
    <button type="button" class="donebtn" onclick="window.location.href='stuViewSubmittedQuizzes.php?user_id=<?php echo $_SESSION['user_id']; ?>'">Done</button>
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