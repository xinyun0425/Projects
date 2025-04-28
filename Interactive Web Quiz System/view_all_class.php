<?php
include('session.php');
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
            .allclasses{
                padding: 20px 60px;
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

            .allclasses{
                padding: 20px 80px;
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
        }

        .dropbtn {
            border-style:none; 
            background-color:transparent;
            padding: 10px;
            cursor: pointer;
        }

        .dropbtn:hover, .dropbtn:focus {
            background-color: #f6dae3;
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
            height:50px;
        }
  
        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .show {
            display:block;
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
        
        .row_hover:hover {
            background-color: #FBF8F5;
            cursor: pointer;
        }        
    </style>  
</head>
<body>
<div style="position:sticky; z-index:1; top:0; height: 73px;background-color:#FBF8F5;">
        <div style="float:left; padding:10px 10px 10px 30px; cursor: pointer">
            <img src="logo.png" style="width:150px;" onclick="window.location.href='TeaMainPage.php'">
        </div>
        <div style="float:right; padding-right:40px;">
            <div class="dropdown">
                <button class="dropbtn" id="dropbtn" type="button" onclick="profileDropDown()">
                    <img src="stuprofilebtn.png" style="width:50px;">
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="TeaProfilePage.php?page_before_profile=view_all_class.php?"> 
                        <img src="profileIcon.png">Profile
                    </a>
                    <a href="logoutPage.php?page_before_logout=view_all_class.php?"> 
                        <img src="logoutIcon.png"> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
        <br>
        <button class="back" type="submit" name="back" onclick="window.location.href='TeaMainPage.php'">< Back</button>
    <div class="allclasses">
        <h1>All Classes</h1>
        <?php
            $con=mysqli_connect("localhost","root","","rwdd_assignment");

            if(mysqli_connect_errno()){
                echo "Failed to connect to MySQL:".mysqli_connect_error();
            }

            $sql="SELECT class.class_id, class.class_name, class.teacher_id, COUNT(student.student_id) AS class_count
            FROM class LEFT JOIN student ON class.class_id=student.class_id
            GROUP BY class.class_id, class.class_name, class.teacher_id
            ORDER BY class.class_name
            ";
            $result=mysqli_query($con,$sql);
        ?>

        <table id="class_table">
            <tr>
                <th style="width:50%;">Class Name</th>
                <th style="width:42%;">Number of Student</th>
            </tr>    

            <?php
            while ($row=mysqli_fetch_array($result)){
                ?>
                <tr class="row_hover" onclick="window.location.href='view_class_main_page.php?class_id=<?php echo $row['class_id']; ?>'">
                    <td><?php echo $row['class_name'];?></td>
                    <td><?php echo $row['class_count'];?></td>
                </tr>
            <?php                
            }
            ?>
        </table>
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