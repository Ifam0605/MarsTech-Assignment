<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Data</title>
    <style>
        body {
            background: linear-gradient(to right, #fcb045, #fd1d1d, #833ab4);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 40px;
        }
        h1 {
            color: #fff;
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
        }
        h2 {
            color: #fefefe;
            text-align: center;
            font-size: 26px;
            font-weight: bold;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
            margin-bottom: 10px;
        }
        a {
            display: block;
            width: fit-content;
            margin: 30px auto;
            padding: 10px 20px;
            background: #fff;
            color: #333;
            font-size: 20px;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
        }
        a:hover {
            background: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <?php   
        include("config.php");

        if(isset($_POST['submit'])){

          /*  session_start();
            if(isset($_SESSION['row_data'])){
                $row = $_SESSION['row_data']; // get data from session
            }

            $id = $row['id'];
        */
            $fullname = $_POST['fullname'];
            $dob = $_POST['dob'];
            $nic = $_POST['nic'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $occupation = $_POST['occupation'];
            $gender = $_POST['gender'];

            $result = mysqli_query($mysqli, "UPDATE residents SET full_name = '$fullname', dob = '$dob', nic = '$nic', address = '$address', phone = '$phone', email = '$email', occupation = '$occupation', gender = '$gender' WHERE id = $id");
            
            if($result){
                echo "<h1>Data updated successfully</h1>";
            } else {
                echo "<h2>Data not updated</h2>";
            }
        }
    ?>
    <a href="index.php">Go TO Home</a>
</body>
</html>
