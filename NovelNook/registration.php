<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <title>Registration Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include 'Navbar.php';
require_once 'dbConn.php';

$errors = [];

if (isset($_POST['submit'])) {
    $conn = connection();

    $Email = trim(mysqli_real_escape_string($conn, $_POST['Email'] ?? null )); 
    $Mobile = trim(mysqli_real_escape_string($conn, $_POST['Mobile'] ?? null ));
    $FirstName = trim(mysqli_real_escape_string($conn, $_POST['FirstName'] ?? '' ));
    $LastName = trim(mysqli_real_escape_string($conn,$_POST['LastName'] ?? ''));
    $Password = trim(mysqli_real_escape_string($conn,$_POST['Password'] ?? ''));
    $Role = $_POST['Role'] ?? '';
    $ProfileImage = $_FILES['ProfileImage']['name'] ?? '';

    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (strlen($Password) < 3) {
        $errors[] = "Password must be at least 3 characters long.";
    }

    if (!is_string($FirstName) || strlen($FirstName) > 15) {
        $errors[] = "Name should not exceed 15 characters.";
    }
    if (!is_string($LastName) || strlen($LastName) > 15) {
        $errors[] = "Surname should not exceed 15 characters.";
    }

    if (empty($errors)) {
        $emailCheckQuery = "SELECT * FROM Users WHERE Email='$Email' OR Mobile='$Mobile'";
        $result = mysqli_query($conn, $emailCheckQuery);

        if (mysqli_num_rows($result) > 0) {
            $errors[] = "Email or Mobile already registered. Please choose a different email or mobile.";
        } else {
            // Hash the password
            $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
            
            // Handle file upload
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($ProfileImage);
            move_uploaded_file($_FILES["ProfileImage"]["tmp_name"], $targetFile);

        
            $sql = "INSERT INTO Users (Email, Mobile, FirstName, LastName, Password, Role, ProfileImage) 
                    VALUES ('$Email', '$Mobile', '$FirstName', '$LastName', '$hashedPassword', '$Role', '$ProfileImage')";

            if (mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success'>New record created successfully</div>";
                header('Location: login.php');
                exit();
            } else {
                $errors[] = "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        mysqli_close($conn);
    }
}
?>

<div class="container">
    <h1>Registration</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="registration.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="FirstName" class="form-label">Name</label>
            <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="Name" required>
        </div>
        <div class="mb-3">
            <label for="LastName" class="form-label">Surname</label>
            <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Surname" required>
        </div>
        <div class="mb-3">
            <label for="Email" class="form-label">Email</label>
            <input type="email" class="form-control" id="Email" name="Email" placeholder="example@gmail.com" required>
        </div>
        <div class="mb-3">
            <label for="Mobile" class="form-label">Mobile</label>
            <input type="tel" class="form-control" id="Mobile" name="Mobile" placeholder="Mobile" required>
        </div>
        <div class="mb-3">
            <label for="Password" class="form-label">Password</label>
            <input type="password" class="form-control" id="Password" name="Password" placeholder="Password" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Choose Role:</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="Role" id="Admin" value="Admin">
                <label class="form-check-label" for="Admin">Admin</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="Role" id="Normal" value="Normal" checked>
                <label class="form-check-label" for="Normal">Normal</label>
            </div>
        </div>
        <div class="mb-3">
            <label for="ProfileImage" class="form-label">Profile Image</label>
            <input id="ProfileImage" class="form-control" type="file" name="ProfileImage">
        </div>
        <button type="submit" name="submit" class="btn btn-dark">Sign Up</button>
    </form>
</div>

</body>
</html>
