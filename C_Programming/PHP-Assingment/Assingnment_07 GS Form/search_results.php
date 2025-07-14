<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recitent Results</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            font-family: Arial,sans-serif;
            margin-left: 400px;
            margin-right: 400px;
            margin: 20px;
            background: #D9D27A;
        }
        .resident-details{
            border:1px,solid,#ddd;
            padding:20px;
            margin-bottom: 20px;
            margin-right: 5px;
            background-color: #6355A5;
        }
        .resident-details h2{
            margin-top: 0;
        }
        .buttons{
            margin-top: 15px;
        }
        .btn{
            padding: 10px 15px;
            margin:5px;
            border:none;
            cursor:pointer;
            border-radius: 3px;
        }
        .modify-btn{
            background-color:  #4CAF50;
            color:white;
        }
        .delete-btn{
            background-color: #f44936;
            color:white;

        }
         
    </style>
</head>
       <body>
                <?php
                include("config.php");

                if(isset($_POST['submit'])){
                    $fullname = $_POST['fullname'];
                    $nic = $_POST['nic'];  
                    $address = $_POST['address'];     

                    $result= mysqli_query($mysqli,"SELECT * FROM residents WHERE full_name LIKE '%$fullname%' AND nic LIKE '%$nic%' AND address LIKE '%$address%'");
                
                    if($result){
                        echo "Resident Fount!";
                        $row = mysqli_fetch_assoc($result);
                    }
                    else{
                        echo "Resident Not Fount!";
                    }
                       
                
                }
                ?>

                <h1>Resident Result Found</h1>
             
                <div class = "resident-details">
                    <h2>Resident Detailes</h2>
                    <p><strong>Id:<?php echo $row['id'];?></strong> </p>
                    <p><strong>Full_Name:<?php echo $row['full_name'];?></strong> </p>
                    <p><strong>Date of Birth:<?php echo $row['dob'];?></strong> </p>
                    <p><strong>NIC:<?php echo $row['nic'];?></strong> </p>
                    <p><strong>Address:<?php echo $row['address'];?></strong> </p>
                    <p><strong>Phone:<?php echo $row['phone'];?></strong> </p>
                    <p><strong>Email:<?php echo $row['email'];?></strong> </p>
                    <p><strong>Occupation:<?php echo $row['occupation'];?></strong> </p>
                    <p><strong>Gender:<?php echo $row['gender'];?></strong> </p>
                    <p><strong>Registered Date:</strong> <?php echo $row['registered_date']; ?></p>



                        <div class = "buttons">
                              <?php
                                 session_start();
                                 $_SESSION['row_data'] = $row; // save in session
                               ?>     
                    
                                 <a href = "modify.php">
                                 <button class = "btn modify-btn" name = "submit"> Modify</button>
                                 </a>

                                 <a href = "delete.php">
                                 <button class = "btn modify-btn" name = "submit"> Delete</button>
                              </a>

                       </div>

                  </div>


        </body>
</html>