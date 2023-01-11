<?php


#######
$conn = new mysqli('terraform-20230108221845171900000001.csfl3dafisa1.eu-central-1.rds.amazonaws.com', DB_USER, 'ohayPgeefVYbWnovSHu99iVQ', DB_NAME);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT author, message FROM urler";
$result = $conn->query($sql);

print_r($result);

print_r($result->fetch_assoc());

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["author"]." ".$row["message"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();

#######

?>