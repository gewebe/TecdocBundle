
# TecdocBundle for Symfony

This bundle integrates the TecDoc vehicle and spare parts database into Symfony.

## Features

 * Import fixed width files to database
 * Entity model for fixed width files and orm*
 * Automatic translations of descriptions, textmodules and images
 * Little REST-API for demonstration
 
 \* For copyright reasons it's not possible to publish the full tecdoc schema. Please contact me if you need more entities or help with integration.

## Installation

```sh
composer require gweb/tecdoc-bundle
```

Add plugin dependencies to your AppKernel.php file:
```php
new Gweb\TecdocBundle\GwebTecdocBundle(),
```

Import required config in your app/config/config.yml file:
```yaml
imports:
    - { resource: "@GwebTecdocBundle/Resources/config/config.yml" }
```

If you want to use the demo API, import routing on top of your app/config/routing.yml file:
```yaml
gweb_tecdoc:
    resource: "@GwebTecdocBundle/Controller/"
    type:     rest
    prefix:   /tecdoc

```

Parameters you can override in your parameters.yml(.dist) file
```yaml
tecdoc_database_driver: pdo_mysql
tecdoc_database_host: localhost
tecdoc_database_port: 3306
tecdoc_database_name: tecdoc
tecdoc_database_user: tecdoc
tecdoc_database_password: secret
tecdoc_download_reference: var/tecdoc/download/R_TAF24
tecdoc_download_supplier: var/tecdoc/download/D_TAF24
tecdoc_download_media: var/tecdoc/download/PIC_FILES
tecdoc_default_locale: en
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
Simple example usage, you can find more in Controller directory

```php
class SupplierController
{
    public function indexAction() {
        $em = $this->getDoctrine()->getManager('tecdoc');
    
        $suppliers = $em->getRepository(Tecdoc001DataSupplier::class)->findAll();
    }
}
```
