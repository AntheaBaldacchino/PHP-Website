<?php
session_start();
require_once 'dbConn.php';
//include('dbConn.php');

// Fetch user role if logged in
if (isset($_SESSION['UserID'])) {
    $conn = connection();
    $UserID = $_SESSION['UserID'];
    $userSql = "SELECT Role FROM `Users` WHERE UserID = $UserID";
    $userResult = mysqli_query($conn, $userSql);

    if ($userResult) {
        $userRow = mysqli_fetch_assoc($userResult);
        $_SESSION['Role'] = $userRow['Role'];
    } else {
        echo "Error fetching user role: " . mysqli_error($conn);
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Book Listing</title>
    <style>
        .plus-sign-container {
            width: 300px;
            height: 400px;
            border: 4px dotted #1E90FF;
            display: flex;
            align-content: center;
            justify-content: center;
            border-radius: 10px;
            position: relative;
        }

        .addbook {
            display: flex;
            flex-direction: row;
            align-content: center;
            justify-content: center;
       
        }

        .material-icons {
            font-family: 'Material Icons';
            font-weight: normal;
            font-style: normal;
            font-size: 40px;
            letter-spacing: normal;
            text-transform: none;
            display: inline-block;
            white-space: nowrap;
            word-wrap: normal;
            direction: unset;
            -webkit-font-feature-settings: 'liga';
            -webkit-font-smoothing: antialiased;
            flex-direction: column;
            flex-wrap: nowrap;
            align-content: center;
            justify-content: center;
            align-items: center;
        }



        a[href*="InsertBook.php"] {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php include('Navbar.php'); ?>
    <?php 

     if (isset($_SESSION['Role']) && $_SESSION['Role'] === 'Admin'){
        echo "<div class='alert alert-danger'>Notice: You are in `Admin` Mode!</div>";
    }else{
        echo "<div class='alert alert-success'>Welcome to Novel Nook!</div>";
    }
    
    ?>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Novel Nook</h1>
            <hr class="my-4">
            <p class="lead">Your gateway to knowledge and culture. Accessible for everyone.</p>
        </div>
    </div>

   
    <div class="addbook">
   
        <div class="plus-sign-container">
        <?php if (isset($_SESSION['UserID'])) : ?>
            <a href="InsertBook.php" class="material-icons">
                <i class="material-icons" style="color: #1E90FF; font-size: 40px;">&#xe148;</i>
            </a>
            <?php else: ?>
                <a href="#" class="material-icons">
                <i class="material-icons" style="color: darkgrey; font-size: 40px;">&#xe148;</i>
            </a>
            <?php endif; ?>
        </div>

    </div>

    <div class='container' style="padding: 5%;">
        <div class="row">
            
            <?php
            // Fetch Book Table
            $conn = connection();
            $sql = "SELECT * FROM `Books`;";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $BookID = $row['BookID'];
                    $Title = $row['Title'];
                    $Author = $row['Author'];
                    $Genre = $row['Genre'];
                    $Description = $row['Description'];
                    $CoverImage = $row['CoverImage'];
            ?>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card border-primary h-100 shadow-lg p-3 mb-3 bg-body rounded" style="width: 22rem;">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5>Book Title -  <?php echo htmlspecialchars($Title); ?></h5>
                                <?php if (isset($_SESSION['Role']) && $_SESSION['Role'] === 'Admin') : ?>
                                    <a href="editBook.php?BookID=<?php echo $BookID; ?>" class="badge rounded-pill bg-danger">Edit</a>
                                <?php endif; ?>
                            </div>
                            <img src="<?php echo htmlspecialchars($CoverImage); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($Title); ?>" style="max-height: 40rem;">
                            <div class="card-body d-flex flex-column">
                                <ul class="list-group list-group-flush">

                                    <li class="list-group-item">
                                        <p class="fw-light">Genre: <?php echo htmlspecialchars($Genre); ?></p>
                                    </li>
                                    <li class="list-group-item">
                                        <p class="fw-lighter">Description: <?php echo htmlspecialchars($Description); ?></p>
                                    </li>
                                </ul>
                                
                                <div class="card-body d-flex flex-column">
                                <?php if (isset($_SESSION['Role']) && $_SESSION['Role'] === 'Admin') : ?>
                                    <a href="removeBook.php?BookID=<?php echo $BookID; ?>" class="btn btn-danger">Remove</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>


</html>
