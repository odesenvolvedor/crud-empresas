<?php
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
