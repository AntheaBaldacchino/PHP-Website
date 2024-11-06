<?php
require_once('dbConn.php');

$BookID = trim($_GET['BookID']);
$conn = connection();
$BookID = mysqli_real_escape_string($conn, $BookID);

// Delete from the referencing table first
$sql1 = "DELETE FROM `recentlyaddedbookbyuserid` WHERE BookID = '$BookID'";
if (!mysqli_query($conn, $sql1)) {
    echo "Error deleting from a Users' Dashboard: " . mysqli_error($conn);
    mysqli_close($conn);
    exit();
}

// Now delete from the Books table
$sql2 = "DELETE FROM `Books` WHERE BookID = '$BookID'";
if (!mysqli_query($conn, $sql2)) {
    echo "Error deleting from Book Shelf: " . mysqli_error($conn);
    mysqli_close($conn);
    exit();
}

header('Location: index.php');
exit();

mysqli_close($conn);
?>
