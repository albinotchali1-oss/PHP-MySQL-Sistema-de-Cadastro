<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    header('Location: index.php');
    unset($_SESSION['email']);
    Unset($_SESSION['senha']);
    exit;
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: home.php');
    exit;
}

$sql = 'SELECT nome, email, telefone, data_nasc, cidade, sexo FROM usuarios WHERE id = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc();

if (!$usuario) {
    header('Location: home.php');
    exit;
}

$escapar = static fn($valor) => htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f3f5f1">
    <title>Editar cliente</title>
    <link rel="stylesheet" href="src/css/style-form.css">
       <script src="src/js/toggle-senha.js" defer></script>
</head>
<body>
    <main>
        <section id="cadastro" aria-labelledby="titulo">
            <header>
                <p class="identificacao">Editar / clientes</p>
                <h1 id="titulo">Vamos começar?</h1>
                <p class="descricao">Preencha seus dados para atualizar o cadastro.</p>
            </header>

            <form action="atualizar.php" method="post">
                <fieldset>
                    <legend>Dados pessoais</legend>
                    <div class="campos">
                        <div class="campo">
                            <label for="nome">Nome completo</label>
                            <input type="text" name="nome" id="nome" autocomplete="name" maxlength="30" value="<?= $escapar($usuario['nome']) ?>" required>
                        </div>
                        <div class="campo">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" autocomplete="email" maxlength="30" value="<?= $escapar($usuario['email']) ?>" required>
                        </div>
                        <div class="campo">
                            <label for="senha">Senha</label>
                               <div class="campo-senha">
                                   <input type="password" name="senha" id="senha" autocomplete="new-password" placeholder="Digite sua senha" minlength="8" maxlength="20" required>
                                   <button type="button" data-toggle-password aria-controls="senha" aria-pressed="false" aria-label="Mostrar senha">Mostrar</button>
                               </div>
                        </div>
                        <div class="campo">
                            <label for="telefone">Telefone</label>
                            <input type="tel" name="telefone" id="telefone" autocomplete="tel" maxlength="15" value="<?= $escapar($usuario['telefone']) ?>" required>
                        </div>
                        <div class="campo">
                            <label for="data">Data de nascimento</label>
                            <input type="date" name="data" id="data" autocomplete="bday" value="<?= $escapar($usuario['data_nasc']) ?>" required>
                        </div>
                        <div class="campo">
                            <label for="cidade">Cidade</label>
                            <input type="text" name="cidade" id="cidade" autocomplete="address-level2" maxlength="20" value="<?= $escapar($usuario['cidade']) ?>" required>
                        </div>
                        <fieldset class="campo-genero">
                            <legend>Sexo</legend>
                            <label class="opcao-genero" for="genero-masculino">
                                <input type="radio" name="genero" id="genero-masculino" value="M" <?= $usuario['sexo'] === 'M' ? 'checked' : '' ?> required>
                                Masculino
                            </label>
                            <label class="opcao-genero" for="genero-feminino">
                                <input type="radio" name="genero" id="genero-feminino" value="F" <?= $usuario['sexo'] === 'F' ? 'checked' : '' ?> required>
                                Feminino
                            </label>
                        </fieldset>
                    </div>
                </fieldset>
                <button type="submit">Atualizar</button>
                <a href="home.php" class="link-voltar">Retornar</a>
            </form>
        </section>
    </main>
</body>
</html>