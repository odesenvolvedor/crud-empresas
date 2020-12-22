<?php 

/**
 * Mascara de CNPJ
 * 
 * @param   string $cnpj
 * @return  string 
 * retorna o CNPJ no formato 99.999.999/9999-99
 */
function formatarCnpj($cnpj) {
    return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj);
}

/**
 * Mascara de CEP
 * 
 * @param   string $cep
 * @return  string 
 * retorna o CEP no formato 99999-999
 */
function formatarCep($cep) {
    return preg_replace("/(\d{5})(\d{3})/", "\$1-\$2", $cep);
}

/**
 * Mascara de Telefone, serve para fixo e móvel
 * 
 * @param   string $telefone
 * @return  string  
 * retorna o Telefone no formato (99) 9999-9999 ou (99) 99999-9999
 */
function formatarTelefone($telefone) {
    return strlen(somenteNumeros($telefone)) == 10
    ? preg_replace("/(\d{2})(\d{4})(\d{4})/", "(\$1) \$2-\$3", $telefone)
    : preg_replace("/(\d{2})(\d{5})(\d{4})/", "(\$1) \$2-\$3", $telefone);
}

/**
 * Mantém somente caracteres numéricos em uma string
 * 
 * @param string $string
 * @return string
 */
function somenteNumeros($string) {
    return preg_replace("/\D/","", $string);
}

/**
 * Retorna o último valor inserido em um campo no formulário
 * 
 * @param string $key
 * @return mixed $old
 */
function old($key) {
    $old = getSessionVariableOnArray('old', $key);
    unset($_SESSION["old"]["$key"]);
    return $old;
}

/**
 * Retorna o erro de uma validação de input
 * 
 * @param string $key
 * @return mixed
 */
function error($key) {
    return getSessionVariableOnArray('errors', $key);
}

/**
 * Retorna uma variável da session
 * 
 * @param string $key
 * @return mixed|null
 */
function getSessionVariableOnArray($array, $key) {
    return isset($_SESSION["$array"]["$key"]) ? $_SESSION["$array"]["$key"]: null;
}

/**
 * Retorna uma lista dos estados brasileiros
 * @return array
 */
function estados() {
    return array(
        array("sigla_estado" => "AC", "nome_estado" => "Acre"),
        array("sigla_estado" => "AL", "nome_estado" => "Alagoas"),
        array("sigla_estado" => "AM", "nome_estado" => "Amazonas"),
        array("sigla_estado" => "AP", "nome_estado" => "Amapá"),
        array("sigla_estado" => "BA", "nome_estado" => "Bahia"),
        array("sigla_estado" => "CE", "nome_estado" => "Ceará"),
        array("sigla_estado" => "DF", "nome_estado" => "Distrito Federal"),
        array("sigla_estado" => "ES", "nome_estado" => "Espírito Santo"),
        array("sigla_estado" => "GO", "nome_estado" => "Goiás"),
        array("sigla_estado" => "MA", "nome_estado" => "Maranhão"),
        array("sigla_estado" => "MT", "nome_estado" => "Mato Grosso"),
        array("sigla_estado" => "MS", "nome_estado" => "Mato Grosso do Sul"),
        array("sigla_estado" => "MG", "nome_estado" => "Minas Gerais"),
        array("sigla_estado" => "PA", "nome_estado" => "Pará"),
        array("sigla_estado" => "PB", "nome_estado" => "Paraíba"),
        array("sigla_estado" => "PR", "nome_estado" => "Paraná"),
        array("sigla_estado" => "PE", "nome_estado" => "Pernambuco"),
        array("sigla_estado" => "PI", "nome_estado" => "Piauí"),
        array("sigla_estado" => "RJ", "nome_estado" => "Rio de Janeiro"),
        array("sigla_estado" => "RN", "nome_estado" => "Rio Grande do Norte"),
        array("sigla_estado" => "RO", "nome_estado" => "Rondônia"),
        array("sigla_estado" => "RS", "nome_estado" => "Rio Grande do Sul"),
        array("sigla_estado" => "RR", "nome_estado" => "Roraima"),
        array("sigla_estado" => "SC", "nome_estado" => "Santa Catarina"),
        array("sigla_estado" => "SE", "nome_estado" => "Sergipe"),
        array("sigla_estado" => "SP", "nome_estado" => "São Paulo"),
        array("sigla_estado" => "TO", "nome_estado" => "Tocantins")
    ); 
}