<?php
    include('session.php');
    if (isset($_GET['user_id'])){
        $stu_id = $_GET['user_id'];
    }else{
        echo "<script>alert('Please login!');window.location.href='login.php';</script>";
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
            th{
                display: none;
            }

            .row{
                padding:15px;
                align-items:stretch;
            }

            .tableColumn2{
                display:none;
            }

            .firstrow{
                width: 85%;
                font-size:20px;
                border-top:2px solid black;
                border-bottom:none;
                padding-top:20px;
                padding-bottom:0px;
                font-weight:bold;
            }

            .firstrowcolumn3{
                width: 15%;
                font-size:20px;
                border-top:2px solid black;
                border-bottom:none;
                padding-bottom:0px;
                padding-top:20px;
            }

            .tableColumn1{
                width: 85%;
                font-size:20px;
                border-bottom:none;
                padding-top:20px;
                padding-bottom:0px;
                font-weight:bold;
                
            }

            .tableColumn3{
                font-size:20px;
                width: 15%;
                padding-top:20px;
                padding-bottom:0px;
                border-bottom:none;
            }

            .tableColumn4{
                width: 100%;
                font-size:16px;
                padding-bottom:20px;
                padding-top:10px;
            }

            td{
                display:inline-block;
                padding:10px;
            }

            .noquiz{
                font-size:16px;
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
        
            th{
                font-size:16px;
                padding:15px;
                border-bottom: 2px solid black;
            }


            td,th{
                height: 60px; 
                padding: 10px;
                text-align: left; 
                vertical-align: middle;
                box-sizing: border-box;
            }

            .tableColumn1 {
                width: 40%;
            }

            .tableColumn2 {
                width: 15%;
            }

            .tableColumn3 {
                width: 10%;
            }

            .tableColumn4 {
                width: 15%;
            }

            .row{
                padding:15px;
            }
            
            hr{
                display:none;
            }
        }

        table{
            width:100%; 
            border-collapse: collapse;
            font-size:16px;
        }

        td{
            border-bottom: 1px solid grey; 
        }

        .row:hover{
            background-color:#FBF8F5;
        }
        
        .back{
            font-size: 16px; 
            background-color:transparent; 
            border-style:none; 
            padding-left:50px;
        }

        .back:hover{
            color:#D81B60;
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
            <button type="button" class="notificationProfileBtn" onclick="window.location.href='stuViewAnnouncementPage.php?user_id=<?php echo $_SESSION['user_id']; ?>&page_before_announcement=stuViewSubmittedQuizzes.php'">
                <img src="notificationbtn.png" style="width:55px;">
            </button>
            <div class="dropdown">
                <button class="dropbtn" id="dropbtn" type="button" onclick="profileDropDown()">
                    <img src="stuprofilebtn.png" style="width:50px;">
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="StuProfilePage.php?page_before_profile=stuViewSubmittedQuizzes.php?"> 
                        <img src="profileIcon.png">Profile
                    </a>
                    <a href="logoutPage.php?page_before_logout=stuViewSubmittedQuizzes.php?"> 
                        <img src="logoutIcon.png"> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <button class="back" type="submit" name="back" onclick="window.location.href='StuMainPage.php?user_id=<?php echo $_SESSION['user_id']; ?>'">< Back</button>
    <div style="padding:20px 80px;">
        <h1>All Submitted Quizzes</h1>
        <br>
        <table>
            <tr style="padding:15px;">
                <th class="tableColumn1" style="font-weight:bold;">Quiz Name</th>
                <th class="tableColumn2" style="font-weight:bold;">Date Posted</th>
                <th class="tableColumn3" style="font-weight:bold;">Score</th>
                <th class="tableColumn4" style="font-weight:bold;">Status</th>
            </tr>
            <?php
                $con = mysqli_connect("localhost","root","","rwdd_assignment");

                if(mysqli_connect_errno()){
                    echo "Failed to connect to MySQL:".mysqli_connect_error();
                } 
                $stuSubmittedQuiz = "SELECT DISTINCT stq.stu_quiz_id, q.quiz_name, cq.post_date, stq.score, stq.submitted_status FROM quiz q
                                        INNER JOIN class_quiz cq ON q.quiz_id = cq.quiz_id
                                        INNER JOIN student_take_quiz stq ON cq.class_quiz_id = stq.class_quiz_id
                                        WHERE stq.student_id = ".$_SESSION['user_id'].";"; 

                
                $result = mysqli_query($con,$stuSubmittedQuiz);
                $nloop = 0;
                if (mysqli_num_rows($result) <=0 ){
                    echo '<tr>';
                    echo '<td style="height:auto; padding:20px 10px; border-bottom: 1px solid grey;" class="noquiz firstrow tableColumn1">No Submitted Quizzes</td>';
                    echo '<td class="mobile tableColumn2"></td>';
                    echo '<td class="mobile tableColumn3"></td>';
                    echo '<td class="mobile tableColumn4"></td>';
                    echo '</tr>';
                }else{
                    while($row = mysqli_fetch_array($result)){
                        $stuQuizID = $row['stu_quiz_id'];
                        $quizScoresql = mysqli_query($con,"SELECT SUM(question_score) AS totalscore FROM question 
                        inner join quiz q on question.quiz_id = q.quiz_id
                        inner join class_quiz cq on q.quiz_id = cq.quiz_id
                        WHERE cq.class_quiz_id = (SELECT class_quiz_id from student_take_quiz WHERE stu_quiz_id=".$stuQuizID.")");
                        $quizScore = mysqli_fetch_array($quizScoresql);
                        if ($nloop ==0){
                            echo '<tr style="border-bottom: 2px solid black;"></tr>';
                            echo '<tr class="row" data-quiz-id="'.$stuQuizID.'" onclick="GetStuQuizID(this)">';
                            echo '<td class="tableColumn1">'.$row['quiz_name'].'</td>';
                            echo '<td class="tableColumn2">'.date('d/m/Y',strtotime($row['post_date'])).'</td>';
                            echo '<td class="tableColumn3" style="padding-left:17px;">'.$row['score'].'/' .$quizScore['totalscore'].'</td>';
                            echo '<td class="tableColumn4">'.$row['submitted_status'].'</td>';
                            echo '</tr>';
                        }else{
                            echo '<tr class="row" data-quiz-id="'.$stuQuizID.'" onclick="GetStuQuizID(this)">';
                            echo '<td class="tableColumn1">'.$row['quiz_name'].'</td>';
                            echo '<td class="tableColumn2">'.date('d/m/Y',strtotime($row['post_date'])).'</td>';
                            echo '<td class="tableColumn3" style="padding-left:17px;">'.$row['score'].'/' .$quizScore['totalscore'].'</td>';
                            echo '<td class="tableColumn4">'.$row['submitted_status'].'</td>';
                            echo '</tr>';
                        }
                        $nloop += 1;
                    }
                }
            ?>

        </table>
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

        function GetStuQuizID(row){
            const stuquizID = row.getAttribute('data-quiz-id');
            console.log(stuquizID);
            window.location.href='stuReviewQuizPage.php?stuTakeQuizID=' + stuquizID;
        }

    </script>
</body>
</html>