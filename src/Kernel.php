<?php

namespace App;

use Symfony\Bundle\MakerBundle\MakerBundle;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    //on utilise makerbundle uniquement en dev
    public function registerBundles(): iterable
    {
        $bundles = [
            //... liste de vos autres bundles
        ];

        if ($this->getEnvironment() === 'dev') {
            $bundles[] = new MakerBundle();
        }

        return $bundles;
    }
}
