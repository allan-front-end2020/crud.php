<?php
require __DIR__ . '/vendor/autoload.php';

define('TITLE', 'Dados cadastrais');

use \App\Entity\Automovel;

$objAuto = new Automovel;

// Variável para armazenar a mensagem
$mensagem = '';

// Definindo $duplicidade inicialmente como false
$duplicidade = false;

// VALIDAÇÃO DO POST
if (
    isset($_POST['descricao'], $_POST['placa'], $_POST['renavam'], $_POST['ano_modelo'], $_POST['ano_fabricacao'], $_POST['cor'], $_POST['km'], $_POST['marca'], $_POST['preco'], $_POST['preco_fipe'])
) {

    $placa = htmlspecialchars($_POST['placa']);
    $renavam = htmlspecialchars($_POST['renavam']);

    $duplicidade = Automovel::verificarExistenciaPorPlacaRenavam($placa, $renavam);
    if ($duplicidade) {
        $mensagem .= '<div class="alert alert-danger">';
        if ($duplicidade->tipo === 'ambos') {
            $mensagem .= 'Veículo com a placa <strong>' . $placa . '</strong> e renavam <strong>' . $renavam . '</strong> já estão cadastrados para o automóvel marca <strong>' . $duplicidade->descricao . '</strong>!';
        } else {
            if ($duplicidade->tipo === 'placa') {
                $mensagem .= 'Veículo com a placa <strong>' . $placa . '</strong> já está cadastrado com a descrição <strong> ' . $duplicidade->descricao . '</strong>!';
            } else {
                $mensagem .= 'Veículo com o renavam <strong>' . $renavam . '</strong> já está cadastrado com a descrição <strong> ' . $duplicidade->descricao . '</strong>!';
            }
        }
        $mensagem .= '</div>';
       
        $mensagem .= '
            <script>
                setTimeout(function() {
                    document.querySelector(".alert.alert-danger").style.display = "none";
                }, 4000);
            </script>
        ';
    
    
    } else {

        $objAuto->descricao = $_POST['descricao'];
        $objAuto->placa = $placa;
        $objAuto->renavam = $renavam;
        $objAuto->ano_modelo = $_POST['ano_modelo'];
        $objAuto->ano_fabricacao = $_POST['ano_fabricacao'];
        $objAuto->cor = $_POST['cor'];
        $objAuto->km = $_POST['km'];
        $objAuto->marca = $_POST['marca'];
        $objAuto->preco = $_POST['preco'];
        $objAuto->preco_fipe = $_POST['preco_fipe'];

        // Pegando os componentes do carro selecionados
        $componentes = isset($_POST['componentes']) ? $_POST['componentes'] : [];
        $objAuto->cadastrar($componentes);
        
        // Redirecionar após o sucesso
        header('Location:index.php?status=success');
        exit;
    }
}

include './includes/header.php';
?>


  
        <?php if ($duplicidade) : ?>
            <?= $mensagem; // Exibe a mensagem apenas se houver duplicidade ?>
        <?php endif; ?>
        <?php if (isset($mensagemErro)) : ?>
            <div class="error"><?= $mensagemErro ?></div>
        <?php endif; ?>

        <form method="post" id="crud-auto" style="margin-top: 20px;">
        <?php include './includes/formulario.php'; ?>
        </form>


<?php include './includes/footer.php'; ?>
