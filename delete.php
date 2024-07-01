<?php

//Deletar registro
require_once 'db_connect.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM usuarios WHERE id=$id";
    $deletar = mysqli_query($conn,$sql);

    //Voltar para o listar
    if ($deletar) {
        header('location: listar.php');

    } else {
        mysqli_error($conn);
    }
}
?>