<?php
	include("conexao.php");
	$sql_campus = "Select id,nome from elemento_organizacional where nome like 'Câmpus%' order by nome;";
	$result_campus = pg_query($conexao,$sql_campus);
	$x = 0;
	if(@empty(@$_POST["campus"])){
		$campus=0;
	}else{
	$campus = @$_POST["campus"];
	}
	if(@empty(@$_POST["curso"])){
		$curso=0;
	}else{
	$curso = @$_POST["curso"];
	}
	if(@empty(@$_POST["disciplina"])){
		$disc=0;
	}else{
	$disc = @$_POST["disciplina"];
	}
?>
<form method="POST">
<?php
	include("/componentes/combobox_campus.php");
	if(@$campus>0){
		
			$sql_curso = "select curso.id,curso.nome_reduzido from curso INNER JOIN elemento_organizacional ON (elemento_organizacional.id = curso.unidade_organizacional_id) where elemento_organizacional.elemento_organizacional_id = '".$campus."' order by curso.nome_reduzido;";
			$result_curso = pg_query($conexao,$sql_curso);
			?>
		<div class="col-md-12">
		<?php
			include("/componentes/combobox_cursos.php");
		?>
			<div class="col-md-2">
				<button type="submit" class="btn btn-primary">Carregar Disciplinas</button>
			</div>
		</div>

<?php
	}
	if(@$curso>0){
?>
	<div>
		<?php
			$sql_disciplina = "select id,nome from elemento_curricular where curso_id = '".$curso."' order by nome;";
			$result_disc = pg_query($conexao,$sql_disciplina);
			include("/componentes/combobox_disciplinas.php");
		?>
	</div>

<?php
	} ?>
	</form>
	</div>
<?php if(@$disc>0){
	$sql = "SELECT  count(*) from enturmacao 
inner join status_aluno_classe on(enturmacao.status_aluno_classe_id = status_aluno_classe.id) 
INNER JOIN classe ON (enturmacao.classe_id = classe.id)
INNER JOIN disciplina ON (classe.disciplina_id = disciplina.elemento_curricular_id)
INNER JOIN elemento_curricular ON (disciplina.elemento_curricular_id = elemento_curricular.id)
INNER JOIN matricula ON (enturmacao.matricula_id = matricula.id)
INNER JOIN status_aluno_curso ON (matricula.status_aluno_curso_id = status_aluno_curso.id)
WHERE status_aluno_classe.descricao like 'Reprovado%' and status_aluno_curso.descricao like 'Em Curso' and elemento_curricular.id = '".$disc."';";
	$result = pg_query($conexao,$sql);
	
	$sql = "SELECT distinct pessoa_fisica.nome dist from enturmacao 
inner join status_aluno_classe on(enturmacao.status_aluno_classe_id = status_aluno_classe.id) 
INNER JOIN classe ON (enturmacao.classe_id = classe.id)
INNER JOIN disciplina ON (classe.disciplina_id = disciplina.elemento_curricular_id)
INNER JOIN elemento_curricular ON (disciplina.elemento_curricular_id = elemento_curricular.id)
INNER JOIN matricula ON (enturmacao.matricula_id = matricula.id)
INNER JOIN pessoa_fisica ON (matricula.aluno_id = pessoa_fisica.id)
INNER JOIN status_aluno_curso ON (matricula.status_aluno_curso_id = status_aluno_curso.id)
INNER JOIN matriz_curricular ON (matricula.matriz_curricular_id = matriz_curricular.id)
INNER JOIN curso ON (curso.id = matriz_curricular.curso_id)
WHERE status_aluno_classe.descricao like 'Reprovado%' and status_aluno_curso.descricao like '%Em curso%' and curso.id='".$curso."'  and elemento_curricular.id = '".$disc."' order by dist;";
	$result = pg_query($conexao,$sql);
?>
		<div class="panel panel-danger">
            <div class="panel-heading">
              <h3 class="panel-title">Alunos reprovados nesta disciplina</h3>
            </div>
            <div class="panel-body">
		<ul class="list-group">
		<?php
			while($line = pg_fetch_array($result)){
		?>
			 <li class="list-group-item">
			<?php echo $line["dist"]; ?>
			</li>
			
		<?php	}
		?>
		
		 </ul>
		 </div>
          </div>
	</div>
<?php
	} ?>