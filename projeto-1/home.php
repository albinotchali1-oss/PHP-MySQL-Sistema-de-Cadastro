<?php
    session_start();
    // print_r($_SESSION);
    if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
        header('Location: index.php');
        unset($_SESSION['email']);
        Unset($_SESSION['senha']);
        exit;
    }else{ $loggedInEmail = $_SESSION['email']; }
    
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de cadastro</title>
    <link rel="stylesheet" href="src/css/style-home.css">
</head>
<body>
    <header>
        <h1>
            Sistema de Cadastro
        </h1>
        <a href="sair.php" class="btn-sair">Sair</a>
    </header>
    <main>
        <h1>Bem-vindo ao Sistema de Cadastro</h1>
        <p>Você está logado como: <strong> <?php echo htmlspecialchars($loggedInEmail); ?></strong></p>
    </main>
</body>
</html>