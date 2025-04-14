<?php

namespace Seworqs\Composer\Enum;

enum EnumComposerPackageType: string
{
    case LIBRARY = 'library';
    case PROJECT = 'project';
    case METAPACKAGE = 'metapackage';
    case COMPOSER_PLUGIN = 'composer-plugin';
    case COMPOSER_INSTALLER = 'composer-installer';
}