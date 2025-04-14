## Usage examples

The `ComposerEditor` inherits the `JsonEditor`, so you can use all its functionality.

> See:
> 
> https://packagist.org/packages/seworqs/json-editor
> https://github.com/seworqs/json-editor

## Basic

```php
use Seworqs\Composer\ComposerEditor;
use Seworqs\Composer\Enum\EnumComposerAutoloadType;
use Seworqs\Composer\Enum\EnumComposerPackageLicense;
use Seworqs\Composer\Enum\EnumComposerPackageType;
use Seworqs\Composer\Enum\EnumComposerStability;
use Seworqs\Composer\Enum\EnumComposerSupportType;

// === CREATE NEW FILE ===
$editor = ComposerEditor::createNew('path/to/composer.json', true);

$editor
    // Basic info
    ->addProjectName('seworqs/new-project')
    ->addDescription('Some nice project!')
    ->addType(EnumComposerPackageType::LIBRARY)
    ->addLicense(EnumComposerPackageLicense::APACHE_2)

    // Meta
    ->addAuthor('J. Doe', 'jd@somecompany.com')
    ->addHomepage('https://github.com/seworqs/new-project')
    ->addKeywords('example', 'json', 'composer', 'seworqs')
    ->addSupport(EnumComposerSupportType::ISSUES, 'https://github.com/seworqs/new-project/issues')
    ->addSupport(EnumComposerSupportType::SOURCE, 'https://github.com/seworqs/new-project')

    // Dependencies
    ->addRequire('php', '^8.1')
    ->addRequire('somevendor/somepackage', '^1.0')
    ->addRequireDev('phpunit/phpunit', '^11')

    // Autoload (PSR-4)
    ->addAutoloadFromName()
    ->addAutoloadDevFromName()
    
    // Or add custom autoload.
    //->addAutoload(EnumComposerAutoloadType::PSR_4, 'Some\\Namespace\\', 'src/');
    //->addAutoloadDev(EnumComposerAutoloadType::PSR_4, 'Some\\Namespace\\Test\\', 'src/');
    
    // Scripts
    ->addScript('test', 'phpunit')
    ->addScript('analyse', ['phpstan', 'php-cs-fixer'])

    // Extra
    ->addBin('bin/console')
    ->addConfig('optimize-autoloader', true)
    ->addSuggest('vendor/extra-features', 'This is just a dummy suggestion for demonstration purposes')
    ->addMinimumStability(EnumComposerStability::STABLE)

    ->save();

    // And there are also getters.
    
    // Simple string return.
    $projectName = $editor->getProjectName();
    
    // Get array of all scripts.
    $scripts = $composer->getScripts();    
    
    // Get specific script
    $script = $composer->getScript('cleanup');   

    // Etc.
```
## Advanced

```php

// You can add other autoload types.
$editor = ComposerEditor::createNew('path/to/composer.json', true);

// Files and Classmap
$editor->addAutoloadPath($type, $path);
$editor->addAutoloadDevPath($type, $path);

```

> For more examples, you could take a look at the test files.