<?php
$route = "manter"
?>
<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="form-empresa">
            <form method='post' action=''>
                <div class="row">
                    <div class="col-md-12">
                        <h5>Identificação</h5>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cnpj"><span class="text-danger">*</span> CNPJ</label>
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control <?=error('cnpj') ? 'has-error' : ''?>"
                                    id="cnpj"
                                    placeholder="Insira o CNPJ"
                                    name="cnpj"
                                    value ="<?=formatarCnpj(isset($empresa["cnpj"]) ? $empresa["cnpj"] : old('cnpj'))?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary buscar-empresa" type="button"><i class="fa fa-search"></i></button>
                                    </div>
                            </div>
                            <p class="text-danger cnpj-invalido" style="display: none">Dados não encontrados</p>
                            <p class="text-danger cnpj-em-branco" style="display: none">Por favor, primeiro insira um CNPJ</p>
                            <?php if (error('cnpj')) {?>
                                <p class="text-danger"><?=error('cnpj')?></p>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title"><span class="text-danger">*</span> Razão Social</label>
                            <input
                                type="text"
                                class="form-control <?=error('razao_social') ? 'has-error' : ''?>"
                                id="razao_social"
                                placeholder="Insira a Razão Social"
                                name="razao_social"
                                value ="<?=isset($empresa["razao_social"]) ? $empresa["razao_social"] : old('razao_social')?>">
                            <?php if (error('razao_social')) {?>
                                <p class="text-danger"><?=error('razao_social')?></p>
                            <?php }?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title"><span class="text-danger">*</span> Nome Fantasia</label>
                            <input
                                type="text"
                                class="form-control <?=error('nome_fantasia') ? 'has-error' : ''?>"
                                id="nome_fantasia"
                                placeholder="Insira o Nome Fantasia"
                                name="nome_fantasia"
                                value ="<?=isset($empresa["nome_fantasia"]) ? $empresa["nome_fantasia"] : old('nome_fantasia')?>">
                            <?php if (error('nome_fantasia')) {?>
                                <p class="text-danger"><?=error('nome_fantasia')?></p>
                            <?php }?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title"><span class="text-danger">*</span> Telefone</label>
                            <input
                                type="text"
                                class="form-control <?=error('telefone') ? 'has-error' : ''?>"
                                id="telefone"
                                placeholder="Insira o Telefone"
                                name="telefone"
                                value ="<?=formatarTelefone(isset($empresa["telefone"]) ? $empresa["telefone"] : old('telefone'))?>">
                            <?php if (error('telefone')) {?>
                                <p class="text-danger"><?=error('telefone')?></p>
                            <?php }?>
                            <input type="hidden" id="hidden-field">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group <?=error('id_cnae') ? 'has-error' : ''?>" >
                            <label for="title"><span class="text-danger">*</span> CNAE</label>
                            <select
                                class="form-control selectpicker"
                                data-live-search="true"
                                data-width="100%"
                                data-dropup-auto="false"
                                id="id_cnae"
                                name="id_cnae">
                                <option value="">Selecione...</option>
                                <?php foreach ($cnaes as $cnae) { $oldCnae = empty($oldCnae) ? old('id_cnae') : $oldCnae?>
                                <option 
                                    <?= ( isset($empresa["id_cnae"]) && $empresa["id_cnae"] == $cnae['id_cnae'] )
                                    || $oldCnae == $cnae['id_cnae']
                                    ? "selected" : ''?>
                                    value="<?=$cnae['id_cnae']?>"
                                    ><?=trim($cnae['codigo_cnae'] . ' - ' . $cnae['desc_cnae'])?></option>
                                <?php } ?>
                            </select>
                            <?php if (error('id_cnae')) {?>
                                <p class="text-danger"><?=error('id_cnae')?></p>
                            <?php }?>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <h5>Endereço</h5>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"><span class="text-danger">*</span> CEP</label>
                            <input
                                type="text"
                                class="form-control <?=error('cep') ? 'has-error' : ''?>"
                                id="cep"
                                placeholder="Insira o CEP"
                                name="cep"
                                value ="<?=formatarCep(isset($empresa["cep"]) ? $empresa["cep"] : old('cep'))?>">
                            <?php if (error('cep')) {?>
                                <p class="text-danger"><?=error('cep')?></p>
                            <?php }?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title"><span class="text-danger">*</span> Logradouro</label>
                            <input
                                type="text"
                                class="form-control <?=error('logradouro') ? 'has-error' : ''?>"
                                id="logradouro"
                                placeholder="Insira o Logradouro"
                                name="logradouro"
                                value ="<?=isset($empresa["logradouro"]) ? $empresa["logradouro"] : old('logradouro')?>">
                            <?php if (error('logradouro')) {?>
                                <p class="text-danger"><?=error('logradouro')?></p>
                            <?php }?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="title"><span class="text-danger">*</span> Número</label>
                            <input
                                type="text"
                                class="form-control <?=error('numero') ? 'has-error' : ''?>"
                                id="numero"
                                placeholder="Insira o Número"
                                name="numero"
                                value ="<?=isset($empresa["numero"]) ? $empresa["numero"] : old('numero')?>">
                            <?php if (error('numero')) {?>
                                <p class="text-danger"><?=error('numero')?></p>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"><span class="text-danger">*</span> Bairro</label>
                            <input
                                type="text"
                                class="form-control <?=error('bairro') ? 'has-error' : ''?>"
                                id="bairro"
                                placeholder="Insira o Bairro"
                                name="bairro"
                                value ="<?=isset($empresa["bairro"]) ? $empresa["bairro"] : old('bairro')?>">
                            <?php if (error('bairro')) {?>
                                <p class="text-danger"><?=error('bairro')?></p>
                            <?php }?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group <?=error('sigla_estado') ? 'has-error' : ''?>">
                            <label for="sigla_estado"><span class="text-danger">*</span> Estado</label>
                            <select
                                class="form-control selectpicker "
                                data-live-search="true"
                                data-width="100%"
                                data-dropup-auto="false"
                                id="sigla_estado"
                                name="sigla_estado">
                                    <option value="">Selecione...</option>
                                <?php foreach (estados() as $estado) { $oldEstado = empty($oldEstado) ? old('sigla_estado') : $oldEstado?>
                                    <option 
                                        <?= ( isset($empresa["sigla_estado"]) && $empresa["sigla_estado"] == $estado['sigla_estado'] )
                                        || $oldEstado == $estado['sigla_estado']
                                        ? "selected" : ''?>
                                        value="<?=$estado['sigla_estado']?>"
                                        ><?=$estado['nome_estado']?></option>
                                <?php } ?>
                            </select>
                            <?php if (error('sigla_estado')) {?>
                                <p class="text-danger"><?=error('sigla_estado')?></p>
                            <?php }?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"><span class="text-danger">*</span> Cidade</label>
                            <input
                                type="text"
                                class="form-control <?=error('cidade') ? 'has-error' : ''?>"
                                id="cidade"
                                placeholder="Insira a Cidade"
                                name="cidade"
                                value ="<?=isset($empresa["cidade"]) ? $empresa["cidade"] : old('cidade')?>">
                            <?php if (error('cidade')) {?>
                                <p class="text-danger"><?=error('cidade')?></p>
                            <?php }?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-check">
                            <h6>
                            <label class="form-check-label" for="ck_observacao">
                                <input
                                class="form-check-input"
                                type="checkbox"
                                name="ck_observacao"
                                id="ck_observacao"
                                <?=isset($empresa["observacao"]) ? 'checked' : '' ?>
                                />
                                <span class="form-check-label--faux"></span>
                                Usa observação
                            </label>
                            </h5>
                        </div>
                    </div>
                    <div id="observacao" class="col-md-12" <?=!isset($empresa["observacao"]) ? 'style="display: none"' : ''?>>
                        <div class="form-group" >
                            <textarea 
                            class="form-control" 
                            name="observacao"
                            rows="6"><?=isset($empresa["observacao"]) ? $empresa["observacao"] : old('observacao')?></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h5>Situação da empresa</h5>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label" for="ativo">
                                    <input class="form-check-input" 
                                           type="radio" 
                                           name="situacao" 
                                           id="ativo" 
                                           value="1"
                                           <?=!isset($empresa["situacao"]) || $empresa["situacao"] ? 'checked' : '' ?> />
                                    <span class="form-check-label--faux"></span>
                                    Ativa
                                </label>
                                <label class="form-check-label" for="inativo">
                                    <input class="form-check-input" 
                                           type="radio" 
                                           name="situacao" 
                                           id="inativo" 
                                           value="0"
                                           <?=isset($empresa["situacao"]) && !$empresa["situacao"] ? 'checked' : '' ?> />
                                    <span class="form-check-label--faux"></span>
                                    Inativa
                                </label>
                            </div>
                            <?php if (error('situacao')) {?>
                            <p class="text-danger"><?=error('situacao')?></p>
                            <?php }?>
                        </div>
                    </div>
                </div>
                    
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>

    </div>
</div>
