<?php
include('../connection.php');

// Verifica se o ID foi fornecido via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Primeiro, busca o caminho da imagem associada ao usuário
    $sql_image = "SELECT imagem FROM usuarios WHERE id = ?";
    $stmt_image = $conn->prepare($sql_image);
    $stmt_image->bind_param("i", $id);
    $stmt_image->execute();
    $result_image = $stmt_image->get_result();

    if ($result_image->num_rows > 0) {
      $row_image = $result_image->fetch_assoc();
      $imagem = $row_image['imagem'];

      // Verifica se a imagem existe e tenta deletá-la
      $image_path = '../uploads/' . $imagem;
      if (file_exists($image_path)) {
        if (unlink($image_path)) {
          echo "Imagem excluída com sucesso. ";
        } else {
          echo "Erro ao excluir a imagem.";
        }
      }
    }

    // Prepara a consulta SQL para deletar o usuário pelo ID
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
      echo "Usuário deletado com sucesso.";
      session_start();
      session_unset();
      session_destroy();
    } else {
      echo "Erro ao deletar o usuário: " . $conn->error;
    }

    $stmt->close();
  } else {
    echo "ID do usuário não fornecido.";
  }
} else {
  echo "Método de requisição inválido.";
}

$conn->close();
