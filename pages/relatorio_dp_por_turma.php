<?php
	include("conexao.php");
	$sql_campus = "Select id,nome from elemento_organizacional where nome like 'Câmpus%' order by nome;";
	$result_campus = pg_query($conexao,$sql_campus);
	$cod = @$_GET["cod"];
	if(@empty($_POST["campus"])){
		$campus=0;
	}else{
	$campus = $_POST["campus"];
	}
	if(@empty($_POST["curso"])){
		$curso=0;
	}else{
	$curso = $_POST["curso"];
	}
	if(@empty($_POST["ano_ingresso"])){
		$ano_ingresso=0;
	}else{
	$ano_ingresso= $_POST["ano_ingresso"];
	}
	
?>
<form method="POST">
<?php include("/componentes/combobox_campus.php");
	if(@$campus>0){
		$sql_curso = "select curso.id,curso.nome_reduzido from curso INNER JOIN elemento_organizacional ON (elemento_organizacional.id = curso.unidade_organizacional_id) where elemento_organizacional.elemento_organizacional_id = '".$campus."' order by curso.nome_reduzido;";
		$result_curso = pg_query($conexao,$sql_curso);
?>
		<div class="col-md-12">
		<?php
			include("/componentes/combobox_cursos.php");
		?>
			<div class="col-md-2">
				<button type="submit" class="btn btn-primary">Carregar Turmas</button>
			</div>
		</div>
	<?php
		if(@$curso>0){
			$sql_ano = "select distinct periodo_letivo.ano from periodo_letivo
						INNER JOIN turma ON (periodo_letivo.id = turma.periodo_letivo_id)
						INNER JOIN matriz_curricular ON (turma.matriz_curricular_id = matriz_curricular.id)
						WHERE matriz_curricular.curso_id = '".$curso."' order by ano;";
			$result_ano = pg_query($conexao,$sql_ano);
?>
		<?php
			include("/componentes/combobox_ano.php");
		?>
		<div class="col-md-2">
			<a target="_blank" href="<?php echo'pages/relatorios/turma.php?curso='.$curso.'&ano='.$ano_ingresso; ?>"><button type="button" class="btn btn-success">Gerar Relatório</button></a>
		</div>
		<?php }} ?>		 
</form>
