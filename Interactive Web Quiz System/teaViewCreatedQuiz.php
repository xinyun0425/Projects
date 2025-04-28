<?php
include('session.php');
$servername = "localhost"; 
$username = "root";        
$password = "";            
$database = "rwdd_assignment";  

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_quiz_id'])){
        $quiz_id = mysqli_real_escape_string($conn, $_POST['delete_quiz_id']);
        $delete_query = "DELETE FROM quiz WHERE quiz_id = '$quiz_id'";
        $delete_class_quiz = "DELETE FROM class_quiz WHERE quiz_id = '$quiz_id'";
        $delete_question = "DELETE FROM question WHERE quiz_id = '$quiz_id'";
        $delete_mcq_ans ="DELETE FROM mcq_answer WHERE question_id IN (
                            SELECT question_id FROM question WHERE quiz_id ='$quiz_id')";
        $delete_struc_ans ="DELETE FROM structure_answer WHERE question_id IN (
                            SELECT question_id FROM question WHERE quiz_id ='$quiz_id')";
        $delete_stu_quiz = "DELETE FROM student_take_quiz WHERE class_quiz_id IN 
                            (SELECT class_quiz_id FROM class_quiz WHERE quiz_id = '$quiz_id')";
        mysqli_query($conn, $delete_stu_quiz);
        mysqli_query($conn, $delete_question);
        mysqli_query($conn, $delete_mcq_ans);
        mysqli_query($conn, $delete_struc_ans);
        mysqli_query($conn, $delete_class_quiz);

        if (mysqli_query($conn, $delete_query)) {
            echo "<script>alert('Quiz deleted successfully.'); window.location.href = 'TeaViewCreatedQuiz.php';</script>";
        } else {
            echo "<script>alert('Error deleting quiz. Please try again.');</script>";
        }

    $result = mysqli_query($conn, "SELECT q.quiz_id, q.quiz_name, q.quiz_description, q.creation_time, q.teacher_id, COUNT(stq.stu_quiz_id) AS NoOfResponses
                                    FROM quiz q 
                                    LEFT JOIN class_quiz cq ON q.quiz_id = cq.quiz_id
                                    LEFT JOIN student_take_quiz stq ON cq.class_quiz_id = stq.class_quiz_id
                                    WHERE q.teacher_id = ".$_SESSION['user_id']."
                                    GROUP BY q.quiz_id
                                    ORDER BY q.creation_time ASC");

    }else{
        $quiz_id = $_POST['quiz_id'];
        $quiz_name = $_POST['quiz_name'];

        // Update quiz name
        $sql = "UPDATE quiz SET quiz_name = ? WHERE quiz_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $quiz_name, $quiz_id);

        if ($stmt->execute()) {
            echo "Quiz renamed successfully.";
            header("Location: teaViewCreatedQuiz.php");
            exit();
        } else {
            echo "Error renaming quiz: " . $conn->error;
        }

        $stmt->close();
    }
}

    
$sql = "SELECT q.quiz_id, q.quiz_name, q.quiz_description, q.creation_time, q.teacher_id, COUNT(stq.stu_quiz_id) AS NoOfResponses
        FROM quiz q 
        LEFT JOIN class_quiz cq ON q.quiz_id = cq.quiz_id
        LEFT JOIN student_take_quiz stq ON cq.class_quiz_id = stq.class_quiz_id
        WHERE q.teacher_id = ".$_SESSION['user_id']."
        GROUP BY q.quiz_id
        ORDER BY q.creation_time ASC;
