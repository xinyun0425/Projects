<?php
    include('session.php');
?>

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
            .allclasses{
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

            .allclasses{
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

        #search_class {
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
        
        .row_hover:hover {background-color: #FBF8F5; cursor: pointer}

        .adminclass3dotbtn {
            border-style:none; 
            background-color:transparent;
            cursor: pointer;
        }

        .adminclass3dotdropdown {
            position: relative;
            display: inline-block;
        }

        .adminclass3dotdropdown-content {
            display: none;
        }

        .adminclass3dotdropdown-content.show {
            display: block;
            position: absolute;
            background-color: #f1f1f1;
            margin-top: 5px;
            min-width: 100px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .adminclass3dotdropdown-content a {
            color: black;
            padding: 10px 10px;
            text-decoration: none;
            display: flex;
            text-align:center;
            align-items:center;
            font-size: 14px;
            gap: 10px;
        }

        .adminclass3dotdropdown-content a:hover {
            background-color: #f7e3c8;
        }

        .adminclass3dotdropdown-content form {
            display: flex;
            align-items: center;
            text-align: center;
            font-size: 14px;
        }

        .adminclass3dotdropdown-content form button {
            background: none; 
            border: none;
            font-size: 14px;
            padding: 0 10px;
            text-decoration: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            height: 39px;
            width: 100px;
        }

        .adminclass3dotdropdown-content form button:hover {
            background-color: #f7e3c8;
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
    </style>
</head>
<body>
    <div style="position:sticky; z-index:1; top:0; height: 73px;background-color:#FBF8F5;">
        <div style="float:left; padding:10px 10px 10px 30px; cursor: pointer">
            <img src="logo.png" style="width:150px;" onclick="window.location.href='AdmMainPage.php'">
        </div>
        <div style="float:right; padding-right:40px;">
            <div class="dropdown">
                <button class="dropbtn" id="dropbtn" type="button" onclick="profileDropDown()">
                    <img src="stuprofilebtn.png" style="width:50px;">
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="AdmProfilePage.php?page_before_profile=AdminViewAllClasses.php"> 
                        <img src="profileIcon.png">Profile
                    </a>
                    <a href="logoutPage.php?page_before_logout=AdminViewAllClasses.php"> 
                        <img src="logoutIcon.png"> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <button class="back" type="submit" name="back" onclick="window.location.href='AdmMainPage.php'">< Back</button>

    <div class="allclasses">
        <h1>All Classes</h1>

        <input type="text" id="search_class" onkeyup="filterClass()" placeholder="Search class name">

        <?php
            $con=mysqli_connect("localhost","root","","rwdd_assignment");
        
            if(mysqli_connect_errno()){
                echo "Failed to connect to MySQL:".mysqli_connect_error();
            }

            $sql = "SELECT class.class_id, class.class_name, class.teacher_id, COUNT(student.student_id) AS class_count
            FROM class LEFT JOIN student ON class.class_id = student.class_id
            GROUP BY class.class_id, class.class_name, class.teacher_id
            ORDER BY class.class_name, class.class_id, class.teacher_id";
            
            $result = mysqli_query($con, $sql);
        ?>

        <table id="class_table">
            <tr>
                <th style="width:50%;">Class Name</th>
                <th style="width:8%;"> </th>
                <th style="width:42%;">Number of Student</th>
            </tr>
            
            <?php
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr class="row_hover" onclick="window.location.href='ClassDetailsPage.php?class_id=<?php echo $row['class_id']; ?>'">
                    <td><?php echo $row['class_name']; ?></td>
                    
                    <td>
                        <div class="adminclass3dotdropdown" onclick="event.stopPropagation();">
                            <button class="adminclass3dotbtn" type="button" onclick="toggleDropdown(this)">
                                <img src="adminclass3dot.png" style="width:25px;">
                            </button>
                            <div class="adminclass3dotdropdown-content">
                                <a onclick="event.stopPropagation(); openEditModal('<?php echo $row['class_id']; ?>', '<?php echo $row['class_name']; ?>', '<?php echo $row['teacher_id']; ?>')">
                                    Edit
                                </a>
                                <form method="POST" onsubmit="return confirmDelete()" style="display: inline;" onclick="event.stopPropagation();">
                                    <input type="hidden" name="delete_class_id" value="<?php echo $row['class_id']; ?>">
                                    <button type="submit">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>

                    <td><?php echo $row['class_count']; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>

    <div style="position:sticky; bottom:0; height: 73px;background-color:transparent;">
        <div style="float:right; padding-right:40px;">
            <button class="addbtn" type="button" 
            onclick="document.getElementById('addClass').style.display='block'" style="width:auto;">
                <img src="adminaddbtn.png" style="width:50px;">
            </button>
        </div>
    </div>

    <div id="addClass" class="modal">
        <form class="modal-content animate" action="#" method="post">
            <div class="imgcontainer">
                <span onclick="document.getElementById('addClass').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>

            <div class="container">
                <h1>Create Class</h1>
                <p>Please fill in this form to create a class.</p>
                <br>
                <label for="class_name"><b>Class Name</b></label>
                <input type="text" placeholder="Enter class name" name="class_name" required>
                <br><br>
                <label for="teacher"><b>Teacher</b></label>
                <?php
                    $con=mysqli_connect("localhost","root","","rwdd_assignment");
                
                    if(mysqli_connect_errno()){
                        echo "Failed to connect to MySQL:".mysqli_connect_error();
                    }

                    $sql = "SELECT * FROM teacher ORDER BY teacher_name";
                    
                    $all_teacher = mysqli_query($con, $sql);

                    if(isset($_POST['createBtn'])){
                        $name = mysqli_real_escape_string($con,$_POST['class_name']);
                        $id = mysqli_real_escape_string($con,$_POST['teacher']);
                        $admin_id = $_SESSION['user_id'];

                        $check_query = "SELECT * FROM class WHERE class_name = '$name'";
                        $check_result = mysqli_query($con, $check_query);

                        if (mysqli_num_rows($check_result) > 0) {
                            echo "<script>alert('Error: Class name already exists. Please choose another name.');</script>";
                        } else {
                            $sql_insert="INSERT INTO class (class_name, teacher_id, admin_id) 
                            VALUES ('$name','$id', '$admin_id')";

                            if (!mysqli_query($con,$sql_insert)){
                                die('Error'.mysqli_error());
                            }else{
                                echo "<script>alert('New class created successfully.'); window.location.href = 'AdminViewAllClasses.php';</script>";
                            }
                        }
                    }
                ?>
                <select placeholder="Select teacher" name="teacher" required>
                    <option value="" disabled selected>Select teacher</option> 
                    <?php 
                        while ($teacher_name = mysqli_fetch_array(
                                $all_teacher,MYSQLI_ASSOC)):; 
                    ?>
                        <option value="<?php echo $teacher_name["teacher_id"];?>">
                            <?php 
                                echo $teacher_name["teacher_name"];
                            ?>
                        </option>
                    <?php 
                        endwhile; 
                    ?>
                </select>
                <br><br><br>
                <button class="addformbtn" type="submit" name="createBtn">Create</button>
            </div>
        </form>
    </div>

    <div id="editClass" class="modal">
        <form class="modal-content animate" action="#" method="post">
            <div class="imgcontainer">
                <span onclick="document.getElementById('editClass').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>

            <div class="container">
                <h1>Edit Class</h1>
                <p>Please update the class details below.</p>
                <br>
                <label for="edit_class_name"><b>Class Name</b></label>
                <input type="text" id="edit_class_name" name="edit_class_name" placeholder="Enter class name" required>
                <br><br>
                <label for="edit_teacher"><b>Teacher</b></label>
                <?php
                    $con=mysqli_connect("localhost","root","","rwdd_assignment");
                
                    if(mysqli_connect_errno()){
                        echo "Failed to connect to MySQL:".mysqli_connect_error();
                    }

                    $sql = "SELECT * FROM teacher ORDER BY teacher_name";

                    $all_teacher = mysqli_query($con, $sql);

                    if (isset($_POST['updateBtn'])) {
                        $classId = mysqli_real_escape_string($con, $_POST['edit_class_id']);
                        $className = mysqli_real_escape_string($con, $_POST['edit_class_name']);
                        $teacherId = mysqli_real_escape_string($con, $_POST['edit_teacher']);
                    
                        // Check for duplicate class name
                        $check_query = "SELECT * FROM class WHERE class_name = '$className' AND class_id != '$classId'";
                        $check_result = mysqli_query($con, $check_query);
                    
                        if (mysqli_num_rows($check_result) > 0) {
                            echo "<script>alert('Error: Class name already exists. Please choose another name.');</script>";
                        } else {
                            $update_query = "UPDATE class SET class_name = '$className', teacher_id = '$teacherId' WHERE class_id = '$classId'";
                            
                            if (mysqli_query($con, $update_query)) {
                                echo "<script>alert('Class updated successfully.'); window.location.href = 'AdminViewAllClasses.php';</script>";
                            } else {
                                echo "<script>alert('Error updating class.');</script>";
                            }
                        }
                    }
                ?>
                <select id="edit_teacher" name="edit_teacher" required>
                    <?php
                        while ($teacher_name = mysqli_fetch_array($all_teacher, MYSQLI_ASSOC)): ?>
                            <option value="<?php echo $teacher_name["teacher_id"]; ?>">
                                <?php echo $teacher_name["teacher_name"]; ?>
                            </option>
                    <?php endwhile; ?>
                </select>
                <br><br><br>
                <input type="hidden" id="edit_class_id" name="edit_class_id">
                <button class="addformbtn" type="submit" name="updateBtn">Update</button>
            </div>
        </form>
    </div>

    <!-- Delete Class Function php -->
    <?php
        $con = mysqli_connect("localhost", "root", "", "rwdd_assignment");

        if (mysqli_connect_errno()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_class_id'])) {
            $class_id = mysqli_real_escape_string($con, $_POST['delete_class_id']);

            $delete_query = "DELETE FROM class WHERE class_id = '$class_id'";
            if (mysqli_query($con, $delete_query)) {
                echo "<script>alert('Class deleted successfully.'); window.location.href = 'AdminViewAllClasses.php';</script>";
            } else {
                echo "<script>alert('Error deleting class. Please try again.');</script>";
            }
        }

        $result = mysqli_query($con, "SELECT * FROM class");
    ?>

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

        function filterClass() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search_class");
            filter = input.value.toUpperCase();
            table = document.getElementById("class_table");
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

        function toggleDropdown(button) {
            // Close all other open dropdowns
            document.querySelectorAll('.adminclass3dotdropdown-content').forEach(menu => {
                if (menu !== button.nextElementSibling) {
                    menu.classList.remove('show');
                }
            });

            // Toggle the dropdown for the clicked button
            const dropdownContent = button.nextElementSibling;
            if (dropdownContent) {
                dropdownContent.classList.toggle('show');
            }
        }

        function openEditModal(classId, className, teacherId) {
            document.getElementById('edit_class_name').value = className;
            document.getElementById('edit_class_id').value = classId;
            document.getElementById('edit_teacher').value = teacherId;
            document.getElementById('editClass').style.display = 'block';
        }

        function confirmDelete() {
            return confirm("Are you sure you want to delete this class?");
        }
    </script>

</body>
</html>