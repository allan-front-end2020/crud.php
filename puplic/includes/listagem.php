<?php
$mensagem = '';
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'success':
            $mensagem = '
            <div id="mensagem" class="alert alert-success mensagem">
            Ação realizada com sucesso
        </div>
               ';
            break;
        case 'error':
            $mensagem = '
                <div class="alert alert-danger">
                    Ação não realizada
                </div>';
            break;
    }
}

$mensagem .= '
    <script>
        setTimeout(function() {
            document.getElementById("mensagem").style.display = "none";
        }, 4000);
    </script>
';



function formatarPreco($preco) {
    return number_format($preco, 2, ',', '.');
}





$resultados = '';

foreach ($automoveis as $automovel) {

    $resultados .= '<tr>
  
     <td>' . $automovel->descricao . '</td>
     <td>' . $automovel->placa . '</td>
     <td>' . $automovel->renavam . '</td>
     <td class="text-center">' . $automovel->ano_modelo . '</td>
     <td class="text-center">' . $automovel->ano_fabricacao . '</td>
     <td>' . $automovel->cor . '</td>
    <td>' . $automovel->km . '</td>
    <td>' . $automovel->marca . '</td>
     <td>' . formatarPreco($automovel->preco) . '</td>
     <td>' . formatarPreco($automovel->preco_fipe)  . '</td>
    <td>
       <a href="editar.php?id=' . $automovel->id . '">
         <button type="button" class="btn btn-primary"> <i class="bi bi-pencil"></i></button>
       </a>
      
       <button type="button" class="btn btn-danger" onclick="exibirModalExclusao(' . $automovel->id . ', \'' . $automovel->marca . '\')"><i class="bi bi-trash"></i></button>



    </td>
    <td>
    
    
    </td>
    </tr>';
}
$resultados = strlen($resultados) ? $resultados : '
<tr>
  <td colspan="12" class="text-center"> Nenhum automóvel encontrado  !</td>
</tr>
';

$paginacao = '';
$paginas = $objPagination->getPages();

foreach ($paginas as $key => $pagina) {
    $class = $pagina['atual'] ? 'btn btn-primary' : 'btn btn-danger';
    $paginacao .= '<a href="?pagina=' . $pagina['pagina'] . '">
      <button type="button" class="btn ' . $class . '">' . $pagina['pagina'] . '</button>
    </a>';
}
?>




