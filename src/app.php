<?php


#######
$conn = new mysqli('terraform-20230108221845171900000001.csfl3dafisa1.eu-central-1.rds.amazonaws.com', 'admin', 'ohayPgeefVYbWnovSHu99iVQ', 'mydb');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT author, message FROM urler";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Author</th><th>Message</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["author"]." ".$row["message"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();

#######

?>