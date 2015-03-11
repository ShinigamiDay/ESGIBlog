<?php

namespace ESGI\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ESGIUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
