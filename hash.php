<?php
// Database connection settings
$host = 'localhost';
$db   = 'yiishopping_db';   // replace with your database name
$user = 'root';        // replace with your DB username
$pass = 'quickstart';        // replace with your DB password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    $username = 'admin';
    $password = 'admin123';
    $role     = 'admin';
    $status   = 10;

    // Generate password hash and auth_key
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $auth_key = bin2hex(random_bytes(16));

    // Check if user exists
    $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $existing = $stmt->fetch();

    if ($existing) {
        // Update existing admin
        $stmt = $pdo->prepare("
            UPDATE user 
            SET password_hash = :password_hash, auth_key = :auth_key, status = :status, role = :role, updated_at = UNIX_TIMESTAMP()
            WHERE username = :username
        ");
        $stmt->execute([
            ':password_hash' => $password_hash,
            ':auth_key'      => $auth_key,
            ':status'        => $status,
            ':role'          => $role,
            ':username'      => $username
        ]);
        echo "Admin user updated successfully!\n";
    } else {
        // Create new admin
        $stmt = $pdo->prepare("
            INSERT INTO user (username, password_hash, auth_key, status, role, created_at, updated_at)
            VALUES (:username, :password_hash, :auth_key, :status, :role, UNIX_TIMESTAMP(), UNIX_TIMESTAMP())
        ");
        $stmt->execute([
            ':username'      => $username,
            ':password_hash' => $password_hash,
            ':auth_key'      => $auth_key,
            ':status'        => $status,
            ':role'          => $role
        ]);
        echo "Admin user created successfully!\n";
    }

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
