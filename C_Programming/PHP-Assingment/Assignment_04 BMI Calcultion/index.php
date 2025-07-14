<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container, .report-container {
            border: 1px solid #ccc;
            padding: 20px;
            width: 50%;
            margin: 20px 0;
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
        }
        .form-container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }
        .form-container button {
            padding: 10px 20px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h2>BMI Calculator</h2>
    <div class="form-container">
        <form method="POST" action="">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="contact_number">Contact Number:</label>
            <input type="text" id="contact_number" name="contact_number" required>

            <label for="weight">Weight (KG):</label>
            <input type="number" id="weight" name="weight" step="0.1" required>

            <label for="height">Height (cm):</label>
            <input type="number" id="height" name="height" step="0.1" required>

            <button type="submit" name="submit">Submit</button>
            <button type="reset">Clear</button>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        // Collect form data
        $full_name = htmlspecialchars($_POST['full_name']);
        $age = htmlspecialchars($_POST['age']);
        $address = htmlspecialchars($_POST['address']);
        $contact_number = htmlspecialchars($_POST['contact_number']);
        $weight_kg = floatval($_POST['weight']);
        $height_cm = floatval($_POST['height']);

        // Convert height to meters
        $height_m = $height_cm / 100;

        // Calculate BMI
        $bmi = $weight_kg / ($height_m * $height_m);
        $bmi = round($bmi, 1);

        // Convert weight to pounds (1 kg = 2.205 pounds)
        $weight_pounds = round($weight_kg * 2.205);

        // Convert height to feet and inches (1 cm = 0.0328084 feet)
        $height_feet_total = $height_cm * 0.0328084;
        $height_feet = floor($height_feet_total);
        $height_inches = round(($height_feet_total - $height_feet) * 12);

        // Determine BMI category
        $category = '';
        if ($bmi < 18.5) {
            $category = 'Under healthy weight';
        } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
            $category = 'Healthy weight';
        } elseif ($bmi >= 25 && $bmi <= 29.9) {
            $category = 'Overweight';
        } elseif ($bmi >= 30 && $bmi <= 34.9) {
            $category = 'Obese I';
        } elseif ($bmi >= 35 && $bmi <= 39.9) {
            $category = 'Obese II';
        } else {
            $category = 'Obese III';
        }

        // Display the report (Figure 2)
        echo '<div class="report-container">';
        echo '<h3>BMI Report of ' . $full_name . '</h3>';
        echo '<p><strong>Age:</strong> ' . $age . '</p>';
        echo '<p><strong>Address:</strong> ' . $address . '</p>';
        echo '<p><strong>Contact Number:</strong> ' . $contact_number . '</p>';
        echo '<hr>';
        echo '<p><strong>Weight (Pounds):</strong> ' . $weight_pounds . '</p>';
        echo '<p><strong>Height (Inches):</strong> ' . $height_feet . '\' ' . $height_inches . '"</p>';
        echo '<p><strong>BMI:</strong> ' . $bmi . '</p>';
        echo '<p><strong>Category:</strong> ' . $category . '</p>';
        echo '</div>';
    }
    ?>
</body>
</html>