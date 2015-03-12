	<label class="col-md-3"><h4>Selecione o Curso:</h4></label>
	<div class="col-md-3 dropdown theme-dropdown clearfix">
		<select class="dropdown-menu" role="menu" name="curso">		
			<?php
				$ativado='selected="selected"';
				while($line = pg_fetch_array($result_curso)){?>
					<option role="presentation" <?php if($line["id"]==$curso){ echo $ativado;} ?> value="<?php echo $line["id"]; ?>"><?php echo $line["nome_reduzido"]; ?></option>
			<?php	}		?>
		</select>
	</div>