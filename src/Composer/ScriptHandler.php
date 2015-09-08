<?php

namespace Stfalcon\Bundle\TinymceBundle\Composer;

use Composer\Script\Event;
use Mopa\Bridge\Composer\Util\ComposerPathFinder;
use Stfalcon\Bundle\TinymceBundle\Command\TinymceSymlinkCommand;

/**
 * Class ScriptHandler.
 */
class ScriptHandler
{
    public static function postInstallSymlinkTinymce(Event $event)
    {
        $IO = $event->getIO();
        $composer = $event->getComposer();
        $cmanager = new ComposerPathFinder($composer);
        $options = array(
            'targetSuffix' => self::getTargetSuffix(),
            'sourcePrefix' => '..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR,
        );
        list($symlinkTarget, $symlinkName) = $cmanager->getSymlinkFromComposer(
            TinymceSymlinkCommand::$tinymceBundleName,
            TinymceSymlinkCommand::$tinymceName,
            $options
        );
        $IO->write('Checking Symlink', false);
        if (false === TinymceSymlinkCommand::checkSymlink($symlinkTarget, $symlinkName, true)) {
            $IO->write('Creating Symlink: '.$symlinkName, false);
            TinymceSymlinkCommand::createSymlink($symlinkTarget, $symlinkName);
        }
        $IO->write(' ... <info>OK</info>');
    }

    public static function postInstallMirrorTinymce(Event $event)
    {
        $IO = $event->getIO();
        $composer = $event->getComposer();
        $cmanager = new ComposerPathFinder($composer);
        $options = array(
            'targetSuffix' => self::getTargetSuffix(),
            'sourcePrefix' => '..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR,
        );
        list($symlinkTarget, $symlinkName) = $cmanager->getSymlinkFromComposer(
            TinymceSymlinkCommand::$tinymceBundleName,
            TinymceSymlinkCommand::$tinymceName,
            $options
        );
        $IO->write('Checking Mirror', false);
        if (false === TinymceSymlinkCommand::checkSymlink($symlinkTarget, $symlinkName)) {
            $IO->write('Creating Mirror: '.$symlinkName, false);
            TinymceSymlinkCommand::createMirror($symlinkTarget, $symlinkName);
        }
        $IO->write(' ... <info>OK</info>');
    }

    protected static function getTargetSuffix()
    {
        return DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'tinymce';
    }
}
