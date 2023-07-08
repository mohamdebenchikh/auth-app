<?php

namespace App\Controllers;

use App\Core\Redirect;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;

class Controller
{

    protected View $view;
    protected Request $request;
    protected Response $response;

    /**
     * Create a new Controller instance.
     */
    public function __construct()
    {
        $this->view = new View();
        $this->request = new Request();
        $this->response = new Response();
    }

    /**
     * Set the layout for the view.
     *
     * @param string $layout
     * @return $this
     */
    public function setViewLayout($layout)
    {
        return $this->view->setLayout($layout);
    }

    /**
     * Render a view with the given parameters.
     *
     * @param string $view
     * @param array $params
     * @return string
     */
    public function view($view, $params = [])
    {
        return $this->view->render($view, $params);
    }

    /**
     * Create a new Redirect instance.
     *
     * @return Redirect
     */
    public function redirect()
    {
        return new Redirect();
    }

    public function request()
    {
        return $this->request;
    }

   
    public function response()
    {
        return $this->response;
    }

    public function isRequestMethod($method)
    {
        return $this->request->method() === $method;
    }
}
