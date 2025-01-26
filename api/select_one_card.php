<?php
session_start();

include 'db_connect.php';

if (!isset($_SESSION['token'])) {
	echo json_encode(['status' => 'error', 'message' => 'No token']);
	exit;
}

$room = $_POST['room'] ?? null;
$player = $_POST['player'] ?? null;
$type = $_POST['type'] ?? null;

if (empty($card) || empty($player)) {
	echo json_encode(['status' => 'error', 'message' => 'Not enough info']);
	exit;
}

$stmt = $pdo->prepare('SELECT s338859.select_one_card(:t, :player, :type, :room)');
$stmt->execute(['t' => $_SESSION['token'], 'room' => $room, 'type' => $type, 'player' => $player]);
$result = $stmt->fetchColumn();

$response = json_decode($result, true);

if ($response && isset($response['status']) && $response['status'] === 'success') {
	echo json_encode([
		'status' => 'success',
		'info' => $response
	]);
} else {
	echo json_encode([
		'status' => 'error',
		'message' => $response['message'] ?? 'Error'
	]);
}
?>