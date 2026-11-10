<?php
require_once 'Usuario.php';

$usuarios = Usuario::listarTodos();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
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

        .topo {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        h1 { margin: 0; font-size: 1.5rem; color: #f3ecff; }

        .contador {
            background: #2e1b4d;
            color: #c4a5ff;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 999px;
            border: 1px solid #4c2a85;
        }

        ul { list-style: none; margin: 0 0 24px; padding: 0; }

        li {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 14px;
            border-radius: 10px;
            transition: background 0.15s;
        }

        li:hover { background: #271a3d; }

        .avatar {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: linear-gradient(135deg, #4c1d95, #7c3aed);
            color: #fff;
            font-weight: 700;
            box-shadow: 0 0 12px rgba(124, 58, 237, 0.5);
        }

        .botao {
            display: block;
            text-align: center;
            text-decoration: none;
            background: linear-gradient(135deg, #5b2a9e, #7c3aed);
            color: #fff;
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            transition: box-shadow 0.15s, transform 0.15s;
        }

        .botao:hover {
            box-shadow: 0 0 18px rgba(139, 92, 246, 0.6);
            transform: translateY(-1px);
        }

        .alerta {
            background: #2b2210;
            border: 1px solid #5c4a1a;
            border-left: 5px solid #f59e0b;
            color: #f5d58a;
            padding: 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <main class="cartao">
        <div class="topo">
            <h1>Lista de Usuários</h1>
            <?php if (!empty($usuarios)): ?>
                <span class="contador"><?= count($usuarios) ?></span>
            <?php endif; ?>
        </div>

        <?php if (empty($usuarios)): ?>
            <div class="alerta" role="alert">
                <strong>Não há registros.</strong><br>
                Inclua o primeiro nome para começar.
            </div>
            <a class="botao" href="cadastrar.php">Incluir um nome</a>
        <?php else: ?>
            <ul>
                <?php foreach ($usuarios as $usuario): ?>
                    <?php $nome = $usuario->getNome(); ?>
                    <li>
                        <span class="avatar"><?= htmlspecialchars(mb_strtoupper(mb_substr($nome, 0, 1)), ENT_QUOTES, 'UTF-8') ?></span>
                        <span><?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <a class="botao" href="cadastrar.php">+ Cadastrar novo nome</a>
        <?php endif; ?>
    </main>
</body>
</html>