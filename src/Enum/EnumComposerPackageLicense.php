<?php

namespace Seworqs\Composer\Enum;

enum EnumComposerPackageLicense: string
{
    case MIT = 'MIT';
    case APACHE_2 = 'Apache-2.0';
    case GPL_3 = 'GPL-3.0-or-later';
    case LGPL_3 = 'LGPL-3.0-or-later';
    case BSD_3 = 'BSD-3-Clause';
    case PROPRIETARY = 'Proprietary';
}
