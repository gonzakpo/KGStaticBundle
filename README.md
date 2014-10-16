KGStaticBundle
==============

This bundle makes it possible to load static content from
Symfony bundles.

Licence
-------

This bundle is under the MIT license. See the complete license in the bundle:

    Resources/meta/LICENCE

Installation
------------
"require": {
    ...
    "kg/static": "2.3.*@dev",
}

Register
--------
new KG\StaticBundle\KGStaticBUndle(),

Basic usage
-----------
{{ file('@AcmeDemoBundle/Static/hello.txt') }}
