<?php
session_start();

include 'db_connect.php';

if (!isset($_SESSION['token'])) {
	echo json_encode(['status' => 'error', 'message' => 'No token']);
	exit;
}

$room = $_POST['room'] ?? null;
$player = $_POST['player'] ?? null;

if (empty($card) || empty($player)) {
	echo json_encode(['status' => 'error', 'message' => 'Not enough info']);
	exit;
}

$stmt = $pdo->prepare('SELECT s338859.draw_card(:t, :room, :player)');
$stmt->execute(['t' => $_SESSION['token'], 'room' => $room, 'player' => $player]);
$result = $stmt->fetchColumn();

$response = json_decode($result, true);

if ($response && isset($response['status']) && $response['status'] === 'success') {
	echo json_encode([
		'status' => 'success',
		'message' => $response['message']
	]);
} else {
	echo json_encode([
		'status' => 'error',
		'message' => $response['message'] ?? 'Error'
	]);
}
?>