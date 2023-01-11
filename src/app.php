<!DOCTYPE html>
    <html>
        <head>
            <style>
                table, th, td {
                border: 1px solid white;
                border-collapse: collapse;
                }
                th, td {
                background-color: #96D4D4;
                }
            </style>
        </head>
    <body>
<?php

    $conn = new mysqli($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME']);
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
            echo "<tr><td>".$row["author"]."</td><td>".$row["message"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();

    ?>

    </body>
</html>

