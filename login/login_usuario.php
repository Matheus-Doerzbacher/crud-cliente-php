<?php
include('../connection.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // $myPass = password_hash('123123', PASSWORD_BCRYPT);
    // echo $myPass;

    $sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows() > 0) {
        $stmt->bind_result($id, $nome, $hash);
        $stmt->fetch();

        if (password_verify($senha, $hash)) {
            $_SESSION['usuario_id'] = $id;
            $_SESSION['usuario_nome'] = $nome;
            echo "Login realizado com sucesso!";
        } else {
            echo "Senha incorreta";
        }
    } else {
        echo "Nenhum usuario encontrado com esse email";
    }

    $stmt->close();
    $conn->close();
}
?>