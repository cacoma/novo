<?php
$link = mysqli_connect("localhost", "root", "pascal");
if (!$link){
	echo "ERRO: Nao foi possivel conectar. " . mysqli_connect_error() . "\n";
} else {
	echo "Conectado com sucesso! Host info: " . mysqli_get_host_info($link) . "\n";
}
mysqli_close($link);
?>
