<?php
include_once("connection/db.php");
include_once("controllers/userController.php");
include_once("dao/userDao.php");
include_once("models/user.php");

$userD = new userDao($conn);
$userController = new userController($userD);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["cadastrar"])) {
        $nome = isset($_POST["nome"]) ? $_POST["nome"] : null;
        $idade = isset($_POST["idade"]) ? $_POST["idade"] : null;
        $endereco = isset($_POST["endereco"]) ? $_POST["endereco"] : null;

        if ($nome !== null && $idade !== null && $endereco !== null) {
            $userController->create($nome, $idade, $endereco);
        }
    }

    if (isset($_POST['delete'])) {
        $userIdToDelete = $_POST['delete'];
        $userController->delete($userIdToDelete);
    }
}

$users = $userController->viewAllUsers();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            margin-bottom: 10px;
        }

        h3 {
            margin-top: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }

        a {
            color: #333;
            text-decoration: none;
            margin-left: 10px;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #0066cc;
        }

        p {
            font-style: italic;
            color: #666;
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>

        <label for="idade">Idade:</label>
        <input type="number" name="idade" required><br>

        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco" required><br>

        <input type="submit" name="cadastrar" value="Cadastrar">
    </form>

    <h3>Usuários Cadastrados</h3>

    <?php if (!empty($users)) : ?>
        <ul>
            <?php foreach ($users as $user) : ?>
                <li>
                    <strong>ID:</strong> <?php echo $user['id']; ?><br>
                    <strong>Nome:</strong> <?php echo $user['nome']; ?><br>
                    <strong>Idade:</strong> <?php echo $user['idade']; ?><br>
                    <strong>Endereço:</strong> <?php echo $user['endereco']; ?><br>
                    <form action="edit.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <input type="submit" value="Editar">
                    </form>
                    <form action="" method="post" style="display:inline;">
                        <input type="hidden" name="delete" value="<?php echo $user['id']; ?>">
                        <input type="submit" value="Excluir">
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>Nenhum usuário cadastrado.</p>
    <?php endif; ?>
</body>

</html>