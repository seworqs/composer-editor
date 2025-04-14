<?php

namespace Seworqs\Composer\Test;

use PHPUnit\Framework\TestCase;
use Seworqs\Composer\ComposerEditor;
use Seworqs\Composer\Enum\EnumComposerPackageLicense;
use Seworqs\Composer\Enum\EnumComposerPackageType;
use Seworqs\Composer\Enum\EnumComposerStability;
use Seworqs\Composer\Enum\EnumComposerSupportType;

class ComposerEditorTest extends TestCase {

    private string $_pathToTestFile = __DIR__ . '/json/test.json';
    private string $_pathToTemplateFile = __DIR__ . '/json/template.json';

    public function tearDown(): void
    {
        // Clean up test.json.
        //unlink($this->_pathToTestFile);
        parent::tearDown();
    }

    public function testCreateNewJsonFile()
    {

        // === CREATE NEW FILE ===
        $editor = ComposerEditor::createNew($this->_pathToTestFile, true);

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

            // Autoload
            ->addAutoloadFromName()
            ->addAutoloadDevFromName()

            // Scripts
            ->addScript('test', 'phpunit')
            ->addScript('analyse', ['phpstan', 'php-cs-fixer'])

            // Extra
            ->addBin('bin/console')
            ->addConfig('optimize-autoloader', true)
            ->addSuggest('vendor/extra-features', 'This is just a dummy suggestion for demonstration purposes')
            ->addMinimumStability(EnumComposerStability::STABLE)

            ->save();

        // Check file existence and valid JSON.
        $this->assertFileExists($this->_pathToTestFile);
        $this->assertJson(file_get_contents($this->_pathToTestFile));

        // Compare with template file (and testing createFromFile also...)
        $tmplEditor = ComposerEditor::createFromFile($this->_pathToTemplateFile);
        $this->assertEquals($tmplEditor->toArray(), $editor->toArray());
    }
}