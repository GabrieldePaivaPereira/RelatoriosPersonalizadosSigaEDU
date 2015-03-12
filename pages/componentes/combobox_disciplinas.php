<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="col-md-12">
	<label class="col-md-3"><h4>Selecione a Disciplina:</h4></label>
	<div class="col-md-4 dropdown theme-dropdown clearfix">
		<select class="dropdown-menu" role="menu" name="disciplina">		
			<?php
				$ativado='selected="selected"';
				while($line = pg_fetch_array($result_disc)){?>
					<option role="presentation" <?php if($line["id"]==$disc){ echo $ativado;} ?> value="<?php echo $line["id"]; ?>"><?php echo $line["nome"]; ?></option>
			<?php	}		?>
		</select>
	</div>
	<div class="col-md-2">
		<button type="submit" class="btn btn-success">Gerar Relatorio</button>
	</div>
</div>