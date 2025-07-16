<!DOCTYPE html>
<html>
<head>
    <title>Delete Resident</title>
    <style>
        body {
            background: linear-gradient(to right, #fa709a, #fee140);
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        h1 {
            color: #fff;
            font-size: 28px;
            text-shadow: 1px 1px 2px #000;
        }

        .message {
            background-color: rgba(255, 255, 255, 0.8);
            color: #333;
            padding: 20px;
            margin: 30px auto;
            width: 400px;
            border-radius: 10px;
            font-size: 18px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }

        a {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            transition: background 0.3s;
        }

        a:hover {
            background: #555;
        }
    </style>
</head>
<body>

<?php
    include("config.php");
    session_start();

    if (isset($_SESSION['row_data'])) {
        $row = $_SESSION['row_data']; // Get data from session
        $id = $row['id'];

        $result = mysqli_query($mysqli, "DELETE FROM residents WHERE id = $id");

        if ($result) {
            echo '<div class="message">✅ Successfully deleted!</div>';
        } else {
            echo '<div class="message">❌ Could not delete the record.</div>';
        }
    } else {
        echo '<div class="message">⚠️ No resident data found in session.</div>';
    }
?>

<a href="index.php">Go To Home</a>

</body>
</html>
