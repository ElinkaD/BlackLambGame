<?php
session_start();

include 'db_connect.php';

if (!isset($_SESSION['token'])) {
	echo json_encode(['status' => 'error', 'message' => 'No token']);
	exit;
}

$stmt = $pdo->prepare('SELECT s335141.remove_tokens(:t)');
$stmt->execute(['t' => $_SESSION['token']]);
$result = $stmt->fetchColumn();

$response = json_decode($result, true);

if ($response && isset($response['status']) && $response['status'] === 'success') {
	session_destroy();
	
	echo json_encode([
		'status' => 'success',
		'info' => $response
	]);
} else {
	echo json_encode([
		'status' => 'error',
		'message' => $response['error'] ?? 'Error'
	]);
}
?>