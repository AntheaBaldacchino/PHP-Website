<?php
session_start(); //User must have Role set to Admin to edit
if (!isset($_SESSION['UserID'])) {
    header('Location: login.php');
    exit();
}
//include 'dbConn.php';
require_once 'dbConn.php';

if (isset($_POST['submit'])) {
    $Title = $_POST['Title'];
    $Author = $_POST['Author'];
    $Genre = $_POST['Genre'];
    $Description = $_POST['Description'];
    $BookID = $_POST['BookID'];

    $conn = connection();

    $sql = "UPDATE `Books` SET `Title` = '$Title', `Author` = '$Author', `Genre`= '$Genre', `Description`='$Description' WHERE `BookID` = $BookID";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    if (isset($_GET['BookID'])) {
        $BookID = $_GET['BookID'];
    } else {
        echo "BookID is not set!";
        exit();
    }

    $conn = connection();

    $sql = "SELECT * FROM `Books` WHERE BookID = $BookID";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $_SESSION['BookID'] = $row['BookID'];
            $_SESSION['Title'] = $row['Title'];
            $_SESSION['Author'] = $row['Author'];
            $_SESSION['Genre'] = $row['Genre'];
            $_SESSION['Description'] = $row['Description'];
            $_SESSION['CoverImage'] = $row['CoverImage'];
        } else {
            echo "Book not found!";
            exit();
        }
    } else {
        echo "Error fetching book details: " . mysqli_error($conn);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Editing Book Page</title>
</head>
<body>
    <?php include 'Navbar.php'; ?>
    <div class="container">
        <form method="POST" action="editBook.php">
            <div class="mb-3">
                <img src="<?php echo htmlspecialchars($_SESSION['CoverImage']); ?>" alt="Book Image" class="img-fluid">
            </div>
            <div class="mb-3">
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control" id="Title" name="Title" value="<?php echo htmlspecialchars($_SESSION['Title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="Author" class="form-label">Author</label>
                <input type="text" class="form-control" id="Author" name="Author" value="<?php echo htmlspecialchars($_SESSION['Author']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="Genre" class="form-label">Genre</label>
                <input type="text" class="form-control" id="Genre" name="Genre" value="<?php echo htmlspecialchars($_SESSION['Genre']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="Description" class="form-label">Description</label>
                <input type="text" class="form-control" id="Description" name="Description" value="<?php echo htmlspecialchars($_SESSION['Description']); ?>" required>
            </div>
           
            <input type="hidden" name="BookID" value="<?php echo htmlspecialchars($_SESSION['BookID']); ?>">
            
            <button type="submit" name="submit" class="btn btn-primary mb-2">Submit</button>
        </form>
    </div>
</body>
</html>
