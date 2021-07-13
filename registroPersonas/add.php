<?php

	session_start();
	include_once('connection.php');

	if(isset($_POST['add'])){
		$database = new Connection();
		$db = $database->open();
		try{
			// hacer uso de una declaración preparada para evitar la inyección de sql
			$stmt = $db->prepare("INSERT INTO estudiante (codigo, nombre, telefono, direccion) VALUES (:codigo,:nombre, :telefono, :direccion)");
			// declaración if-else en la ejecución de nuestra declaración preparada
			$_SESSION['message'] = ( $stmt->execute(array(':codigo' => $_POST['codigo'], ':nombre' => $_POST['nombre'] , ':telefono' => $_POST['telefono'] , ':direccion' => $_POST['direccion'])) ) ? 'Estudiante agregado correctamente' : 'Algo salió mal. No se puede agregar un estudiante';	
	    
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//cerrar conexión
		$database->close();
	}

	else{
		$_SESSION['message'] = 'Fill up add form first';
	}

	header('location: index.php');
	
?>
