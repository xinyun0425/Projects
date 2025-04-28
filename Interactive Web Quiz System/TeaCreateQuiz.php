<?php
    include('session.php');
    $host = 'localhost';
    $db = 'rwdd_assignment';
    $user = 'root';
    $pass = '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
    
            $stmt = $conn->prepare("INSERT INTO quiz (quiz_name, quiz_description, creation_time, teacher_id) 
                                    VALUES (:quiz_name, :quiz_description, NOW(), :teacher_id)");
            $stmt->execute([
                ':quiz_name' => $data['quiz_name'],
                ':quiz_description' => $data['quiz_description'],
                ':teacher_id' => $data['teacher_id']
            ]);
    
            $quiz_id = $conn->lastInsertId();
    
            $stmt = $conn->prepare("INSERT INTO question (question_text, question_type, question_score, quiz_id) 
                                    VALUES (:question_text, :question_type, :question_score, :quiz_id)");
            
            $stmtOption = $conn->prepare("INSERT INTO mcq_answer (mcq_answer_text, is_ques_ans_correct,question_id) 
                                        VALUES (:option_text, :is_correct, :question_id)");
            
            $stmtStruc = $conn->prepare("INSERT INTO structure_answer (struc_answer_text, question_id) 
                                        VALUES (:strucAns_text, :question_id)");
           
            foreach ($data['questions'] as $question) {
                $stmt->execute([
                    ':question_text' => $question['text'],
                    ':question_type' => $question['type'],
                    ':question_score' => $question['score'],
                    ':quiz_id' => $quiz_id
                ]);
    
                $question_id = $conn->lastInsertId();
    
            
                if ($question['type'] === 'Multiple Choice Question' && !empty($question['options'])) {
                    foreach ($question['options'] as $option) {
                        $stmtOption->execute([
                            ':option_text' => $option['text'],
                            ':is_correct' => $option['is_correct'], 
                            ':question_id' => $question_id
                        ]);
                    }
                }else{
                    $stmtStruc->execute([
                        ':strucAns_text' => $question['answer'],
                        ':question_id' => $question_id
                    ]);
                }
            }
    
    
    
            echo json_encode(['success' => true]);
            exit;
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        exit;
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

        @media only screen and (min-width: 320px) and (max-width: 767px) {
            .column1{
                width:30%;
            }

            .column2{
                width:3%;
            }

            .column3{
                width:67%;
            }

            .question-block {
                width: 100%;
                margin-bottom: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 10px;
                background-color:#FBF8F5;
            }

            .container{
                padding:60px 40px;
            }

            .question-type-score{
                display:flex;
                padding-right:10px;
                flex-wrap:wrap;
            }

            .question{
                padding:20px 20px 10px 20px; 
                width:100%; 
                font-size:18px;
            }

            .type{
                width: 70%;
            }

            .score{
                width:30%; 
                display:flex;
            }

            .add-delete{
                display:flex; 
                flex-direction:row;
                float:right;
            }

            .add-delete-div{
                width: 100%;
            }

            .add-delete button{
                padding:0px 10px;
            }


        }

        @media only screen and (min-width: 768px) {
            .column1{
                width:15%;
            }

            .column2{
                width:3%;
            }

            .column3{
                width:82%;
            }

            .question-block {
                width: 95%;
                margin-bottom: 20px;
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 10px 20px 10px 10px;
                background-color: #fff;
                float:left;
                background-color:#FBF8F5;

            }

            .container{
                padding:60px 80px;
            }

            .question-type-score{
                display:flex;
                padding-right:10px;
            }

            .question{
                padding:20px 20px 10px 20px; 
                width:60%; 
                font-size:18px;
            }

            .type{
                width: 30%;
            }

            .score{
                width:10%; 
                display:flex;
            }

            .add-delete{
                display:flex; 
                flex-direction:column;
            }
            
            .add-delete-div{
                width: 5%;
            }
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
            background-color: #f7e3c8;
        }

        .show {
            display:block;
        }
            form {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            font-size: 16px;
        }

        input[type="text"],
        textarea,
        select,
        input[type="number"] {
            width: calc(100% - 20px);
            margin-bottom: 15px;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        textarea {
            resize: none;
            height: 80px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #D81B60;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
        }


        .question-no{
            width:100%; 
            display:flex; 
            flex-wrap:wrap;   
        }

        .option-container {
            margin-top: 10px;
        }

        button.add-option,
        button.remove-option {
            background-color: #28a745;
            color: white;
            margin-top: 5px;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            cursor: pointer;
        }

        button.add-option:hover {
            background-color: #218838;
        }

        button.remove-option {
            background-color: #dc3545;
        }

        button.remove-option:hover {
            background-color: #c82333;
        }

        button.add-question {
            margin-top: 10px;
            background-color:#D81B60;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        button.add-question:hover {
            opacity:0.8;
        }

        .save-quiz-btn {
            margin-top: 20px;
            background-color:#D81B60;
            border: none;
            padding: 10px 80px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            color: #fff;
        }

        .save-quiz-btn:hover {
            opacity:0.8;
        }

        .cancelQuiz {
            margin-top: 20px;
            background-color:white;
            border: 2px solid black;
            padding: 10px 80px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            color: black;
        }

        .cancelQuiz:hover {
            transform:scale(1.06);
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
                    <a href="TeaProfilePage.php?page_before_profile=TeaCreateQuiz.php?"> 
                        <img src="profileIcon.png">Profile
                    </a>
                    <a href="logoutPage.php?page_before_logout=TeaCreateQuiz.php?"> 
                        <img src="logoutIcon.png"> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h1 style="text-align:left; font-weight:bold; font-size:40px;">Create Quiz</h1>
        <br>
        <table style="width:100%;">
            <tr>
                <td class="column1" style="vertical-align:top;"><label for="quiz-name" style="padding-top:8px;">Quiz Name</label></td>
                <td class="column2" style="vertical-align:top;"><label style="padding-top:8px;">:</label></td>
                <td class="column3" style="vertical-align:top;"><input type="text" id="quiz-name" placeholder="Enter quiz name" ></td>
            </tr>
            <tr>
                <td class="column1" style="vertical-align:top;"><label for="quiz-description" style="padding-top:8px;">Quiz Description</label></td>
                <td class="column2" style="vertical-align:top;"><label style="padding-top:8px;">:</label></td>
                <td class="column3" style="vertical-align:top;"><textarea id="quiz-description" placeholder="Enter description"></textarea></td>
            </tr>
        </table>
        <div>
            <div id="questions-container" style="padding: 40px 15px 40px 0px; width:100%;">
                <div class="question-no">
                    <div class="question-block">
                        <div class="question-type-score">
                            <label class="question">Question</label>
                            <div class="type">
                                <select style="margin:10px 20px; padding-right:10px;" class="question-type" onchange="toggleOptions(this)" required>
                                    <option value="">Question Type</option>
                                    <option value="Subjective Question">Structured</option>
                                    <option value="Multiple Choice Question">Multiple Choice</option>
                                </select>
                            </div>
                            <div class="score">
                                <input style="margin:10px 5px 10px 20px; width:100%;" type="number" min="1" class="points-input" required>
                                <label style="padding:20px 0px 0px 0px;">points</label>
                            </div>
                        </div>
                        <textarea style="margin:10px 20px;" placeholder="Type your question"class="question-input" required></textarea>
                        <div class="struc-answer-input" style="display:none;">
                            <input style="margin:10px 20px;" type="text" placeholder="Correct answer" required>
                        </div>
                        <div class="option-container" style="display:none;">
                            <button style="margin-left:20px;"type="button" onclick="addOption(this)">Add Option</button>
                        </div>
                    </div>
                    <div class="add-delete-div">
                        <div class="add-delete">
                            <button type="button" onclick="removeQuestion(this)" style="background-color:transparent; padding-left:18px;"><img src="deleteQuestionBtn.png" width=38></button>
                            <button type="button" onclick="addQuestion()" style="background-color:transparent;"><img src="adminaddbtn.png" width=35></button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" onclick="addFirstQuestion()" class="add-question-btn" style="display:none;">Add Question</button>
            <div style="display:flex; float:right; gap:20px;">
                <button class="cancelQuiz">Cancel</button>
                <button class="save-quiz-btn">Save Quiz</button>
            </div>
        </div>
</body>
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

    document.addEventListener("DOMContentLoaded", () => {
        document.querySelector(".save-quiz-btn").addEventListener("click", async () => {
            const quizName = document.getElementById("quiz-name").value.trim();
            const quizDescription = document.getElementById("quiz-description").value.trim();
            const questionCount = document.querySelectorAll('.question-no').length;

            if (questionCount === 0){
                alert("Quiz must have at least one question.");
                return;
            }

            if (!quizName || !quizDescription) {
                alert("Quiz name and description are required.");
                return;
            }

            const questions = [];
            let hasError = false;
            
            document.querySelectorAll(".question-block").forEach((block) => {
                const questionText = block.querySelector(".question-input").value.trim();
                const questionType = block.querySelector(".question-type").value;
                const questionScore = block.querySelector(".points-input").value.trim();

                if (!questionText || !questionType || !questionScore) {
                    alert("All question fields are required.");
                    hasError = true;
                    return;
                }

                const question = {
                    text: questionText,
                    type: questionType,
                    score: parseInt(questionScore, 10),
                };
                
                if (questionType === "Multiple Choice Question") {
                    let havecorrectans = false;
                    const options = [];
                    block.querySelectorAll(".option-container > div").forEach((optionDiv) => {
                        const optionText = optionDiv.querySelector("input[type='text']").value.trim();
                        const isCorrect = optionDiv.querySelector("input[type='radio']").checked;

                        if (!optionText) {
                            alert("Option text is required for MCQ.");
                            hasError = true;
                            return;
                        }
            
                                
                        if(isCorrect){
                            havecorrectans = true;
                        }
                        options.push({text: optionText, is_correct: isCorrect});
                    });

                    if (havecorrectans === false){
                        alert("Please select a correct answer for each question.");
                        hasError = true;
                        return;
                    }

                    if (options.length <=1 ) {
                        alert("MCQs must have at least two option.");
                        hasError = true;
                        return;
                    }

                    question.options = options;
                    
                } else if (questionType === "Subjective Question") {
                    const structuredAnswer = block.querySelector(".struc-answer-input input").value.trim();
                    if (!structuredAnswer) {
                        alert("Structured answer is required.");
                        hasError = true;
                        return;
                    }
       
                    question.answer = structuredAnswer;
                
                }
                questions.push(question);
            });

            if (hasError) {
                return;
            }

            const data = {
                quiz_name: quizName,
                quiz_description: quizDescription,
                teacher_id: <?php echo $_SESSION['user_id']; ?>,
                questions: questions,
            };

           
            try {
                const response = await fetch("", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data),
                });

                const result = await response.json();
                if (result.success) {
                    alert("Quiz saved successfully!");
                    window.location.href="TeaViewCreatedQuiz.php";
                } else {
                    alert("Failed to save quiz: " + result.message);
                }
            } catch (error) {
                console.error("Error saving quiz:", error);
                alert("An error occurred while saving the quiz.");
            }
        });
        document.querySelector(".cancelQuiz").addEventListener("click", async () => {
            if (confirm("Are you sure you want to exit? \nThis quiz will not be saved.")) {
                window.location.href = "teaViewCreatedQuiz.php";
            }
        });
    });

        // Add functionality for adding options
        function addOption(button) {
            const optionContainer = button.parentElement.querySelector(".option-container");
            const newOption = document.createElement("div");
            newOption.className = "option-block";
            newOption.innerHTML = `
                <div style="display:flex;">
                    <input style="margin:0px 20px;" type="radio" class="option-input" placeholder="Option" name="correct-answer" required>
                    <input style="width:100%; margin-top:10px;" type="text" class="option-input" placeholder="Option" required>
                    <button type="button" onclick="removeOption(this)" style="background-color:transparent;padding-right:0px;"><img src="adminremovestudent.png" width='20'></button>
                </div>
            `;
            optionContainer.appendChild(newOption);
        }

        window.addOption = (button) => {
            const optionContainer = button.closest(".option-container");
            const newOption = document.createElement("div");
            newOption.className = "option-block";
            newOption.innerHTML = `
                <div style="display:flex;">
                    <input style="margin:0px 20px;" type="radio" class="option-input" placeholder="Option" name="correct-answer" required>
                    <input style="width:100%; margin-top:10px;" type="text" class="option-input" placeholder="Option" required>
                    <button type="button" onclick="removeOption(this)" style="background-color:transparent; padding-right:0px;"><img src="adminremovestudent.png" width='20'></button>
                </div>
            `;
            optionContainer.appendChild(newOption);
        };

        window.removeOption = (button) => {
            button.closest(".option-block").remove();
            
        };

        window.removeQuestion = (button) => {
            button.closest(".question-no").remove();
            const questionCount = document.querySelectorAll('.question-no').length;
            const addQuesBtn = document.getElementsByClassName('add-question-btn')[0];
            
            if (questionCount === 0){
                addQuesBtn.style.display = "block";
            }else{
                addQuesBtn.style.display = "none";
            }
        };

        window.addQuestion = () => {
            const questionContainer = document.getElementById("questions-container");
            const newQuestionBlock = document.createElement("div");
            newQuestionBlock.className = "question-no";
            newQuestionBlock.innerHTML = `
                <div class="question-block">
                    <div class="question-type-score">
                        <label class="question">Question</label>
                        <div class="type">
                            <select style="margin:10px 20px; padding-right:10px;" class="question-type" onchange="toggleOptions(this)" required>
                                <option value="">Question Type</option>
                                <option value="Subjective Question">Structured</option>
                                <option value="Multiple Choice Question">Multiple Choice</option>
                            </select>
                        </div>
                        <div class="score">
                            <input style="margin:10px 5px 10px 20px; width:100%;" type="number" min="1" class="points-input" required>
                            <label style="padding:20px 0px 0px 0px;">points</label>
                        </div>
                    </div>
                    <textarea style="margin:10px 20px;" placeholder="Type your question"class="question-input" required></textarea>
                    <div class="struc-answer-input" style="display:none;">
                        <input style="margin:10px 20px;" type="text" placeholder="Correct answer" required>
                    </div>
                    <div class="option-container" style="display:none;">
                        <button type="button" onclick="addOption(this)">Add Option</button>
                    </div>
                </div>
                <div class="add-delete-div">
                    <div class="add-delete">
                        <button type="button" onclick="removeQuestion(this)" style="background-color:transparent;"><img src="adminremovestudent.png" width=35></button>
                        <button type="button" onclick="addQuestion()" style="background-color:transparent;"><img src="adminaddbtn.png" width=35></button>
                    </div>
                </div>
            `;
            questionContainer.appendChild(newQuestionBlock);
        };

        window.toggleOptions = (select) => {
            const optionContainer = select.closest(".question-block").querySelector(".option-container");
            const strucAnsInput = select.closest(".question-block").querySelector(".struc-answer-input");
            if (select.value === "Multiple Choice Question") {
                optionContainer.style.display = "block";
                strucAnsInput.style.display = "none";
            } else {
                strucAnsInput.style.display = "block";
                optionContainer.style.display = "none";
            }
        };

        function toggleOptions(select) {
            const optionContainer = select.parentElement.querySelector(".option-container");
            const strucAnsInput = select.parentElement.querySelector(".struc-answer-input");
            if (select.value === "Multiple Choice Question") {
                optionContainer.style.display = "block";
                strucAnsInput.style.display = "none";
            } else {
                strucAnsInput.style.display = "block";
                optionContainer.style.display = "none";
            }
        }

        window.addFirstQuestion = () => {
            const questionContainer = document.getElementById("questions-container");
            const newQuestionBlock = document.createElement("div");
            newQuestionBlock.className = "question-no";
            newQuestionBlock.innerHTML = `
                <div class="question-block">
                    <div class="question-type-score">
                        <label class="question">Question</label>
                        <div class="type">
                            <select style="margin:10px 20px; padding-right:10px;" class="question-type" onchange="toggleOptions(this)" required>
                                <option value="">Question Type</option>
                                <option value="Subjective Question">Structured</option>
                                <option value="Multiple Choice Question">Multiple Choice</option>
                            </select>
                        </div>
                        <div class="score">
                            <input style="margin:10px 5px 10px 20px; width:100%;" type="number" min="1" class="points-input" required>
                            <label style="padding:20px 0px 0px 0px;">points</label>
                        </div>
                    </div>
                    <textarea style="margin:10px 20px;" placeholder="Type your question"class="question-input" required></textarea>
                    <div class="struc-answer-input" style="display:none;">
                        <input style="margin:10px 20px;" type="text" placeholder="Correct answer" required>
                    </div>
                    <div class="option-container" style="display:none;">
                        <button type="button" onclick="addOption(this)">Add Option</button>
                    </div>
                </div>
                <div class="add-delete-div">
                    <div class="add-delete">
                        <button type="button" onclick="removeQuestion(this)" style="background-color:transparent;"><img src="adminremovestudent.png" width=35></button>
                        <button type="button" onclick="addQuestion()" style="background-color:transparent;"><img src="adminaddbtn.png" width=35></button>
                    </div>
                </div>
            `;
            questionContainer.appendChild(newQuestionBlock);
            const addQuesBtn = document.getElementsByClassName('add-question-btn')[0];
            addQuesBtn.style.display = "none";
        };
        
</script>
</html>