 <?php




$anoInicial = intval(date("Y")); // Converte o ano atual para um valor inteiro
$anoFinal = 1980;

// Inicialize um array para armazenar os anos disponíveis
$anosDisponiveis = [];

// Gere a lista de anos
for ($ano = $anoInicial; $ano >= $anoFinal; $ano--) {
$anosDisponiveis[] = $ano;
}
?>

<main>
<section>

<h2 class="mt-3"><?= TITLE ?></h2>


<?php if (isset($mensagemErro)) : ?>
<div class="error"><?= $mensagemErro ?></div>
<?php endif; ?>


<form method="post" id='crud-auto'>
<div class="row">
    <div class="form-group col-md-4 mb-3">
        <label class="mb-2" for="descricao">Descrição</label>
        <input type="text" class="form-control" id="descricao" name="descricao" value='<?= $objAuto->descricao ?? '' ?>'>
    </div>
    <div class="form-group col-md-4 mb-3">
        <label class="mb-2" for="placa">Placa</label>
        <input type="text" class="form-control" id="placa" name="placa" value="<?= $objAuto->placa ?? '' ?>" maxlength="7">
    </div>
    <div class="form-group col-md-4 mb-3 ">
        <label class="mb-2" for="renavam"> Código RENAVAM</label>
        <input type="text" class="form-control" id="renavam" name="renavam" value='<?= $objAuto->renavam ?? '' ?>'>
    </div>
</div>

<div class="row">

<div class="form-group col-md-3 mb-3 position-relative">
    <label class="mb-2" for="ano_modelo">Ano Modelo</label>
    <div class="position-relative">
        <select class="form-control" id="anosModeloDisponiveis" name="ano_modelo">
            <option value="0" class="x" disabled selected>Selecione ano </option>
            <?php foreach ($anosDisponiveis as $ano) : ?>
                <option value="<?= $ano ?>" <?= ($ano == $objAuto->ano_modelo) ? 'selected' : '' ?>><?= $ano ?></option>
            <?php endforeach; ?>
        </select>
        <i class="bi bi-caret-down-fill" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%);"></i>
    </div>
</div>

<div class="form-group col-md-3 mb-3 position-relative">
    <label class="mb-2" for="ano_fabricacao">Ano Fabricação</label>
    <div class="position-relative">
        <select class="form-control" id="anosFabricacaoDisponiveis" name="ano_fabricacao">
            <option value="" disabled selected>Selecione ano </option>
            <?php foreach ($anosDisponiveis as $ano) : ?>
                <option value="<?= $ano ?>" <?= ($ano == $objAuto->ano_fabricacao) ? 'selected' : '' ?>><?= $ano ?></option>
            <?php endforeach; ?>
        </select>
        <i class="bi bi-caret-down-fill" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%);"></i>
    </div>
