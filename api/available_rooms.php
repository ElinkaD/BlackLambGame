<?php
session_start();

include 'db_connect.php';

if (!isset($_SESSION['token'])) {
	echo json_encode(['status' => 'error', 'message' => 'No token']);
	exit;
}

$stmt = $pdo->prepare('SELECT s338859.available_rooms(:t)');
$stmt->execute(['t' => $_SESSION['token']]);
$result = $stmt->fetchColumn();

$response = json_decode($result, true);

if ($response && isset($response['success']) && $response['succes'] === true) {
	$_SESSION['rooms'] = $response['rooms'];

	echo json_encode([
		'status' => 'success',
		'info' => $response
	]);
} else {
	echo json_encode([
		'status' => 'error',
		'message' => $response['result_message'] || 'Error'
	]);
}
?>