<?php

$senhaOriginal = "12345678";
$id = 4;
$hash = password_hash($senhaOriginal, PASSWORD_DEFAULT);
$nome = "Tchali";
require_once "config.php";
$sql = "UPDATE usuarios SET senha = ? WHERE id = ? OR nome = ?";


$stmt = $conn->prepare($sql);
$stmt->bind_param('sis', $hash, $_GET['id'], $nome);

if ($stmt->execute()) {
    echo "<script>alert('Senha atualizada com sucesso!'); window.location.href='home.php';</script>";
} else {
    echo "<script>alert('Não foi possível atualizar a senha!'); window.location.href='home.php';</script>";
}