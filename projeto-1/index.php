<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="src/css/style-login.css">
</head>
<body>
    <main>
        <section id="login">
            <div id="img"></div>
            <div id="form">
                <h1>Login</h1>
                <p>Seja bem-vindo</p>
                <hr>
                <form action="testelogin.php" method="post" autocomplete="on">  
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Digite seu email" autocomplete="email" required maxlength="30">
                    </div>
                    <div>
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" placeholder="Digite sua senha" autocomplete="current-password" required minlength="8" maxlength="20">
                    </div>
                    <button type="submit">Entrar</button>
                    <p>Ainda não tens uma conta? <a href="form.php">Cadastre-se</a></p>
                </form>
            </div>
        </section>
    </main>
</body>
</html>