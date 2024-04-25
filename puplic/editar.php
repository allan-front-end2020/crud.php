<?php
require __DIR__ . '/vendor/autoload.php';

define('TITLE', 'Editar automóvel');

use \App\Entity\Automovel;

if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?status=error');
    exit;
} 

$objAuto = Automovel::getAutomovel($_GET['id']);

if(!$objAuto instanceof Automovel){
   header('Location: index.php?status=error');
   exit;
}

$descricaoOriginal = $objAuto->descricao;

$mensagemErro = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $objAuto->descricao = $_POST['descricao'];
    $objAuto->ano_modelo = $_POST['ano_modelo'];
    $objAuto->ano_fabricacao = $_POST['ano_fabricacao'];
    $objAuto->cor = $_POST['cor'];
    $objAuto->km = $_POST['km'];
    $objAuto->marca = $_POST['marca'];
    $objAuto->preco = $_POST['preco']; 
    $objAuto->preco_fipe = $_POST['preco_fipe']; 


    if ($objAuto->placa !== $_POST['placa'] || $objAuto->renavam !== $_POST['renavam']) {
        $placa = htmlspecialchars($_POST['placa']);
        $renavam = htmlspecialchars($_POST['renavam']);
        $duplicidade = Automovel::verificarExistenciaPorPlacaRenavam($placa, $renavam);

        if ($duplicidade) {
            $mensagemErro = '<div id="alert" class="alert alert-danger">';
            if ($duplicidade->tipo === 'ambos') {
                $mensagemErro .= 'A placa <strong>' . $placa . '</strong> e o Renavam <strong>' . $renavam . '</strong> já estão cadastrados para o automóvel com a descrição <strong> ' . $duplicidade->descricao . '</strong>!';
            } elseif ($duplicidade->tipo === 'placa') {
                $mensagemErro .= 'A placa <strong>' . $placa . '</strong> já está cadastrada para o automóvel com a descrição <strong> ' . $duplicidade->descricao . '</strong>!';
            } elseif ($duplicidade->tipo === 'renavam') {
                $mensagemErro .= 'O Renavam <strong>' . $renavam . '</strong> já está cadastrado para o automóvel com a descrição <strong> ' . $duplicidade->descricao . '</strong>!';
            }
            $mensagemErro .= '</div>';
            $mensagemErro .= '<script>
                                setTimeout(function() {
                                    var alertDiv = document.getElementById("alert");
                                    alertDiv.style.display = "none";
                                }, 8000);
                            </script>';
        } else {
           
            $objAuto->placa = $_POST['placa'];
            $objAuto->renavam = $_POST['renavam'];
            $objAuto->atualizar();          
            header('location:index.php?status=success');
            exit;
        }
    } else {
        $objAuto->atualizar();          
        header('location:index.php?status=success');
        exit;
    }
}

include './includes/header.php';
include './includes/formulario.php';
include './includes/footer.php';
?>
