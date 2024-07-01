<?php
require_once 'db_connect.php';
// Função para atualizar
if (isset($_POST['nome'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = "UPDATE usuarios SET nome = '$nome', email = '$email' where id = $id";
    $atualizar = mysqli_query($conn,$sql);

    if ($atualizar) {
        echo "<script>alert('Usuário foi atualizado com sucesso!')</script>";
        header('location: listar.php');
    } else {
        mysqli_error($conn);
    }
}

?>