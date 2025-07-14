<html>
<body>
    <div class="container">
        <h2>Display the Submitted Data</h2>

        <?php
        // Initialize variables
        $fullname = $email = $contact = $dob = $position = $resume = $coverletter = $linkedin = $experience = $skills = "";
        $errors = [];

        // Validate form on submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validate Full Name
            if (empty($_POST["fullname"])) {
                $errors["fullname"] = "Full Name is required.";
            } else {
                $fullname = test_input($_POST["fullname"]);
            }

            // Validate Email
            if (empty($_POST["email"])) {
                $errors["email"] = "Email is required.";
            } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "Invalid email format.";
            } else {
                $email = test_input($_POST["email"]);
            }

            // Validate Contact Number
            if (empty($_POST["contact"])) {
                $errors["contact"] = "Contact Number is required.";
            } elseif (!preg_match("/^[0-9]{10}$/", $_POST["contact"])) {
                $errors["contact"] = "Invalid contact number format (10 digits only).";
            } else {
                $contact = test_input($_POST["contact"]);
            }

            // Validate Date of Birth
            if (empty($_POST["dob"])) {
                $errors["dob"] = "Date of Birth is required.";
            } else {
                $dob = test_input($_POST["dob"]);
            }

            // Validate Position
            if (empty($_POST["position"])) {
                $errors["position"] = "Position is required.";
            } else {
                $position = test_input($_POST["position"]);
            }

            // Validate Resume (PDF file)
            if (isset($_FILES["resume"]) && $_FILES["resume"]["error"] == 0) {
                $allowed_types = ["application/pdf"];
                $file_type = $_FILES["resume"]["type"];
                $file_extension = strtolower(pathinfo($_FILES["resume"]["name"], PATHINFO_EXTENSION));

                if (!in_array($file_type, $allowed_types) || $file_extension != "pdf") {
                    $errors["resume"] = "Resume must be a PDF file.";
                } else {
                    $resume = $_FILES["resume"]["name"];
                    $upload_dir = "uploads/";
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0755, true); // Create the directory if it doesn't exist
                    }
                    move_uploaded_file($_FILES["resume"]["tmp_name"], $upload_dir . $resume);
                }
            } else {
                $errors["resume"] = "Resume file is required.";
            }

            // Validate Cover Letter
            if (empty($_POST["coverletter"])) {
                $errors["coverletter"] = "Cover Letter is required.";
            } else {
                $coverletter = test_input($_POST["coverletter"]);
            }

            // Validate LinkedIn Profile
            if (empty($_POST["linkedin"])) {
                $errors["linkedin"] = "LinkedIn Profile is required.";
            } else {
                $linkedin = test_input($_POST["linkedin"]);
            }

            // Validate Work Experience
            if (empty($_POST["experience"])) {
                $errors["experience"] = "Work Experience is required.";
            } else {
                $experience = test_input($_POST["experience"]);
            }

            // Validate Skills
            if (isset($_POST["skills"]) && is_array($_POST["skills"])) {
                $skills = implode(", ", $_POST["skills"]);
            } else {
                $errors["skills"] = "At least one skill must be selected.";
            }

            // If no errors, display success message
            if (empty($errors)) {
                echo "<div class='success'>";
                echo "<h3>Application Submitted Successfully!</h3>";
                echo "<p>Full Name: $fullname</p>";
                echo "<p>Email: $email</p>";
                echo "<p>Contact: $contact</p>";
                echo "<p>Date of Birth: $dob</p>";
                echo "<p>Position: $position</p>";
                echo "<p>Resume: $resume</p>";
                echo "<p>Cover Letter: $coverletter</p>";
                echo "<p>LinkedIn Profile: $linkedin</p>";
                echo "<p>Work Experience: $experience years</p>";
                echo "<p>Skills: $skills</p>";
                echo "</div>";
            } else {
                // Display error messages
                echo "<div class='error'>";
                echo "<h3>Error: Please correct the following issues:</h3>";
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
                echo "</div>";
            }
        } else {
            // If the form is not submitted, show an error message
            echo "<div class='error'>";
            echo "<p>Error: No form data submitted.</p>";
            echo "<p>Please go back to the <a href='index.php'>Job Application Form</a> and submit your details.</p>";
            echo "</div>";
        }

        // Function to sanitize input data
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
    </div>
</body>
</html>