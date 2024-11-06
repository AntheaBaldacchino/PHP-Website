<?php
session_start();
//include 'dbConn.php';
require_once 'dbConn.php';

if (!isset($_SESSION['UserID'])) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['UserID'];
$conn = connection();

// Retrieve user info from the database
$sql = "SELECT * FROM Users WHERE UserID = $userId";
$result = mysqli_query($conn, $sql);

if ($result && $row = mysqli_fetch_assoc($result)) {
    $userInfo = $row;
    $pp = $row['ProfileImage'];
} else {
    echo "Error fetching user info: " . mysqli_error($conn);
    exit();
}

// Handle form submission to update user info
if (isset($_POST['submit'])) {
    $name = $_POST['FirstName'];
    $surname = $_POST['LastName'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    // Handle file upload
    if (!empty($_FILES['ProfileImage']['name'])) {
        $profileImage = 'uploads/' . basename($_FILES['ProfileImage']['name']);
        move_uploaded_file($_FILES['ProfileImage']['tmp_name'], $profileImage);
    } else {
        $profileImage = $userInfo['ProfileImage'];
    }

    $sql = "UPDATE Users SET FirstName = '$name', LastName = '$surname', Email = '$email', Password = '$password', ProfileImage = '$profileImage' WHERE UserID = $userId";
    $updateResult = mysqli_query($conn, $sql);

    if ($updateResult) {
        header("Location: userDashboard.php");
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }

    
}
// Retrieve recently added books by user
$sql = "SELECT b.BookID, b.Title, b.Author, b.CoverImage, rab.RecentlyAddedBookID
        FROM RecentlyAddedBookByUserID rab
        JOIN Books b ON rab.BookID = b.BookID
        WHERE rab.AddedByUserID = $userId
        ORDER BY rab.RecentlyAddedBookID DESC";

$result = mysqli_query($conn, $sql);

$recentBooks = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $recentBooks[] = $row;
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="style.css" rel="stylesheet">
    <script src="script.js"></script>

</head>
<body>
<?php include 'Navbar.php'; ?>

<div class="container">
    
    <form class="form-" method="POST" action="userDashboard.php" enctype="multipart/form-data">
        <div class="form-style">
        <div class="mb-3" id="profile-container">
            <img src="<?php echo $userInfo['ProfileImage']; ?>" id="profileImage" alt="" style="width: 150px;" class="img-fluid mb-3">
            <input  type="file" class="form-control" id="imageUpload" name="ProfileImage">
        </div>
        </div>
        <div class="mb-3">
            <label for="FirstName" class="form-label">Name</label>
            <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?php echo $userInfo['FirstName']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="LastName" class="form-label">Surname</label>
            <input type="text" class="form-control" id="LastName" name="LastName" value="<?php echo $userInfo['LastName']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="Email" class="form-label">Email</label>
            <input type="email" class="form-control" id="Email" name="Email" value="<?php echo $userInfo['Email']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="Password" class="form-label">Password</label>
            <input type="password" class="form-control" id="Password" name="Password" value="<?php echo $userInfo['Password']; ?>" required>
        </div>
        <button type="submit" name="submit" class="btn btn-dark mb-2">Submit</button>
    </form>
</div>

<h1 style="padding: 1%">Your Recently Added Books</h1>
<div class="container mt-4  d-flex flex-row flex-wrap" >
    <?php if (count($recentBooks) > 0): ?>
        <?php foreach ($recentBooks as $index => $book): ?>
            <div class="card bg-dark text-white mb-3 me-3" style="max-width: 18rem;">
                <img class="card-img" src="<?php echo $book['CoverImage']; ?>" >
                <div class="card-img-overlay">
                    <h5 class="card-title"><?php echo $book['Title']; ?></h5>
                    <p class="card-text"><?php echo $book['Author']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You haven't added any books recently.</p>
    <?php endif; ?>
</div>
<?php include('footer.php'); ?>

</body>

</html>