</div>


    <div class="form-group col-md-2 mb-3">
        <label class="mb-2" for="cor">Cor</label>
        <input type="text" class="form-control" id="cor" name="cor" value='<?= $objAuto->cor ?? '' ?>'>
    </div>
    <div class="form-group col-md-2 mb-3">
        <label class="mb-2" for="km">km</label>
        <input type="text" class="form-control" id="km" name="km" value='<?= $objAuto->km ?? '' ?>'>
    </div>
    <div class="form-group col-md-2 mb-3 position-relative">
        <label class="mb-2" for="marca">Marca</label>
        <select class="form-control" id="marca" name="marca" >
            <option value="" disabled selected>Selecione a marca</option>
            <option value="Chevrolet" <?= ($objAuto->marca == "Chevrolet") ? "selected" : "" ?>>Chevrolet</option>
            <option value="Ford" <?= ($objAuto->marca == "Ford") ? "selected" : "" ?>>Ford</option>
            <option value="Volkswagen" <?= ($objAuto->marca == "Volkswagen") ? "selected" : "" ?>>Volkswagen</option>
            <option value="Toyota" <?= ($objAuto->marca == "Toyota") ? "selected" : "" ?>>Toyota</option>
            <option value="Honda" <?= ($objAuto->marca == "Honda") ? "selected" : "" ?>>Honda</option>
            <option value="BMW" <?= ($objAuto->marca == "BMW") ? "selected" : "" ?>>BMW</option>
            <option value="Mercedes-Benz" <?= ($objAuto->marca == "Mercedes-Benz") ? "selected" : "" ?>>Mercedes-Benz</option>
            <option value="Audi" <?= ($objAuto->marca == "Audi") ? "selected" : "" ?>>Audi</option>
            <option value="Kia" <?= ($objAuto->marca == "Kia") ? "selected" : "" ?>>Kia</option>
            <option value="Renault" <?= ($objAuto->marca == "Renault") ? "selected" : "" ?>>Renault</option>
            <option value="Fiat" <?= ($objAuto->marca == "Fiat") ? "selected" : "" ?>>Fiat</option>
            <option value="Peugeot" <?= ($objAuto->marca == "Peugeot") ? "selected" : "" ?>>Peugeot</option>
            <option value="Citroën" <?= ($objAuto->marca == "Citroën") ? "selected" : "" ?>>Citroën</option>
            <option value="Volvo" <?= ($objAuto->marca == "Volvo") ? "selected" : "" ?>>Volvo</option>
            <option value="Mitsubishi" <?= ($objAuto->marca == "Mitsubishi") ? "selected" : "" ?>>Mitsubishi</option>
            <option value="Land Rover" <?= ($objAuto->marca == "Land Rover") ? "selected" : "" ?>>Land Rover</option>
            <option value="Jeep" <?= ($objAuto->marca == "Jeep") ? "selected" : "" ?>>Jeep</option>
            <option value="Subaru" <?= ($objAuto->marca == "Subaru") ? "selected" : "" ?>>Subaru</option>
            <option value="Jaguar" <?= ($objAuto->marca == "Jaguar") ? "selected" : "" ?>>Jaguar</option>
            <option value="Ferrari" <?= ($objAuto->marca == "Ferrari") ? "selected" : "" ?>>Ferrari</option>
            <option value="Porsche" <?= ($objAuto->marca == "Porsche") ? "selected" : "" ?>>Porsche</option>
            <option value="Lamborghini" <?= ($objAuto->marca == "Lamborghini") ? "selected" : "" ?>>Lamborghini</option>
            <option value="Bugatti" <?= ($objAuto->marca == "Bugatti") ? "selected" : "" ?>>Bugatti</option>
            <option value="McLaren" <?= ($objAuto->marca == "McLaren") ? "selected" : "" ?>>McLaren</option>
            <option value="Lotus" <?= ($objAuto->marca == "Lotus") ? "selected" : "" ?>>Lotus</option>
            <option value="Alfa Romeo" <?= ($objAuto->marca == "Alfa Romeo") ? "selected" : "" ?>>Alfa Romeo</option>
            <option value="Maserati" <?= ($objAuto->marca == "Maserati") ? "selected" : "" ?>>Maserati</option>
            <option value="Aston Martin" <?= ($objAuto->marca == "Aston Martin") ? "selected" : "" ?>>Aston Martin</option>
            <option value="Rolls-Royce" <?= ($objAuto->marca == "Rolls-Royce") ? "selected" : "" ?>>Rolls-Royce</option>
            <option value="Bentley" <?= ($objAuto->marca == "Bentley") ? "selected" : "" ?>>Bentley</option>
        </select>
        <i class="bi bi-caret-down-fill position-absolute" style="right: 21px;     top: 71%;; transform: translateY(-50%);"></i>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-4 mb-3">
        <label class="mb-2" for="preco">Preço</label> 
        <input type="text" class="form-control" id="preco" name="preco" value='<?= $objAuto->preco ?? '' ?>'>
        
    </div>
    <div class="form-group col-md-4 mb-3">
        <label class="mb-2" for="preco_fipe">Preço FIPE</label>
        <input type="text" class="form-control" id="preco_fipe" name="preco_fipe" value='<?= $objAuto->preco_fipe ?? '' ?>'>
    </div>
</div>
<hr>
<div class="row mb">
<?php

use \App\Entity\Componente;

// Obtém os componentes dinamicamente
$componentes = Componente::getTodosComponentes();

// Obtém os componentes selecionados do objeto automóvel
$componentesSelecionados = $objAuto->getComponentes();

?>

<div class="row mb-2">
    <h3 class="mb-5">Componentes adicionais</h3>
    <?php $count = 0; ?>
    <?php foreach ($componentes as $componente) : ?>
        <?php 
        $idComponente = isset($componente['id']) ? $componente['id'] : ''; 
        $nomeComponente = isset($componente['componente']) ? $componente['componente'] : '';
        ?>
        <div class="form-check col-lg-2 col-md-4 col-sm-6 <?= $count % 6 === 0 ? 'mb-4' : '' ?>">
            <input class="form-check-input" type="checkbox" id="<?= strtolower(str_replace(' ', '', $nomeComponente)) ?>" name="componentes[]" value="<?= $idComponente ?>" <?= (in_array($idComponente, $componentesSelecionados) ? 'checked' : '') ?>>
            <label class="form-check-label" for="<?= strtolower(str_replace(' ', '', $nomeComponente)) ?>"><?= $nomeComponente ?></label>
        </div>
        <?php $count++; ?>
        <?php if ($count % 6 === 0) : ?>
            </div><div class="row mb-2">
        <?php elseif ($count === count($componentes) && $count % 6 !== 0) : ?>
            </div><div class="row mb-2">
        <?php endif; ?>
    <?php endforeach; ?>
</div>






<div class="row">
    <a href="index.php" class="btn col-2 ml-2" style="border: 2px solid green; margin-right: 23px;">Cancelar</a>
    
    <button type="submit" class="btn btn-success col-2 ml-2">Cadastrar</button>
</div>

</form>
</section>
</main>