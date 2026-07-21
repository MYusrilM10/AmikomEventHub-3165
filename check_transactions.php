<?php
$dsn = 'mysql:host=127.0.0.1;dbname=eventtiket_db';
$user = 'root';
$pass = '';
try {
    $pdo = new PDO($dsn, $user, $pass);
    $stmt = $pdo->query('SELECT id, user_id, customer_email, customer_name, status, created_at FROM transactions ORDER BY created_at DESC LIMIT 15');
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "=== LAST 15 TRANSACTIONS ===\n\n";
    foreach ($result as $row) {
        echo "ID: " . $row['id'] . " | user_id: " . ($row['user_id'] ?? 'NULL') . " | email: " . $row['customer_email'] . " | status: " . $row['status'] . " | time: " . $row['created_at'] . "\n";
    }
    echo "\n=== USERS ===\n\n";
    $stmt2 = $pdo->query('SELECT id, name, email, role FROM users ORDER BY id DESC LIMIT 10');
    $users = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    foreach ($users as $u) {
        echo "ID: " . $u['id'] . " | name: " . $u['name'] . " | email: " . $u['email'] . " | role: " . $u['role'] . "\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
