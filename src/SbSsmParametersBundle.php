<?php

declare(strict_types=1);

namespace Sb\SsmParametersBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SbSsmParametersBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}