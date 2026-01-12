<?php
// debug_admin_users.php
// Standalone script to debug what PHP sees in the admin_users table

echo "<pre>";
echo "</pre>\n";
// Standalone DB debug: direct MySQLi, no CodeIgniter
$host = 'localhost';
$user = 'root'; // change if not default
$pass = '';
$db   = 'eecbafoussam'; // adjust if needed
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo "[ERROR] MySQL connection failed: " . $conn->connect_error . "\n";
    exit(2);
}
$sql = "SELECT * FROM admin_users";
$result = $conn->query($sql);
if (!$result) {
    echo "[ERROR] Query failed: " . $conn->error . "\n";
    exit(3);
}
if ($result->num_rows === 0) {
    echo "[INFO] No rows found in admin_users table.\n";
} else {
    echo "[INFO] Rows in admin_users table:\n";
    while ($row = $result->fetch_assoc()) {
        print_r($row);
    }
}
$conn->close();
