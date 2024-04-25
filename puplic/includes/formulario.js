$(document).ready(function () {
    $('#crud-auto').validate({
        rules: {
            descricao: {
                required: true
            },
            placa: {
                required: true,
                minlength: 7,
            },
            renavam: {
                required: true,
                minlength: 10,
            },
            ano_modelo: {
                required: true,
                maxlength: 4,

            },
            ano_fabricacao: {
                required: true,
                maxlength: 4,
            },
            km: {
                required: true
            },
            cor: {
                required: true
            },
            marca: {
                required: true
            },
            preco: {
                required: true
            },
            preco_fipe: {
                required: true
            }
        },
        messages: {
            descricao: {
                required: "<span class='error-text'>Campo obrigatório</span>"
            },
            placa: {
                required: "<span class='error-text'>Campo obrigatório</span>",
                minlength: "<span class='error-text'>Mínimo de 7 caracteres</span>",
            },
            renavam: {
                required: "<span class='error-text'>Campo obrigatório</span>",
                minlength: "<span class='error-text'>Mínimo de 11 caracteres</span>",
            },
            ano_modelo: {
                required: "<span class='error-text'>Campo obrigatório</span>",
                maxlength: "<span class='error-text'>Por favor, insira um ano válido</span>",
                max: "<span class='error-text'>O ano não pode ser maior que o ano atual</span>"
            },
            ano_fabricacao: {
                required: "<span class='error-text'>Campo obrigatório</span>",
                maxlength: "<span class='error-text'>Por favor, insira um ano válido</span>",
                max: "<span class='error-text'>O ano não pode ser maior que o ano atual</span>"
            },
            km: {
                required: "<span class='error-text'>Campo obrigatório</span>"
            },
            marca: {
                required: "<span class='error-text'>Campo obrigatório</span>"
            },
            cor: {
                required: "<span class='error-text'>Campo obrigatório</span>"
            },
            preco: {
                required: "<span class='error-text'>Campo obrigatório</span>"
            },
            preco_fipe: {
                required: "<span class='error-text'>Campo obrigatório</span>"
            }
        },
        
   
    });
    
    $('#km').mask('0#0.000', { reverse: true });
    $('#preco').mask('000.000,00', { reverse: true });
    $('#preco_fipe').mask('000.000,00', { reverse: true });
    
    
    $('#renavam').mask('0000000000', {
        'translation': {
            S: { pattern: /[A-Za-z0-9]/ } // Aceita letras e números
        }
    });
    // Remover vírgulas antes de enviar ao banco de dados
$('#crud-auto').submit(function() {
    var preco = $('#preco').val();
    var precoFipe = $('#preco_fipe').val();
    
    // Remover vírgulas
    preco = preco.replace(/\./g, '').replace(',', '.');
    precoFipe = precoFipe.replace(/\./g, '').replace(',', '.');
    
    // Atualizar os valores nos campos
    $('#preco').val(preco);
    $('#preco_fipe').val(precoFipe);
});
});