<main>
    <?= $mensagem ?>
    <section>
        <a href="cadastrar.php" class="btn btn-success">Cadastrar Automóvel</a>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section>
                    <form method="get">
                        <div class="row my-4">
                            <div class="col">
                                <label for="">Descrição</label>
                                <input type="text" name="buscaDescricao" class="form-control" value='<?= $buscaDescricao ?? '' ?>'>
                            </div>
                            <div class="col">
                                <label for="">Placa</label>
                                <input type="text" name="buscaPlaca" class="form-control" value='<?= $buscaPlaca ?? '' ?>'>
                            </div>
                            <div class="col">
                                <label for="">Renavam</label>
                                <input type="text" name="buscaRenavam" class="form-control" value='<?= $buscaRenavam ?? '' ?>'>
                            </div>
                            <div class="col-2">
                                <label for="">Marca</label>
                                <div class="position-relative">
                                    <select name="buscaMarca" class="form-control">
                                        <option value="" disabled selected>Selecione marca</option>
                                        <?php
                                        $marcas = array(
                                            "Chevrolet", "Ford", "Volkswagen", "Toyota", "Honda",
                                            "BMW", "Mercedes-Benz", "Audi", "Kia", "Renault",
                                            "Fiat", "Peugeot", "Citroën", "Volvo", "Mitsubishi",
                                            "Land Rover", "Jeep", "Subaru", "Jaguar", "Ferrari",
                                            "Porsche", "Lamborghini", "Bugatti", "McLaren", "Lotus",
                                            "Alfa Romeo", "Maserati", "Aston Martin", "Rolls-Royce",
                                            "Bentley"
                                        );
                                        foreach ($marcas as $marca) {
                                            $selected = ($buscaMarca == $marca) ? "selected" : "";
                                            echo "<option value=\"$marca\" $selected>$marca</option>";
                                        }
                                        ?>
                                    </select>
                                    <i class="bi bi-caret-down-fill position-absolute" style="right: 12px; top: 50%; transform: translateY(-50%);"></i>
                                </div>

                            </div>
                            <div class="col-2">
                                <label for="">Ano Modelo</label>
                                <div class="position-relative">
                                    <select name="buscaAnoModelo" class="form-control">
                                        <option value="" <?php echo empty($_POST['buscaAnoModelo']) ? 'selected' : ''; ?> disabled>Selecione ano</option>
                                        <?php
                                        for ($ano = date("Y"); $ano >= 1980; $ano--) {
                                            $selected = ($ano == $_POST['buscaAnoModelo']) ? 'selected' : '';
                                            echo "<option value=\"$ano\" $selected>$ano</option>";
                                        }
                                        ?>
                                    </select>
                                    <i class="bi bi-caret-down-fill position-absolute" style="right: 12px; top: 50%; transform: translateY(-50%);"></i>
                                </div>
                            </div>
                            <div class="col-2">
                                <label for="">Ano Fabricação</label>
                                <div class="position-relative">
                                    <select name="buscaAnoFabricacao" class="form-control">
                                        <option value="" <?php echo empty($_POST['buscaAnoFabricacao']) ? 'selected' : ''; ?> disabled>Selecione ano</option>
                                        <?php
                                        for ($ano = date("Y"); $ano >= 1980; $ano--) {
                                            $selected = ($ano == $_POST['buscaAnoFabricacao']) ? 'selected' : '';
                                            echo "<option value=\"$ano\" $selected>$ano</option>";
                                        }
                                        ?>
                                    </select>
                                    <i class="bi bi-caret-down-fill position-absolute" style="right: 12px; top: 50%; transform: translateY(-50%);"></i>
                                </div>
                            </div>


                            <div class="col">
                                <label for="">Cor</label>
                                <input type="text" name="buscaCor" class="form-control" value='<?= $buscaCor ?? '' ?>'>
                            </div>
                            <div class="col d-flex align-items-end ml-2">
                                <button type="submit" class="btn btn-primary ml-3" style="margin-right: 4px;"><i class="bi bi-search"></i></button>
                                <button type="button" onclick="limparFiltros()" style="margin-right: 5px;" class="btn btn-secondary mr-2">Limpar</button>
                                <a href="relatorio.php" class="btn btn-info mr-2" target="_blank"><i class="bi bi-printer"></i></a>
                            </div>


                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>

    <section>
        <!-- <button type="button" onclick="alterarOrdemListagem()" class="btn btn-primary">Alterar Ordem</button> -->

        <table class="table mt-5">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Placa</th>
                    <th>Renavam</th>
                    <th>Ano modelo</th>
                    <th>Ano de fabricação</th>
                    <th>Cor</th>
                    <th>Km</th>
                    <th>Marca</th>
                    <th>Preço </th>
                    <th>Preço Fipe</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?= $resultados ?>
                <h2 style="display: none;">Quantidades de registros <?= $quantidadeAuto ?? '' ?> </h2>
            </tbody>
        </table>
        <section>
            <?= $paginacao ?>
        </section>
    </section>
</main>

<script>
    function excluirAutomovel(idAutomovel) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../excluir.php',
            data: {
                id: idAutomovel

            },
            success: function(response) {
                if (response.success) {

                    window.location.href = 'index.php'; // Redireciona para index.php
                    window.location.href = 'index.php?status=success';
                } else {
                    alert(response.message); // Exibe uma mensagem de erro
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText, status);
                alert('Erro ao processar a requisição. Verifique o console para mais detalhes.');
            }
        });
    }

    function exibirModalExclusao(idAutomovel, marcaAutomovel) {
        $.confirm({
            title: 'Confirmar Exclusão',
            content: 'Tem certeza que deseja excluir o automóvel da marca: <strong>' + marcaAutomovel + '</strong>?',
            buttons: {
                confirm: {
                    text: 'Excluir',
                    btnClass: 'btn-danger',
                    action: function() {
                        excluirAutomovel(idAutomovel);
                    }
                },
                cancel: {
                    text: 'Cancelar',
                    btnClass: 'btn-secondary'
                }
            }
        });
    }



    function limparFiltros() {
        document.getElementsByName("buscaDescricao")[0].value = "";
        document.getElementsByName("buscaPlaca")[0].value = "";
        document.getElementsByName("buscaRenavam")[0].value = "";
        document.getElementsByName("buscaMarca")[0].value = "";
        document.getElementsByName("buscaAnoModelo")[0].value = "";
        document.getElementsByName("buscaAnoFabricacao")[0].value = "";
        document.getElementsByName("buscaCor")[0].value = "";
    }
</script>