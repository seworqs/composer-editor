<?php

namespace Seworqs\Composer\Enum;

enum EnumComposerAutoloadType: string
{
    case PSR_4 = 'psr-4';
    case PSR_0 = 'psr-0';
    case CLASSMAP = 'classmap';
    case FILES = 'files';
}