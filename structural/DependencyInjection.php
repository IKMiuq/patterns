<?php

namespace structural;

class ControllerConfiguration
{
    private string $name;
    private string $action;

    /**
     * @param string $name
     * @param string $action
     */
    public function __construct(string $name, string $action)
    {
        $this->name = $name;
        $this->action = $action;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAction(): string
    {
        return $this->action;
    }


}
class DependencyInjectionController
{
    private ControllerConfiguration $controllerConfiguration;

    /**
     * @param ControllerConfiguration $controllerConfiguration
     */
    public function __construct(ControllerConfiguration $controllerConfiguration)
    {
        $this->controllerConfiguration = $controllerConfiguration;
    }

    public function getConfiguration(): string
    {
        return $this->controllerConfiguration->getName() . '@' . $this->controllerConfiguration->getAction();
    }

}

$configuration = new ControllerConfiguration('PostController', 'index');

$controller = new DependencyInjectionController($configuration);
var_dump($controller->getConfiguration());