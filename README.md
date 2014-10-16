KGStaticBundle
==============

This bundle makes it possible to load static content from Symfony bundles.
By https://github.com/kgilden/KGStaticBundle

Licence
-------

This bundle is under the MIT license. See the complete license in the bundle:

    Resources/meta/LICENCE

Installation
------------
```json
"require": {
    ...
    "kg/static": "2.3.*@dev",
}
```

Execute:

```cli
php composer update "kg/static"
```

Register
--------
```php
new KG\StaticBundle\KGStaticBundle(),
```

Basic usage
-----------
```twig
{{ file(asset('imagen.jpeg')) }}
```
