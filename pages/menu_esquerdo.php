<div >
			<?php
			 $car = 0;
			 $car = @$_GET["cod"];
			?>
          <div class="list-group">
            <a href="index.php?cod=0" class="list-group-item <?php if($car == 0){ echo 'active' ;} ?>">In�cio</a>            
            <a href="index.php?cod=1" class="list-group-item <?php if($car == 1){ echo 'active' ;} ?>">Depend�ncias por Disciplina</a>
            <a href="index.php?cod=2" class="list-group-item <?php if($car == 2){ echo 'active' ;} ?>">Depend�ncias por Turma</a>
		</div>
</div>
