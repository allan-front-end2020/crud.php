<?php
use \App\Entity\Automovel;

require __DIR__ . '/vendor/autoload.php';


if (isset($_POST['id'])) {
$idAutomovel = $_POST['id'];
// $objAuto = Automovel::getAutomovel($idAutomovel);
$automovel = new Automovel();
$dadosAutomoveis = $automovel->getAutomovel($idAutomovel);


if ($dadosAutomoveis) {
    if ($automovel->excluir($dadosAutomoveis->id)) {
        $response = [
            'success' => true,
            'message' => 'O automóvel com o ID ' . $dadosAutomoveis->id . ' foi excluído com sucesso.'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Falha ao excluir o automóvel com o ID ' . $dadosAutomoveis->id . '.'
        ];
    }
} else {
    $response = [
        'success' => false,
        'message' => 'O automóvel com o ID ' . $dadosAutomoveis->id . ' não foi encontrado.'
    ];
}
header('Content-Type: application/json');
echo json_encode($response);
    exit(); 
}

