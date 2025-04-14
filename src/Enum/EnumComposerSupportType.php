<?php

namespace Seworqs\Composer\Enum;

enum EnumComposerSupportType: string
{
    case EMAIL = 'email';
    case ISSUES = 'issues';
    case FORUM = 'forum';
    case WIKI = 'wiki';
    case IRC = 'irc';
    case SOURCE = 'source';
    case DOCS = 'docs';
    case RSS = 'rss';
    case CHAT = 'chat';
}