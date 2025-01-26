<?php
session_start();

if (!isset($_SESSION['token'])) {
	header("Location: ./start.php");
}

$idRoom = $_GET['room'];

include '../api/db_connect.php';

$stmt = $pdo->prepare('SELECT * FROM s335141.users_in_rooms where login_user =:login and id_room =:room');
$stmt->execute(['login' => $_SESSION['user']['login'], 'room' => $idRoom]);
$result = $stmt->fetch();

if (!$result) {
	header("Location: ./rooms.php");
}
?>

<!DOCTYPE html>
<html>
	<?php @include './head.tpl'; ?>
	<?php @include './media.tpl'; ?>	
	
	<main class='game'>
		<section class='aside'>
			<div>
				<div class="info">
					<div class='head'>
						<h4 id='game_status'></h4>
						<div>
							<button data-show-dialog="rules-dialog">правила</button>
							<button id="quit-button" data-id-room="<?php echo $idRoom; ?>">выйти из игры</button>
							<button onclick="window.location.href = './profile.php';">в профиль</button>
						</div>
					</div>
					<span id='role'></span>
					<div class='timer hidden'>
						<span>Время до конца хода:</span>
						<div id='timer'></div>
					</div>
					<div class='moves hidden'>
						<span>До победы саботёров в игре осталось ходов:</span>
						<div id='moves'></div>
					</div>
				</div>

				<div class='players'>
					<h3>Игроки</h3>
					<ul class="players-list"></ul>
				</div>
				<div class="game-play">
					<ul class="cards-hand waiting"></ul>
					<div>
						<button title='вы можете перевернуть карты' id="switch-cards" class="waiting">
							<img src="../img/switch.png" alt="">
						</button>
						<div title='вы сбросить карту в колоду сброса' class="drop-card waiting">
							<img src="../img/drop.svg" alt="">
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class='field waiting'>
			<div>
			<?php
				for ($y = 6; $y > -1; $y--) {
					echo '<div class="row">';
					for ($x = 1; $x < 10; $x++) {
						echo '<div class="card empty" data-x=' . $x . ' data-y=' . $y . '>';
						echo '</div>';
					}
					echo '</div>';
		}?>
		</div>
		</section>
		<?php 
			include './rules.tpl'; 
			include './secretDialog.tpl' ;
			include './endDialog.tpl' ;
			include './alertDialog.tpl' ;
		?>
	</main>

	<script type="module" src="../scripts/index.js"></script>
	<script type="module" src="../scripts/quit.js"></script>
	<script type="module" src="../scripts/game/game.js"></script>
	<script type="module" src="../scripts/game/cards.js"></script>
</html>