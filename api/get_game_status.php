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

$stmt = $pdo->prepare('SELECT s338859.get_game_status(:t, :room)');
$stmt->execute(['t' => $_SESSION['token'], 'room' => $room]);
$result = $stmt->fetchColumn();

$response = json_decode($result, true);

if ($response && isset($response['success']) && $response['success'] === true) {
	$_SESSION['game'] = $response;

	echo json_encode([
		'status' => 'success',
		'info' => $response
	]);
} else {
	echo json_encode([
		'status' => 'error',
		'message' => $response['result_message'] ?? 'Error'
	]);
}
?>