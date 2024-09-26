<?php
session_start();

// Verifica se a sessão validateLogin existe e se está configurada como false
if (!isset($_SESSION["validateLogin"]) || $_SESSION["validateLogin"] == false) {
  header('Location: ../login');
  exit();
}

include('../connection.php');

// Verifica se o ID foi fornecido via GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Prepara a consulta SQL para buscar o usuário pelo ID
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica se o usuário foi encontrado
        if ($result->num_rows > 0) {
            // Recupera os dados do usuário
            $row = $result->fetch_assoc();
        } else {
            echo "Usuário não encontrado.";
            exit();
        }
    } else {
        echo "ID do usuário não fornecido.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="../assets/user.jpg" type="image/jpeg">

    <title>Editar Usuários</title>
</head>

<body class="container">
    <h1>Atualizar cadastro do usuário</h1>

    <form id="form_update_usuario" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" id="id">

        <div class="row mb-2">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome: </label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $row['nome']; ?>" />
            </div>
            <div class="col-md-6">
                <label for="sobrenome" class="form-label">Sobrenome: </label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?php echo $row['sobrenome']; ?>" />
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <label for="cpf" class="form-label">CPF: </label>
                <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $row['cpf']; ?>" />
            </div>
            <div class="col-md-6">
                <label for="rg" class="form-label">RG:</label>
                <input type="text" class="form-control" id="rg" name="rg" value="<?php echo $row['rg']; ?>" />
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <label for="email" class="form-label">Email: </label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" />
            </div>
            <div class="col-md-6">
                <label for="telefone" class="form-label">Telefone:</label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $row['telefone']; ?>" />
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <label for="cep" class="form-label">CEP: </label>
                <input type="text" class="form-control" id="cep" name="cep" value="<?php echo $row['cep']; ?>" />
            </div>
            <div class="col-md-6">
                <label for="endereco" class="form-label">Endereço: </label>
                <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo $row['endereco']; ?>" />
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <label for="numero" class="form-label">Número:</label>
                <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $row['numero']; ?>" />
            </div>
            <div class="col-md-6">
                <label for="bairro" class="form-label">Bairro:</label>
                <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $row['bairro']; ?>" />
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <label for="cidade" class="form-label">Cidade:</label>
                <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $row['cidade']; ?>" />
            </div>
            <div class="col-md-6">
                <label for="estado" class="form-label">Estado:</label>
                <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $row['estado']; ?>" />
            </div>
        </div>

        <div class="mb-3">
            <label for="imagem" class="form-label">Foto de Perfil:</label>
            <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" />
        </div>

        <button type="button" id="update-button" class="btn btn-primary">Atualizar Usuário</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='../home/search_usuario.php';">Cancelar</button>
        <button type="button" id="deleteButton" class="btn btn-danger">Excluir meu Usuário</button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="ajax/ajaxFunctions.js"></script>
</body>

</html>