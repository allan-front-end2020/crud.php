<?php

namespace App\Entity;

use App\Db\Database;
use App\Entity\Componente;


use \PDO;

class Automovel {

    public $id;
    public $descricao;
    public $placa;
    public $renavam;
    public $ano_modelo;
    public $ano_fabricacao;
    public $cor;
    public $km;
    public $marca;
    public $preco;
    public $preco_fipe;
    public $componentes;

    public function __construct() {
        $this->componentes = []; // Inicialize o array de componentes
    }


    public function cadastrar($componente) {

        // Instancia a classe Database
        $db = new Database('automoveis');

        // Insere os dados na tabela
        //query
        $this->id = $db->insert([
            'descricao' => $this->descricao,
            'placa' => $this->placa,
            'renavam' => $this->renavam,
            'ano_modelo' => $this->ano_modelo,
            'ano_fabricacao' => $this->ano_fabricacao,
            'cor' => $this->cor,
            'km' => $this->km,
            'marca' => $this->marca,
            'preco' => $this->preco,
            'preco_fipe' => $this->preco_fipe
        ]);

        $componentesAuto = new Componente();
        foreach ($componente as $componentes) {
            $componentesAuto->id_automovel = $this->id;
            $componentesAuto->id_componente = $componentes;
            $componentesAuto->cadastrar();
        }


        return true;
    }
   

    public static function getAnosFabricacaoDisponiveis() {
        return (new Database('automoveis'))->select()->distinct('ano_fabricacao')->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function getModelosDisponiveis() {
        return (new Database('automoveis'))->select()->distinct('ano_modelo')->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function getVagas($where = null, $order = null, $limit = null,) {
        return (new Database('automoveis'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getQuantidadeAuto($where = null) {
        return (new Database('automoveis'))->select($where, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;
    }
    public static function getAutomovel($id) {
        return (new Database('automoveis'))->select('id = ' . $id)->fetchObject(self::class);
    }

    public  function atualizar() {
        return (new Database('automoveis'))->update('id = ' . $this->id, [
            'descricao' => $this->descricao,
            'placa' => $this->placa,
            'renavam' => $this->renavam,
            'ano_modelo' => $this->ano_modelo,
            'ano_fabricacao' => $this->ano_fabricacao,
            'cor' => $this->cor,
            'km' => $this->km,
            'marca' => $this->marca,
            'preco' => $this->preco,
            'preco_fipe' => $this->preco_fipe
        ]);
    }

    public function excluir($id) {
        // Exclui os componentes associados a este automóvel
        $dbComponents = new Database('automoveis_componentes');
        $dbComponents->delete('id_automovel = ' . $id);
        
        // Em seguida, exclui o automóvel
        $dbAutomovel = new Database('automoveis');
        return $dbAutomovel->delete('id = ' . $id);
    }

    public static function verificarExistenciaPorPlacaRenavam($placa, $renavam) {
        $db = new Database('automoveis');
        
        $sql = "SELECT placa, renavam, descricao FROM automoveis WHERE placa = :placa OR renavam = :renavam";
        $params = [':placa' => $placa, ':renavam' => $renavam];
        $resultado = $db->execute($sql, $params)->fetch(PDO::FETCH_OBJ);
        
        if ($resultado) {
            if ($resultado->placa === $placa && $resultado->renavam === $renavam) {
                return (object) [
                    'placa' => $resultado->placa,
                    'renavam' => $resultado->renavam,
                    'descricao' => $resultado->descricao, // Incluir a propriedade 'marca'
                    'tipo' => 'ambos',
                    'valor' => 'Placa e Renavam'
                ];
            } elseif ($resultado->placa === $placa) {
                return (object) [
                    'placa' => $resultado->placa,
                    'descricao' => $resultado->descricao, // Incluir a propriedade 'marca'
                    'tipo' => 'placa',
                    'valor' => 'Placa'
                ];
            } else {
                return (object) [
                    'renavam' => $resultado->renavam,
                    'descricao' => $resultado->descricao, // Incluir a propriedade 'marca'
                    'tipo' => 'renavam',
                    'valor' => 'Renavam'
                ];
            }
        }
    
        return null;
    }
    

    public function associarComponentes($componentes) {
        // Verifica se há componentes a serem associados
        if (!empty($componentes)) {
            // Instancia a classe Database
            $db = new Database('componentes');

            // Insere os dados na tabela de relação
            foreach ($componentes as $componente) {
                $db->insert([
                    'id_automovel' => $this->id,
                    'id_componente' => $componente->id // Supondo que cada componente tenha um ID
                ]);
            }

            return true;
        }

        return false;
    }

    public  function getComponentes() {
        if ($this->id) {
            // Se o ID do automóvel estiver definido, recupere os componentes associados
            $db = new Database('automoveis_componentes');
            $componentes = $db->select('id_automovel = ' . $this->id)->fetchAll(PDO::FETCH_ASSOC);
            

            // Adicione os componentes ao array de componentes do automóvel
            foreach ($componentes as $componente) {
                $this->componentes[] = $componente['id_componente'];
            }
        }

        return $this->componentes;
    }

    public function atualizarComponentes($novosComponentes) {
        // Limpa os componentes existentes associados a este automóvel
        $db = new Database('automoveis_componentes');
        $db->delete('id_automovel = ' . $this->id);
    
        // Associa os novos componentes fornecidos
        foreach ($novosComponentes as $componente) {
            $db->insert([
                'id_automovel' => $this->id,
                'id_componente' => $componente
            ]);
        }
    
        // Atualiza a lista de componentes associados na instância do objeto
        $this->componentes = $novosComponentes;
    
        return true;
    }

   
    
    
    

}
