<?php

namespace KG\StaticBundle\Twig;

use Symfony\Component\HttpKernel\KernelInterface;

class StaticExtension extends \Twig_Extension
{
    /**
     * @var KernelInterface
     */
    protected $kernel;

    public function __construct(KernelInterface $kernel) {
        $this->kernel = $kernel;
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
    public function file($path)
    {
        // $path = $this->kernel->locateResource($path, null, true);
        $reemplazar = array("/app_dev.php");
        $path = str_replace($reemplazar, "", $path);

        return "data:image/jpg;base64,".base64_encode(file_get_contents(".".$path));
    }

    public function getName()
    {
        return 'StaticExtension';
    }
}