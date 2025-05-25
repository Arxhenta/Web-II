
<?php
$conn = mysqli_connect("localhost", "root", "ardona", "e-commerce");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>