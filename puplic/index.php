<?php
require __DIR__ . '/vendor/autoload.php';




use App\Entity\Automovel;
use App\Db\Pagination;

// Filtro por descrição
;$buscaDescricao = filter_input(INPUT_GET, 'buscaDescricao');

// Filtro por placa
$buscaPlaca = filter_input(INPUT_GET, 'buscaPlaca');

// Filtro por renavam
$buscaRenavam = filter_input(INPUT_GET, 'buscaRenavam');

// Filtro por marca
$buscaMarca = filter_input(INPUT_GET, 'buscaMarca');

// Filtro por ano de modelo
$buscaAnoModelo = filter_input(INPUT_GET, 'buscaAnoModelo');

// Filtro por ano de fabricação
$buscaAnoFabricacao = filter_input(INPUT_GET, 'buscaAnoFabricacao');

// Filtro por cor
$buscaCor = filter_input(INPUT_GET, 'buscaCor');

// Condições para a busca
$condicoes = [];

if (!empty($buscaAnoModelo)) {
    $condicoes[] = 'ano_modelo = ' . $buscaAnoModelo;
}

if (!empty($buscaAnoFabricacao)) {
    $condicoes[] = 'ano_fabricacao = ' . $buscaAnoFabricacao;
}


if (!empty($buscaDescricao)) {
    $condicoes[] = 'descricao LIKE "%' . str_replace(' ', '%', $buscaDescricao) . '%"';
}

if (!empty($buscaPlaca)) {
    $condicoes[] = 'placa LIKE "%' . $buscaPlaca . '%"';
}

if (!empty($buscaRenavam)) {
    $condicoes[] = 'renavam LIKE "%' . $buscaRenavam . '%"';
}

if (!empty($buscaMarca)) {
    $condicoes[] = 'marca LIKE "%' . $buscaMarca . '%"';
}

if (!empty($buscaAnoModelo)) {
    $condicoes[] = 'ano_modelo LIKE "%' . $buscaAnoModelo . '%"';
}

if (!empty($buscaAnoFabricacao)) {
    $condicoes[] = 'ano_fabricacao LIKE "%' . $buscaAnoFabricacao . '%"';
}

if (!empty($buscaCor)) {
    $condicoes[] = 'cor LIKE "%' . $buscaCor . '%"';
}

// Junta as condições com "AND"
$where = implode(' AND ', $condicoes);

$quantidadeAuto = Automovel::getQuantidadeAuto($where);

$objPagination = new Pagination($quantidadeAuto, $_GET['pagina'] ?? 1, 5);


$automoveis = Automovel::getVagas($where, null, $objPagination->getLimit());




include './includes/header.php';
include './includes/listagem.php';
include './includes/footer.php';
