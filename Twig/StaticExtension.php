<?php

namespace KG\StaticBundle\Twig;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\DependencyInjection\Container;

class StaticExtension extends \Twig_Extension
{
    /**
     * @var KernelInterface
     */
    protected $kernel;
    protected $container;

    public function __construct(KernelInterface $kernel, Container $container = null) {
        $this->kernel    = $kernel;
        $this->container = $container;
    }

    /**
     * {@inherit-Doc}
     */
    public function getFunctions()
    {
        return array(
            'file' => new \Twig_Function_Method($this, 'file')
        );
    }

    /**
     * Returns the contents of a file to the template.
     *
     * @param string $path    A logical path to the file (e.g '@AcmeFooBundle:Foo:resource.txt').
     *
     * @return string         The contents of a file.
     */
    public function file($path, $filter)
    {
        $extension = substr(pathinfo($path, PATHINFO_EXTENSION), 0, 3);
        $src = $this->container->get('templating.helper.assets')->getUrl($path);
        $avalancheService = $this->container->get('imagine.cache.path.resolver');
        $src = $avalancheService->getBrowserPath(
            $src,
            $filter
        );
        $cacheManager = $this->container->get('imagine.cache.manager');
        $cacheManager->cacheImage(
            $this->container->get('request')->getBaseUrl(),
            $path,
            $filter
        );
        $reemplazar = array("/app_dev.php");
        $src = str_replace($reemplazar, "", $src);

        return "data:image/$extension;base64,".base64_encode(file_get_contents(".".$src));
    }

    public function getName()
    {
        return 'StaticExtension';
    }
}