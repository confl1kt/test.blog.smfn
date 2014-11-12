<?php

namespace Sonata\BlogBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SonataBlogBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
