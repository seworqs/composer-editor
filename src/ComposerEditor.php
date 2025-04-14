<?php

namespace Seworqs\Composer;

use Seworqs\Commons\String\Helper\NamespaceHelper;
use Seworqs\Composer\Enum\EnumComposerAutoloadType;
use Seworqs\Composer\Enum\EnumComposerPackageLicense;
use Seworqs\Composer\Enum\EnumComposerPackageType;
use Seworqs\Composer\Enum\EnumComposerStability;
use Seworqs\Composer\Enum\EnumComposerSupportType;
use Seworqs\Json\JsonEditor;

class ComposerEditor extends JsonEditor {

    public function addRequire(string $package, ?string $version): static {
        $this->add("require.{$package}", $version);
        return $this;
    }

    public function getRequire(): array {
        return $this->get('require', []);
    }

    public function getRequireEntry(string $package): ?string {
        return $this->get("require.{$package}", null);
    }

    public function addRequireDev(string $package, ?string $version): static {
        $this->add("require-dev.{$package}", $version);
        return $this;
    }

    public function getRequireDev(): array {
        return $this->get('require-dev', []);
    }

    public function getRequireDevEntry(string $package): ?string {
        return $this->get("require-dev.{$package}", null);
    }

    /**
     * @param string|list<string> $command
     */
    public function addScript(string $name, string|array $command): static {
        $this->add("scripts.{$name}", $command);
        return $this;
    }

    public function getScripts(): array {
        return $this->get('scripts', []);
    }

    public function getScriptEntry(string $name): string|array|null {
        return $this->get("scripts.{$name}", null);
    }

    public function addProjectName(string $name): static {
        $this->add('name', $name);
        return $this;
    }

    public function getProjectName(): string {
        return $this->get('name');
    }

    public function addDescription(string $description): static {
        $this->add('description', $description);
        return $this;
    }

    public function getDescription(): string {
        return $this->get('description');
    }

    public function addType(string|EnumComposerPackageType $type): static {
        $value = $type instanceof EnumComposerPackageType ? $type->value : $type;
        $this->add('type', $value);
        return $this;
    }

    public function getType(): string {
        return $this->get('type');
    }

    public function addLicense(string|EnumComposerPackageLicense $type): static {
        $value = $type instanceof EnumComposerPackageLicense ? $type->value : $type;
        $this->add('license', $value);
        return $this;
    }

    public function getLicense(): string {
        return $this->get('license');
    }

    public function addAuthor(string $name, string $email): static {
        $author = ['name' => $name, 'email' => $email];
        return $this->add('authors', $this->has('authors') ? $author : [$author]);
    }

    public function getAuthors(): array {
        return $this->get('authors', []);
    }

    public function addAutoload(EnumComposerAutoloadType $type, string $namespace, string $path): static {
        if (!in_array($type, [EnumComposerAutoloadType::PSR_4, EnumComposerAutoloadType::PSR_0])) {
            throw new \InvalidArgumentException("This autoload type requires a namespace.");
        }
        return $this->add("autoload.{$type->value}.{$namespace}", $path);
    }

    public function addAutoloadPath(EnumComposerAutoloadType $type, string $path): static {
        if (!in_array($type, [EnumComposerAutoloadType::FILES, EnumComposerAutoloadType::CLASSMAP])) {
            throw new \InvalidArgumentException("This autoload type expects a path, not a namespace.");
        }
        return $this->add("autoload.{$type->value}", $path);
    }

    public function addAutoloadFromName(string $path = 'src/'): static {
        if (!$this->has('name')) {
            throw new \RuntimeException('Composer "name" field is not set.');
        }
        $namespace = NamespaceHelper::fromString($this->get('name'))->toNamespace('\\') . '\\';
        return $this->addAutoload(EnumComposerAutoloadType::PSR_4, $namespace, $path);
    }

    public function getAutoload(?EnumComposerAutoloadType $type): array {
        if ($type === null || $type->value === '') {
            return $this->get('autoload', []);
        }
        return $this->get("autoload.{$type->value}", []);
    }

    public function addAutoloadDev(EnumComposerAutoloadType $type, string $namespace, string $path): static {
        if (!in_array($type, [EnumComposerAutoloadType::PSR_4, EnumComposerAutoloadType::PSR_0])) {
            throw new \InvalidArgumentException("This autoload type requires a namespace.");
        }
        return $this->add("autoload-dev.{$type->value}.{$namespace}", $path);
    }

    public function addAutoloadDevPath(EnumComposerAutoloadType $type, string $path): static {
        if (!in_array($type, [EnumComposerAutoloadType::FILES, EnumComposerAutoloadType::CLASSMAP])) {
            throw new \InvalidArgumentException("This autoload type expects a path, not a namespace.");
        }
        return $this->add("autoload-dev.{$type->value}", $path);
    }

    public function addAutoloadDevFromName(string $path = 'tests/'): static {
        if (!$this->has('name')) {
            throw new \RuntimeException('Composer "name" field is not set.');
        }
        $namespace = NamespaceHelper::fromString($this->get('name'))->toNamespace('\\') . '\\Test\\';
        return $this->addAutoloadDev(EnumComposerAutoloadType::PSR_4, $namespace, $path);
    }

    public function getAutoloadDev(?EnumComposerAutoloadType $type): array {
        if ($type === null || $type->value === '') {
            return $this->get('autoload-dev', []);
        }
        return $this->get("autoload-dev.{$type->value}", []);
    }

    public function addMinimumStability(EnumComposerStability $stability): static {
        return $this->add('minimum-stability', $stability->value);
    }

    public function getMinimumStability(): EnumComposerStability {
        return EnumComposerStability::tryFrom($this->get('minimum-stability'));
    }

    public function addKeywords(string ...$keywords): static {
        return $this->add('keywords', $keywords);
    }

    public function getKeywords(): array {
        return $this->get('keywords');
    }

    public function addHomepage(string $url): static {
        return $this->add('homepage', $url);
    }

    public function getHomepage(): string {
        return $this->get('homepage');
    }

    public function addSupport(EnumComposerSupportType $type, string $url): static {
        return $this->add("support.{$type->value}", $url);
    }

    public function getSupport(): array {
        return $this->get('support', []);
    }

    public function getSupportEntry(EnumComposerSupportType $type): ?string {
        return $this->get("support.{$type->value}", null);
    }

    public function addBin(string ...$binaries): static {
        return $this->add('bin', $binaries);
    }

    public function getBin(): array {
        return $this->get('bin');
    }

    public function addConfig(string $key, mixed $value): static {
        return $this->add("config.{$key}", $value);
    }

    public function getConfig(): array {
        return $this->get('config', []);
    }

    public function getConfigEntry(string $key): mixed {
        return $this->get("config.{$key}", null);
    }

    public function addSuggest(string $package, string $reason): static {
        return $this->add("suggest.{$package}", $reason);
    }

    public function getSuggest(): array {
        return $this->get('suggest', []);
    }

    public function getSuggestEntry(string $package): ?string {
        return $this->get("suggest.{$package}", null);
    }
}
