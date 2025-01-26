<?php
session_start();

if (!isset($_SESSION['token'])) {
	header("Location: ./start.php");
}
include '../api/db_connect.php';
?>

<!DOCTYPE html>
<html>
	<?php @include './head.tpl'; ?>	
	<?php @include './media.tpl'; ?>	
	
	<main class='rooms'>
		<div class='header'>
			<h2>Добро пожаловать,
				<?php 
					echo $_SESSION['user']['login'];
				?>
			</h2>
			<div>
				<button data-show-dialog="rules-dialog">правила</button>
				<button onclick="window.location.href = './profile.php';">в профиль</button>
			</div>
		</div>

		<div class="form-group">
			<input name="name" type="text" placeholder=" " required>
			<label for="name">
				Чтобы подключиться к игре, введите имя
			</label>
		</div>

		<div class="games">
			<h3>Список игр, доступных для подключения</h3>
			<?php
				echo '<ul class="rooms-list">';
				if ($_SESSION['rooms']){
				foreach ($_SESSION['rooms'] as $room) {
					if (!in_array($room['id'], $idArray)) {
						echo '<li>';
						echo '<span>№' . htmlspecialchars($room['id']) . '</span>';
						echo '<span>' . htmlspecialchars($room['amount_of_players'] - $room['count']) . ' игроков ожидается</span>';
						echo '<span>' . htmlspecialchars($room['time_for_move']) . ' с на ход</span>';
						echo '<button class="join-room" data-id-room="' . $room['id'] . '">войти в игру</button>';
						echo '</li>';
					}
				}
			}
			else {
				echo '<p>Нет доступных комнат</p>';
			}
				echo '</ul>';?>

			<button data-show-dialog="create-room-dialog">создать игру</button>
		</div>

		<?php
		include './rules.tpl'; 
		include './alertDialog.tpl' ;
		include './createRoomDialog.tpl';
		?>
	</main>
	<script type="module" src="../scripts/index.js"></script>
	<script type="module" src="../scripts/joinRoom.js"></script>
</html>