<?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        
        require 'phpmailer/src/PHPMailer.php';
        require 'phpmailer/src/SMTP.php';
        require 'phpmailer/src/Exception.php';

        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "rwdd_assignment";

        $conn = mysqli_connect($host, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (isset($_POST['reset_password'])) {
            $id = $_POST['id'];
            $email = $_POST['email'];

            if (empty($id) || empty($email)) {
                echo "ID and Email are required.";
                exit();
            }

            $sql = "
                SELECT email, name, user_type FROM (
                    SELECT student_email AS email, student_name AS name, 'student' AS user_type FROM student WHERE student_id = '$id'
                    UNION
                    SELECT teacher_email AS email, teacher_name AS name, 'teacher' AS user_type FROM teacher WHERE teacher_id = '$id'
                    UNION
                    SELECT admin_email AS email, admin_name AS name, 'admin' AS user_type FROM administrator WHERE admin_id = '$id'
                ) AS combined_table WHERE email = '$email'
            ";

            $forgotPWresult = mysqli_query($conn, $sql);

            if ($forgotPWresult->num_rows > 0) {
                $row = $forgotPWresult->fetch_assoc();
                $name = $row['name'];
                $role = $row['user_type'];
                $random_token = bin2hex(random_bytes(16));

                $updateSql = "INSERT INTO forgot_pw (id, name, email, random_pw) VALUES ('$id', '$name','$email','$random_token')";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->execute();
                if ($role == 'student'){
                    $updatePWsql = mysqli_query($conn, "UPDATE student SET student_password = '$random_token' WHERE student_id='$id'");
                }else if ($role == 'teacher'){
                    $updatePWsql = mysqli_query($conn, "UPDATE teacher SET teacher_password = '$random_token' WHERE teacher_id='$id'");
                }else if ($role == 'admin'){
                    $updatePWsql = mysqli_query($conn, "UPDATE admin SET admin_password = '$random_token' WHERE admin_id='$id'");
                }

                $mail = new PHPMailer(true);
                try {
                    // Server settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'mathwebsite12@gmail.com';
                    $mail->Password = 'azsr rhel igpj exzw';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;
        
                    // Recipients
                    $mail->setFrom('mathwebsite12@gmail.com', '+Math Website');
                    $mail->addAddress($email, $name);
        
                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Password Reset Request';
                    $mail->Body = "
                        <html>
                        <body>
                            <p>Hi $name,</p>
                            <p>Your password has been reset. Here is your new password:</p>
                            <p><strong>$random_token</strong></p>
                            <p>Please log in using the new password and change it immediately.</p>
                            <p>Regards,<br>+Math Website</p>
                        </body>
                        </html>
                    ";
        
                    $mail->send();
                    echo "An email with the new password has been sent to $email.";
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                // Redirect to the next page with the token in the URL
                header("Location: forgotpasswordconfirmationemail.php?token=$random_token&email=$email");
                exit(); // Exit after the redirect to ensure no further code is executed
            } else {
                echo "<script type='text/javascript'>alert('No user found with this ID or Email.'); window.location.href='forgotPW.php';</script>";
                exit();
            }

            $stmt->close();
        }
        $conn->close();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>+  Math</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300..800&display=swap');
        @media only screen and (min-width: 768px) {
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #FBF8F5;
            margin: 0;
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
        }

        .content {
            text-align: center;
            width: 35%;
        }

        img {
            width: 150px; 
            margin-bottom: 10px;
        }

        h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            color: #666;
            margin-bottom: 35px;
        }

        form {
            margin: 0 auto;
            text-align: left; /* Align the form contents to the left */
        }

        label {
            font-size: 16px;
            color: #333;
            display: block;
            margin-bottom: 5px;
            font-weight: 600; /* Slightly bold for emphasis */
        }

        input[type="text"], input[type="submit"] {
            box-sizing:border-box;
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            font-family: 'Open Sans', sans-serif; /* Ensure consistent font */
        }

        input[type="submit"] {
            background-color: #d81b60;
            color: #fff;
            cursor: pointer;
            margin-top:40px;
            font-size:18px;
        }

        input[type="submit"]:hover {
            opacity:0.8;
        }

        a {
            font-size: 16px;
            color: blue;
            margin-top: 10px;
            display: inline-block;
        }

        a:hover {
            color:#D81B60;
        }
    }
        @media only screen and (min-width: 320px) and (max-width:767px){
            body {
                font-family: 'Open Sans', sans-serif;
                background-color: #FBF8F5;
                margin: 0;
                padding: 0;
                display: flex; 
                justify-content: center; 
                align-items: center; 
                height: 100vh; 
            }

            .content {
                text-align: center;
                width: 80%;
                margin: 0;
                padding: 0;

            }

            img {
                width: 130px; 
                margin-bottom: 8px;
                margin: 0;
                padding: 0;
            }

            h2 {
                font-size: 28px; /* Reduced heading size */
                color: #333;
                margin-bottom: 8px;
            }

            p {
                font-size: 16px; /* Smaller text for descriptions */
                color: #666;
                margin-bottom: 35px;
            }

            form {
                margin: 0;
                padding: 0;
                text-align: left; /* Align the form contents to the left */
            }

            label {
                font-size: 16px; /* Slightly smaller labels */
                color: #333;
                display: block;
                margin-bottom: 4px;
                font-weight: 600;
            }

            input[type="text"], input[type="submit"] {
                width: 100%;
                box-sizing:border-box;
                padding: 10px 0px 10px 10px; /* Reduce padding */
                margin: 10px 0px;
                border: 1px solid #ddd;
                border-radius: 6px;
                font-size: 16px; /* Smaller font size */
                font-family: 'Open Sans', sans-serif;
            }

            input[type="submit"] {
                background-color: #d81b60;
                color: #fff;
                cursor: pointer;
                margin-top:40px;
                font-size:18px;
            }

            input[type="submit"]:hover {
                opacity:0.8;
            }

            a {
                font-size: 16px; /* Reduce link size */
                margin-top: 10px;
                display: inline-block;
                color:blue;
            }

            a:hover {
                color:#D81B60;
            }
        }
    </style>
</head>
<body>
    <div class="content">
        <img src="forgotpassword.png" alt="Forgot Password">
        <h2>Forgot Password?</h2>
        <p>No worries, we will send you email instructions.</p>
                
        <form method="POST" action="">
            <label for="id">ID</label>
            <input type="text" id="id" name="id" placeholder="Type your ID" required>
            <br><br>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="Type your email" required>
            
            <input type="submit" name="reset_password" value="Reset Password">
        </form>
        <a href="login.php">&lt; Back to Login</a>
    </div>
    

</body>
</html>
