# ezplatform-location-reference

## Problem

The common case in the eZ Platform configuration is referencing to some location, usually using Location ID e.g.

* Content root for Site Access (https://doc.ezplatform.com/en/latest/guide/multisite/#location_id)
* Folder used to store Image Assets (https://doc.ezplatform.com/en/latest/api/field_type_reference/#configuration)

This several issues in this approaches:

* Location IDs differ between environments
* Using [Magic numbers](https://en.wikipedia.org/wiki/Magic_number_%28programming%29) is a [code smell](https://en.wikipedia.org/wiki/Code_smell)

## Solution

This package introduce [Domain Specific Language](https://en.wikipedia.org/wiki/Domain-specific_language), based on Symfony [Expression Language](https://symfony.com/doc/current/components/expression_language.html) component, allowing to refer locations using meaningful and descriptive expressions. For example:

* Content Tree Root:

```
root()
````

* Location by Remote ID

```
remote_id("babe4a915b1dd5d369e79adb9d6c0c6a")
``` 

* Parent of named reference 

```
parent(named("MEDIA"))
```
 
