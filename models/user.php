<?php

class User
{
    private $id;
    private $nome;
    private $idade;
    private $endereco;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getIdade()
    {
        return $this->idade;
    }
    public function setIdade($idade)
    {
        $this->idade = $idade;
    }
    public function getEndereco()
    {
        return $this->endereco;
    }
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }
}

interface userDaoInterface
{
    public function createUser(User $user);
    public function findAllUsers();
    public function findUserbyId($id);
    public function updateUser(User $user);
    public function deleteUser(User $user);
}
