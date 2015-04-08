<?php
namespace Framework\DI;

class DI {

    private $services;

    /**
     * @param string $name
     * @param object $callback
     */
    public function set($name, $callback)
    {
        $this->services[$name] = $callback;
    }

    /**
     * @param string $name
     * @return null|object
     */
    public function get($name)
    {
        if (isset($this->services[$name])) {
            return $this->services[$name];
        }
        return null;
    }
} 