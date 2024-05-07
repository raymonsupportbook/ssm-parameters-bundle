<?php

declare(strict_types=1);

namespace Sb\SsmParametersBundle\EnvVarProcessor;

use AsyncAws\Ssm\Enum\ParameterType;
use AsyncAws\Ssm\SsmClient;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\DependencyInjection\EnvVarProcessorInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class SsmEnvVarProcessor implements EnvVarProcessorInterface
{
    public function __construct(
        private SsmClient $ssmClient,
        private CacheInterface $cache
    ) {
    }

    public function getEnv(string $prefix, string $name, \Closure $getEnv): ?string
    {
        $name = $getEnv($name);

        return $this->cache->get(
            sprintf(
                'sb-ssm-param-%s',
                str_replace(
                    '/',
                    '.',
                    $name
                )
            ),
            function (ItemInterface $cacheItem) use ($name) {
                return $this->ssmClient->getParameter(
                    [
                        'Name' => $name,
                        'WithDecryption' => true,
                        'Type' => ParameterType::SECURE_STRING,
                    ]
                )->getParameter()->getValue();
            }
        );
    }

    #[ArrayShape(['string' => 'string'])]
    public static function getProvidedTypes(): array
    {
        return [
            'ssm' => 'string',
        ];
    }
}
