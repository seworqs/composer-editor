<?php

namespace Seworqs\Composer\Enum;

enum EnumComposerStability: string
{
    case DEV = 'dev';
    case ALPHA = 'alpha';
    case BETA = 'beta';
    case RC = 'RC';
    case STABLE = 'stable';
}