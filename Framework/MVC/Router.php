<?php
namespace Framework\MVC;

class Router {

    private $_routes = [];
    private $_route;
    private $_http_method;

    public function add($pattern, $paths=null, array $httpMethods=['GET', 'POST'])
    {
        foreach ($httpMethods as $http_method) {
            $this->_routes[$http_method][preg_quote($pattern)] = $paths;
        }
    }

    public function addPost($pattern, $paths=null)
    {
        $this->add($pattern, $paths, ['POST']);
    }

    public function addGet($pattern, $paths=null)
    {
        $this->add($pattern, $paths, ['GET']);
    }

    /**
     * @param string $http_method
     * @param string $uri
     * @return bool
     */
    public function wasMatched($http_method, $uri)
    {
        $this->_http_method = $http_method;
        foreach ($this->_routes[$http_method] as $pattern=>$paths) {
            if (preg_match('#^'.$pattern.'$#', $uri)) {
                $this->_route = $pattern;
                return true;
            }
        }
        return false;
    }

    public function getNameSpace()
    {
        return $this->_routes[$this->_http_method][$this->_route]['namespace'];
    }

    public function getControllerName()
    {
        return $this->_routes[$this->_http_method][$this->_route]['controller'] . 'Controller';
    }

    public function getActionName()
    {
        return $this->_routes[$this->_http_method][$this->_route]['action'].'Action';
    }
} 