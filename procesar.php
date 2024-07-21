<?php

	include_once('config/connection.php');

    if (isset($_POST["registrar"])) {
    
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $celular = $_POST['celular'];
    

        $existe_cedula = $connection->prepare("SELECT * FROM usuarios WHERE CEDULA=:cedula");
        $existe_cedula->bindParam("cedula", $cedula, PDO::PARAM_STR);
        $existe_cedula->execute();

        if ($existe_cedula->rowCount() > 0) {
            echo '<script>alert("¡Este usuario ya existe!")</script>';
        }
        else{
            try {      

                $insert_user = $connection->prepare("INSERT INTO usuarios(cedula, nombre, apellido, correo, direccion, celular) VALUES (:cedula, :nombre, :apellido, :correo, :direccion, :celular)");
                $insert_user ->bindParam("cedula", $cedula, PDO::PARAM_STR);
                $insert_user ->bindParam("nombre", $nombre, PDO::PARAM_STR);
                $insert_user ->bindParam("apellido", $apellido, PDO::PARAM_STR);
                $insert_user->bindParam("correo", $correo, PDO::PARAM_STR);
                $insert_user ->bindParam("direccion", $direccion, PDO::PARAM_STR);
                $insert_user ->bindParam("celular", $celular, PDO::PARAM_STR);
                $result = $insert_user->execute(); 
                
                if ($result) {
                    echo "<script> alert('Operacion exitosa ✅✅')</script>";
                    echo "<script> window.location.href = 'index.html'; </script>";
                }

            } catch (PDOException $e) {
                echo "<script> alert('Error: No se guardaron  los datos ❌❌')</script>";
            }
        }
    }

?>