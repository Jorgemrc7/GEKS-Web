<?php
    //session_start();
    include_once 'conexion.php';

    $usuario_login = $_POST['login_user'];
    $password_login = $_POST['login_password'];

    //Verificar que existe el usuario
	$sql = 'SELECT * FROM docentes WHERE User_D=?';
	$sentencia = $pdo->prepare($sql);
	$sentencia->execute(array($usuario_login));
	$resultado = $sentencia->fetch();

    if(!$resultado){
        header('Location: ../HTML/registro.hmtl');
    }

    if(password_verify($password_login, $resultado['Password_D'])){
        $_SESSION['admin'] = $usuario_login;
        header('Location: ../HTML/Inicio.html');
    }else{
        echo 'Contrasena Incorrecta';
        header('Location: ../HTML/login.html');
    }
?>