<?php
require_once 'Usuario.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $usuario = new Usuario();
        $usuario->setNome($_POST['nome'] ?? '');

        if ($usuario->salvar()) {
            header('Location: index.php');
            exit;
        }

        $erro = 'Não foi possível gravar o nome. Verifique as permissões da pasta.';
    } catch (InvalidArgumentException $e) {
        $erro = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            font-family: "Segoe UI", Roboto, Arial, sans-serif;
            background: radial-gradient(circle at top, #2a1450 0%, #120a22 55%, #0a0613 100%);
            color: #e9e1f5;
        }

        .cartao {
            width: 100%;
            max-width: 460px;
            background: #1b1229;
            border: 1px solid #3b2765;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 0 40px rgba(124, 58, 237, 0.25), 0 20px 40px rgba(0, 0, 0, 0.6);
        }

        h1 { margin: 0 0 24px; font-size: 1.5rem; color: #f3ecff; }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #c4a5ff;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 14px;
            font-size: 1rem;
            color: #f3ecff;
            background: #120b1d;
            border: 2px solid #3b2765;
            border-radius: 10px;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        input[type="text"]::placeholder { color: #7a6a99; }

        input[type="text"]:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.2);
        }

        button {
            width: 100%;
            margin-top: 16px;
            padding: 12px;
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(135deg, #5b2a9e, #7c3aed);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: box-shadow 0.15s, transform 0.15s;
        }

        button:hover {
            box-shadow: 0 0 18px rgba(139, 92, 246, 0.6);
            transform: translateY(-1px);
        }

        .voltar {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #9d8bbd;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .voltar:hover { color: #c4a5ff; }

        .erro {
            background: #2e1219;
            border: 1px solid #6b2230;
            border-left: 5px solid #ef4444;
            color: #fca5b0;
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <main class="cartao">
        <h1>Cadastrar Usuário</h1>

        <?php if ($erro !== ''): ?>
            <div class="erro" role="alert"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <form method="post" action="cadastrar.php">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Digite o nome" required autofocus>
            <button type="submit">Salvar</button>
        </form>

        <a class="voltar" href="index.php">← Voltar para a lista</a>
    </main>
</body>
</html>