<?php
namespace Framework\MVC;


use Framework\DI\DI;

class Application {

    /**
     * @var DI
     */
    private $_di;

    /**
     * @var Router
     */
    private $_route;

    /**
     * @var Controller
     */
    private $_controller;

    public function setDI(DI $di)
    {
        $this->_di = $di;
    }

    /**
     * Обработка
     */
    public function handle()
    {
        $this->_route = $this->_di->get('router');
        if (!$this->_route->wasMatched($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'])) {
            throw new \Exception('404');
        }
        $this->_controller = $this->_route->getNameSpace() . '\\' . $this->_route->getControllerName();
        $this->_controller = new $this->_controller();
        // exists method
        if (!method_exists($this->_controller, $this->_route->getActionName())) {
            throw new \Exception('There is no action ' . $this->_route->getActionName());
        }
        return $this;
    }

    public function getContent()
    {
        return $this->_controller->{$this->_route->getActionName()}();
    }
} 