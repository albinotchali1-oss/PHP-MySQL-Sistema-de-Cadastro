<?php

include_once "config.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form.php');
    exit;
}

$nome = isset($_POST['nome']) && is_string($_POST['nome']) ? trim($_POST['nome']) : '';
$email = isset($_POST['email']) && is_string($_POST['email']) ? trim($_POST['email']) : '';
$senhaOriginal = isset($_POST['senha']) && is_string($_POST['senha']) ? $_POST['senha'] : '';
$telefone = isset($_POST['telefone']) && is_string($_POST['telefone']) ? trim($_POST['telefone']) : '';
$data = isset($_POST['data']) && is_string($_POST['data']) ? $_POST['data'] : '';
$cidade = isset($_POST['cidade']) && is_string($_POST['cidade']) ? trim($_POST['cidade']) : '';
$genero = isset($_POST['genero']) && is_string($_POST['genero']) ? $_POST['genero'] : '';

$sql = 'SELECT * FROM usuarios WHERE email = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    echo "<script>alert('Email já cadastrado!'); window.location.href='form.php';</script>";
    exit;
}else{

    $hash = password_hash($senhaOriginal, PASSWORD_DEFAULT);
    $sql = 'INSERT INTO usuarios (nome, email, senha, telefone, data_nasc, cidade, sexo) VALUES (?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssss', $nome, $email, $hash, $telefone, $data, $cidade, $genero);

    if ($stmt->execute()) {
        echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Não foi possível realizar o cadastro!'); window.location.href='form.php';</script>";
    }
}
?>