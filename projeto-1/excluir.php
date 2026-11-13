<?php

include_once "config.php";
session_start();
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    echo "<script>alert('ID inválido!'); window.location.href='home.php';</script>";
    exit;
}else if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    echo "<script>alert('Acesso negado!'); window.location.href='index.php';</script>";
    exit;
}
$sql = 'SELECT * FROM usuarios WHERE id = ?';

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if ($usuario && $usuario['email'] === $_SESSION['email']) {
    // Permitir exclusão
    $sqlDelete = 'DELETE FROM usuarios WHERE id = ?';
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bind_param('i', $id);
    if($stmtDelete->execute()) {
        echo "<script>alert('Usuário excluído com sucesso!'); window.location.href='home.php';</script>";
    } else {
        echo "<script>alert('Não foi possível excluir o usuário!'); window.location.href='home.php';</script>";
    }
} else {
    echo "<script>alert('Não é possível excluir este usuário!'); window.location.href='home.php';</script>";
}
