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

class HomeController extends Controller
{
    /**
     * Renderiza a pagina inicial da aplicação
     */
    public function index()
    {
        $this->render( "home.index" );
    }
}
