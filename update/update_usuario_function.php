<?php
include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica se o ID foi fornecido via POST
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    // Validações simples (exemplo: tamanho do nome)
    if (strlen($nome) < 3) {
        echo 'O nome deve ter pelo menos 3 caracteres.';
        exit;
    }

    // Prepara a consulta de atualização
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        $imagem = $_FILES['imagem'];
        $imagemNome = basename($imagem['name']);
        $imagemCaminho = '../uploads/' . $imagemNome;

        // Mova o arquivo para o diretório de uploads
        if (move_uploaded_file($imagem['tmp_name'], $imagemCaminho)) {
            // Atualize o caminho da imagem na base de dados
            $sql = "UPDATE usuarios SET nome = ?, sobrenome = ?, cpf = ?, rg = ?, email = ?, telefone = ?, cep = ?, endereco = ?, numero = ?, bairro = ?, cidade = ?, estado = ?, imagem = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssssssssssi', $nome, $sobrenome, $cpf, $rg, $email, $telefone, $cep, $endereco, $numero, $bairro, $cidade, $estado, $imagemNome, $id);
        } else {
            echo "Erro ao fazer upload da imagem.";
            exit;
        }
    } else {
        // Atualize sem imagem
        $sql = "UPDATE usuarios SET nome = ?, sobrenome = ?, cpf = ?, rg = ?, email = ?, telefone = ?, cep = ?, endereco = ?, numero = ?, bairro = ?, cidade = ?, estado = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssssssssssi', $nome, $sobrenome, $cpf, $rg, $email, $telefone, $cep, $endereco, $numero, $bairro, $cidade, $estado, $id);
    }

    if ($stmt->execute()) {
        echo 'Usuário atualizado com sucesso!';
    } else {
        echo 'Erro ao atualizar o usuário: ' . $stmt->error;
    }
}
?>
