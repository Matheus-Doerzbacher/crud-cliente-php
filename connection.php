<?php

$host = 'localhost:3307';
$user = 'root';
$pass = '';
$db = 'crud_usuario';

$conn = new mysqli($host, $user, $pass, $db);

// Verifica se houve erro na conexão
// Se houver, encerra o script e exibe uma mensagem de erro
if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}
