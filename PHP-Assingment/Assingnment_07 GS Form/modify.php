<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Residents</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #ff9a9e, #fad0c4, #fad0c4, #fbc2eb, #a6c1ee);
            font-family: 'Arial', sans-serif;
            margin: 0;
        }
        form {
            background: linear-gradient(to right, #FCB454, #f7797d);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            width: 420px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.25);
            animation: pop-in 0.3s ease-out;
        }
        @keyframes pop-in {
            from { transform: scale(0.95); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        label {
            display: block;
            margin: 15px 0 5px;
            font-weight: bold;
            color: #2c3e50;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            transition: 0.3s ease;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #6a82fb;
            box-shadow: 0 0 5px #6a82fb;
        }
        button {
            margin-top: 25px;
            color: white;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            border: none;
            padding: 12px 40px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.4s ease;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        button:hover {
            background: linear-gradient(to right, #43cea2, #185a9d);
        }
        h1 {
            color: #ffffff;
            text-align: center;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px #00000040;
        }
        h3 {
            text-align: center;
            color: #fff;
            margin-bottom: 25px;
            text-shadow: 1px 1px 2px #00000020;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #ffffff;
            font-weight: bold;
            font-size: 18px;
            text-decoration: none;
            transition: 0.3s;
        }
        a:hover {
            color: #000000;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php
        session_start();
        if (isset($_SESSION['row_data'])) {
            $row = $_SESSION['row_data'];
        }
    ?>

    <h1>Grama Nilathari Residents Management System</h1>

    <form method="POST" action="modify_process.php">
        <h3>Modify Details</h3>

        <label>Full Name
            <input type="text" name="fullname" id="fullname" value="<?php echo $row['full_name'] ?>">
        </label>

        <label>Date Of Birth
            <input type="date" name="dob" id="dob" value="<?php echo $row['dob'] ?>">
        </label>

        <label>NIC
            <input type="text" name="nic" id="nic" value="<?php echo $row['nic'] ?>">
        </label>

        <label>Address
            <input type="text" name="address" id="address" value="<?php echo $row['address'] ?>">
        </label>

        <label>Phone 
            <input type="tel" name="phone" id="phone" value="<?php echo $row['phone']; ?>">
        </label>


        <label>Email
            <input type="text" name="email" id="email" value="<?php echo $row['email'] ?>">
        </label>

        <label>Occupation
            <input type="text" name="occupation" id="occupation" value="<?php echo $row['occupation'] ?>">
        </label>

        <label>Gender
            <select name="gender" id="gender" value="<?php echo $row['gender'] ?>">
                <option value="">Select gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </label>

        <button type="submit" name="submit">Modify</button>

        <a href="index.php">Go To Home</a>
    </form>
</body>
</html>