";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>+  Math</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Nanum+Myeongjo&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Sour+Gummy:wdth,wght@101.8,500&display=swap');
        
        @media only screen and (max-width:767px) {
            .date-created{
                display:none;
            }
        }

        body {
            font-family: "Open Sans", sans-serif;
            box-sizing:border-box;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            margin-top: 5px;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            z-index: 1;
            left: 0;
        }

        .dropdown-content a {
            color: black;
            padding: 10px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }
        .dropbtn:hover, .dropbtn:focus {
            background-color: #f7e3c8;
        }

        .dropbtn {
            border-style:none; 
            background-color:transparent;
            padding: 10px;
            cursor: pointer;
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

        .dropdown-content a img {
            width: 50px;
            height:50px;
        }

        .show {
            display: block;
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

        tbody tr:hover td {
            background-color: #FBF8F5;
        }

        /* To Add spacing between rows */
        tbody tr {
            transition: background-color 0.3s ease;
        }


        .actions-column {
            text-align: left;
        }

        .rename-delete {
            color: black;
            padding: 0px 10px;
            text-decoration: none;
            display: flex;
            text-align:center;
            align-items:center;
            font-size: 14px;
            gap: 10px;
            height:50px;
        }

        .back {
            font-size: 16px; 
            background-color: transparent; 
            border: none; 
            padding-left: 40px;
            cursor: pointer;
        }

        .back:hover{
            color:#D81B60;
        }

        /* Rename modal */
        .renameModal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            width: 40%;
            height: 40%;
            background: white;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            transform: translate(-50%, -50%);
        }

        .renameModal h3{
            padding:10px 30px 0px 30px;
            font-size:35px;
        }

        .renameModal form{
            padding:10px 30px;
        }

        .renameModal label{
            font-size:20px;
            font-weight:bold;
            padding:10px 0px;
            width:100%;
            margin-bottom:20px;
        }

        .renameModal input{
            font-size:20px;
            padding:10px;
            width:97%;
            margin-bottom:20px;
            border:1px solid #ccc;
        }
        
        .renamesavebtn{
            width:47%;
            color:white;
            background-color:#D81B60;
            border:none;
            padding:15px 0px;
            font-size:16px;
            float:right;
            margin-left:5px;
        }

        .renamecancelbtn{
            width:47%;
            color:white;
            background-color:#D81B60;
            border:none;
            padding:15px 0px;
            font-size:16px;
            float:left;
            margin-right:5px;
        }

        .renameModal button:hover{
            opacity:0.8;
        }

        .addbtn {
            border-style:none; 
            background-color:transparent;
            padding: 10px;
            cursor: pointer;
        }

        .addbtn:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div style="position:sticky; z-index:1; top:0; height: 73px;background-color:#FBF8F5;">
        <div style="float:left; padding:10px 10px 10px 30px;">
            <img src="logo.png" style="width:150px;" onclick="window.location.href='TeaMainPage.php'">
        </div>
        <div style="float:right; padding-right:40px;">
            <div class="dropdown">
                <button class="dropbtn" id="dropbtn" type="button" onclick="profileDropDown()">
                    <img src="stuprofilebtn.png" style="width:50px;">
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="TeaProfilePage.php?page_before_profile=teaViewCreatedQuiz.php?"> 
                        <img src="profileIcon.png">Profile
                    </a>
                    <a href="logoutPage.php?page_before_logout=teaViewCreatedQuiz.php?"> 
                        <img src="logoutIcon.png"> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <button class="back" type="button" onclick="window.location.href='TeaMainPage.php?user_id=<?php echo $_SESSION['user_id']; ?>'">< Back</button>
    <div style="padding:20px 80px;">
        <h1>All Created Quizzes</h1>
        <table>
            <thead>
                <tr>
                    <th>Quiz Name</th>
                    <th></th>
                    <th class="date-created">Date Created</th>
                    <th>Number of Responses</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $quiz_name = htmlspecialchars($row['quiz_name']);
                        $date_created = isset($row['creation_time']) ? date('d/m/Y', strtotime($row['creation_time'])) : 'N/A';

                        echo "<tr ondblclick=\"window.location.href='teaPreviewQuiz.php?page_before_preQuiz=teaViewCreatedQuiz.php&quiz_id=" . $row['quiz_id'] . "';\">";
                        echo "<td>$quiz_name</td>";

                        echo "<td class='actions-column'>
                            <div class='dropdown'>
                                <button style='border:none; background-color:transparent; font-size:20px;' onclick='toggleDropdown(" . $row['quiz_id'] . ")'>...</button>
                                <div id='dropdown1" . $row['quiz_id'] . "' class='dropdown-content'>
                                    <a class='rename-delete' href=\"javascript:void(0);\" onclick=\"openRenameModal('" . $row['quiz_id'] . "', '" . htmlspecialchars($row['quiz_name']) . "')\">Rename Quiz</a>"; ?>
                                    <form method='POST' onsubmit='return confirmDelete()' style='display: inline;' onclick='event.stopPropagation();'>
                                        <input type='hidden' name='delete_quiz_id' value="<?php echo $row['quiz_id']; ?>">
                                        <button type='submit' class='rename-delete' style='width:100%; background-color: transparent; border: none; cursor: pointer;'>
                                            Delete
                                        </button>
                                    </form>
                                    <?php echo"
                                </div>
                            </div>
                        </td>";

                        echo "<td class='date-created'>$date_created</td>";
                        echo "<td>".$row['NoOfResponses']."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No quizzes created yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
    </div>
    <div style="position:sticky; bottom:20px; height: 73px;background-color:transparent;">
        <div style="float:right; padding-right:40px; ">
            <button class="addbtn" type="button" onclick="window.location.href='TeaCreateQuiz.php'" style="width:auto;">
                <img src="adminaddbtn.png" style="width:50px;">
            </button>
        </div>
    </div>

    <!-- Rename modal -->
    <div class="renameModal" id="renameModal">
        <h3>Rename Quiz</h3>
        <form id="renameForm" method="POST" action="">
            <input type="hidden" id="quizId" name="quiz_id">
            <label for="newQuizName">New Quiz Name:</label>
            <br><br>
            <input type="text" id="newQuizName" name="quiz_name" required>
            <br><br>
            <button class="renamecancelbtn" type="button" onclick="closeRenameModal()">Cancel</button>
            <button class="renamesavebtn" type="submit">Save</button>
        </form>
    </div>

 

    <script>
        // Show dropdown
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

        function toggleDropdown(quiz_id) {
            var dropdown = document.getElementById('dropdown1' + quiz_id);
            dropdown.classList.toggle('show');
        }

        // Open Rename modal
        function openRenameModal(quizId, quizName) {
            // Close the dropdown if it's open
            var dropdown = document.getElementById('dropdown1' + quizId);
            dropdown.classList.remove('show');
            document.getElementById('quizId').value = quizId;
            document.getElementById('newQuizName').value = quizName;
            document.getElementById('renameModal').style.display = 'block';
        }

        // Close Rename modal
        // Close Rename modal
        function closeRenameModal() {
            document.getElementById('renameModal').style.display = 'none';
        }

        function confirmDelete() {
            return confirm("Are you sure you want to delete this quiz?");
        }
    </script>
</body>
</html>
