<?php

declare(strict_types=1);

namespace Triasto\SsmParametersBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TriastoSsmParametersBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}