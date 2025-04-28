<?php
include('session.php');
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

<?php
$current_page = basename($_SERVER['PHP_SELF']); 
$is_student_response_page = ($current_page == "teaViewStudentResponse.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>+  Math</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Nanum+Myeongjo&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Sour+Gummy:wdth,wght@101.8,500&display=swap');
        * {
            font-family: "Open Sans", sans-serif;
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
        .student-response-btn {
            background-color: #f8f9fa;
            color: #333;
            border: 1px solid #ccc;
            padding: 10px 20px;
            cursor: pointer;
        }

        .student-response-btn.active {
            background-color: #d6d6d6;
            color: #888; 
            cursor: not-allowed; 
        }

        .student-response-btn:disabled {
            background-color: #d6d6d6;
            color: #888;
            border: 1px solid #bbb;
            cursor: not-allowed;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            font-weight:bold;

        }

        thead tr {
            border-bottom: 2px solid black;
        }


        tbody tr {
            transition: background-color 0.3s ease;
        }

        a.view-button {
            color: #FF4081;
            font-weight: bold;
            padding: 5px 10px;
            transition: background-color 0.3s ease, color 0.3s ease;
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
        @media only screen and (max-width:767px) {
            .tableColumn1{
                width: 40%;
            }

            .tableColumn2{
                width: 20%;
            }

            .tableColumn3{
                display:none;
            }

            .tableColumn4{
                width: 20%;
            }

        }

        @media only screen and (min-width:768px) {
            .tableColumn1{
                width: 40%;
            }

            .tableColumn2{
                width: 20%;
            }

            .tableColumn3{
                display:20;
            }

            .tableColumn4{
                width: 20%;
            }

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
                    <a href="TeaProfilePage.php?page_before_profile=teaViewStudentResponse.php?quiz_id=<?php echo $quiz_id; ?>&"> 
                        <img src="profileIcon.png">Profile
                    </a>
                    <a href="logoutPage.php?page_before_logout=teaViewStudentResponse.php?quiz_id=<?php echo $quiz_id; ?>& "> 
                        <img src="logoutIcon.png"> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>

    <br>
    <button class="back" type="button" onclick="window.location.href='teaViewCreatedQuiz.php'">< Back</button>

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
        onclick="window.location.href='teaPreviewQuiz.php?page_before_preQuiz=teaViewCreatedQuiz.php&quiz_id=<?php echo $quiz_id; ?>'">Preview Quiz</button>
    
    <button class="student-response-btn <?php echo $is_student_response_page ? 'active' : ''; ?>" 
    <?php echo $is_student_response_page ? 'disabled' : "onclick=\"window.location.href='teaViewStudentResponse.php?quiz_id=$quiz_id'\""; ?>>
    Student Response</button>

    <br><br>

    <table border="0" cellpadding="10" cellspacing="0" style="width:100%; text-align: left; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Score</th>
                <th class="tableColumn3">Date Submitted</th>
                <th>View Response</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Query to fetch student details and scores
            $studentResponsesQuery = " SELECT s.student_id, s.student_name, stq.score, stq.submitted_date, stq.student_id, stq.stu_quiz_id FROM student_take_quiz stq
                                        INNER JOIN student s ON stq.student_id = s.student_id
                                        INNER JOIN class_quiz cq on stq.class_quiz_id = cq.class_quiz_id
                                        WHERE cq.quiz_id = ?";

            $stmt = $conn->prepare($studentResponsesQuery);
            $stmt->bind_param("i", $quiz_id);
            $stmt->execute();
            $studentResponsesResult = $stmt->get_result();

            $quizScoresql = mysqli_query($conn,"SELECT SUM(question_score) AS totalscore FROM question 
                        inner join quiz q on question.quiz_id = q.quiz_id
                        WHERE q.quiz_id ='$quiz_id'");
            $quizScore = mysqli_fetch_array($quizScoresql);

            // Populate table rows with data
            while ($row = $studentResponsesResult->fetch_assoc()) :
            ?>
            <tr>
                <td class="tableColumn1"><?php echo htmlspecialchars($row['student_name']); ?></td>
                <td class="tableColumn2"><?php echo htmlspecialchars($row['score']); ?> / <?php echo $quizScore['totalscore'];?></td>
                <td class="tableColumn3">
                    <?php 
                    $formattedDate = date("j / n / Y", strtotime($row['submitted_date']));
                    echo $formattedDate;
                    ?>
                </td>
                <td class="tableColumn4"><a class="view-button" href="teaViewSpecStuResponse.php?stu_quiz_id=<?php echo $row['stu_quiz_id']; ?>&quiz_id=<?php echo $quiz_id; ?>&student_id=<?php echo $row['student_id']; ?>">View</a></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
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
