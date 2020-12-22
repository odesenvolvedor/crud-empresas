<?php
/**
 * Empresa.php
 * @see Base
 *
 * @package    App/Models
 * @author     Fernando Campos de Oliveira <fernando@odesenvolvedor.net>
 * @version    $Id$
 **/

namespace App\Models;

class Empresa extends Base 
{
    protected $table = 'empresas';

    public static $rules = [
            "razao_social" => "required",
            "nome_fantasia" => "required",
            "cnpj" => "required|cnpj",
            "telefone" => "required",
            "id_cnae" => "required",
            "cep" => "required",
            "logradouro" => "required",
            "numero" => "required",
            "bairro" => "required",
            "sigla_estado" => "required",
            "cidade" => "required",
        ];

    public static $messages = [
            "razao_social" => [
                "required" => "O campo Razão Social é obrigatório",
            ],
            "nome_fantasia" => [
                "required" => "O campo Nome Fantasia é obrigatório",
            ],
            "cnpj" => [
                "required" => "O campo CNPJ é obrigatório",
                "cnpj" => "O campo CNPJ é inválido",
            ],
            "telefone" => [
                "required" => "O campo Telefone é obrigatório",
            ],
            "cnae" => [
                "required" => "O campo CNAE é obrigatório",
            ],
            "cep" => [
                "required" => "O campo CEP é obrigatório",
            ],
            "logradouro" => [
                "required" => "O campo Logradouro é obrigatório",
            ],
            "numero" => [
                "required" => "O campo Número é obrigatório",
                "number" => "O campo Número deve conter apenas números",
            ],
            "bairro" => [
                "required" => "O campo Bairro é obrigatório",
            ],
            "sigla_estado" => [
                "required" => "O campo Estado é obrigatório",
            ],
            "cidade" => [
                "required" => "O campo Cidade é obrigatório",
            ],
        ];
}