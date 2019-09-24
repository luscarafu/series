<?php 
	
	session_start();
	if (!isset($_SESSION['para_assistir']) || !count($_SESSION['para_assistir'])) {
		$_SESSION['para_assistir'] = [];
	}
	if (!isset($_SESSION['disponiveis']) || !count($_SESSION['disponiveis'])) {
		
		$_SESSION['disponiveis'] = array(
			'Naruto',
			'Breaking Bad',
			'La casa de Papel',
			'The seven deadly sins',
			'Rick and Morty',
			'Vis a Vis',
		);
	} else {
		// $ultima = count($_SESSION['disponiveis'])-1;
		// unset($_SESSION['disponiveis'][$ultima]);
	}
	if (isset($_GET['de']) && $_GET['de']) {
		
		$id = $_GET['id'];
		switch ($_GET['de']) {
			case 'disponiveis':
				
				if (isset($_SESSION['disponiveis'][$id])) {
					$_SESSION['para_assistir'][] = $_SESSION['disponiveis'][$id];
				}
				unset($_SESSION['disponiveis'][$id]);
				break;
			case 'para_assistir':
				$para = $_GET['para'];
				if ($para == 'disponiveis') {
					if (isset($_SESSION['para_assistir'][$id])) {
						$_SESSION['disponiveis'][] = $_SESSION['para_assistir'][$id];
					}
					unset($_SESSION['para_assistir'][$id]);
					
				} else {
					if (isset($_SESSION['para_assistir'][$id])) {
						$_SESSION['assistidos'][] = $_SESSION['para_assistir'][$id];
					}
					unset($_SESSION['para_assistir'][$id]);
				}
				
				break;
			
			case 'assistidos':
				if (isset($_SESSION['assistidos'][$id])) {
					$_SESSION['para_assistir'][] = $_SESSION['assistidos'][$id];
				}
				unset($_SESSION['assistidos'][$id]);
				
				break;
		
		}
	}
 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Lista de séries</title>

	<link href="style.css?v=<?= rand() ?>" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light&display=swap" rel="stylesheet">

</head>
<body>
	
	<h1 id="site_title">Minha lista de Séries</h1>
	
	<div class="col-33">
		<h2 class="category_title">Disponíveis</h2>
		<ul>
			<?php 
				foreach ($_SESSION['disponiveis'] as $index => $serie) {
					echo "	
						<li>
							$serie
							<a href=\"?de=disponiveis&id=$index\">
                                →
							</a>
						</li>";
				}
			 ?>
		</ul>
	</div>

	<div class="col-33">
		<h2 class="category_title">Para Assistir</h2>
		<ul>
			<?php 
				foreach ($_SESSION['para_assistir'] as $index => $serie) {
					echo "	
						<li>
							$serie
							<a href=\"?de=para_assistir&para=disponiveis&id=$index\">
                                ← 
							</a>
							<a href=\"?de=para_assistir&para=assistidos&id=$index\">
                                →
							</a>
						</li>";
				}
			 ?>
		</ul>
	</div>

	<div class="col-33">
		<h2 class="category_title">Assistidos</h2>
		<ul>
			<?php 
				foreach ($_SESSION['assistidos'] as $index => $serie) {
					echo "	
						<li>
							$serie
							<a href=\"?de=assistidos&id=$index\">
                                ← 
							</a>
						</li>";
				}
			 ?>
		</ul>
	</div>

<!-- <pre>
<?php 
	print_r($_SESSION);
	 ?>
</pre> -->

</body>
</html>