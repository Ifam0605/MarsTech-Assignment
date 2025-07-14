<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Form</title>
    <link rel="stylesheet" href="css/basci.css">
</head>
<body>

<div class="container">
    <h2>Job Application Form</h2>
    <form enctype="multipart/form-data" method="post" action="welcome.php">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="contact">Contact Number</label>
        <input type="tel" id="contact" name="contact" required>

        <label for="dob">Date of Birth</label>
        <input type="date" id="dob" name="dob" required>

        <label for="position">Position Applied For</label>
        <select id="position" name="position">
            <option value="Software Developer">Software Developer</option>
            <option value="Web Designer">Web Designer</option>
            <option value="Project Manager">Project Manager</option>
        </select>

        <label for="resume">Upload Resume</label>
        <input type="file" id="resume" name="resume">

        <label for="coverletter">Cover Letter</label>
        <textarea id="coverletter" name="coverletter" rows="4"></textarea>

        <label for="linkedin">LinkedIn Profile</label>
        <input type="url" id="linkedin" name="linkedin">

        <label for="experience">Work Experience (Years)</label>
        <input type="number" id="experience" name="experience" min="0">

        <label>Skills</label>
        <div class="skills">
            <input type="checkbox" id="html" name="skills[]" value="HTML">
            <label for="html">HTML</label>

            <input type="checkbox" id="css" name="skills[]" value="CSS">
            <label for="css">CSS</label>

            <input type="checkbox" id="js" name="skills[]" value="JavaScript">
            <label for="js">JavaScript</label>

            <input type="checkbox" id="php" name="skills[]" value="PHP">
            <label for="php">PHP</label>

            <input type="checkbox" id="java" name="skills[]" value="Java">
            <label for="java">Java</label>
        </div>

        <button type="submit">Apply</button>
    </form>
</div>

</body>
</html>