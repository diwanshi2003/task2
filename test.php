<?php
$conn = new mysqli("localhost", "root", "root", "user_auth");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SHOW TABLES";
$result = $conn->query($sql);
while ($row = $result->fetch_array()) {
    echo $row[0] . "<br>";
}
$conn->close();
?>
