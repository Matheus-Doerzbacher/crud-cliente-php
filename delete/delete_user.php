  <?php
  include('../connection.php');

  // Verifica se o ID foi fornecido via GET
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
      $id = $_POST['id'];

      // Prepara a consulta SQL para deletar o produto pelo ID
      $sql = "DELETE FROM usuarios WHERE id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);

      if ($stmt->execute()) {
        echo "Usuario deletado com sucesso.";
        session_start();
        session_unset();
        session_destroy();
      } else {
        echo "Erro ao deletar o usuario: " . $conn->error;
      }

      $stmt->close();
    } else {
      echo "Id do usuario não fornecido.";
    }
  } else {
    echo "Método de requisição inválido.";
  }

  $conn->close();
  ?>