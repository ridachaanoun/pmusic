<?php
echo "good ";

if (isset($_SESSION['user'])) {
    $user =$_SESSION['user'];
    echo "Welcome, " . $user['username'];
    echo "</br>";
    var_dump($user);
} else {
    echo "Go login";
}?>

<img src="<?php echo $user["image"] ?>" alt="sdddddddddd">
<img src="http://localhost/uploads/WIN_20241206_15_06_16_Pro.jpg" alt="sdddddddddd">
