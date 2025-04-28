<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>+ Math</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Nanum+Myeongjo&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Sour+Gummy:wdth,wght@101.8,500&display=swap');

        /* For mobile phones: */
        @media only screen and (max-width:767px) {
            .allmembers{
                padding: 20px 40px;
            }

            .modal-content {
                background-color: #fefefe;
                margin: 5% auto 15% auto;
                border: 1px solid #888;
                width: 80%;
            }
        }

        @media only screen and (min-width: 768px) {
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

            .allmembers{
                padding: 20px 80px;
            }

            .modal-content {
                background-color: #fefefe;
                margin: 5% auto 15% auto; 
                border: 1px solid #888;
                width: 50%;
            }
        }

        * {
            box-sizing: border-box;
            font-family: "Open Sans", sans-serif;

        }
 
       .back{
            font-size: 16px; 
            background-color:white; 
            border-style:none; 
            padding-left:40px;
            cursor: pointer
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
            height: 50px;
        }

        .dropdown-content a:hover {
            background-color: #f7e3c8;
        }

        .show {
            display:block;
        }

        #search_student {
            background-image: url('https://www.w3schools.com/css/searchicon.png');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        #search_student_no_class {
            background-image: url('https://www.w3schools.com/css/searchicon.png');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
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
        
        .row_hover:hover {background-color: #FBF8F5;}

        .adminclass3dotbtn {
            border-style:none; 
            background-color:transparent;
            cursor: pointer;
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

        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 16px;
        }

        select {
            width: 100%;
            height: 48px;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 16px;
            background-color: default;
        }

        .addformbtn {
            background-color: #D81B60;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .addformbtn:hover {
            opacity: 0.8;
        }

        .imgcontainer {
            text-align: center;
            margin: 20px 0 40px 40px;
            position: relative;
        }

        .container {
            padding-left: 50px;
            padding-right: 50px;
            padding-bottom: 50px;
            padding-top: 25px;
        }

        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px;
        }

        .close {
            position: absolute;
            right: 25px;
            top: 0;
            color: #000;
            font-size: 35px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #D81B60;
            cursor: pointer;
        }

        .animate {
            -webkit-animation: animatezoom 0.6s;
            animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom {
            from {-webkit-transform: scale(0)} 
            to {-webkit-transform: scale(1)}
        }
            
        @keyframes animatezoom {
            from {transform: scale(0)} 
            to {transform: scale(1)}
        }

        .scrollable-wrapper {
            max-height: 190px;
            overflow: auto;
            border: 1px solid #ddd;
        }

        .tick-cell::after {
            content: '✔';
            color: black;
            display: none;
        }

        .tick-cell.selected::after {
            display: inline;
        }

        .selected-row {
            background-color: #FBF8F5;
        }

        .selected-row td {
            color: #000; 
        }
    </style>
</head>
<body>
    <div style="position:sticky; z-index:1; top:0; height: 73px;background-color:#FBF8F5;">
        <div style="float:left; padding:10px 10px 10px 30px; cursor: pointer">
            <img src="logo.png" style="width:150px;" onclick="window.location.href='adminHomePage.php'">
        </div>
        <div style="float:right; padding-right:40px;">
            <div class="dropdown">
                <button class="dropbtn" id="dropbtn" type="button" onclick="profileDropDown()">
                    <img src="stuprofilebtn.png" style="width:50px;">
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="AdmProfilePage.php?page_before_profile=ClassDetailsPage.php"> 
                        <img src="profileIcon.png">Profile
                    </a>
                    <a href="logoutPage.php?page_before_logout=ClassDetailsPage.php"> 
                        <img src="logoutIcon.png"> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <button class="back" type="submit" name="back" onclick="window.location.href='AdminViewAllClasses.php'">< Back</button>

    <div class="allmembers">
        <?php
            $con = mysqli_connect("localhost", "root", "", "rwdd_assignment");

            if (mysqli_connect_errno()) {
                die("Failed to connect to MySQL: " . mysqli_connect_error());
            }
    
            // Check if class_id is provided
            if (isset($_GET['class_id'])) {
                $class_id = mysqli_real_escape_string($con, $_GET['class_id']);
                
                // Fetch class details
                $class_query = "SELECT class_name FROM class WHERE class_id = '$class_id'";
                $class_result = mysqli_query($con, $class_query);
    
                if ($class_row = mysqli_fetch_assoc($class_result)) {
                    $class_name = $class_row['class_name'];
    
                    // Fetch class student
                    $student_query = "SELECT student_id, student_name FROM student WHERE class_id = '$class_id' ORDER BY student_name";
                    $student_result = mysqli_query($con, $student_query);

                    // Fetch class teacher
                    $teacher_query = "SELECT class.class_id, teacher.teacher_name FROM class INNER JOIN teacher ON class.teacher_id = teacher.teacher_id WHERE class.class_id = '$class_id'";
                    $teacher_result = mysqli_query($con, $teacher_query);
                } else {
                    echo "<script>
                            alert('Class not found.');
                            window.location.href = 'AdminViewAllClasses.php';
                          </script>";
                    exit();
                }
            } else {
                echo "<script>
                        alert('No class selected.');
                        window.location.href = 'AdminViewAllClasses.php';
                      </script>";
                exit();
            }
    
            // Handle delete action
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_student_id'], $_POST['class_id'])) {
                $student_id = mysqli_real_escape_string($con, $_POST['delete_student_id']);
                $delete_query = "UPDATE student SET class_id = NULL WHERE student_id = '$student_id'";
    
                if (mysqli_query($con, $delete_query)) {
                    echo "<script>
                            alert('Student removed successfully.');
                            window.location.href = 'ClassDetailsPage.php?class_id=' + $class_id;
                          </script>";
                    exit();
                } else {
                    echo "<script>
                            alert('Error deleting student. Please try again.');
                          </script>";
                }
            }
        ?>

        <h1><?php echo $class_name; ?></h1>

        <input type="text" id="search_student" onkeyup="filterStudent()" placeholder="Search student name">

        <table>
            <tr>
                <th style="width:90%;">Teacher</th>
            </tr>
            
            <?php 
                if (mysqli_num_rows($teacher_result) > 0) {
                    while ($teacher = mysqli_fetch_assoc($teacher_result)) { ?>
                        <tr class="row_hover">
                            <td><?php echo htmlspecialchars($teacher['teacher_name']); ?></td>
                        </tr>
                    <?php 
                    }
                } else { ?>
                    <tr>
                        <td colspan="2">No teacher in this class.</td>
                    </tr>
                <?php 
                } 
            ?>
        </table>

        <br><br>

        <table id="student_table">
            <tr>
                <th style="width:90%;">Student</th>
                <th style="width:10%;"> </th>
            </tr>
            
            <?php 
                if (mysqli_num_rows($student_result) > 0) {
                    while ($student = mysqli_fetch_assoc($student_result)) { ?>
                        <tr class="row_hover">
                            <td><?php echo htmlspecialchars($student['student_name']); ?></td>
                            <td>
                                <form method="POST" onsubmit="return confirmDelete()" style="display: inline;">
                                    <input type="hidden" name="delete_student_id" value="<?php echo $student['student_id']; ?>">
                                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                                    <button class="adminclass3dotbtn" type="submit">
                                        <img src="adminremovestudent.png" style="width:20px;">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php 
                    }
                } else { ?>
                    <tr>
                        <td colspan="2">No student in this class.</td>
                    </tr>
                <?php 
                } 
            ?>
        </table>
    </div>

    <div style="position:sticky; bottom:0; height: 73px;background-color:transparent;">
        <div style="float:right; padding-right:40px;">
            <button class="addbtn" type="button" 
            onclick="resetModal(); document.getElementById('addStudent').style.display='block'" style="width:auto;">
                <img src="adminaddstudent.png" style="width:50px;">
            </button>
        </div>
    </div>

    <div id="addStudent" class="modal">
        <form class="modal-content animate" action="ClassDetailsPage.php?class_id=<?php echo $class_id; ?>" method="post" onsubmit="return validateSelection()">
            <div class="imgcontainer">
                <span onclick="document.getElementById('addStudent').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>

            <div class="container">
                <?php
                    $con = mysqli_connect("localhost", "root", "", "rwdd_assignment");

                    if (mysqli_connect_errno()) {
                        die("Failed to connect to MySQL: " . mysqli_connect_error());
                    }
            
                    // Fetch students without class
                    $studentsxclass_query = "SELECT * FROM student WHERE class_id IS NULL ORDER BY student_name";
                    $studentsxclass_result = mysqli_query($con, $studentsxclass_query);

                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['student_id'], $_POST['class_id'])) {
                        $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
                        $class_id = mysqli_real_escape_string($con, $_POST['class_id']);
                    
                        $update_query = "UPDATE student SET class_id = '$class_id' WHERE student_id = '$student_id'";
                    
                        if (mysqli_query($con, $update_query)) {
                            echo "<script>
                                    alert('Student added successfully.');
                                    window.location.href = 'ClassDetailsPage.php?class_id=$class_id';
                                  </script>";
                            exit();
                        } else {
                            echo "<script>
                                    alert('Error adding student. Please try again.');
                                  </script>";
                        }
                    }
                ?>
                <h1>Add Student</h1>
                <p>Please select a student from the list below.</p>
                <br>
                <input type="text" id="search_student_no_class" onkeyup="filterStudentNoClass()" placeholder="Search student name">
                
                <input type="hidden" id="selected_student_id" name="student_id">
                <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                
                <div class="scrollable-wrapper">
                    <table id="student_no_class_table">
                        <tr>
                            <th style="width: 90%;">Student(s) Without Class Assigned</th>
                            <th style="width: 10%;"> </th>
                        </tr>
                        
                        <?php 
                            if (mysqli_num_rows($studentsxclass_result) > 0) {
                                while ($student = mysqli_fetch_assoc($studentsxclass_result)) { ?>
                                    <tr class="row_hover" style="cursor: pointer;" onclick="selectRow(this, '<?php echo $student['student_id']; ?>')">
                                        <td><?php echo htmlspecialchars($student['student_name']); ?></td>
                                        <td class="tick-cell"></td>
                                    </tr>
                                <?php 
                                }
                            } else { ?>
                                <tr>
                                    <td colspan="2">No student without class assigned.</td>
                                </tr>
                            <?php 
                            } 
                        ?>
                    </table>
                </div>
                <br>
                <button class="addformbtn" type="submit" name="createBtn">Add Student</button>
            </div>
        </form>
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

        function filterStudent() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search_student");
            filter = input.value.toUpperCase();
            table = document.getElementById("student_table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }

        function filterStudentNoClass() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search_student_no_class");
            filter = input.value.toUpperCase();
            table = document.getElementById("student_no_class_table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }

        function confirmDelete() {
            return confirm("Are you sure you want to remove this student from this class?");
        }

        function selectRow(row, studentId) {
            // Deselect any previously selected row
            const table = document.getElementById("student_no_class_table");
            const rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) { // Start from 1 to skip header row
                rows[i].classList.remove("selected-row"); // Remove highlight class from all rows
                const tickCell = rows[i].getElementsByClassName("tick-cell")[0];
                if (tickCell) {
                    tickCell.classList.remove("selected"); // Remove tick from all tick cells
                }
            }

            // Highlight the current row
            row.classList.add("selected-row"); // Add highlight class to clicked row
            const tickCell = row.getElementsByClassName("tick-cell")[0];
            if (tickCell) {
                tickCell.classList.add("selected"); // Show tick in the tick cell
            }

            // Store the selected student ID
            document.getElementById("selected_student_id").value = studentId;
        }

        function validateSelection() {
            const studentId = document.getElementById("selected_student_id").value;
            console.log("Selected student ID:", studentId); // Debugging
            if (!studentId) {
                alert("Please select a student from the list.");
                return false;
            }
            return true;
        }

        function resetModal() {
            // Reset the search input field
            document.getElementById("search_student_no_class").value = "";

            // Reset the visibility of all rows in the table
            const table = document.getElementById("student_no_class_table");
            const tr = table.getElementsByTagName("tr");

            // Loop through all rows and ensure they're displayed
            for (let i = 1; i < tr.length; i++) { // Start at 1 to skip the header row
                tr[i].style.display = ""; // Reset display to default
                tr[i].classList.remove("selected-row"); // Remove any previously selected rows
                const tickCell = tr[i].getElementsByClassName("tick-cell")[0];
                if (tickCell) {
                    tickCell.classList.remove("selected"); // Remove tick from selected cells
                }
            }

            // Clear the hidden input field for the selected student ID
            document.getElementById("selected_student_id").value = "";
        }
    </script>

</body>
</html>