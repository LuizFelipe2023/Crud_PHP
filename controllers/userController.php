<?php
include_once("models/user.php");
include_once("dao/userDao.php");

class userController
{
    private $userD;

    public function __construct(userDao $userD)
    {
        $this->userD = $userD;
    }

    public function create($nome, $idade, $endereco)
    {
        $user = new User();
        $user->setNome($nome);
        $user->setIdade($idade);
        $user->setEndereco($endereco);

        try {
            if ($this->userD->createUser($user)) {
                return "Usuario criado com sucesso!";
            } else {
                return "Erro ao criar o Usuario!";
            }
        } catch (Exception $e) {
            return "Erro inesperado ao criar o usuário: " . $e->getMessage();
        }
    }

    public function viewAllUsers()
    {
        try {
            return $this->userD->findAllUsers();
        } catch (Exception $e) {
            return [];
        }
    }

    public function viewUserById($id)
    {
        try {
            return $this->userD->findUserById($id);
        } catch (Exception $e) {
            return null;
        }
    }

    public function update($id, $nome, $idade, $endereco)
    {
        $userUpdate = new User();
        $userUpdate->setId($id);
        $userUpdate->setNome($nome);
        $userUpdate->setIdade($idade);
        $userUpdate->setEndereco($endereco);

        try {
            if ($this->userD->updateUser($userUpdate)) {
                return "Usuario atualizado com sucesso!";
            } else {
                return "Erro ao atualizar o usuario!";
            }
        } catch (Exception $e) {
            return "Erro inesperado ao atualizar o usuário: " . $e->getMessage();
        }
    }

    public function delete($userId)
    {
        $userDelete = new User();
        $userDelete->setId($userId);

        try {
            if ($this->userD->deleteUser($userDelete)) {
                return "Usuario apagado com sucesso!";
            } else {
                return "Erro ao apagar o usuario!";
            }
        } catch (Exception $e) {
            return "Erro inesperado ao apagar o usuário: " . $e->getMessage();
        }
    }
}
