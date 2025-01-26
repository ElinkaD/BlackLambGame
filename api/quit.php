<?php
session_start();

include 'db_connect.php';

if (!isset($_SESSION['token'])) {
	echo json_encode(['status' => 'error', 'message' => 'No token']);
	exit;
}

$room = $_POST['room'] ?? null;


if (empty($room)) {
	echo json_encode(['status' => 'error', 'message' => 'Write all the information']);
	exit;
}

$stmt = $pdo->prepare('SELECT s335141.quit(:t, :room)');
$stmt->execute(['t' => $_SESSION['token'], 'room' => $room]);
$result = $stmt->fetchColumn();

$response = json_decode($result, true);

if ($response && isset($response['status']) && $response['status'] === 'success') {
	$_SESSION['rooms'] = $response['available_games'];

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