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

$erros = [];
$camposObrigatorios = [
    'nome' => $nome,
    'e-mail' => $email,
    'senha' => $senhaOriginal,
    'telefone' => $telefone,
    'data de nascimento' => $data,
    'cidade' => $cidade,
    'sexo' => $genero,
];

foreach ($camposObrigatorios as $campo => $valor) {
    if ($valor === '') {
        $erros[] = "O campo $campo é obrigatório.";
    }
}

$tamanho = static function (string $valor): int {
    return mb_strlen($valor, 'UTF-8');
};

if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $erros[] = 'Informe um e-mail válido.';
}
if ($nome !== '' && $tamanho($nome) > 30) {
    $erros[] = 'O nome deve ter no máximo 30 caracteres.';
}
if ($email !== '' && $tamanho($email) > 30) {
    $erros[] = 'O e-mail deve ter no máximo 30 caracteres.';
}
if ($senhaOriginal !== '' && ($tamanho($senhaOriginal) < 8 || $tamanho($senhaOriginal) > 20)) {
    $erros[] = 'A senha deve ter entre 8 e 20 caracteres.';
}
if ($telefone !== '' && $tamanho($telefone) > 15) {
    $erros[] = 'O telefone deve ter no máximo 15 caracteres.';
}
if ($cidade !== '' && $tamanho($cidade) > 20) {
    $erros[] = 'A cidade deve ter no máximo 20 caracteres.';
}
if ($data !== '') {
    $partesData = explode('-', $data);
    if (
        count($partesData) !== 3
        || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $data)
        || !checkdate((int) ($partesData[1] ?? 0), (int) ($partesData[2] ?? 0), (int) ($partesData[0] ?? 0))
    ) {
        $erros[] = 'Informe uma data de nascimento válida.';
    }
}
if ($genero !== '' && !in_array($genero, ['M', 'F'], true)) {
    $erros[] = 'Selecione uma opção de sexo válida.';
}

if ($erros) {
    http_response_code(400);
    echo '<!DOCTYPE html><html lang="pt-BR"><meta charset="UTF-8"><title>Dados inválidos</title>';
    echo '<h1>Não foi possível realizar o cadastro</h1><ul>';
    foreach ($erros as $erro) {
        echo '<li>' . htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') . '</li>';
    }
    echo '</ul><a href="form.php">Voltar ao formulário</a></html>';
    exit;
}

$hash = password_hash($senhaOriginal, PASSWORD_DEFAULT);
$sql = 'INSERT INTO usuarios (nome, email, senha, telefone, data_nasc, cidade, sexo) VALUES (?, ?, ?, ?, ?, ?, ?)';
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssssss', $nome, $email, $hash, $telefone, $data, $cidade, $genero);

if ($stmt->execute()) {
    echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Não foi possível realizar o cadastro!'); window.location.href='form.php';</script>";
}
?>