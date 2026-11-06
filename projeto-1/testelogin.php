<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$email = isset($_POST['email']) && is_string($_POST['email']) ? trim($_POST['email']) : '';
$senhaOriginal = isset($_POST['senha']) && is_string($_POST['senha']) ? $_POST['senha'] : '';

include_once 'config.php';

$senha = $senhaOriginal;
$sql = 'SELECT id, senha FROM usuarios WHERE email = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if ($usuario && password_verify($senhaOriginal, $usuario['senha'])) {
    // echo 'Login válido.';
    session_start();
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    header('Location: home.php');
} else {
    // echo 'E-mail ou senha incorretos.';
    unset($_SESSION['email']);
    Unset($_SESSION['senha']);
    header('Location: index.php');
}

$stmt->close();