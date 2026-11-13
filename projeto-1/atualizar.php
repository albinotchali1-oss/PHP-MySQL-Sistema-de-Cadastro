<?php

include_once "config.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: home.php');
    exit;
}

$nome = isset($_POST['nome']) && is_string($_POST['nome']) ? trim($_POST['nome']) : '';
$email = isset($_POST['email']) && is_string($_POST['email']) ? trim($_POST['email']) : '';
$senhaOriginal = isset($_POST['senha']) && is_string($_POST['senha']) ? $_POST['senha'] : '';
$telefone = isset($_POST['telefone']) && is_string($_POST['telefone']) ? trim($_POST['telefone']) : '';
$data = isset($_POST['data']) && is_string($_POST['data']) ? $_POST['data'] : '';
$cidade = isset($_POST['cidade']) && is_string($_POST['cidade']) ? trim($_POST['cidade']) : '';
$genero = isset($_POST['genero']) && is_string($_POST['genero']) ? $_POST['genero'] : '';

if ($email === $_SESSION['email']) {
    $hash = password_hash($senhaOriginal, PASSWORD_DEFAULT);
    $sql = 'UPDATE usuarios SET nome = ?, email = ?, senha = ?, telefone = ?, data_nasc = ?, cidade = ?, sexo = ? WHERE email = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssss', $nome, $email, $hash, $telefone, $data, $cidade, $genero, $_SESSION['email']);
}else {
    echo "<script>alert('Não é possível alterar o e-mail! ou dados de outros usuários.'); window.location.href='home.php';</script>";
}


if ($stmt->execute()) {
    echo "<script>alert('Alteração realizada com sucesso!'); window.location.href='home.php';</script>";
} else {
    echo "<script>alert('Não foi possível realizar a alteração!'); window.location.href='home.php';</script>";
}
?>