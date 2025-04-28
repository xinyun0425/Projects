<?php
    include('session.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
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
            .allaccounts{
                padding: 20px 40px;
            }

            .modal-content {
                background-color: #fefefe;
                margin: 5% auto 15% auto;
                border: 1px solid #888;
                width: 80%;
            }

            .column3{
                display:none;
            }

            .column4{
                display:none;
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

            .allaccounts{
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

        #search_account {
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

        input[type=email] {
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

        select[readonly] {
            pointer-events: none;
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div style="position:sticky; top:0; height: 73px;background-color:#FBF8F5;">
        <div style="float:left; padding:10px 10px 10px 30px; cursor: pointer">
            <img src="logo.png" style="width:150px;" onclick="window.location.href='AdmMainPage.php'">
        </div>
        <div style="float:right; padding-right:40px;">
            <div class="dropdown">
                <button class="dropbtn" id="dropbtn" type="button" onclick="profileDropDown()">
                    <img src="stuprofilebtn.png" style="width:50px;">
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="AdmProfilePage.php?page_before_profile=AdmViewAllAccounts.php"> 
                        <img src="profileIcon.png">Profile
                    </a>
                    <a href="logoutPage.php?page_before_profile=AdmViewAllAccounts.php"> 
                        <img src="logoutIcon.png"> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <button class="back" type="submit" name="back" onclick="window.location.href='AdmMainPage.php'">< Back</button>

    <div class="allaccounts">
        <h1>All Accounts</h1>

        <input type="text" id="search_account" onkeyup="filterAccount()" placeholder="Search user name">

        <?php
            $con=mysqli_connect("localhost","root","","rwdd_assignment");
        
            if(mysqli_connect_errno()){
                echo "Failed to connect to MySQL:".mysqli_connect_error();
            }

            $sql = "SELECT student_name AS name, student_id AS id, student_password AS password, student_email AS email, 'Student' AS role FROM student
            UNION
            SELECT teacher_name AS name, teacher_id AS id, teacher_password AS password, teacher_email AS email, 'Teacher' AS role FROM teacher
            UNION
            SELECT admin_name AS name, admin_id AS id, admin_password AS password, admin_email AS email, 'Admin' AS role FROM administrator
            ORDER BY name";
            
            $result = mysqli_query($con, $sql);
        ?>

        <table id="account_table">
            <tr>
                <th style="width:38%;">Name</th>
                <th style="width:8%;"> </th>
                <th class="column3" style="width:12%;">ID</th>
                <th class="column4" style="width:27%;">Email</th>
                <th style="width:15%;">Role</th>
            </tr>
            
            <?php
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr class="row_hover">
                    <td><?php echo $row['name']; ?></td>
                    
                    <td>
                        <div class="adminclass3dotdropdown" onclick="event.stopPropagation();">
                            <button class="adminclass3dotbtn" type="button" onclick="toggleDropdown(this)">
                                <img src="adminclass3dot.png" style="width:25px;">
                            </button>
                            <div class="adminclass3dotdropdown-content">
                                <a onclick="event.stopPropagation(); openEditModal('<?php echo $row['id']; ?>', '<?php echo $row['name']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['role']; ?>')">
                                    Edit
                                </a>
                                <form method="POST" onsubmit="return confirmDelete()" style="display: inline;" onclick="event.stopPropagation();">
                                    <input type="hidden" name="delete_account_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="delete_account_role" value="<?php echo $row['role']; ?>">
                                    <button type="submit">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>

                    <td class="column3"><?php echo $row['id']; ?></td>

                    <td class="column4"><?php echo $row['email']; ?></td>

                    <td><?php echo $row['role']; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>

    <div style="position:sticky; bottom:0; height: 73px;background-color:transparent;">
        <div style="float:right; padding-right:40px;">
            <button class="addbtn" type="button" 
            onclick="document.getElementById('addAccount').style.display='block'" style="width:auto;">
                <img src="adminaddbtn.png" style="width:50px;">
            </button>
        </div>
    </div>

    <div id="addAccount" class="modal">
        <form class="modal-content animate" action="#" method="post">
            <div class="imgcontainer">
                <span onclick="document.getElementById('addAccount').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>

            <div class="container">
                <h1>Create Account</h1>
                <p>Please fill in this form to create an account.</p>
                <br>

                <label for="account_name"><b>Name</b></label>
                <input type="text" placeholder="Enter user name" name="account_name" required>
                <br><br>

                <label for="account_email"><b>Email</b></label>
                <input type="email" placeholder="Enter user email" name="account_email" required>
                <br><br>

                <label for="account_password"><b>Password</b></label>
                <input type="text" placeholder="Enter user password" name="account_password" required>
                <br><br>

                <label for="account_role"><b>Role</b></label>
                <?php
                    $con=mysqli_connect("localhost","root","","rwdd_assignment");
                
                    if(mysqli_connect_errno()){
                        echo "Failed to connect to MySQL:".mysqli_connect_error();
                    }

                    if(isset($_POST['createBtn'])){
                        $name = mysqli_real_escape_string($con,$_POST['account_name']);
                        $email = mysqli_real_escape_string($con,$_POST['account_email']);
                        $password = mysqli_real_escape_string($con,$_POST['account_password']);
                        $role = mysqli_real_escape_string($con,$_POST['account_role']);

                        if ($role == "Student"){
                            $sql_insert = "INSERT INTO student (student_name, student_password, student_email) VALUES ('$name', '$password', '$email')";
                        }else if ($role == "Teacher"){
                            $sql_insert = "INSERT INTO teacher (teacher_name, teacher_password, teacher_email) VALUES ('$name', '$password', '$email')";
                        }else if ($role == "Admin"){
                            $sql_insert = "INSERT INTO administrator (admin_name, admin_password, admin_email) VALUES ('$name', '$password', '$email')";
                        }
                        
                        if (mysqli_query($con, $sql_insert)) {
                            $mail = new PHPMailer(true);
                            try {
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com';
                                $mail->SMTPAuth = true;
                                $mail->Username = 'mathwebsite12@gmail.com';
                                $mail->Password = 'azsr rhel igpj exzw'; 
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                $mail->Port = 587;
                        
                                $mail->setFrom('mathwebsite12@gmail.com', '+Math Website');
                                $mail->addAddress($email, $name); 
                        
                                $mail->isHTML(true);
                                $mail->Subject = 'Account Created';
                                $mail->Body = "Hi $name, <br><br>Your account has been created successfully!<br><br>Email: $email<br>Password: $password<br>Role: $role<br><br>Best regards,<br>+Math Website";
                        
                                $mail->send();
                                echo "<script>alert('New account created successfully. Email sent to the user.'); window.location.href = 'AdmViewAllAccounts.php';</script>";
                            } catch (Exception $e) {
                                echo "<script>alert('New account created successfully but email could not be sent. Error: {$mail->ErrorInfo}'); window.location.href = 'AdmViewAllAccounts.php';</script>";
                            }

                        } else {
                            echo "<script>alert('Error creating account. Please try again.');</script>";
                        }
                    }
                ?>
                <select name="account_role" required>
                    <option value="" disabled selected>Select role</option>
                    <option value="Student">Student</option>
                    <option value="Teacher">Teacher</option>
                    <option value="Admin">Admin</option>
                </select>
                <br><br><br>
                <button class="addformbtn" type="submit" name="createBtn">Create</button>
            </div>
        </form>
    </div>

    <div id="editAccount" class="modal">
        <form class="modal-content animate" action="#" method="post">
            <div class="imgcontainer">
                <span onclick="document.getElementById('editAccount').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>

            <div class="container">
                <h1>Edit Account</h1>
                <p>Please update the account details below.</p>
                <br>

                <label for="edit_account_name"><b>Name</b></label>
                <input type="text" id="edit_account_name" name="edit_account_name" placeholder="Enter user name" required>
                <br><br>

                <label for="edit_account_email"><b>Email</b></label>
                <input type="email" id="edit_account_email" placeholder="Enter user email" name="edit_account_email" required>
                <br><br>

                <label for="edit_account_role"><b>Role</b></label>
                <?php
                    $con=mysqli_connect("localhost","root","","rwdd_assignment");
                
                    if(mysqli_connect_errno()){
                        echo "Failed to connect to MySQL:".mysqli_connect_error();
                    }
                    if(isset($_POST['updateBtn'])){
                        $id = mysqli_real_escape_string($con,$_POST['edit_id']);
                        $name = mysqli_real_escape_string($con,$_POST['edit_account_name']);
                        $email = mysqli_real_escape_string($con,$_POST['edit_account_email']);
                        $role = mysqli_real_escape_string($con,$_POST['edit_account_role']);
                        
                        if ($role == "Student"){
                            $update_query = "UPDATE student SET student_name = '$name', student_email = '$email' WHERE student_id = '$id'";
                        }else if ($role == "Teacher"){
                            $update_query = "UPDATE teacher SET teacher_name = '$name, teacher_email = '$email' WHERE teacher_id = '$id'";
                        }else if ($role == "Admin"){
                            $update_query = "UPDATE administrator SET admin_name = '$name', admin_email = '$email' WHERE admin_id = '$id'";
                        }
                        if (mysqli_query($con, $update_query)) {
                            $mail1 = new PHPMailer(true);

                            try {
                                $mail1->isSMTP();
                                $mail1->Host = 'smtp.gmail.com';
                                $mail1->SMTPAuth = true;
                                $mail1->Username = 'mathwebsite12@gmail.com'; 
                                $mail1->Password = 'azsr rhel igpj exzw'; 
                                $mail1->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                $mail1->Port = 587;
                        
                                // Recipients
                                $mail1->setFrom('mathwebsite12@gmail.com', '+Math Website');
                                $mail1->addAddress($email, $name); 
                        
                                // Content
                                $mail1->isHTML(true);
                                $mail1->Subject = 'Account Updated';
                                $mail1->Body = "Hi $name, <br><br>Your account details have been updated successfully!<br><br>
                                    Email: $email<br>
                                    Role: $role<br><br>
                                    Best regards,<br>+Math Website";
                        
                                $mail1->send();
                                echo "<script>alert('Account updated successfully. Email sent to the user.'); window.location.href = 'AdmViewAllAccounts.php';</script>";
                            } catch (Exception $e) {
                                echo "<script>alert('Account updated successfully but email could not be sent. Error: {$mail1->ErrorInfo}'); window.location.href = 'AdmViewAllAccounts.php';</script>";
                            }
                        } else {
                            echo "<script>alert('Error updating account. Please try again.');</script>";
                        }
                    }
                   
                ?>
                <select id="edit_account_role" name="edit_account_role" readonly>
                    <option value="" disabled selected>Select role</option>
                    <option value="Student">Student</option>
                    <option value="Teacher">Teacher</option>
                    <option value="Admin">Admin</option>
                </select>
                <br><br><br>
                <input type="hidden" id="edit_id" name="edit_id">
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_account_id']) && isset($_POST['delete_account_role'])) {
            $account_id = mysqli_real_escape_string($con, $_POST['delete_account_id']);
            $account_role = mysqli_real_escape_string($con, $_POST['delete_account_role']);

            if ($account_role == "Student"){
                $check_query = "SELECT COUNT(*) FROM student_take_quiz WHERE student_id = '$account_id'";
            }else if ($account_role == "Teacher"){
                $check_query = "SELECT COUNT(*) FROM class WHERE teacher_id = '$account_id'";
            }else if ($account_role == "Admin"){
                $check_query = "SELECT COUNT(*) FROM class WHERE admin_id = '$account_id'";
            }

            $result1 = mysqli_query($con, $check_query);
            if (mysqli_num_rows($result1) > 0) {
                echo "<script>alert('The account cannot be deleted because it is referenced in other tables in the database. Please remove any dependencies first.'); window.location.href = 'AdmViewAllAccounts.php';</script>";
            }else{
                if ($account_role == "Student"){
                    $delete_query = "DELETE FROM student WHERE student_id = '$account_id'";
                }else if ($account_role == "Teacher"){
                    $delete_query = "DELETE FROM teacher WHERE teacher_id = '$account_id'";
                }else if ($account_role == "Admin"){
                    $delete_query = "DELETE FROM administrator WHERE admin_id = '$account_id'";
                }
            
                if (mysqli_query($con, $delete_query)) {
                    echo "<script>alert('Account deleted successfully.'); window.location.href = 'AdmViewAllAccounts.php';</script>";
                } else {
                    echo "<script>alert('Error deleting account. Please try again.');</script>";
                }
            }

        }

        $result = mysqli_query($con, "SELECT student_name AS name, student_id AS id, student_email AS email, 'Student' AS role FROM student
            UNION
            SELECT teacher_name AS name, teacher_id AS id, teacher_email AS email, 'Teacher' AS role FROM teacher
            UNION
            SELECT admin_name AS name, admin_id AS id, admin_email AS email, 'Admin' AS role FROM administrator
            ORDER BY name");
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

        function filterAccount() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search_account");
            filter = input.value.toUpperCase();
            table = document.getElementById("account_table");
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

        function openEditModal(id, accountName, accountEmail, accountRole) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_account_name').value = accountName;
            document.getElementById('edit_account_email').value = accountEmail;
            document.getElementById('edit_account_role').value = accountRole;
            document.getElementById('editAccount').style.display = 'block';
        }

        function confirmDelete() {
    const confirmed = confirm("Are you sure you want to delete this account?");
    console.log("User confirmation: ", confirmed); // Debugging output
    return confirmed;
}
    </script>

</body>
</html>