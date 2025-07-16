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
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(45deg, #74512D, #4a4a4a);
            font-family: 'Arial', sans-serif;
        }
        label {
            display: block;
            margin: 10px 0;
            color: white;
        }
        input, select, textarea {
            width: 100%;
            padding: 5px;
        }
        button {
            margin-top: 15px;
            color: white;
            background: #381a06;
            border: none;
            padding: 12px 40px;
            cursor: pointer;
        }
        h1, h3 {
            color: white;
            text-align: center;
        }
        .error {
            color: red;
            font-size: 13px;
        }
        form {
            background: rgba(59, 44, 44, 0.05);
            padding: 50px;
            border-radius: 10px;
            width: 350px;
            
        }
            a.btn {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: white;
            background: #381a06;
            border: none;
            padding: 12px 40px;
           text-align: center;
           cursor: pointer;
           font-family: inherit;
           font-size: 16px;
           border-radius: 5px;
        }
         a.btn:hover {
           background: #5a2a0a;
        }


    </style>
</head>
<body>

<?php
$fullnameerr = $doberr = $nicerr = $addresserr = $phoneerr = $emailerr = $gendererr = "";
$fullname = $dob = $nic = $address = $phone = $email = $gender = $occupation = "";

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["fullname"])) {
        $fullnameerr = "Full Name is required";
    } else {
        $fullname = test_input($_POST["fullname"]);
        if (!preg_match("/^[a-zA-Z\s]*$/", $fullname)) {
            $fullnameerr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["dob"])) {
        $doberr = "Date of birth is required";
    } else {
        $dob = test_input($_POST["dob"]);
    }

    if (empty($_POST["nic"])) {
        $nicerr = "NIC is required";
    } else {
        $nic = test_input($_POST["nic"]);
        if (!preg_match("/^([0-9]{9}[VXvx]|[0-9]{12})$/", $nic)) {
            $nicerr = "Invalid NIC. Only numbers, V or X are allowed";
        }
    }

    if (empty($_POST["address"])) {
        $addresserr = "Address is required";
    } else {
        $address = test_input($_POST["address"]);
    }

    if (empty($_POST["phone"])) {
        $phoneerr = "Phone number is required";
    } else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $phoneerr = "Invalid phone number. 10 digits only.";
        }
    }

    if (empty($_POST["email"])) {
        $emailerr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailerr = "Invalid email format";
        }
    }

    if (empty($_POST["gender"])) {
        $gendererr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    if (!empty($_POST["occupation"])) {
        $occupation = test_input($_POST["occupation"]);
    }

    if (
        empty($fullnameerr) && empty($doberr) && empty($nicerr) && empty($addresserr) &&
        empty($phoneerr) && empty($emailerr) && empty($gendererr)
    ) {
        include("config.php");

$sql = "INSERT INTO residents (full_name, dob, nic, address, phone, email, occupation, gender)
        VALUES ('$fullname', '$dob', '$nic', '$address', '$phone', '$email', '$occupation', '$gender')";



        $result = mysqli_query($mysqli, $sql);

        if ($result) {
            echo '<div style="color: yellow; font-weight: bold; font-size: 30px; margin-top: 20px;">Resident registered successfully</div>';
        } else {
            echo '<div style="color: red; font-weight: bold; font-size: 20px;">Data not stored: ' . mysqli_error($mysqli) . '</div>';
        }
    }
}
?>

<h1>Grama Niladhari Resident Management</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h3>Register Form</h3>

    <label>Full Name <input type="text" name="fullname" id="fullname"></label>
    <span class="error">* <?php echo $fullnameerr; ?></span>

    <label>Date Of Birth <input type="date" name="dob" id="dob"></label>
    <span class="error">* <?php echo $doberr; ?></span>

    <label>NIC <input type="text" name="nic" id="nic"></label>
    <span class="error">* <?php echo $nicerr; ?></span>

    <label>Address <textarea name="address" id="address"></textarea></label>
    <span class="error">* <?php echo $addresserr; ?></span>

    <label>Phone <input type="tel" name="phone" id="phone"></label>
    <span class="error">* <?php echo $phoneerr; ?></span>

    <label>Email <input type="email" name="email" id="email"></label>
    <span class="error">* <?php echo $emailerr; ?></span>

    <label>Occupation <input type="text" name="occupation" id="occupation"></label>

    <label>Gender
        <select name="gender" id="gender">
            <option value="">Select gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
    </label>
    <span class="error">* <?php echo $gendererr; ?></span>

    <button type="submit" name="submit">Register Resident</button>
    <a href="index.php" class="btn">Home</a>
    </button>
</form>

</body>
</html>
