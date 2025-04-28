<?php
include('session.php');

if (isset($_GET['page_before_preQuiz'])){
    $PageBefore = $_GET['page_before_preQuiz'];
}else if (isset($_GET['class_quiz'])){
    $class_id = $_GET['class_id'];
    $PageBefore = $_GET['page_before_preQuiz']."?class_id=".$class_id;
}else if (isset($_GET['quiz_id']) && isset($_GET['page_before_preQuiz'])){
    $quiz_id = $_GET['quiz_id'];
    $PageBefore = $_GET['page_before_preQuiz']."?quiz_id=".$quiz_id;
}else{
    $PageBefore = 'teaViewCreatedQuiz.php';
}
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "rwdd_assignment";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch quiz details and questions
if (isset($_GET['quiz_id'])) {
    $quiz_id = intval($_GET['quiz_id']);

    // Fetch quiz details
    $quizQuery = "SELECT quiz_id, quiz_name, quiz_description FROM quiz WHERE quiz_id = ?";
    $stmt = $conn->prepare($quizQuery);
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    $quizResult = $stmt->get_result();

    if ($quizResult->num_rows > 0) {
        $quiz = $quizResult->fetch_assoc();
    } else {
        echo "Quiz not found.";
        exit();
    }

    // Fetch questions for the selected quiz
    $questionsQuery = "SELECT question_id, question_text, question_type FROM question WHERE quiz_id = ?";
    $stmt = $conn->prepare($questionsQuery);
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    $questionsResult = $stmt->get_result();
} else {
    echo "Invalid request. No quiz ID provided.";
    exit();
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
        body {
            font-family: "Open Sans", sans-serif;
            box-sizing:border-box;
        }

        header {
            position: sticky;
            top: 0;
            height: 73px;
            background-color: #FBF8F5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            z-index:1;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        header img {
            width: 150px;
            cursor: pointer;
        }

        .content {
            padding: 20px 60px;
        }

        .content h2 {
            color: #333;
        }

        .preview-btn.active {
            background-color: #d6d6d6; /* Gray color */
            color: #888;
            cursor: not-allowed; 
            border: 1px solid #bbb; 
        }


        button {
            background-color: #f8f9fa; 
            color: #333;
            border: 1px solid #ccc;
            padding: 10px 20px;
            cursor: pointer;
        }

        button:hover {
            background-color: inherit; 
        }

        .back{
            font-size: 16px; 
            background-color:inherit; 
            border-style:none; 
            padding-left:40px;
        }

        .back:hover{
            color:#D81B60;
        }

        .question-card {
            margin: 20px 0;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .question-card strong {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .options {
            list-style-type: none;
            padding: 0;
        }

        .options li {
            margin: 5px 0;
        }

        .question-div{
            width:100%;
            height: auto;
            margin-left:15px;
            background-color:#fffbf7;
            margin-top:20px;
            box-sizing:border-box;
        }

        .questionNo{
            width:100%; 
            background-color:#faf1e7; 
            margin-top:0px; 
            margin-bottom:0px; 
            padding:10px 20px; 
            font-weight:bold;
            box-sizing:border-box;
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
            background-color:#f7e3c8;
        }

        .show {
            display:block;
        }
    </style>
</head>
<body>

    <div style="position:sticky; z-index:1; top:0; height: 73px;background-color:#FBF8F5;">
        <div style="float:left; padding:10px 10px 10px 30px;cursor:pointer;">
            <img src="logo.png" style="width:150px;" onclick="window.location.href='TeaMainPage.php'">
        </div>
        <div style="float:right; padding-right:40px;">
            </button>
            <div class="dropdown">
                <button class="dropbtn" id="dropbtn" type="button" onclick="profileDropDown()">
                    <img src="stuprofilebtn.png" style="width:50px;">
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="TeaProfilePage.php?page_before_profile=TeaPreviewQuiz.php?quiz_id=<?php echo $quiz_id; ?>&"> 
                        <img src="profileIcon.png">Profile
                    </a>
                    <a href="logoutPage.php?page_before_logout=TeaPreviewQuiz.php?quiz_id=<?php echo $quiz_id; ?>&"> 
                        <img src="logoutIcon.png"> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>

<br>
<button class="back" type="button" onclick="window.location.href='<?php echo $PageBefore; ?>'">< Back</button>

<div class="content">
    <h2><?php echo htmlspecialchars($quiz['quiz_name']); ?></h2>
    <p><?php echo htmlspecialchars($quiz['quiz_description']); ?></p>

    <?php
    // Check if the user is previewing the quiz
    $current_page = basename($_SERVER['PHP_SELF']); 
    $is_previewing = ($current_page == "teaPreviewQuiz.php"); 
    ?>

    <button 
        class="preview-btn <?php echo $is_previewing ? 'active' : ''; ?>" 
        <?php echo $is_previewing ? 'disabled' : ''; ?>
        onclick="window.location.href='teaPreviewQuiz.php?quiz_id=<?php echo $quiz_id; ?>'">
        Preview Quiz
    </button>
    
    <button onclick="window.location.href='teaViewStudentResponse.php?quiz_id=<?php echo $quiz_id; ?>'">Student Response</button>
    <br><br>

    <?php 
        $con = mysqli_connect("localhost","root","","rwdd_assignment");

        if(mysqli_connect_errno()){
            echo "Failed to connect to MySQL:".mysqli_connect_error();
        } 
        $questionsql = "SELECT question_id, question_text, question_type FROM question WHERE quiz_id=$quiz_id";
        $allquestion = mysqli_query($con, $questionsql);
        $questionNo = 1;
        while ($question = mysqli_fetch_array($allquestion)){
            echo'<div class="col-12 question-div">';
            $questionID = $question['question_id'];
            echo '<p class="questionNo">Question '.$questionNo.'</p>';
            echo '<div class="col-12" style="padding: 0px 40px 0px 30px;">';
            echo '<p>'.$question['question_text'].'</p>';

            if ($question['question_type'] == 'Multiple Choice Question'){
                $answersql = "SELECT mcq_answer_id, mcq_answer_text, is_ques_ans_correct FROM mcq_answer WHERE question_id=$questionID";
                $allansweroption = mysqli_query($con, $answersql);
            
                while ($answer = mysqli_fetch_array($allansweroption)){
                    if ($answer['is_ques_ans_correct'] == '1'){
                        echo '<input type="radio" style="accent-color:rgb(23, 92, 23);" checked>'.$answer['mcq_answer_text'];
                    }else{
                        echo '<input type="radio" disabled>'.$answer['mcq_answer_text'];
                    }
                    echo '<br>';
                }
            }else{
                $answerforquestionsql = mysqli_query($con,"SELECT struc_answer_text FROM structure_answer WHERE question_id=$questionID");
                $answerforquestion = mysqli_fetch_array($answerforquestionsql);
                echo '<input type="text" placeholder="'.$answerforquestion['struc_answer_text'].'" style="background-color:white; border: 1px solid black; padding:10px 20px; margin-bottom:20px; width:95%;" disabled>';
                
            }
            echo '</div>';
            echo '<br>';
            echo'</div>';
            $questionNo += 1;
            echo '<br>';
        }
    ?>  
</div>

<script>
    function previewQuiz() {
        window.location.href = 'previewQuiz.php?quiz_id=<?php echo $quiz_id; ?>';
    }

    function viewStudentResponses() {
        window.location.href = 'studentResponses.php?quiz_id=<?php echo $quiz_id; ?>';
    }
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
</body>
</html>
