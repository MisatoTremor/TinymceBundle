<?php

namespace Stfalcon\Bundle\TinymceBundle\Composer;

use Composer\Script\Event;
use Sensio\Bundle\DistributionBundle\Composer\ScriptHandler as BaseScriptHandler;

/**
 * Class ScriptHandler.
 *
 * @package Stfalcon\Bundle\TinymceBundle\Composer
 */
class ScriptHandler extends BaseScriptHandler
{
    /**
     * @param Event $event
     */
    public static function createSymlink(Event $event)
    {
        $options = self::getOptions($event);
        $consoleDir = self::getConsoleDir($event, 'hello world');

        if (null === $consoleDir) {
            return;
        }

        static::executeCommand($event, $consoleDir, 'stfalcon:tinymce:symlink', $options['process-timeout']);
    }
}
