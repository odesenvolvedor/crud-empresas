<?php
/**
 * Validator.php
 *
 * @package    App/Validators
 * @author     Fernando Campos de Oliveira <fernando@odesenvolvedor.net>
 * @version    $Id$
 **/

namespace App\Validators;

class Validator
{
    /**
     * @var array $rules
     */
    private $rules;

    /**
     * @var array $request
     */
    private $request;

    /**
     * @var array $messages
     */
    private $messages;

    /**
     * Class constructor.
     * @param array $rules
     * @param array $request
     * @param array $messages
     */
    public function __construct($rules, $request, $messages)
    {
        $this->rules = $rules;
        $this->request = $request;
        $this->messages = $messages;
        return $this->validate();
    }

    /**
     * Realiza validação dos campos com as regras do controller
     * 
     * Se passar na validação, segue o fluxo do software
     * 
     * Se algum campo não passar na validação, salva os erros na session
     * e retorna para a página de origem
     * @access protected
     */
    protected function validate()
    {
        foreach ($this->rules as $k => $rules) {

            $value = trim($this->request[$k]);

            $rules = \explode('|', $rules);

            foreach ($rules as $rule) {
                if ( $rule == 'required' && (null == $value || '' == $value) ) {
                    $_SESSION['errors'][$k] = $this->messages[$k][$rule];
                }
                if ( $rule == 'number' && (null == $value || '' == $value) && !is_numeric($value) ) {
                    $_SESSION['errors'][$k] = $this->messages[$k][$rule];
                }
                if ( $rule == 'email' && !$this->validarEmail($value) ) {
                    $_SESSION['errors'][$k] = $this->messages[$k][$rule];
                }
                if ( $rule == 'cnpj'&& !empty($value) && !$this->validaCnpj($value)) {
                    $_SESSION['errors'][$k] = $this->messages[$k][$rule] ? $this->messages[$k][$rule] : "O Campo $k deve ser um CNPJ válido";
                }
            }
        }

        if (isset($_SESSION['errors']) && null != $_SESSION['errors']) {
            $_SESSION['old'] = $this->request;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die;
        }
    }

    /**
     * Valida Email
     * @access protected
     * @param string $val
     * @return bool true para e-mail válido
     */
    protected function validarEmail($val)
    {
        //verifica se e-mail esta no formato correto de escrita
        if (!ereg('^([a-zA-Z0-9.-_])*([@])([a-z0-9]).([a-z]{2,3})', $val)) {
            return false;
        } else {
            //Valida o dominio
            $dominio = explode('@', $val);
            if (!checkdnsrr($dominio[1], 'A')) {
                return false;
            }
        }
        return true;
    }

    /**
     * Valida CNPJ
     *
     * @access protected
     * @param  string     $cnpj
     * @return bool       true para CNPJ correto
     */
    protected function validaCnpj($cnpj)
    {
       $somenteNumeros = preg_replace('/[\D]/', '', (string)$cnpj);

       /*Elimina CNPJ em branco, menor que 14 digitos e com todos os numeros iguais*/
       $numerosIguais = preg_match('/^(1{14}|2{14}|3{14}|4{14}|5{14}|6{14}|7{14}|8{14}|9{14}|0{14})$/', $somenteNumeros);

       if ($cnpj == '' || strlen($somenteNumeros) != 14 || $numerosIguais) {
           return false;
       }

       $tamanho = strlen($somenteNumeros) - 2;
       //numero a ser validado (12 primeiros)
       $numerosEtapa1 = substr($somenteNumeros, 0, $tamanho);
       //resgata o digito verificador (2 ultimos)
       $digitoVerificador = substr($somenteNumeros, $tamanho);
       //retorna a primeira posicao do digito verificador
       $resultadoDv1 = $this->retornaResultadoDv($tamanho, $numerosEtapa1);

       if ($resultadoDv1 != substr($digitoVerificador, 0, 1)) {
           return false;
       }

       $tamanho += 1;
       //numero a ser validado (13 primeiros)
       $numerosEtapa2 = substr($somenteNumeros, 0, $tamanho);
       //retorna a segunda posicao do digito verificador
       $resultadoDv2 = $this->retornaResultadoDv($tamanho, $numerosEtapa2);
       if ($resultadoDv2 != substr($digitoVerificador, 1, 1)) {
           return false;
       }

       return true;
   }


   /**
   * Calcula cada digito verificador do CNPJ
   *
   * @access private
   * @param int $tamanho
   * @param int $numeros
   * @return int
   */
   private function retornaResultadoDv($tamanho, $numeros)
   {
       $soma = 0;
       $pos = $tamanho - 7;
       for ($i = $tamanho; $i >= 1; $i--) {
           $soma += substr($numeros, $tamanho - $i, 1) * $pos--;
           if ($pos < 2) {
               $pos = 9;
           }
       }
       $resultado = $soma % 11 < 2 ? 0 : 11 - $soma % 11;
       return $resultado;
   }

}
