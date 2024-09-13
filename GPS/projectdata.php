<?php
// Database connection
$conn = new mysqli('localhost', 'root', 'youpassword', 'gps');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve project data
$sql = "SELECT * FROM projects";
$result = $conn->prepare($sql);
$result->execute();
$res=$result->get_result();
if ($res->num_rows > 0) {
    echo '<table style="border: 1px solid black; width:100%; text-align:center;border-collapse: collapse;" >';
    echo '<tr><th style="border: 1px solid white; background-color: black; color: white; height:50px;border-collapse: collapse;">PROJECT NUMBER</th>
    <th style="border: 1px solid white; background-color: black; color: white; height:50px;border-collapse: collapse;">PROJECT NAME</th>
    <th style="border: 1px solid white; background-color: black; color: white; height:50px;border-collapse: collapse;">CLIENT NAME</th>
    <th style="border: 1px solid white; background-color: black; color: white; height:50px;border-collapse: collapse;">CONTRACT NUMBER</th></tr>';

    // Output data of each row
    while ($row = $res->fetch_assoc()) {
        echo '<tr>';
        echo '<td style="border: 1px solid black;border-collapse: collapse;">' . $row['pno'] . '</td>';
        echo '<td style="border: 1px solid black;border-collapse: collapse;">' . $row['pname'] . '</td>';
        echo '<td style="border: 1px solid black;border-collapse: collapse;">' . $row['cname'] . '</td>';
        echo '<td style="border: 1px solid black;border-collapse: collapse;">' . $row['cno'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo 'No projects found.';
}

$conn->close();
?>
