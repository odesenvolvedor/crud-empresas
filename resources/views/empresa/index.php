<?php 
$route = "lista"
?>

<h3>Lista de Empresas</h3>

<div class="row">
    <div class="col-md-12 mt-sm-3 ">
        <a aria-controls="collapseFilters" class="btn btn-info mb-3" data-target="#collapseFilters" data-toggle="collapse" href="#" id="open-filter-link" role="button">
            <span class="fa fa-filter mr-xs"></span>
            Filtros
        </a>
        <div class="collapse" id="collapseFilters" style="">
            <div class="well">
                <h5>
                    <strong>Filtrar resultados</strong>
                    <div class="close-well">
                        <a aria-controls="collapseFilters" 
                           aria-expanded="true" 
                           data-target="#collapseFilters" 
                           data-toggle="collapse" 
                           href="#" role="button" 
                           class="">
                            <i class="fa fa-close"></i>
                        </a>
                    </div>
                    <button class="btn btn-inverse no-border btn-xs btn-inline m-btn mb-sm btn-disabled-hidden float-right clean-filter" 
                            type="button"
                            onclick="limparFiltros()">Limpar filtros</button>
                </h5>

                <div class="row filterbox">
                    <div class="col-md-9 col-sm-8 filterbox-info ng-star-inserted">
                        Nenhum filtro selecionado
                    </div>
                    <div class="col-md-9 col-sm-8" id="filtros">
                        
                    </div>
                    <div class="col-md-3 col-sm-4 approach-buttons">
                        <div class="btn-group btn-group-sm">
                            <label id="and" class="btn btn-gray active" aria-pressed="true" onclick="alteraAbordagem('and', this)">
                                Abordagem E
                            </label>
                            <label id="or" class="btn btn-gray" aria-pressed="false" onclick="alteraAbordagem('or', this)">
                                Abordagem OU
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row" id="filters">

                    <div class="form-group col-lg-3 col-md-4 col-12" id="filters-first">
                        <label class="form-label filter-select-label" for="campo-filtro"><strong>1.</strong> Campo</label>
                        <select class="form-control custom-select input-lg " id="campo-filtro" name="campo_filtro">
                            <option hidden="" value="">Selecione...</option>
                            <option value="cnpj">CNPJ</option>
                            <option value="razao_social">Razão Social</option>
                            <option value="telefone">Telefone</option>
                            <option value="situacao">Situação</option>
                        </select>
                    </div>

                    <div class="form-group col-lg-3 col-md-4 col-12" id="div-operacao-filtro">
                        <label class="form-label filter-select-label" for="operacao-filtro"><strong>2.</strong> Operação</label>
                        <select class="form-control custom-select input-lg " id="operacao-filtro" name="operacao_filtro">
                            <option hidden="" value="">Selecione...</option>
                            <option value="=">igual a</option>
                            <option value="like">semelhante a</option>
                            <option value="not">diferente de</option>
                            <option value="st">menor que</option>
                            <option value="max">menor ou igual a</option>
                            <option value="gt">maior que</option>
                            <option value="min">maior ou igual a</option>
                            <option value="in">dentro da lista</option>
                        </select>
                    </div>


                    <div class="form-group col-lg-3 col-md-4 col-12" id="div-valor-filtro">
                        <label class="form-label filter-select-label" for="third-filter-input"><strong>3.</strong> Valor</label>
                        <input class="form-control input-lg third-filter-input" id="valor-filtro" name="valor_filtro" disabled="" type="text" placeholder="Selecione um campo">
                    </div>

                    <div class="form-group col-lg-3 col-md-4 col-12" id="div-filtro-situacao" style="display: none">
                        <label id="lb-filtro-ativo" class="form-check-label" for="filtro-ativo">
                            <input class="form-check-input filtro-situacao" type="checkbox" id="filtro-ativo" value="1" />
                            <span class="form-check-label--faux"></span>
                            Ativa
                        </label>

                        <label id="lb-filtro-inativo" class="form-check-label" for="filtro-inativo">
                            <input class="form-check-input filtro-situacao" type="checkbox" id="filtro-inativo" value="0" />
                            <span class="form-check-label--faux"></span>
                            Inativa
                        </label>

                    </div>
                    <div class="form-group col-lg-3 col-md-12 add-clean-actions" id="filters-actions">

                        <button class="btn btn-sm mt-xs ml-xs" id="filter-add" onclick="adicionarFiltro()" disabled="">
                            <span class="fa fa-plus mr-xs"></span>
                            <span id="default-filter-add-filter">Adicionar</span>
                        </button>

                        <button class="btn btn-sm mt-xs ml-xs" id="filter-reset" onclick="resetarFiltros()" disabled="">
                            <span class="fa fa-eraser mr-xs"></span>
                            <span id="default-filter-reset-filter-form">Limpar</span>
                        </button>
                    </div>
                </div>

                <div class="spacer"></div>

                <div class="row">

                    <div class="col-sm-12">
                        <div class="float-right">
                            <button class="btn btn-success btn-inline m-btn mb-sm ml-xs float-right" onclick="executarFiltro()">
                                Filtrar resultado
                            </button>
                            <button aria-controls="collapseFilters" aria-expanded="true" class="btn btn-default btn-inline m-btn mb-sm ml-xs float-right" data-target="#collapseFilters" data-toggle="collapse" type="button">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered custab">
                <thead>
                    <tr>
                        <th>CNPJ</th>
                        <th>Razao Social</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <?php
                if (empty($empresas)) {
                    echo 
                    '<tr>
                        <td colspan="4">
                            <h4 class="text-danger">Nenhum registro encontrado</h4>
                        </td>
                    </tr>';
                } else {
                    foreach ($empresas as $empresa)
                    {
                        
                        echo '<tr' . (!$empresa['situacao'] ? ' class="inativa">' : '>');
                        echo "<td>" . formatarCnpj($empresa['cnpj']) . "</td>";
                        echo "<td>" . $empresa['razao_social'] . "</td>";
                        echo "<td>" . formatarTelefone($empresa['telefone']) . "</td>";
                        echo '<td>
                                <a href="javascript:void(0)" class="text-primary" onclick="editar(' . $empresa['id'] . ')"><i class="fa fa-pencil"></i></a>
                                <a href="javascript:void(0)" class="text-danger ml-2" onclick="excluir(' . $empresa['id'] . ')"><i class="fa fa-trash"></i></a>
                             </td>';
                        echo "</tr>";
                        
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>

<script>
    var   filtros           = [];
    var   arrFiltroSituacao = [];
    const campoFiltro       = $("#campo-filtro");
    const opFiltro          = $("#operacao-filtro");
    const valFiltro         = $("#valor-filtro");
    const btnAdFiltro       = $("#filter-add");
    const btnLpFiltro       = $("#filter-reset");
    const filtroSituacao    = $(".filtro-situacao");
    const divOperacaoFiltro = $("#div-operacao-filtro");
    const divValorFiltro    = $("#div-valor-filtro");
    const divFiltroSituacao = $("#div-filtro-situacao");
    var   abordagem         = 'and';

    /** Ações no Carregamento **/
    $(function () {
        divOperacaoFiltro.css('transition', 'normal');

        campoFiltro.on('change', () => {
            arrFiltroSituacao = filtroSituacao.map(function(){
                if (this.checked) return this.value;
            }).get();

            valFiltro.attr('disabled', !(campoFiltro.val() && opFiltro.val()) );
            btnLpFiltro.attr('disabled', !(campoFiltro.val() || opFiltro.val() || valFiltro.val() || (campoFiltro.val() == 'situacao' && arrFiltroSituacao.length)) );
            btnAdFiltro.attr('disabled', !(campoFiltro.val() == 'situacao' && arrFiltroSituacao.length) );

            if (campoFiltro.val() == 'situacao') {
                divFiltroSituacao.show()
                divValorFiltro.hide();
                divOperacaoFiltro.css('visibility', 'hidden');
            } else {
                divFiltroSituacao.hide()
                divValorFiltro.show();
                divOperacaoFiltro.css('visibility', 'visible');
            }
        })

        opFiltro.on('change', () => {
            valFiltro.attr('disabled', !(campoFiltro.val() && opFiltro.val()));
            btnLpFiltro.attr('disabled', !(campoFiltro.val() || opFiltro.val() || valFiltro.val()));
        })

        valFiltro.on('keyup', () => {
            btnAdFiltro.attr('disabled', !(campoFiltro.val() && opFiltro.val() && valFiltro.val()));
            btnLpFiltro.attr('disabled', !(campoFiltro.val() || opFiltro.val() || valFiltro.val()));
        })

        filtroSituacao.on('change', (e) => {
            arrFiltroSituacao = filtroSituacao.map(function(){
                if (this.checked) return this.value;
            }).get();
            btnLpFiltro.attr('disabled', !(campoFiltro.val() || opFiltro.val() || valFiltro.val() || (campoFiltro.val() == 'situacao' && arrFiltroSituacao.length)) );
            btnAdFiltro.attr('disabled', !(campoFiltro.val() == 'situacao' && arrFiltroSituacao.length) );
        })
    });

    function listarFiltros() {
        console.log(filtros);
        const eFiltros = $("#filtros");
        eFiltros.html('');
        !filtros.length ? $('.filterbox-info').show() : $('.filterbox-info').hide();
        filtros.forEach( (e, i) => {
            console.log(e, i);
            const html = `<span class="filterbox-labels animated bounceIn">
                <span>${e.texto}</span>
                <button aria-hidden="true" class="close close-tag ml-2" id="remove-filter-tag" type="button" onclick="removerFiltro(${i})">×</button>
            </span>`
            eFiltros.append(html);
        });

    }

    function editar(id) {
        window.location.href = '<?=BASE_URL?>' + "/empresa/editar/" + id;
    };

    function excluir(id) {
        if (window.confirm("Você realmente quer exlcuir?"))
            window.location.href = '<?=BASE_URL?>' + "/empresa/excluir/" + id;
    };

    function adicionarFiltro(){

        const cft = campoFiltro.find(":selected").text();
        let   opf = opFiltro.find(":selected").text();
        let   op  = opFiltro.val();
        let   vf  = valFiltro.val();
        let   txt = cft;

        if (campoFiltro.val() == 'situacao') {
            txt += (arrFiltroSituacao.length == 2 ? `: Ativas e Inativas` : (arrFiltroSituacao[0] == 1 ? ': Ativas' : ": Inativas"));
            op = 'in';
            vf  = arrFiltroSituacao
        } else {
            txt += ` ${opf} ${vf}`;
        }

        const filtro = {
            campo: campoFiltro.val(),
            texto: txt,
            op   : op,
            valor: vf
        }

        let index = filtros.findIndex(val => val.campo == campoFiltro.val());

        if(index < 0) { 
            filtros.push(filtro);
        } else {
            if (abordagem == 'or') {
                filtros[index].texto += ` ou ${filtro.texto}`;
                filtros[index].valor += `,${filtro.valor}`;
            } else {
                filtros[index] = filtro;
            }
        }


        listarFiltros();
    }

    function removerFiltro(i){
        filtros.splice(i, 1);
        listarFiltros();
    }

    function resetarFiltros() {
        campoFiltro.val('');
        opFiltro.val('');
        valFiltro.val('');
        btnLpFiltros.attr('disabled', true);
    }

    function limparFiltros() {
        filtros = [];
        listarFiltros();
    }

    function alteraAbordagem(a, e) {
        abordagem = a;
        $(e).addClass('active');
        abordagem == 'and' ? $('#or').removeClass('active') : $('#and').removeClass('active');
    }

    function executarFiltro() {
        let filtrar = '';

        filtros.forEach( (filtro, i) => {
            if (i == 0) {
                filtrar += `?${filtro.campo}${(filtro.op == '=' ? '=' : '-'+ filtro.op + '=')}${filtro.valor}`;
            } else {
                filtrar += `&${filtro.campo}${(filtro.op == '=' ? '=' : '-'+ filtro.op + '=')}${filtro.valor}`;
            }
        })

        baseUrl = window.location.href.split('?');

        if (filtrar) {
            window.location.href = baseUrl[0] + filtrar + `&approach=${abordagem}`;
        } else {
            window.location.href = baseUrl[0]
        }
    }
</script>