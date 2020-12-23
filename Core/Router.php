<?php
/**
 * Router.php
 *
 * @package    Core
 * @author     Fernando Campos de Oliveira <fernando@odesenvolvedor.net>
 * @version    $Id$
 **/

namespace Core;

class Router
{

    static public function parse($url, $request)
    {
        $url = parse_url($url);

        $explode_url = explode('/', $url['path']);
        $explode_url = array_slice($explode_url, 1);

        if (!empty($explode_url[0])) {
            $controller = $explode_url[0];
            $action = isset($explode_url[1]) ? $explode_url[1] : 'index';

            $request->controller = $controller;
            $request->action     = $action;
            $request->params     = array_slice($explode_url, 2);

        } else {

            $request->controller = 'home';
            $request->action     = 'index';
            $request->params     = [];
            
        }
    }
}