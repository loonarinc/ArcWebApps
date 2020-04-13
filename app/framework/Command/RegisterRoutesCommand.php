<?php


namespace Framework\Command;


use Framework\Contract\CommandInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Kernel;

class RegisterRoutesCommand implements CommandInterface
{
    protected $routeCollection;
    protected $containerBuilder;
    public function __construct(Kernel $kernel)
    {
        $this->kernel = $kernel;
        $this->containerBuilder = $kernel->getContainerBuilder();
    }

    public function execute(): void
    {
        $this->routeCollection = require __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'routing.php';
        $this->containerBuilder->set('route_collection', $this->routeCollection);
    }
}