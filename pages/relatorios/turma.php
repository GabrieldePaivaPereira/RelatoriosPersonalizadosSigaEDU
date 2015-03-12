<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="../../dist/css/theme.css" rel="stylesheet">
<?php
	include("../conexao.php");
	$ano = @$_GET["ano"];
	$curso = @$_GET["curso"];
	$id_elemento_curricular = array();
	$sql = "SELECT  elemento_curricular.id,elemento_curricular.nome from elemento_curricular 
			INNER JOIN elemento_matriz ON (elemento_curricular.id = elemento_matriz.elemento_curricular_id)
			WHERE elemento_curricular.curso_id='".$curso."' order by elemento_matriz.periodo_curricular,elemento_curricular.nome;";
	$result = pg_query($conexao,$sql);
?>
	<table><tr><td></td>
<?php
	while($line = pg_fetch_assoc($result)){
		array_push($id_elemento_curricular,$line["id"]);
?>
	<td class="label label-default"><h5>
<?php echo $line["nome"]; ?>
	</h5></td>
<?php
	 }
	 $x = count($id_elemento_curricular);
?>
</tr>
<?php 
	$sql = "SELECT pessoa_fisica.id,pessoa_fisica.nome FROM pessoa_fisica
			INNER JOIN matricula ON (pessoa_fisica.id = matricula.aluno_id)
			INNER JOIN matriz_curricular ON (matricula.matriz_curricular_id = matriz_curricular.id)
			INNER JOIN status_aluno_curso ON (matricula.status_aluno_curso_id = status_aluno_curso.id)
			WHERE matriz_curricular.curso_id = '".$curso."' AND status_aluno_curso.descricao LIKE 'Em curso%' 
			AND matricula.data_matricula >= '".$ano."-01-01' AND matricula.data_matricula <= '".$ano."-12-31' AND status_aluno_curso.id='12' order by pessoa_fisica.nome ;";
	$result = pg_query($conexao,$sql);
	while($line = pg_fetch_assoc($result)){
		$id_aluno = $line["id"];
		array_push($id_elemento_curricular,$line["id"]);
?>
	<tr>
	<td <td class="label label-default"><h5>
<?php echo $line["nome"]; ?>
	</h5></td>
<?php
	
	for($i = 0; $i < $x;$i++){
		$sql1 = "SELECT elemento_curricular.nome,status_aluno_classe.descricao FROM status_aluno_classe
					INNER JOIN enturmacao ON (enturmacao.status_aluno_classe_id = status_aluno_classe.id)
					INNER JOIN matricula ON (enturmacao.matricula_id = matricula.id)
					INNER JOIN pessoa_fisica ON (pessoa_fisica.id = matricula.aluno_id)
					INNER JOIN classe ON (enturmacao.classe_id = classe.id)
					INNER JOIN elemento_curricular ON (classe.disciplina_id = elemento_curricular.id)
					WHERE pessoa_fisica.id='".$id_aluno."' AND elemento_curricular.id = '".$id_elemento_curricular[$i]."';";
		$result1 = pg_query($conexao,$sql1);
		$conteudo = "";
		$classe = "";
		while($l2 = pg_fetch_assoc($result1)){
			
			$conteudo = $l2["descricao"];
			$classe = "";
			if($l2["descricao"] == "Aprovado por Nota"){
				$classe = 'class="btn btn-lg btn-success"';
			}else{
				if($l2["descricao"] == "Em Curso"){
				$classe = 'class="btn btn-lg btn-info"';
			}else{
				$classe = 'class="btn btn-lg btn-danger"';
			}
			}
		}
		if($classe==""){
				$sql1 = "SELECT elemento_curricular.nome,status_aluno_classe.descricao FROM status_aluno_classe
					INNER JOIN enturmacao ON (enturmacao.status_aluno_classe_id = status_aluno_classe.id)
					INNER JOIN matricula ON (enturmacao.matricula_id = matricula.id)
					INNER JOIN pessoa_fisica ON (pessoa_fisica.id = matricula.aluno_id)
					INNER JOIN classe ON (enturmacao.classe_id = classe.id)
					INNER JOIN elemento_curricular ON (classe.disciplina_id = elemento_curricular.id)
					WHERE pessoa_fisica.id='".$id_aluno."' AND elemento_curricular.id = (
select elemento_curricular.id from elemento_curricular
where elemento_curricular.nome ilike (select nome from elemento_curricular where id='".$id_elemento_curricular[$i]."') and elemento_curricular.curso_id = (select matriz_curricular.curso_id from matriz_curricular
inner join matricula on(matricula.matriz_curricular_id = matriz_curricular.id )
inner join pessoa_fisica on (pessoa_fisica.id = matricula.aluno_id)
where pessoa_fisica.id='".$id_aluno."' and matriz_curricular.curso_id <> '".$curso."'));";
		$result1 = pg_query($conexao,$sql1);
		$conteudo = "";
		$classe = "";
		while($l2 = pg_fetch_assoc($result1)){
			
			$conteudo = $l2["descricao"];
			$classe = "";
			if($l2["descricao"] == "Aprovado por Nota"){
				$classe = 'class="btn btn-lg btn-success"';
			}else{
				if($l2["descricao"] == "Em Curso"){
				$classe = 'class="btn btn-lg btn-info"';
			}else{
				$classe = 'class="btn btn-lg btn-danger"';
			}
			}
		}
		}
		if($classe == ""){
			$conteudo = "Não Cursado";
			$classe = 'class="btn btn-lg btn-warning"';
			
		}
		?>
		<td <?php echo $classe; ?>><?php echo $conteudo; ?></td>
		<?php
		
	}
?>
	</tr>
	<?php
	 }
?>
</table>