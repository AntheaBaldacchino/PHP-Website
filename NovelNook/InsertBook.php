<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Add Book Page</title>
</head>
<body>



<?php
    include 'Navbar.php';
    //include 'dbConn.php';
    require_once 'dbConn.php';

    $conn = connection();

    if(isset($_POST['submit'])){
        $Title = trim(mysqli_real_escape_string($conn, $_POST['Title']));
        $Author =trim(mysqli_real_escape_string($conn, $_POST['Author'])); 
        $Genre = trim(mysqli_real_escape_string($conn, $_POST['Genre']?? null));   
        $Description = trim(mysqli_real_escape_string($conn, $_POST['Description']?? null)); 
        $ISBN = trim(mysqli_real_escape_string($conn, $_POST['ISBN']?? null));

        if (empty($Title) || empty($Author) || empty($_FILES['CoverImage']['name'])) {
            echo "<div class='alert alert-danger'>Required fields are empty!</div>";
            return;
        }

        $target_dir = "CoverImgs/";
        $target_file = $target_dir . basename($_FILES["CoverImage"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $allowed_formats = array("jpg", "jpeg", "png");

        if (!in_array($imageFileType, $allowed_formats)) {
            echo "<div class='alert alert-danger'>Invalid image format. Only JPG, JPEG and PNG files are allowed.</div>";                   
            return;
        }

        if (move_uploaded_file($_FILES["CoverImage"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO `Books` (`Title`, `Author`, `Genre`, `Description`, `CoverImage`, `ISBN`) 
                    VALUES ('$Title', '$Author', '$Genre', '$Description', '$target_file', '$ISBN')";
            
            if (mysqli_query($conn, $sql)) {
                $bookId = mysqli_insert_id($conn);
                $userId = $_SESSION['UserID'];

                $sql_recent = "INSERT INTO RecentlyAddedBookByUserID (BookID, AddedByUserID) VALUES ('$bookId', '$userId')";
                
                if (mysqli_query($conn, $sql_recent)) {
                    header('Location: userDashboard.php');
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Error: " . $sql_recent . "<br>" . mysqli_error($conn) . "</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . mysqli_error($conn) . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Sorry, there was an error uploading your file.</div>";
        }
    }
    ?>
    <div class="container">
        <h1>Add Book</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control" id="Title" name="Title" required>
            </div>
            <div class="mb-3">
                <label for="Author" class="form-label">Author</label>
                <input type="text" class="form-control" id="Author" name="Author" required>
            </div>
            <div class="mb-3">
                <label for="Genre" class="form-label">Genre</label>
                <input type="text" class="form-control" id="Genre" name="Genre">
            </div>
            <div class="mb-3">
                <label for="Description" class="form-label">Description</label>
                <input type="text" class="form-control" id="Description" name="Description">
            </div> 
            <div class="mb-3">
                <label for="CoverImage" class="form-label">Cover Image</label>
                <input type="file" class="form-control" id="CoverImage" name="CoverImage" required>   
            </div>
            <div class="mb-3">
                <label for="ISBN" class="form-label">ISBN</label>
                <input type="text" class="form-control" id="ISBN" name="ISBN">
            </div> 
            <button type="submit" name="submit" class="btn btn-dark">Submit</button>
        </form>
    </div>
</body>
</html>
