<?php
    include('session.php');

    if(isset($_GET['page_before_logout'])){
        $PageBeforeLogout =$_GET['page_before_logout'];
    }
    $user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>+  Math</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap');
        @media only screen and (min-width: 768px) {
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #737373;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .logout-container {
            width: 400px;
            background: #FBF8F5;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 30px;
        }

        .logout-container .icon {
            font-size: 60px;
            margin-bottom: 20px;
        }

        .logout-container .icon img {
            width: 80px;
            height: 80px;
        }

        .logout-container h2 {
            font-size: 24px;
            color: #000;
            margin-bottom: 15px;
        }

        .logout-container p {
            font-size: 16px;
            color: #555;
            margin-bottom: 30px;
        }

        .logout-container .button-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .logout-container button {
            flex: 1;
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .cancel-btn {
            background-color: #D81B60;
            border: 4px solid black;
            color: white;
        }

        .cancel-btn:hover {
            opacity:0.8;
        }

        .confirm-btn {
            background-color: #D81B60;
            border: 4px solid black;
            color: white;
        }

        .confirm-btn:hover {
            opacity:0.8;
        }
    }
        @media only screen and (min-width: 320px) and (max-width:767px){
            body {
                font-family: 'Open Sans', sans-serif;
                background-color: #737373;
                margin: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .logout-container {
                width: 90%; /* Adjust to occupy most of the screen width on mobile */
                max-width: 280px; /* Limit maximum size */
                background: #FBF8F5;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
                padding: 20px; /* Reduced padding */
            }

            .logout-container .icon {
                font-size: 40px; /* Reduced size */
                margin-bottom: 15px;
            }

            .logout-container .icon img {
                width: 60px; /* Reduced size */
                height: 60px;
            }

            .logout-container h2 {
                font-size: 18px; /* Reduced size */
                color: #000;
                margin-bottom: 10px;
            }

            .logout-container p {
                font-size: 14px; /* Reduced size */
                color: #555;
                margin-bottom: 20px;
            }

            .logout-container .button-container {
                display: flex;
                flex-direction: column; /* Stack buttons on mobile */
                gap: 10px;
            }

            .logout-container button {
                flex: none; /* Allow buttons to size independently */
                padding: 8px 10px; /* Reduced padding */
                font-size: 14px; /* Reduced size */
                border: none;
                cursor: pointer;
            }

            .cancel-btn, .confirm-btn {
                background-color: #D81B60;
                border: 2px solid black; /* Reduced border thickness */
                color: white;
            }
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <div class="icon">
            <img src="logoutpageicon.png" alt="Logout Icon" width="80px" height="80px">
        </div>
        <h2>Logout</h2>
        <p>Are you sure you want to logout from +Math website?</p>
        <div class="button-container">
            <button class="cancel-btn" onclick="window.location.href='<?php echo $PageBeforeLogout; ?>?user_id=<?php echo $user_id; ?>'"><strong>Cancel</strong></button>
            <button class="confirm-btn" onclick="logout()"><strong>Confirm</strong></button>
        </div>
    </div>
</body>
</html>

<script>
    function logout(){
        alert('You have been logged out.');
        window.location.href='logoutsession.php';
    }
</script>
