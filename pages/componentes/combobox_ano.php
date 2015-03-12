<div class="col-md-12">
	<label class="col-md-3"><h4>Selecione o ano de Ingresso da turma:</h4></label>
	<div class="col-md-2 dropdown theme-dropdown clearfix">
		<select class="dropdown-menu" role="menu" name="ano_ingresso">		
			<?php
				$ativado='selected="selected"';
				while($line = pg_fetch_array($result_ano)){?>
					<option role="presentation" <?php if($line["ano"]==$ano_ingresso){ echo $ativado;} ?> value="<?php echo $line["ano"]; ?>"><?php echo $line["ano"]; ?></option>
			<?php	}		?>
		</select>
	</div>
	<div class="col-md-2">
		<button type="submit" class="btn btn-success">Confirmar Informações</button>
	</div>
</div>