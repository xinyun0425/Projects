<?php
    include('session.php');
    $con = mysqli_connect("localhost","root","","rwdd_assignment");

    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL:".mysqli_connect_error();
    } 
    if (isset($_GET['startquizQuizID']) && isset($_GET['class_quiz_id'])) { 
        $nquiz_id_selected = intval($_GET['startquizQuizID']);
        $class_quiz_id = intval($_GET['class_quiz_id']);
        $result = mysqli_query($con, "SELECT quiz_name, quiz_description FROM quiz WHERE quiz_id=$nquiz_id_selected");
        $row = mysqli_fetch_array($result);
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
        
        @media only screen and (max-width: 767px) {
            .submitbtn{
                display:block;
                padding: 13px 55px;
                margin:auto;
                color:white;
                background-color:#d81b60;
                font-size:16px;
                margin-left:auto;
                margin-right:auto;
                border:none;
            }

            .modalbtn{
                padding:10px 20px;
                width: 80%;
                margin-top:10px;
                color:white;
                border:none;
                background-color:#d81b60;
            }

            .modal{
                display:none;
                position: fixed; 
                z-index: 1; 
                left: 10%;
                top: 30%;
                width: 80%;
                height: 50%; 
                background-color: rgb(0,0,0);
                background-color: white; 
                border:1px solid black;
            }

            .modal-content {
                background-color: #fefefe;
                vertical-align:middle;
                width: 100%;
                text-align:center;
                align-items:center;
            }

            .submitbtnWebsite{
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
            
            .submitbtn{
                padding: 13px 55px;
                float:right;
                background-color:#d81b60;
                color:white;
                font-size:16px;
                border:none;
            }
            .submitbtnMobile{
                display:none;
            }

            .modalbtn{
                padding:10px 20px;
                color:white;
                background-color:#d81b60;
                width: 35%;
                border:none;
            }       
            .modal{
                display:none;
                position: fixed; 
                z-index: 1; 
                left: 35%;
                top: 30%;
                width: 30%;
                height: 40%; 
                background-color: white; 
                border:1px solid black;
            }

            .modal-content {
                background-color: #fefefe;
                vertical-align:middle;
                width: 100%;
                text-align:center;
                align-items:center;
            }
        }

        .modalbtn:hover{
            transform:scale(1.05);
        }

        .answerText{       
            padding:10px 20px;
            width: 100%;
            margin-bottom:30px;
            box-sizing:border-box;
        }

        .question-div{
            background-color:#fffbf7;
        }
        .questionNo{
            padding:10px 20px;
            width: 100%;
            background-color:#faf1e7;
            font-weight:bold;
        }

        .submitbtn:hover{
            transform:scale(1.05);
        }
    </style>
</head>
<body>
    <div style="position:sticky; z-index:1; top:0; height: 73px;background-color:#FBF8F5">
        <div style="float:left; padding:10px 10px 10px 30px;">
            <img src="logo.png" style="width:150px;" onclick="stuHP()">
        </div>
    </div>
    <br>
    <div style="padding:0px 60px;" class="col-12">
        <h1> <?php echo $row['quiz_name'];?></h1>
        <p> <?php echo $row['quiz_description'];?></p>
        <br>
        <form method="post" action="#">
            <?php
                $con = mysqli_connect("localhost","root","","rwdd_assignment");

                if(mysqli_connect_errno()){
                    echo "Failed to connect to MySQL:".mysqli_connect_error();
                } 
                $questionsql = "SELECT question_id, question_text, question_type FROM question WHERE quiz_id=$nquiz_id_selected";
                $allquestion = mysqli_query($con, $questionsql);
                $questionNo = 1;
                while ($question = mysqli_fetch_array($allquestion)){
                    echo'<div class="col-12 question-div">';
                    $questionID = $question['question_id'];
                    echo '<p class="questionNo">Question '.$questionNo.'</p>';
                    echo '<div class="col-12" style="padding: 0px 40px 0px 30px;">';
                    echo '<p>'.$question['question_text'].'</p>';

                    if ($question['question_type'] == 'Multiple Choice Question'){
                        $answersql = "SELECT mcq_answer_id, mcq_answer_text FROM mcq_answer WHERE question_id=$questionID";
                        $allansweroption = mysqli_query($con, $answersql);
                    
                        while ($answer = mysqli_fetch_array($allansweroption)){
                            echo '<input class="answerOption" type="radio" value="'.$answer['mcq_answer_text'].'" name="answerforquestion'.$questionID.'" required>'.$answer['mcq_answer_text'];
                            echo '<br>';
                        }
                        
                    }else{
                        echo '<input class="answerText" type="text" placeholder="Type your answer here" name="answerforquestion'.$questionID.'" required>';
                        
                    }
                    echo '</div>';
                    echo '<br>';
                    echo'</div>';
                    $questionNo += 1;
                    echo '<br>';
                }
            ?>
            <br>
            <button type="button" id="submit-quiz" class="submitbtn">Submit</button>
            <div id="confirmSubmitQuizModal" class="modal">
                <div class="modal-content">
                    <br>
                    <img src="submitquizicontest1.png">
                    <h2>Submit</h2>
                    <p>Are you sure you want to submit?</p>
                    <br>
                    <button type="submit" name="confirm-submit" class="submitbtnMobile modalbtn">Confirm</button>
                    <button type="button" onclick="closeModal()" class="modalbtn" style="background-color:white; color:black; border:2px solid black;">Cancel</button>
                    <button type="submit" name="confirm-submit" class="submitbtnWebsite modalbtn" style="margin-left:20px;">Confirm</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        function stuHP(){
            window.location.href="StuMainPage.php?user_id=<?php echo $_SESSION['user_id']; ?>";
        }

        var modal = document.getElementById("confirmSubmitQuizModal");
        var openModalbtn = document.getElementById("submit-quiz");

        openModalbtn.onclick = function(){
            modal.style.display = "block";
        }

        function closeModal(){
            modal.style.display = "none";
        }


    </script>
    <?php
        $con = mysqli_connect("localhost","root","","rwdd_assignment");

        if(mysqli_connect_errno()){
            echo "Failed to connect to MySQL:".mysqli_connect_error();
        } 
        if(isset($_POST['confirm-submit'])){
            echo '<script>alert("Submit successfully.");</script>';
            $quizdatesql = mysqli_query($con,"SELECT due_date FROM class_quiz WHERE quiz_id=$nquiz_id_selected AND class_id=(SELECT class_id FROM student WHERE student_id =".$_SESSION['user_id'].")");
            $quizdate = mysqli_fetch_array($quizdatesql);
            if (strtotime($quizdate['due_date']) < strtotime(date('Y-m-d'))){
                $stuTakeQuizRecord = mysqli_query($con,"INSERT INTO student_take_quiz(submitted_date,submitted_status,student_id,class_quiz_id) VALUES (NOW(),'Submitted Late','{$_SESSION['user_id']}','$class_quiz_id')");
                
            }else{
                $stuTakeQuizRecord = mysqli_query($con,"INSERT INTO student_take_quiz(submitted_date,submitted_status,student_id,class_quiz_id) VALUES (NOW(),'Submitted','{$_SESSION['user_id']}','$class_quiz_id')");
            }
            $stuTakeQuizIDsql = mysqli_query($con, "SELECT stu_quiz_id FROM student_take_quiz WHERE class_quiz_id=$class_quiz_id AND student_id =".$_SESSION['user_id']);
            $stuTakeQuizID = mysqli_fetch_array($stuTakeQuizIDsql);
            $questionsql = "SELECT question_id, question_text, question_type FROM question WHERE quiz_id=$nquiz_id_selected";
            $allquestion = mysqli_query($con, $questionsql);
            while($question_ID = mysqli_fetch_array($allquestion)){
                $stuanswer = $_POST['answerforquestion'.$question_ID['question_id']];
                if ($question_ID['question_type'] == 'Multiple Choice Question'){
                    $correctAnswersql = mysqli_query($con,"SELECT mcq.mcq_answer_text, q.question_score FROM question q INNER JOIN mcq_answer mcq ON q.question_id = mcq.question_id WHERE q.question_id=".$question_ID['question_id']." AND mcq.is_ques_ans_correct = '1'");
                    echo 'SELECT mcq.mcq_answer_text, q.question_score FROM question q INNER JOIN mcq_answer mcq ON q.question_id = mcq.question_id WHERE q.question_id='.$question_ID['question_id'].' AND mcq.is_ques_ans_correct = 1';
                    $correctAnswer = mysqli_fetch_array($correctAnswersql);
                    if ($stuanswer == $correctAnswer['mcq_answer_text']){
                        $stu_answer = "INSERT INTO student_answer(stu_ans, is_stu_ans_correct,stu_ques_score,stu_quiz_id,question_id) VALUES ('$stuanswer','1','{$correctAnswer['question_score']}','{$stuTakeQuizID['stu_quiz_id']}','{$question_ID['question_id']}')";
                    }else{
                        $stu_answer = "INSERT INTO student_answer(stu_ans, is_stu_ans_correct,stu_ques_score,stu_quiz_id,question_id) VALUES ('$stuanswer','0','0','{$stuTakeQuizID['stu_quiz_id']}','{$question_ID['question_id']}')";
                    }
                }else{
                    $correctAnswersql = mysqli_query($con,"SELECT sa.struc_answer_text, q.question_score FROM question q INNER JOIN structure_answer sa ON q.question_id = sa.question_id WHERE q.question_id=".$question_ID['question_id']);
                    $correctAnswer = mysqli_fetch_array($correctAnswersql);
                    $answer= trim($stuanswer, " ");
                    if ($answer == $correctAnswer['struc_answer_text']){
                        $stu_answer = "INSERT INTO student_answer(stu_ans, is_stu_ans_correct,stu_ques_score,stu_quiz_id,question_id) VALUES ('$answer','1','{$correctAnswer['question_score']}','{$stuTakeQuizID['stu_quiz_id']}','{$question_ID['question_id']}')";
                    }else{
                        $stu_answer = "INSERT INTO student_answer(stu_ans, is_stu_ans_correct,stu_ques_score,stu_quiz_id,question_id) VALUES ('$answer','0','0','{$stuTakeQuizID['stu_quiz_id']}','{$question_ID['question_id']}')";
                    }
                }
                
                $stu_anwer_result = mysqli_query($con,$stu_answer);
            }
            $totalScoresql = mysqli_query($con,"SELECT SUM(stu_ques_score) AS totalScore FROM student_answer WHERE stu_quiz_id=".$stuTakeQuizID['stu_quiz_id']);
            $totalScore = mysqli_fetch_array($totalScoresql);
            $insertTSsql ="UPDATE student_take_quiz SET score =" .$totalScore['totalScore']. " WHERE stu_quiz_id = " . $stuTakeQuizID['stu_quiz_id'];
            $insertTSresult = mysqli_query($con,$insertTSsql);
            echo '<script>window.location.href="stuViewResultPage.php?stuQuizID='.$stuTakeQuizID['stu_quiz_id'].'";</script>';
        }
    ?>
</body>
</html>