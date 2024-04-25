<?php

namespace App\Entity;

use App\Db\Database;

class Componente {
    public $id;
    public $id_automovel;
    public $id_componente;
   
    public function cadastrar() {
        // Instancia a classe Database
        $db = new Database('automoveis_componentes');
        // Insere os dados na tabela
        //query 
        $this->id = $db->insert([
            'id_automovel' => $this->id_automovel,
            'id_componente' => $this->id_componente
        ]);
        // Retorna o ID do componente inserido
        return true;
    }

    public static function getTodosComponentes() {
          // Instancia a classe Database
    $db = new Database('componentes');
    
    // Consulta o banco de dados para recuperar todos os componentes cadastrados
    $componentes = $db->selectAll()->fetchAll(); // Busca os dados e transforma em array
    
    // Retorna os componentes encontrados
    return $componentes;
    }

    public function atualizar() {
        // Instancia a classe Database
        $db = new Database('automoveis_componentes');
        
        // Atualiza os componentes associados ao automóvel
        $db->update('id_automovel', $this->id_automovel, [
            'id_componente' => $this->id_componente
        ]);
    }

    public function deletar($where, $params = []) {
        // Instancia a classe Database
        $db = new Database('automoveis_componentes');
        
        // Deleta os componentes associados ao automóvel com base na condição fornecida
        $db->delete('id_automovel = ?', [$this->id_automovel]);
        
        // Agora, podemos excluir o próprio automóvel
        $db = new Database('automoveis');
        $db->delete($where, $params);
    }
    
    

  
}
