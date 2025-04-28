<?php
    session_start(); 

    if (isset($_SESSION['user_id'])){
        $loginID = $_SESSION['user_id'];
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "rwdd_assignment";

        $conn = new mysqli($host, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT student_name FROM student WHERE student_id =".$_SESSION['user_id'];
        $stunameresult = mysqli_query($conn, $sql);
        $stuname = mysqli_fetch_array($stunameresult);
        
        if ($stuname['student_name'] != null) {
            $loginName = $stuname['student_name'];
            $loginID = $_SESSION['user_id'];
        } else {
            echo "Error preparing the statement: " . $conn->error;
        }

        $conn->close();
    }else if (isset($_GET['user_id'])){
        $loginID = $_GET['user_id'];
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "rwdd_assignment";

        $conn = new mysqli($host, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT student_name FROM student WHERE student_id =".$_GET['user_id'];
        $stunameresult = mysqli_query($conn, $sql);
        $stuname = mysqli_fetch_array($stunameresult);
        
        if ($stuname['student_name'] != null) {
            $loginName = $stuname['student_name'];
            $loginID = $_GET['user_id'];
        } else {
            echo "Error preparing the statement: " . $conn->error;
        }

        $conn->close();
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
</head>
<style>       
        @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Nanum+Myeongjo&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Sour+Gummy:wdth,wght@101.8,500&display=swap');
        *{
            font-family: "Open Sans", sans-serif;
            box-sizing:border-box;
        }

        .notificationProfileBtn {
            border-style:none; 
            background-color:transparent;
            padding:10px;
            cursor: pointer;
        }

        .notificationProfileBtn:hover {
            background-color:#f7e3c8;
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
        
        .card-button{
            background-color:white; 
            border:none;
        }

        .card-button:hover{
            opacity: 0.8;
        }

        @media only screen and (min-width: 768px) {
        .title{
            justify-content: center;
            font-size: 46px;
            font-weight: bold;
            padding-top: 100px;
            margin: 20px 0;
            text-align: center;
        }

        .card {
            width: 600px;
            height: 400px; 
            text-align: center;
            background-color: white;
            border-radius: 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: 3px solid #f1f1f1;
            display: flex;
            flex-direction: column;
            justify-content: flex-end; 
            background-size: 70%;
            background-repeat: no-repeat;
            background-position: center;
            position: relative; 
            overflow: hidden;
        }

        .card button {
            width: 100%;
            height: 50px;
            margin: 0;
            padding: 0;
            background-color: #d81b60;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 0;
            cursor: pointer;
            transition: background-color 0.3s;
            position: absolute; 
            bottom: 0;
        }

        .card button:hover {
            background-color: grey;
        }

        .container {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
            padding: 20px;
        }
    }
    @media only screen and (min-width: 320px) and (max-width:767px){
        .title{
            justify-content: center;
            font-size: 30px;
            font-weight: bold;
            padding-top: 60px;
            margin: 20px 0;
            text-align: center;
        }

        .card {
            width: 100%;
            height: 300px; 
            text-align: center;
            background-color: white;
            border-radius: 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: 3px solid #f1f1f1;
            display: flex;
            flex-direction: column;
            justify-content: flex-end; 
            background-size: 70%;
            background-repeat: no-repeat;
            background-position: center;
            position: relative; 
            overflow: hidden;
        }

        .card button {
            width: 100%;
            height: 50px;
            margin: 0;
            padding: 0;
            background-color: #d81b60;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 0;
            cursor: pointer;
            transition: background-color 0.3s;
            position: absolute; 
            bottom: 0;
        }

        .card button:hover {
            background-color: grey;
        }

        .container {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
            padding: 20px;
        }
    
    }
</style> 
<body>
    <div style="position:sticky; z-index:1; top:0; height: 73px;background-color:#FBF8F5;">
            <div style="float:left; padding:10px 10px 10px 30px;cursor:pointer;">
                <img src="logo.png" style="width:150px;" onclick="stuHP()">
            </div>
            <div style="float:right; padding-right:40px;">
                <button type="button" class="notificationProfileBtn" onclick="window.location.href='stuViewAnnouncementPage.php?user_id=<?php echo $_SESSION['user_id']; ?>&page_before_announcement=StuMainPage.php'">
                    <img src="notificationbtn.png" style="width:55px;">
                </button>
                <div class="dropdown">
                    <button class="dropbtn" id="dropbtn" type="button" onclick="profileDropDown()">
                        <img src="stuprofilebtn.png" style="width:50px;">
                    </button>
                    <div id="myDropdown" class="dropdown-content">
                        <a href="stuProfilePage.php?page_before_profile=StuMainPage.php?"> 
                            <img src="profileIcon.png">Profile
                        </a>
                        <a href="logoutPage.php?page_before_logout=StuMainPage.php?"> 
                            <img src="logoutIcon.png"> Logout
                        </a>
                    </div>
                </div>
            </div>
    </div>
    <?php if ($loginName != null): ?>
        <div class="title">
            Welcome, <strong><?php echo htmlspecialchars($loginName); ?></strong>
        </div>
    <?php else: ?>
        <div class="title">
            User not logged in or name not found.
        </div>
    <?php endif; ?>

    <div class="container">
        <div>
            <button onclick="location.href='stuViewAllUnattemptedQuizzes.php?user_id=<?php echo $loginID; ?>'" class="card-button">
                <img class="card" src="attemptQuiz.png" style="padding:0px 60px;">
                <p style="color:white; background-color:#d81b60; padding:15px; margin-top:-5px; margin-bottom:0px; font-size:16px;">Attempt Quiz</p>
            </button>
        </div>
        <div>
            <button onclick="location.href='stuViewSubmittedQuizzes.php?user_id=<?php echo $loginID; ?>'" class="card-button">
                <img class="card" src="reviewQuiz.png" style="padding:0px 60px;">
                <p style="color:white; background-color:#d81b60; padding:15px; margin-top:-5px;  margin-bottom:0px; font-size:16px;">Review Quiz</p>
                </div>
            </button>
        </div>
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

    </script>
</body>
</html>