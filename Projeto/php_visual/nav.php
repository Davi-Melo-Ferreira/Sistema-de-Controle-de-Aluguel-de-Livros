<nav class="sanduba-nav">
	<input type="checkbox" id="menu-toggle" />
	<label for="menu-toggle" class="menu-icon">&#9776;</label>
	<ul class="menu">
		<li><a href="../public/index.php">Início</a></li>
		<li><a href="../php_visual/listar_livros.php">Livros</a></li>
		<li><a href="../php_visual/clientes.php">Clientes</a></li>
		<li><a href="../php_visual/alugar_livro.php">Registros</a></li>
	</ul>
</nav>
<style>
.sanduba-nav {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	background: #333;
	color: #fff;
	padding: 15px 0;
	z-index: 1000;
	box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}
body {
	padding-top: 60px !important;
}
.menu-icon {
	font-size: 2em;
	cursor: pointer;
	display: none;
	padding: 0 20px;
}
.menu {
	list-style: none;
	margin: 0;
	padding: 0;
	display: flex;
	gap: 20px;
	justify-content: center;
}
.menu li a {
	color: #fff;
	text-decoration: none;
	font-weight: bold;
	padding: 8px 16px;
	border-radius: 4px;
	transition: background 0.2s;
}
.menu li a:hover {
	background: #444;
}
#menu-toggle {
	display: none;
}
@media (max-width: 700px) {
	.menu {
		display: none;
		flex-direction: column;
		background: #333;
		position: absolute;
		top: 100%;
		left: 0;
		width: 100%;
		z-index: 10;
	}
	#menu-toggle:checked + .menu-icon + .menu {
		display: flex;
	}
	.menu-icon {
		display: block;
	}
}
</style>