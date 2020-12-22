<?php
/**
 * Dispatcher.php
 *
 * @package    Core
 * @author     Fernando Campos de Oliveira <fernando@odesenvolvedor.net>
 * @version    $Id$
 **/

namespace Core;

class Dispatcher
{

    /**
     * @var Request $request
     */
    private $request;

    /**
     * Método responsável por dispachar a requisição para o controller
     * 
     * Caso a rota não econtre um controller ou uma ação do controller
     * retorna página não encontrada
     */
    public function dispatch()
    {
        try {
            $this->request = new Request();

            Router::parse($this->request->url, $this->request);
    
            $controller = $this->loadController();
   
            if ( ! method_exists( $controller, $this->request->action ) ) {
                require (ROOT . 'resources/views/errors/404.php');
            }
            call_user_func_array([$controller, $this->request->action], $this->request->params);
    
        } catch (\Exception $e) {
            if ($e->getCode() == 404 ) {
                require (ROOT . 'resources/views/errors/404.php');
            } else {
                echo $e->getMessage();
            }
        }
    }

    /**
     * Método responsável por instanciar um Controller
     * 
     * Caso o arquivo do Controller solicitado não exista
     * retorna página não encontrada
     */
    public function loadController()
    {
        $name = ucfirst($this->request->controller) . "Controller";
        $file = ROOT . 'App/Controllers/' . $name . '.php';
 
        if (! is_file($file)) {
            throw new \Exception('Page not found', 404);
        }

        $class = "\\App\\Controllers\\". $name;
        
        return new $class();
    }

}