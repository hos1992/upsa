<?php

class App
{
    protected $controller = 'users';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parse_url();
        if (file_exists("app/controllers/$url[0].php")) {
            $this->controller = $url[0];
            unset($url[0]);
        }
        // require the controller file
        require_once "app/controllers/" . $this->controller . ".php";
        // create new object of the controller class
        $this->controller = new $this->controller;

        // check if the request has any methods in the controller ( index, create, edit )
        if (isset($url[1])) {
            // check if the method exist on the controller
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // populate the params if exist
        $this->params = $url ? array_values($url) : [];

        // call the requested function on the requested controller
        call_user_func_array([$this->controller, $this->method], $this->params);

    }

    protected function parse_url()
    {
        if (isset($_GET['url'])) {
            return $url = explode('/', rtrim($_GET['url'], '/'));
        }
    }
}