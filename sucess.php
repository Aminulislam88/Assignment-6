<!DOCTYPE html>
<html>
<head>
    <title>Registered Users</title>
</head>
<body>
<h2>Registered Users</h2>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Profile Picture</th>
    </tr>
<?php

if (($handle = fopen('users.csv', 'r')) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
        echo '<tr>';
        echo '<td>' . $data[0] . '</td>';
        echo '<td>' . $data[1] . '</td>';
        echo '<td>' . $data[2] . '</td>';
        echo '</tr>';
    }
}
?>
</table>
</body>
</html>

