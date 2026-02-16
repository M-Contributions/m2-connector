## A connector to any data external source, either a WS or a ftp server.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ticaje/m2-connector.svg?style=flat-square)](https://packagist.org/packages/ticaje/m2-connector)
[![Quality Score](https://img.shields.io/scrutinizer/g/M-Contributions/m2-connector.svg?style=flat-square)](https://scrutinizer-ci.com/g/M-Contributions/m2-connector)
[![Total Downloads](https://img.shields.io/packagist/dt/ticaje/m2-connector.svg?style=flat-square)](https://packagist.org/packages/ticaje/m2-connector)
[![Author](https://img.shields.io/badge/HBLateral.com-%2302113a?style=labelColor=lightgrey)](https://hblateral.com)

### Preface

This is an ongoing project, in short i will be providing the guidelines for understanding the purpose of it and the most common use of case for its use.

It's public knowledge that an API exposed in a Web Service defines a series of policies to comply, by other systems wanting to interact with it, in order to achieve
the communications hence the business requirements are met.

The module described in this topic constitutes some sort of middleware that eases the labor of a designer since it allows to focus on high level use cases when
implementing an interaction with an external API.

### Installation

You can install this package using composer(the only way i recommend)

```bash
composer require ticaje/m2-connector
```

### Features

This module uses the base contract module to comply with the foundations of the Design by Contract approach stated in such a module.

The idea is to establish a standard procedure to build a scalable connector to external API so it normalizes repetitive task such as authenticate,
request and process responses from the API and leaves room for defining data and service contracts which is actually the differential factor of a
domain model.

The purpose of this approach is to provide a framework that allows, with little efforts, designers to reflect the business policies a specific domain might
involve with. This way, architects may focus on creating pure business implementations and leave the infrastructure stuff in the hands of this middleware.

### Components of the extension

#### Extension's structure, quite explicit

- Factory: Low level module held responsible for creating higher-level-components dependencies such as login and auth providers.
- Client: Middle level module that wraps the external API consumer, so far REST and SOAP support. It provides basic operations.
- Login Provider: Middle level module in charge of providing login coverage
- Authentication Provider: Middle level module that provides authentication.

All of the modules above implement corresponding interfaces so by means of a Dependency Container the developer is able to build his wanted solutions since
the high level approach dictates an isolated-service-driven design.

#### Amusing Side

The fuzz is about creating recipes for every specific Domain:

For instance, by default the rest connector uses Guzzle Libraries to abstract the low level use cases when connecting to a REST API, you don't want or can not or
you're not convinced of Guzzle, then create a new virtual type for a client factory interface(as reflected in di.xml file line 4) and define your dependencies on it so
your higher level module will use this new virtual type.

By other hand, a token provider uses the same REST client we've just defined to implement the specific logic of requesting a token given a Token Service.
Whenever a new implementation is needed, the power of inheritance plus interface implementation can be used in order to achieve a specific domain modelling.

By the way, this very specific implementation although minimal is pure functional; even so it can be overwritten given the right circumstances with little side effects
since service isolation pattern has been applied.

### Documentation and Playing Out

> There is a a proof of concept to this module implemented in a [Dummy Module](https://github.com/M-Contributions/M2-Dummy-Pool), please feel free to use it.

> Likewise the [Base Contract Module](https://github.com/M-Contributions/m2-contract) documentation is available so you can start digging into it.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Héctor Luis Barrientos](https://github.com/ticaje)
- [All Contributors](../../contributors)

## License

The GNU General Public License (GPLv3). Please see [License File](LICENSE.md) for more information.
