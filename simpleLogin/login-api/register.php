<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['email']) || !isset($data['password']) || !isset($data['name'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Email, password, and name required']);
    exit;
}

$email = trim($data['email']);
$password = trim($data['password']);
$name = trim($data['name']);

// Validate password strength
if (strlen($password) < 6) {
    http_response_code(400);
    echo json_encode(['error' => 'Password must be at least 6 characters']);
    exit;
}

try {
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert new user
    $stmt = $db->prepare('INSERT INTO users (email, password, name) VALUES (?, ?, ?)');
    $stmt->execute([$email, $hashed_password, $name]);

    echo json_encode([
        'success' => true,
        'message' => 'User registered successfully'
    ]);

} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'UNIQUE constraint failed') !== false) {
        http_response_code(409);
        echo json_encode(['error' => 'Email already exists']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Registration failed']);
    }
}
?>