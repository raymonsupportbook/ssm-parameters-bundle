# ssm-parameters-bundle

Simple bundle for adding support for SSM parameters for a Symfony project

Installation
============

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
$ composer require Supportbook/ssm-parameters-bundle
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the following command to download the latest stable
version of this bundle:

```console
$ composer require Supportbook/ssm-parameters-bundle
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Supportbook\SsmParametersBundle\SupportbookSsmParametersBundle::class => ['all' => true],
];
```

Usage
=====

Reference an environment variable that holds the name of an SSM parameter with the `ssm:` prefix:

```yaml
# config/packages/lexik_jwt_authentication.yaml
lexik_jwt_authentication:
    public_key: '%env(ssm:JWT_PUBLIC_KEY)%'   # JWT_PUBLIC_KEY=/sb/api-gateway/test/jwt/key/public
```

The value is fetched (with decryption) and stored in the `cache.app` pool.

Configuration
=============

```yaml
# config/packages/supportbook_ssm_parameters.yaml
supportbook_ssm_parameters:
    # Seconds a parameter is cached (default 600). A rotated value in SSM is picked up after this time,
    # also when `cache.app` is shared between deploys (e.g. a database adapter).
    cache_lifetime: 600
```
