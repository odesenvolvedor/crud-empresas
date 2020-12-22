<?php
/**
 * CnaeController.php
 * @see Controller
 * 
 * @package    App/Controllers
 * @author     Fernando Campos de Oliveira <fernando@odesenvolvedor.net>
 * @version    $Id$
 **/

namespace App\Controllers;

use App\Models\Cnae;
use App\Models\Empresa;

class CnaeController extends Controller
{
    /**
     * @var Cnae $cnaeModel
     */
    private $cnaeModel;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->cnaeModel = new Cnae();
    }

    /**
     * Busca por CNAE
     * @param string $term
     * @return json $cnae
     */
    public function search( $term )
    {
        $cnae = $this->cnaeModel->search( $term );
        echo json_encode( $cnae );
    }
}
