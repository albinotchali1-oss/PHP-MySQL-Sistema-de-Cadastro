<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f3f5f1">
    <title>Cadastro de clientes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <section id="cadastro" aria-labelledby="titulo">
            <header>
                <p class="identificacao">Cadastro / clientes</p>
                <h1 id="titulo">Vamos começar?</h1>
                <p class="descricao">Preencha seus dados para criar o cadastro.</p>
            </header>

            <form method="post">
                <fieldset>
                    <legend>Dados pessoais</legend>
                    <div class="campos">
                        <div class="campo">
                            <label for="nome">Nome completo</label>
                            <input type="text" name="nome" id="nome" autocomplete="name" required>
                        </div>
                        <div class="campo">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" autocomplete="email" required>
                        </div>
                        <div class="campo">
                            <label for="senha">Senha</label>
                            <input type="password" name="senha" id="senha" autocomplete="new-password" minlength="8" required>
                        </div>
                        <div class="campo">
                            <label for="telefone">Telefone</label>
                            <input type="tel" name="telefone" id="telefone" autocomplete="tel">
                        </div>
                        <div class="campo">
                            <label for="data">Data de nascimento</label>
                            <input type="date" name="data" id="data" autocomplete="bday">
                        </div>
                        <div class="campo">
                            <label for="cidade">Cidade</label>
                            <input type="text" name="cidade" id="cidade" autocomplete="address-level2">
                        </div>
                        <fieldset class="campo-genero">
                            <legend>Sexo</legend>
                            <label class="opcao-genero" for="genero-masculino">
                                <input type="radio" name="genero" id="genero-masculino" value="M">
                                Masculino
                            </label>
                            <label class="opcao-genero" for="genero-feminino">
                                <input type="radio" name="genero" id="genero-feminino" value="F">
                                Feminino
                            </label>
                        </fieldset>
                    </div>
                </fieldset>
                <button type="submit">Cadastrar cliente</button>
                <a href="#" class="link-voltar">Retornar</a>
            </form>
        </section>
    </main>
</body>
</html>