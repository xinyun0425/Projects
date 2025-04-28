<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>+  Math</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Nanum+Myeongjo&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Sour+Gummy:wdth,wght@101.8,500&display=swap');
    *{
      font-family: 'Open Sans', sans-serif;
    }
    @media only screen and (min-width: 768px) {
    body {
      font-family: 'Open Sans', sans-serif;
      text-align: center;
      background-color: #FBF8F5;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;

    }

    .icon {
      font-size: 100px; /* Increased icon size */
      color: #000;
      margin-bottom: 30px;
    }

    .icon img {
      width: 150px;
    }

    h1 {
      font-size: 36px; /* Increased heading size */
      font-weight: 600;
      color: #000;
      margin: 0 0 30px;
    }

    p {
      font-size: 18px; /* Increased paragraph font size */
      font-weight: 400;
      color: #555;
      margin: 0 0 30px;
      line-height: 1.8;
    }

    .btn {
      display: inline-block;
      font-size: 20px;
      color: #fff;
      background-color: #D81B60;
      padding: 13px 70px;  
      border-radius: 8px;
      text-decoration: none;
      border: none;
      cursor: pointer;
      margin-top:20px;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #C2185B; /* Slightly darker shade on hover */
    }

  }
  @media only screen and (min-width: 320px) and (max-width:767px){
    body {
      font-family: 'Open Sans', sans-serif;
      text-align: center;
      background-color: #FBF8F5;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .icon {
      font-size: 60px; 
      margin-bottom: 10px;
    }

    .icon img {
      width: 130px; 
    }

    h1 {
      font-size: 30px;
      font-weight: 600;
      color: #000;
      margin: 0 0 20px;
    }s

    p {
      font-size: 15px; 
      font-weight: 400;
      color: #555;
      margin: 0 0 20px;
      line-height: 1.5; 
      word-wrap: break-word;
      overflow-wrap: break-word;
      white-space: normal;
      padding-bottom: 30px;
    }

    .btn {
      display: inline-block;
      font-size: 18px;
      color: #fff;
      background-color: #D81B60;
      padding: 13px 70px; 
      border-radius: 5px;
      text-decoration: none;
      border: none;
      cursor: pointer;
      margin-top:40px;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #C2185B;
    }

  }

  </style>
</head>
<body>
  <div class="icon">
    <img src="emailconfirmation.png" alt="Mail Icon">
  </div>
  <?php
    if (isset($_GET['email'])) {
        $email = $_GET['email']; 
    }

    if (isset($_GET['token'])) {
        $token = $_GET['token']; // Retrieve the token from the URL
    } else {
        die("Invalid request: token is missing.");
    }
    echo "<h1>Check Your Email</h1>";
    echo "<p>We have sent password recovery instructions to <strong>$email</strong>.<br>
            Please follow the instructions to reset your password.</p>";

    echo '<button class="btn" onclick="window.location.href=\'login.php\'">Back to Login Page</button>';
    ?>

</body>
</html>
