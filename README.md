# SEworqs Composer Editor

A high-level Composer JSON editor for PHP, offering enum-driven configuration, strict typing, and intuitive syntax for working with composer.json files.

## Installation

Install via Composer.
```bash
$> composer require seworqs/composer-editor
```

## Usage
```php
use Seworqs\Composer\Enum\EnumComposerPackageType;
use Seworqs\Composer\ComposerEditor;

$composer = ComposerEditor::createNew('path/to/composer.json');

$composer->addProjectName('vendor/some-project')
    ->addDescription('Some nice project!')
    ->addType(EnumComposerPackageType::LIBRARY)
    ...
    ->save();
    
$projectName = $composer->getProjectName();

// Get array of all scripts.
$scripts = $composer->getScripts();    

// Get specific script
$script = $composer->getScript('cleanup');    
    
    

```
> [More examples](docs/Examples.md)

## Features
- [X] Create and edit new Composer JSON file
- [X] Edit existing Composer JSON file
- [X] Use easy dot notation to get to your keys
- [X] Bump version with seworqs/semver integration

> See our [examples](docs/Examples.md)
 
## Classes and namespaces

| Namespace              | Class          | Description          |
|------------------------|----------------|----------------------|
| Seworqs\ComposerEditor | ComposerEditor | Nice Composer editor |


## License

Apache-2.0, see [LICENSE](./LICENSE)

## About SEworqs
Seworqs builds clean, reusable modules for PHP and Mendix developers.

Learn more at [github.com/seworqs](https://github.com/seworqs)

## Badges
[![Latest Version](https://img.shields.io/packagist/v/seworqs/composer-editor.svg?style=flat-square)](https://packagist.org/packages/seworqs/composer-editor)
[![Total Downloads](https://img.shields.io/packagist/dt/seworqs/composer-editor.svg?style=flat-square)](https://packagist.org/packages/seworqs/composer-editor)
[![License](https://img.shields.io/packagist/l/seworqs/composer-editor?style=flat-square)](https://packagist.org/packages/seworqs/composer-editor)
[![PHP Version](https://img.shields.io/packagist/php-v/json/composer-editor.svg?style=flat-square)](https://packagist.org/packages/seworqs/composer-editor)
[![Made by SEworqs](https://img.shields.io/badge/made%20by-SEworqs-002d74?style=flat-square&logo=https://raw.githubusercontent.com/seworqs/json/main/assets/logo.svg&logoColor=white)](https://github.com/seworqs)

