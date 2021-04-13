<?php

declare(strict_types=1);

namespace Triasto\SsmParametersBundle\EnvVarProcessor;

use AsyncAws\Ssm\Input\GetParameterRequest;
use AsyncAws\Ssm\SsmClient;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\DependencyInjection\EnvVarProcessorInterface;

class SsmEnvVarProcessor implements EnvVarProcessorInterface
{
    public function __construct(
        private SsmClient $ssmClient
    ) {
    }

    public function getEnv(string $prefix, string $name, \Closure $getEnv): ?string
    {
        return $this->ssmClient->getParameter(
            [
                'name' => $getEnv($name),
            ]
        )->getParameter()?->getValue();
    }

    #[ArrayShape(['string' => 'string'])]
    public static function getProvidedTypes(): array
    {
        return [
            'ssm' => 'string',
        ];
    }
}
