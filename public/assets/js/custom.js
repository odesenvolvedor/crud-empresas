
$(document).ready(function () {
    if ($(this).width() < 768) {
        $('#sidebar').toggleClass('hidden');
        $('.wrapper').toggleClass('sidebar-hidden');
    }
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('hidden');
        $('.wrapper').toggleClass('sidebar-hidden');
    });
    $('.navbar-toggle').on('click', function () {
        $('.navbar-collapse').toggle();
    });

    $("input[name='cnpj']").on('keyup', function () {
        $(this).val(docNumberMask($(this).val()));
    });

    $("input[name='telefone']").on('keyup', function () {
        $(this).val(phoneMask($(this).val()));
    });

    $("input[name='cep']").on('keyup', function () {
        $(this).val(cepMask($(this).val()));
    });

    $(".buscar-empresa").on('click', function () {
        $('.cnpj-em-branco').hide();
        $('.cnpj-invalido').hide();
        var cnpj = $("input[name='cnpj']").val().replace(/\D/g, "");
        
        if (! cnpj) {
            $('.cnpj-em-branco').show();
        } else if ( ! validarCnpj( cnpj ) ) {
            $('.cnpj-invalido').show();
        } else {
            buscarDadosEmpresa(cnpj);
        }

    });

    $("#ck_observacao").on('change', function() {
        $("#observacao").toggle();
    });

});

function buscarDadosEmpresa(cnpj) {
    $('#loading').toggleClass('on');
    $.ajax({
        url: 'https://www.receitaws.com.br/v1/cnpj/' + cnpj,
        contentType: 'application/json',
        cache: false,
        crossDomain: true,
        dataType: 'JSONP',
        timeout: 9000,
        success: function(data) {
            $('#loading').toggleClass('on');
            if (data.message) {
                $('.cnpj-invalido').show();
                return;
            }

            $("input[name='razao_social']").val(data.nome);
            $("input[name='nome_fantasia']").val(data.fantasia);
            $("input[name='telefone']").val(data.telefone);
            $("input[name='cep']").val(cepMask(data.cep));
            $("input[name='logradouro']").val(data.logradouro);
            $("input[name='numero']").val(data.numero);
            $("input[name='bairro']").val(data.bairro);
            $("input[name='cidade']").val(data.municipio);
            var $estado = $("#sigla_estado");
            $estado.val(data.uf).change().selectpicker('refresh');

            $.get(baseUrl + '/cnae/search/' + cnaeMask(data.atividade_principal[0].code), function(data) {
                data = JSON.parse(data);
                if (data[0].id_cnae) {
                    var $select = $('#id_cnae');
                    $select.val(data[0].id_cnae).change().selectpicker('refresh');;
                }
            });
        },
        error: function(data) {
            console.log(data);
            $('.cnpj-invalido').show();
            $('#loading').toggleClass('on');
        }
    });
}
function docNumberMask(v, docType = 'cnpj') {
    v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
    //let docType = v.length > 11 ? "cnpj" : "cpf";
    if (docType && docType.toLowerCase() == "cpf") {
        v = v.substring(0, 11); // Limita o tamanho
        //Coloca um ponto entre o terceiro e o quarto dígitos
        v = v.replace(/(\d{3})(\d)/, "$1.$2");
        //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
        v = v.replace(/(\d{3})(\d)/, "$1.$2");
        //Coloca um hífen entre o terceiro e o quarto dígitos
        v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    }
    if (docType && docType.toLowerCase() == "cnpj") {
        v = v.substring(0, 14); // Limita o tamanho
        //Coloca ponto entre o segundo e o terceiro dígitos
        v = v.replace(/^(\d{2})(\d)/, "$1.$2");
        //Coloca ponto entre o quinto e o sexto dígitos
        v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
        //Coloca uma barra entre o oitavo e o nono dígitos
        v = v.replace(/\.(\d{3})(\d)/, ".$1/$2");
        //Coloca um hífen depois do bloco de quatro dígitos
        v = v.replace(/(\d{4})(\d)/, "$1-$2");
    }
    return v;
};

function phoneMask(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/^0/, "");
    if (v.length > 10) {
        v = v.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
    } else if (v.length > 6) {
        v = v.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
    } else if (v.length > 2) {
        v = v.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
    } else {
        v = v.replace(/^(\d*)/, "($1");
    }
    return v;
}

function cepMask(v) {
    v = v.replace(/\D/g, "");
    if (v.length > 5) {
        v = v.replace(/^(\d{5})(\d{1,3}).*/, "$1-$2");
    }
    return v;
}

function cnaeMask(v) {
    v = v.replace(/\D/g, "");
    if (v.length > 5) {
        v = v.replace(/^(\d{4})(\d{1})(\d{2}).*/, "$1-$2/$3");
    } else if (v.length > 4) {
        v = v.replace(/^(\d{4})(\d{1}).*/, "$1-$2");
    }
    return v;
}

function validarCnpj(cnpj) {
	cnpj = cnpj.replace(/[^\d]+/g, '')

	// Valida a quantidade de caracteres
	if (cnpj.length !== 14)
		return false

	// Elimina inválidos com todos os caracteres iguais
	if (/^(\d)\1+$/.test(cnpj))
		return false

	// Cáculo de validação
	let t = cnpj.length - 2,
		d = cnpj.substring(t),
		d1 = parseInt(d.charAt(0)),
		d2 = parseInt(d.charAt(1)),
		calc = x => {
			let n = cnpj.substring(0, x),
				y = x - 7,
				s = 0,
				r = 0

				for (let i = x; i >= 1; i--) {
					s += n.charAt(x - i) * y--;
					if (y < 2)
						y = 9
				}

				r = 11 - s % 11
				return r > 9 ? 0 : r
		}

	return calc(t) === d1 && calc(t + 1) === d2
}