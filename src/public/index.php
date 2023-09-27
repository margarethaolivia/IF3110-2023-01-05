<?php
// $host = $_ENV['DB_HOST'];; // This should match the service name defined in your Docker Compose file
// $port = $_ENV['DB_PORT'];;
// $database = $_ENV['DB_NAME'];
// $user = $_ENV['POSTGRES_USER'];
// $password = $_ENV['POSTGRES_PASSWORD'];

// try {
//     $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$database;user=$user;password=$password");
//     echo "Connection succeeded";
//     // Set PDO attributes or perform database operations here
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }

require_once __DIR__ . '/../app/cores/Config.php';
require_once __DIR__ . '/../app/cores/Routing.php';