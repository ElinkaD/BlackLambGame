
<!DOCTYPE html>
<html>	
	<main class="start">
		<h1>Чёрная овечка</h1>
		<p>онлайн настольная игра</p>
		<div>
			<button data-show-dialog="auth-dialog">войти</button>
			<button data-show-dialog="register-dialog">регистрация</button>
			<button data-show-dialog="rules-dialog">правила</button>
		</div>

		<dialog data-dialog-name="auth-dialog">
			<button class="close"></button>
			<form id="loginForm" method="POST">
				<h2>ВХОД</h2>
				<div class="form-group">
					<input name="login-auth" type="text" placeholder=" " required>
					<label for="login-auth">
						Введите логин
					</label>
				</div>
				<div class="form-group">
					<input name="password-auth" type="password" placeholder=" " required>
					<label for="password-auth">
						Введите пароль
					</label>
				</div>
				<button type="submit">войти</button>
			</form>
		</dialog>

		<dialog data-dialog-name="register-dialog">
			<button class="close"></button>
			<form id="registerForm" method="POST">
				<h2>РЕГИСТРАЦИЯ</h2>
				<div class='forms'>
					<div class="form-group">
						<input name="login" type="text" placeholder=" " required>
						<label for="login">
							Введите логин
						</label>
					</div>
					<div class="form-group">
						<input name="password" type="password"  placeholder=" " required>
						<label for="password">
							Введите пароль
						</label>
					</div>
					<div class="form-group">
						<input name="password-again" type="password" placeholder=" " required>
						<label for="password-again">
							Повторите пароль
						</label>
					</div>
				</div>
				<button type="submit">зарегистрироваться</button>
			</form>
		</dialog>
	</main>
	<script type="module" src="../scripts/index.js"></script>
</html>