<?php
	$conexao = pg_connect("host=127.0.0.1 dbname=dbsigaEDU user=postgres password=pereira123 port=5432");
	if (!$conexao){
		echo "Falha na conexão com o banco. Veja detalhes técnicos: " .
		pg_last_error($conexao);
	}
?>