<?php
/**
 * EmpresaController.php
 * @see Controller
 *
 * @package    App/Controllers
 * @author     Fernando Campos de Oliveira <fernando@odesenvolvedor.net>
 * @version    $Id$
 **/


namespace App\Controllers;

use App\Models\Cnae;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    /**
     * @var Cnae $cnaeModel
     */
    private $cnaeModel;
    /**
     * @var Empresa $empresaModel
     */
    private $empresaModel;   



    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->cnaeModel    = new Cnae();
        $this->empresaModel = new Empresa();

        $this->rules        = Empresa::$rules;
        $this->messages     = Empresa::$messages;
    }


    /**
     * Adiciona uma nova empresa ou abre a tela Manter Empresa
     * 
     * Após salvar, redireciona para a lista de empresas
     */
    public function adicionar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $data = $this->secure_form( $_POST );
            $this->validate ( $data );

            $data['cnpj']       = somenteNumeros( $data['cnpj'] );
            $data['telefone']   = somenteNumeros( $data['telefone'] );
            $data['cep']        = somenteNumeros( $data['cep'] );

            unset( $data['ck_observacao'] );

            if ( $this->empresaModel->create( $data ) ) {
                header( "Location: " . BASE_URL . "/empresa" );
            }
        }

        $this->render( "empresa.manter", ['cnaes' => $this->cnaeModel->all()]);
    }

}
