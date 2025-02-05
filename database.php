<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flexapp";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SHOW DATABASES LIKE '$dbname'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    $sql = "CREATE DATABASE $dbname";
    if ($conn->query($sql) === TRUE) {
        echo "Database '$dbname' created successfully.\n";
    } else {
        echo "Error creating database: " . $conn->error . "\n";
        exit;
    }
} else {
    echo "Database '$dbname' already exists.\n";
}

$conn->select_db($dbname);

$table_name = "users";
$sql = "SHOW TABLES LIKE '$table_name'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    $sql = "CREATE TABLE $table_name (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NULL,
        email VARCHAR(255)  NULL,
        age VARCHAR(255) NOT NULL,
        batch VARCHAR(255) NOT NULL,
        description VARCHAR(255) NOT NULL,
        status ENUM('0','1') NOT NULL DEFAULT '1' COMMENT '1 Active, 0 Inactive',
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
        updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
        deleted_at TIMESTAMP NULL DEFAULT NULL
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo "Table '$table_name' created successfully.\n";
    } else {
        echo "Error creating table: " . $conn->error . "\n";
        exit;
    }
} else {
    echo "Table '$table_name' already exists.\n";
}

$conn->close();
?>
