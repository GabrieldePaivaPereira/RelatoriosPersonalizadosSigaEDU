<html  xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="dist/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/css/theme.css" rel="stylesheet">
	
	</head>
	<body>
	<?php $cod = 0;
					$cod = @$_GET["cod"];
					$titulo = "";
					switch($cod){
						case 0:
					
							$titulo = "Home";
						break;
						case 1:
					
							$titulo = "Dependências por Disciplina";
						break;
						case 2:
					
							$titulo = "Histórico de Turma";
						break;
						default:
		
						break;
					}
					?>
		<div id="container" class="col-md-12">
			<?php include("/pages/menu_top.php");?>
			<div id="centro" class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo $titulo; ?></h3>
					</div>
				<div class="panel-body">
					<?php
					
					switch($cod){
						case 0:
							include("/pages/home.php");
							$titulo = "Home";
						break;
						case 1:
							include("/pages/relatorio_dp_por_disciplina.php");
							$titulo = "Dependências por Disciplina";
						break;
						case 2:
							include("/pages/relatorio_dp_por_turma.php");
							$titulo = "Histórico de Turma";
						break;
						default:
		
						break;
					}
					?>
				</div>
			</div>
		  </div>
		</div>
	</body>
	
</html>