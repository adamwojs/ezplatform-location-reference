# ezplatform-location-reference

## Problem

The common case in the eZ Platform configuration is referencing to some location, usually using Location ID e.g.

* Content root for Site Access (https://doc.ezplatform.com/en/latest/guide/multisite/#location_id)
* Folder used to store Image Assets (https://doc.ezplatform.com/en/latest/api/field_type_reference/#configuration)

There are several issues in this approaches:

* Location IDs differ between environments
* Using [Magic numbers](https://en.wikipedia.org/wiki/Magic_number_%28programming%29) is a [code smell](https://en.wikipedia.org/wiki/Code_smell)

This package introduces [Domain Specific Language](https://en.wikipedia.org/wiki/Domain-specific_language), based on Symfony [Expression Language](https://symfony.com/doc/current/components/expression_language.html) component, allowing to refer locations using meaningful and descriptive expressions. 

## Usage

### Resolve location references

Location reference expressions could be resolved using `LocationReferenceResolver` e.g.

```php
<?php

namespace App\Service; 

class FooService 
{
    /**
     * @var \AdamWojs\EzPlatformLocationReference\LocationReferenceResolverInterface  
     */
    private $locationReferenceResolver;

    public function __construct(LocationReferenceResolverInterface $locationReferenceResolver)
    {
        $this->locationReferenceResolver = $locationReferenceResolver;
    }

    public function foo(): void
    {
        $location = $this->locationReferenceResolver->resolve(
            'remote_id("babe4a915b1dd5d369e79adb9d6c0c6a")'
        );

        // ...
    }
}
```

### Retrieving location reference from SiteAccess aware configuration

Location references could be retrieved from the SiteAccess aware configuration 
using `LocationConfigResolver`:  

```php
<?php 

interface LocationConfigResolverInterface
{
    public function getLocation(string $name, ?string $namespace = null, ?string $scope = null): Location;

    public function getLocationReference(string $name, ?string $namespace = null, ?string $scope = null): LocationReference;
}
```


Arguments for both `getLocation` and `getLocationReference` methods are exactly the same as for 
`\eZ\Publish\Core\MVC\ConfigResolverInterface::getParameter`. 


Example:

```php
<?php 

class BarService 
{
    /**
     * @var \AdamWojs\EzPlatformLocationReference\ConfigResolver\LocationConfigResolverInterface  
     */
    private $locationConfigResolver;

    public function __construct(LocationConfigResolverInterface $locationConfigResolver)
    {
        $this->locationConfigResolver = $locationConfigResolver;
    }

    // ...

    public function foo(): void
    {
        // Get reference to location 
        $reference = $this->locationConfigResolver->getLocationReference('content.tree_root.location_id');
        
        // Resolve location reference 
        $location = $reference->getLocation();
        // Return null if location is not available (not found or unauthorized)  
        $location = $reference->getLocationOrNull();
        // Return $defaultLocation if location is not available (not found or unauthorized)
        $location = $reference->getLocationOrDefault($defaultLocation);
        
        // Get reference and immediately resolve
        $location = $this->locationConfigResolver->getLocation('fieldtypes.ezimageasset.parent_location');
    }
}
```

### Available functions

| Function    | Description                  | Example                                         |
|-------------|------------------------------|-------------------------------------------------|
| `root`      | Load root location           | `root()`                                        |
| `parent`    | Load parent location         | `parent(local_id(54))`                          |
| `local_id`  | Load location by ID          | `local_id(54)`                                  |
| `remote_id` | Load location by remote ID   | `remote_id("babe4a915b1dd5d369e79adb9d6c0c6a")` |
| `path`      | Load location by path string | `path("/1/2/54")`                               |
| `named`     | Load named reference         | `named("MEDIA")`                                |
