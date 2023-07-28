<?php
    include_once 'conexion.php';

    $usuario_nuevo = $_POST['User_D'];
    //$email_user = $_POST['Email_D'];
    //$tel_user = $_POST['Tel_D'];
    $password = $_POST['Password_D'];
    $password2 = $_POST['Password2_D'];

    $password =password_hash($password, PASSWORD_DEFAULT);

    //Verificar que existe el usuario
	$sql = 'SELECT * FROM docentes WHERE User_D=?';
	$sentencia = $pdo->prepare($sql);
	$sentencia->execute(array($usuario_nuevo));
	$resultado = $sentencia->fetch();

	if($resultado){
		echo 'El usuario ya existe';
		die();
	}else{
		if(password_verify($password2, $password)){
        
			$sql_agregar = 'INSERT INTO docentes(User_D, Password_D,) values(?,?)';
			$sentencia_agregar = $pdo->prepare($sql_agregar);
			$sentencia_agregar->execute(array($usuario_nuevo, $password));
	
			//Destruir variables 
			$sentencia_agregar = null;
			$pdo = null;
	
			header('location: ../HTML/Inicio.html');
		}else{
			echo 'LAS CONTRASEÑAS NO SON IGUALES';
		}
	}
?>