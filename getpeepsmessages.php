<?php
header('Content-Type');

try {
    $db = new PDO('sqlite:my_database.db');

    $name = $_GET['name'] ?? "";

    $stmt = $db->prepare("SELECT * from messages WHERE author='$name'");
    $stmt->execute();
    $results = $stmt->fetchAll();

    echo json_encode($results);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
