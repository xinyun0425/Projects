<?php
    session_start();
    $con=mysqli_connect("localhost","root","","rwdd_assignment");
    
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL:".mysqli_connect_error();
    }
    if(isset($_POST['login'])){
        $loginRole = $_COOKIE['login-role'];
        echo $loginRole;
        $loginID =  mysqli_real_escape_string($con, $_POST['loginID']);
        $loginPW = $_POST['loginPw'];
        if ($loginRole == "student") {
            $studentPwQuery = "SELECT student_id, student_password FROM student WHERE student_id = '$loginID'";
            $loginResult = mysqli_query($con, $studentPwQuery);
            if ($loginResult && mysqli_num_rows($loginResult) == 1) {
                $row = mysqli_fetch_assoc($loginResult);
                $studentPW = $row['student_password'];
                if ($loginPW === $studentPW) {
                    $_SESSION['user_id'] = $row['student_id'];
                    $_SESSION['user_role']="student";
                    echo "<script>alert('Login Successful.'); window.location.href='StuMainPage.php';</script>";
                } else {
                    echo "<script>alert('Login Unsuccessful.'); window.location.href='login.php';</script>";
                }
            } else {
                echo "<script>alert('Login Unsuccessful.'); window.location.href='login.php';</script>";
            }
        }else if ($loginRole == "teacher") {
            $teacherPwQuery = "SELECT teacher_id, teacher_password FROM teacher WHERE teacher_id = '$loginID'";
            $loginResult = mysqli_query($con, $teacherPwQuery);
            if ($loginResult && mysqli_num_rows($loginResult) == 1) {
                $row = mysqli_fetch_assoc($loginResult);
                $teacherPW = $row['teacher_password'];
                if ($loginPW === $teacherPW) {
                    $_SESSION['user_id'] = $row['teacher_id'];
                    $_SESSION['user_role']="teacher";
                    echo "<script>alert('Login Successful.'); window.location.href='TeaMainPage.php';</script>";
                } else {
                    echo "<script>alert('Login Unsuccessful.'); window.location.href='login.php';</script>";
                }
            } else {
                echo "<script>alert('Login Unsuccessful.'); window.location.href='login.php';</script>";
            }
        }else if ($loginRole == "admin") {
            $adminPwQuery = "SELECT admin_id, admin_password FROM administrator WHERE admin_id = '$loginID'";
            $loginResult = mysqli_query($con, $adminPwQuery);
            if ($loginResult && mysqli_num_rows($loginResult) == 1) {
                $row = mysqli_fetch_assoc($loginResult);
                $adminPW = $row['admin_password'];
                if ($loginPW === $adminPW) {
                    $_SESSION['user_id'] = $row['admin_id'];
                    $_SESSION['user_role']="admin";
                    echo "<script>alert('Login Successful.'); window.location.href='AdmMainPage.php';</script>";
                } else {
                    echo "<script>alert('Login Unsuccessful.'); window.location.href='login.php';</script>";
                }
            } else {
                echo "<script>alert('Login Unsuccessful.'); window.location.href='login.php';</script>";
            }
        }else{
            echo "<script>alert('Error Occured.'); window.location.href='login.php';</script>";
        }
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
        /* For mobile phones: */
        @media only screen and (max-width:767px) {
            .login-image-mobile{
                width: 100%;
            }

            .login{
                padding: 40px;
                float:center;
            }

            .login-image-website{
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

            .login-image-website {
                width: 100%;
                float: left;
            }

            .login-image-mobile{
                display:none;
            }

            .login{
                padding: 40px 120px;
                flex: 1 1 100%;
                float:left;
            }

            .login-image-div{
                background-color:#b6e2d3;
                height: 915px;
                float:left;
                width: 50%;
                display:flex;
                align-items:center;
            }        
        }


        *{
            box-sizing: border-box;
            font-family: "Open Sans", sans-serif;
            
        }

        button{
            font-size:20px; 
            width: 100%; 
            padding: 10px; 
            background-color:#d81b60; 
            border:none; 
            color:white;
        }
        
        button:hover{
            background-color:#ec407a;
        }

        a:hover{
            color:#D81B60;
        }
        
        /* Container for role options */
        .role-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .login-id{
            padding-top: 40px;
            padding-bottom: 20px;
        }

        .login-password{
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .image-container {
            width: 150px;
            max-height: 135px;
            height:auto;
            border-radius: 5px;
            display: flex;
            cursor: pointer; 
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: border-color 0.3s ease; 
            margin: 10px; 
            cursor: pointer;
        }

        .image-container.selected {
            border: 4px solid #d81b60; 
        }

        .image-container img {
            max-width: 100%; 
            display: block;
        }
    </style>
</head>

<body>
    <div>
        <div class="col-6 login-image-div">
            <img class="login-image-mobile" src="mathloginimageMobile.png">
            <img class="login-image-website" src="test1li.png" width="850px">
        </div>
        <div class="login col-6" >
            <h1 style="font-size:45px;">Login</h1>
            <p style="font-weight: normal; font-size:16px;">Please select your role</p>
            <form id="loginForm" method="post" action="#">
                <div class="role-container">
                    <div class="image-container" data-value="student">
                        <img src="studentAvatar.png" width="auto">
                    </div>
                    <div class="image-container" data-value="teacher">
                        <img src="teacherAvatar.png" width="auto">
                    </div>
                    <div class="image-container" data-value="admin">
                        <img src="adminAvatar.png" width="auto">
                    </div>
                       
                </div>
                <div class="login-id">
                    <div style="font-size:18px; padding-bottom:10px; font-weight:600;">ID</div>
                    <div>
                        <input style="width: 100%; padding: 10px; font-size:18px;" type="text" name="loginID" placeholder="Type your ID" required>
                    </div>
                </div>
                <div class="login-password">
                    <div style="font-size:18px; padding-bottom:10px; font-weight:600;">Password</div>
                    <div>
                        <input style="width: 100%; padding: 10px; font-size:18px;" type="password" name="loginPw" placeholder="Type your password" required>
                    </div>
                </div>
                <div style="padding-top: 40px;">
                    <button type="submit" name="login">Login</button>
                </div>
                <div style="padding-top: 30px; text-align: center;">
                    <a href="forgotPw.php">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        const containers = document.querySelectorAll('.image-container');
        let selectedRole = null;

        containers.forEach(container => {
            container.addEventListener('click', () => {
                containers.forEach(div => div.classList.remove('selected'));
                container.classList.add('selected');
                selectedRole = container.getAttribute('data-value');
                document.cookie = "login-role="+ selectedRole;
            });
        });

        const loginForm = document.getElementById('loginForm');

        loginForm.addEventListener('submit', (event) => {
            if (!selectedRole) {
                alert('Please select a role before submitting the form.');
                event.preventDefault(); // Prevent form submission
            }
        });
    </script>
    
</body>
</html>