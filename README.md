
# Tecdoc Bundle

This bundle integrates the TecDoc vehicle and spare parts database into Symfony.

## Features

 * Import fixed width files to database
 * Entity model for fixed width files and orm*
 * Automatic translations of descriptions, textmodules and images
 * REST-API for demonstration
 
 \* For copyright reasons it's not possible to publish the full tecdoc schema. Please contact me if you need more entities or help with integration.

## Installation

```sh
composer require gweb/tecdoc-bundle
```

Now, enable the bundle in your config/bundles.php file:
```php
return [
    // ...
    Gweb\TecdocBundle\GwebTecdocBundle::class => ['all' => true],
];
```

## Configuration

Add new bundle configuration file to: config/packages/gweb_tecdoc.yaml
```yaml
gweb_tecdoc:
    dir:
        download:
            reference: '%kernel.project_dir%/var/tecdoc/download/R_TAF24'
            supplier: '%kernel.project_dir%/var/tecdoc/download/D_TAF24'
            media: '%kernel.project_dir%/var/tecdoc/download/PIC_FILES'
        data:
            reference: '%kernel.project_dir%/var/tecdoc/data/reference'
            supplier: '%kernel.project_dir%/var/tecdoc/data/supplier'
            media: '%kernel.project_dir%/var/tecdoc/data/media'
    translator:
        autoload: false
        default_locale: en
```

Add config for database connection and entity manager
```yaml
doctrine:
    dbal:
        connections:
             tecdoc:
                url:      'mysql://user:pass@localhost:3306/tecdoc'
                driver:   'pdo_mysql'
                charset:  UTF8
    orm:
        entity_managers:
            tecdoc:
                connection: tecdoc
                mappings:
                    GwebTecdocBundle: ~
```

## Import

Copy zipped files to download directories and
extract all 7z files (i.e reference data version 0118)
```sh
bin/console tecdoc:extract --reference=0118 --supplier
```

Create database tables from doctrine schema
```sh
bin/console doctrine:schema:update --em=tecdoc --force
```

Import fixed width files to the new database (i.e use 2 worker threads)
```sh
bin/console tecdoc:import --threads=2
```

## Usage
Simple Controller example

```php
namespace App\Controller;

use Gweb\TecdocBundle\Entity\Tecdoc001DataSupplier;
use Gweb\TecdocBundle\Service\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    private $entityManager;

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/demo")
     */
    public function indexAction()
    {
        $suppliers = $this->entityManager->getRepository(Tecdoc001DataSupplier::class)->findAll();

        $response = [];
        foreach ($suppliers as $supplier) {
            $response[] = $supplier->getMarke();
        }

        return $this->json($response);
    }
}
```

## Demo API usage

Add configuration for rest bundle
````yaml
fos_rest:
    param_fetcher_listener: true
    view:
        view_response_listener:  true
    format_listener:
        rules:
            - { path: ^/tecdoc, prefer_extension: true, fallback_format: json, priorities: [ json ] }
            - { path: ^/, stop: true }
````
Browse API documentation at
[swagger.io](http://editor.swagger.io/?url=https://raw.githubusercontent.com/gewebe/TecdocBundle/master/Api/swagger.json)
