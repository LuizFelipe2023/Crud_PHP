<?php
include_once("connection/db.php");
include_once("controllers/userController.php");
include_once("dao/userDao.php");
include_once("models/user.php");

$userD = new userDao($conn);
$userController = new userController($userD);

$userId = isset($_GET["id"]) ? $_GET["id"] : null;

if (!is_numeric($userId) || $userId <= 0) {
    header("Location: index.php");
    exit();
}

$user = $userController->viewUserbyId($userId);

if ($user === null) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $endereco = $_POST["endereco"];

    $userController->update($id, $nome, $idade, $endereco);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            margin-bottom: 10px;
        }

        a {
            color: #333;
            text-decoration: none;
            margin-right: 10px;
        }

        a:hover {
            color: #0066cc;
        }
    </style>
</head>

<body>
    <h2>Editar Usuário</h2>

    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?php echo $user['nome']; ?>" required><br>

        <label for="idade">Idade:</label>
        <input type="number" name="idade" value="<?php echo $user['idade']; ?>" required><br>

        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco" value="<?php echo $user['endereco']; ?>" required><br>

        <input type="submit" value="Atualizar">
    </form>

    <a href="index.php">Voltar para a Lista de Usuários</a>
</body>

</html>
