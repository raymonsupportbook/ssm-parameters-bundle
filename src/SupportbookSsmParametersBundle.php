<?php

declare(strict_types=1);

namespace Supportbook\SsmParametersBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SupportbookSsmParametersBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}