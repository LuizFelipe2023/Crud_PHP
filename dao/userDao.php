<?php
include_once("models/user.php");

class userDao implements userDaoInterface
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function createUser(User $user)
    {
        try {
            $sql = "INSERT INTO users (nome, idade, endereco) VALUES (:nome, :idade, :endereco)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(':nome', $user->getNome());
            $stmt->bindValue(':idade', $user->getIdade());
            $stmt->bindValue(':endereco', $user->getEndereco());

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao criar usuário: " . $e->getMessage();
            return false;
        }
    }

    public function findAllUsers()
    {
        try {
            $sql = "SELECT * FROM users";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao recuperar todos os usuários: " . $e->getMessage();
            return [];
        }
    }

    public function findUserById($id)
    {
        try {
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao recuperar usuário por ID: " . $e->getMessage();
            return null;
        }
    }

    public function updateUser(User $user)
    {
        try {
            $sql = "UPDATE users SET nome = :nome, idade = :idade, endereco = :endereco WHERE id = :id";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(':id', $user->getId());
            $stmt->bindValue(':nome', $user->getNome());
            $stmt->bindValue(':idade', $user->getIdade());
            $stmt->bindValue(':endereco', $user->getEndereco());

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar usuário: " . $e->getMessage();
            return false;
        }
    }

    public function deleteUser(User $user)
    {
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $user->getId());

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao excluir usuário: " . $e->getMessage();
            return false;
        }
    }
}
