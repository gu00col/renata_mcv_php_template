<?php 
namespace App\Models;

class Usuario {
    protected $db;
    
    public function __construct(\PDO $db){
        $this->db = $db;
    }

    public function getUsuarios(){
        $stm = $this->db->prepare("SELECT * FROM usuarios");
        $stm->execute();
        
        // Obtém os resultados
        $usuarios = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $usuarios; 
    }

    public function getUsuario($param, $type = 'id'){
        $query = "SELECT * FROM usuarios WHERE ";
        
        switch($type) {
            case 'nome':
                $query .= "nome = :param";
                break;
            case 'email':
                $query .= "email = :param";
                break;
            case 'id':
            default:
                $query .= "id = :param";
                break;
        }
        
        $stm = $this->db->prepare($query);
        $stm->bindParam(':param', $param, \PDO::PARAM_STR);
        $stm->execute();
        
        // Obtém o resultado
        $usuario = $stm->fetch(\PDO::FETCH_ASSOC);
        return $usuario; 
    }

    public function insertUsuario($nome, $email, $senha){
        // Criptografar a senha
        $senhaCriptografada = password_hash($senha, PASSWORD_BCRYPT);

        $stm = $this->db->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
        $stm->bindParam(':nome', $nome, \PDO::PARAM_STR);
        $stm->bindParam(':email', $email, \PDO::PARAM_STR);
        $stm->bindParam(':senha', $senhaCriptografada, \PDO::PARAM_STR);
        $stm->execute();
        
        // Retorna o ID do novo usuário inserido
        return $this->db->lastInsertId();
    }

    public function updateUsuario($id, $nome, $email, $senha, $ativo){
        // Criptografar a senha
        $senhaCriptografada = password_hash($senha, PASSWORD_BCRYPT);

        $stm = $this->db->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, ativo = :ativo, atualizado_em = NOW() WHERE id = :id");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->bindParam(':nome', $nome, \PDO::PARAM_STR);
        $stm->bindParam(':email', $email, \PDO::PARAM_STR);
        $stm->bindParam(':senha', $senhaCriptografada, \PDO::PARAM_STR);
        $stm->bindParam(':ativo', $ativo, \PDO::PARAM_INT);
        $stm->execute();
        
        // Retorna o número de linhas afetadas
        return $stm->rowCount();
    }

    public function deleteUsuario($id){
        $stm = $this->db->prepare("DELETE FROM usuarios WHERE id = :id");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->execute();
        
        // Retorna o número de linhas afetadas
        return $stm->rowCount();
    }

    public function validatePassword($email, $senha){
        $usuario = $this->getUsuario($email, 'email');

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return true; // Senha válida
        }
        return false; // Senha inválida
    }
} 
?>
