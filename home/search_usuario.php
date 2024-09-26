<?php
session_start();

// Verifica se a sessão validateLogin existe e se está configurada como false
if (!isset($_SESSION["validateLogin"]) || $_SESSION["validateLogin"] == false) {
  header('Location: ../login');
  exit();
}

$id_usuario = $_SESSION["usuario_id"];
$nome_usuario = $_SESSION["usuario_nome"];
$urlImage_usuario = $_SESSION["usuario_imagem"];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Meta tags Obrigatórias -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="../assets/user.png">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="shortcut icon" href="../assets/user.jpg" type="image/jpeg">

  <title>Home Page</title>

  <style>
    /* Estilo para o scroll lateral */
    .table-responsive {
      overflow-x: auto;
    }

    /* Evitar quebra de linha nas células da tabela */
    .table td,
    .table th {
      white-space: nowrap;
    }

    /* Estilo para o botão de logout */
    .logout-btn {
      position: absolute;
      top: 10px;
      right: 10px;
    }

    /* Estilo para a foto de perfil */
    .profile {
      border-radius: 10px;
      background-color: gray;
      position: absolute;
      top: 10px;
      left: 10px;
      display: flex;
      align-items: center;
      padding: 5px;
    }

    .profile-pic {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 10px;
    }

    .profile-name {
      font-size: 18px;
      font-weight: bold;
    }

    .profile {
      text-decoration: black;
      background-color: lightgray;
    }
  </style>
</head>

<body class="container">

  <!-- Foto de perfil e nome do usuário no canto superior esquerdo -->
  <a href="../update/update_user.php?id=<?php echo $id_usuario ?>" style="text-decoration: none; color: inherit;">
    <div class="profile">
      <img src="<?php echo $urlImage_usuario; ?>" alt="Foto de Perfil" class="profile-pic">
      <span class="profile-name"><?php echo $nome_usuario; ?></span>
    </div>
  </a>

  <!-- Botão de Logout no canto superior direito -->
  <form action="../sair.php" method="POST">
    <button type="submit" class="btn btn-danger logout-btn">Logout</button>
  </form>

  <br>

  <h1 class="mt-5">Lista de Usuarios</h1>

  <!-- JavaScript (Opcional) -->
  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <!-- Contêiner com scroll lateral -->
  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead class="thead-dark">
        <tr>
          <th scope="col">id</th>
          <th scope="col">Nome</th>
          <th scope="col">Sobrenome</th>
          <th scope="col">CPF</th>
          <th scope="col">RG</th>
          <th scope="col">Email</th>
          <th scope="col">Telefone</th>
          <th scope="col">CEP</th>
          <th scope="col">Endereco</th>
          <th scope="col">Número</th>
          <th scope="col">Bairro</th>
          <th scope="col">Cidade</th>
          <th scope="col">Estado</th>
        </tr>
      </thead>
      <tbody>

        <?php
        include('../connection.php');

        $sql = "SELECT * FROM usuarios";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<th>' . $row["id"] . '</th>';
            echo '<th>' . $row["nome"] . '</th>';
            echo '<td>' . $row["sobrenome"] . '</td>';
            echo '<td>' . $row["cpf"] . '</td>';
            echo '<td>' . $row["rg"] . '</td>';
            echo '<td>' . $row["email"] . '</td>';
            echo '<td>' . $row["telefone"] . '</td>';
            echo '<td>' . $row["cep"] . '</td>';
            echo '<td>' . $row["endereco"] . '</td>';
            echo '<td>' . $row["numero"] . '</td>';
            echo '<td>' . $row["bairro"] . '</td>';
            echo '<td>' . $row["cidade"] . '</td>';
            echo '<td>' . $row["estado"] . '</td>';
            echo '</tr>';
          }
        }
        ?>

      </tbody>
    </table>
  </div>

</body>

</html>