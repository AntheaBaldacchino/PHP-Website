<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        include 'Navbar.php' ;
    ?>
    <?php
    //include 'dbConn.php';
    require_once 'dbConn.php';
    $conn = connection();

    if (isset($_POST['submit'])) {
        $Email = $_POST['Email'] ?? null;
        $Mobile = $_POST['Mobile'] ?? null;
        $Password = $_POST['Password'];
        
        $conn = connection();

        if ($Email || $Mobile) {
            if ($Email) {
                $sql = "SELECT * FROM Users WHERE Email='$Email'";
            } else {
                $sql = "SELECT * FROM Users WHERE Mobile='$Mobile'";
            }

            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
    
                if (password_verify($Password, $user['Password'])) {
            
                    echo "<div class='alert alert-success'>Login successful</div>";
                    $_SESSION['UserID'] = $user['UserID'];
                    header('Location: index.php'); 
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Invalid Password</div>";
                    
                }
            } else {
                echo "<div class='alert alert-danger'>No user found with the provided email or mobile.</div>";
              
            }
        } else {
            echo "<div class='alert alert-danger'>Please enter either email or mobile to log in.</div>";
            
        }
    
        mysqli_close($conn);
    }
?>
    <div class="container" style="    
    max-width: 600px;
    margin-top: 5%;
    padding: 50px;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    
">
        <h1>Login</h1>
        <?php if (isset($error)) echo '<div class="alert alert-danger" role="alert">' . $error . '</div>'; ?>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="email" class="form-control" id="Email" name="Email" >
            </div>
            <div style='display: flex;
                        justify-content: center;
                        align-items: center;'> 
            OR</div>
            <div class="mb-3">
                <label for="Mobile" class="form-label">Mobile</label>
                <input type="tel" class="form-control" id="Mobile" name="Mobile"  >
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="password" class="form-control" id="Password" name="Password" required>
            </div>
            <div style='display: flex;
                        justify-content: center;
                        align-items: center;'>
                Not signed up yet ?
                <a href="registration.php"> Sign Up Now </a>
            </div>
            <button name="submit" type="submit" class="btn btn-dark">Login</button>
        </form>
    </div>
</body>
</html>
