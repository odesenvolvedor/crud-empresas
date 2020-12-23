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
            "situacao" => "required",
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
            "situacao" => [
                "required" => "O campo Situação é obrigatório",
            ],
        ];

    /**
     * Retorna todos os registros da tabela
     * @return array|null
     */
    public function all()
    {
        $sql = "SELECT * FROM $this->table WHERE excluido_em IS NULL";

        $filters = $_GET;

        if (isset($filters['excluido_em-not'])) {
            $sql = "SELECT * FROM $this->table WHERE excluido_em IS NOT NULL";
        }

        if (!empty($filters)) {

            if ($filters['approach'] == 'or') {
                $sql .= " AND (";
            }

            foreach( $filters  as $filter => $value) {

                $value          = explode(',', $value);
                $filter         = explode('-', $filter);
                $term           = '';
                $insertApproach = substr($sql, -1) != '(';

                if (isset($filter[1])) {

                    switch ($filter[1]) {
                        case 'like':
                            foreach ($value as $k => $v) 
                                $term .= ($k == 0 ? ' ' : ' or ') . $filter[0] . " like '%" . $v . "%'";
                        break;

                        case 'not':
                            foreach ($value as $k => $v)
                                $term .= ($k == 0 ? ' ' : ' or ') . $filter[0] . " <> '" . $v . "'";
                        break;

                        case 'st':
                            foreach ($value as $k => $v)
                                $term .= ($k == 0 ? ' ' : ' or ') . $filter[0] . " < '" . $v . "'";
                        break;

                        case 'max':
                            foreach ($value as $k => $v)
                                $term .= ($k == 0 ? ' ' : ' or ') . $filter[0] . " <= '" . $v . "'";
                        break;

                        case 'gt':
                            foreach ($value as $k => $v)
                                $term .= ($k == 0 ? ' ' : ' or ') . $filter[0] . " > '" . $v . "'";
                        break;

                        case 'min':
                            foreach ($value as $k => $v)
                                $term .= ($k == 0 ? ' ' : ' or ') . $filter[0] . " >= '" . $v . "'";
                        break;

                        case 'in':
                            foreach ($value as $k => $v)
                                $term .= ($k == 0 ? ' ' : ' or ') . $filter[0] . " in (" . $v . ")";
                        break;

                        default:
                            foreach ($value as $k => $v)
                                $term .= ($k == 0 ? ' ' : ' or ') . $filter[0] . " = '" . $v . "'";
                        break;
                    }

                    $sql .= (' ' . ($insertApproach ? $filters['approach'] : '') . ' ' . $term);

                } else {

                    if ($filter[0] != 'approach') {
                        foreach ($value as $k => $v)
                            $term .= ($k == 0 ? ' ' : ' or ') . $filter[0] . " = '" . $v . "'";

                        $sql .= (' ' . ($insertApproach ? $filters['approach'] : '') . ' ' . $term);
                    }
                }
            }
    
            if ($filters['approach'] == 'or') {
                $sql .= " ) ";
            }

            if (!isset($filters['situacao-in'])) {
                $sql .= " and situacao = 1 ";
            }

        } else {
            $sql .= " and situacao = 1 ";
        }

        $req = $this->conn->prepare( $sql );
        $req->execute();

        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }
}