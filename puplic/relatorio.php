<?php
require __DIR__ . '/vendor/autoload.php';

use \App\Entity\Automovel;

// Buscar todos os automóveis cadastrados
$automoveis = Automovel::getVagas();

include './includes/header.php';
?>



<div class="container mt-4">
    <div class="relatorio">
        <h2> Relatório de Automóveis </h2>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Descrição</th>
                <th scope="col">Placa</th>
                <th scope="col">Renavam</th>
                <th scope="col">Ano Modelo</th>
                <th scope="col">Ano Fabricação</th>
                <th scope="col">Cor</th>
                <th scope="col">KM</th>
                <th scope="col">Marca</th>
                <th scope="col">Preço</th>
                <th scope="col">Preço FIPE</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($automoveis as $automovel) : ?>
                <tr>
                    <td><?= $automovel->id ?></td>
                    <td><?= $automovel->descricao ?></td>
                    <td><?= $automovel->placa ?></td>
                    <td><?= $automovel->renavam ?></td>
                    <td><?= $automovel->ano_modelo ?></td>
                    <td><?= $automovel->ano_fabricacao ?></td>
                    <td><?= $automovel->cor ?></td>
                    <td><?= $automovel->km ?></td>
                    <td><?= $automovel->marca ?></td>
                    <td><?= $automovel->preco ?></td>
                    <td><?= $automovel->preco_fipe ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include './includes/footer.php'; ?>
