<?php

	session_start();
	include_once('connection.php');

	if(isset($_GET['id'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$sql = "DELETE FROM estudiante WHERE id = '".$_GET['id']."'";
			console.log(id);
			// declaración if-else en la ejecución de nuestra consulta
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Estdiante eliminado correctamente' : 'Ocurrió un error. No se pudo eliminar al Estdiante';
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//cerrar conexión
		$database->close();

	}
	else{
		$_SESSION['message'] = 'Seleccione registro para eliminar';
	}

	header('location: index.php');

?>