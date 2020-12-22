<?php
namespace Core;

class Router
{

    static public function parse($url, $request)
    {
        $url = str_replace(BASE_URL, '', trim($url));

        $explode_url = explode('/', $url);
        $explode_url = array_slice($explode_url, 1);

        if (!empty($explode_url[0])) {

            $request->controller = $explode_url[0];
            $request->action     = isset($explode_url[1]) ? $explode_url[1] : 'index';
            $request->params     = array_slice($explode_url, 2);

        } else {

            $request->controller = 'home';
            $request->action     = 'index';
            $request->params     = [];
            
        }
    }
}