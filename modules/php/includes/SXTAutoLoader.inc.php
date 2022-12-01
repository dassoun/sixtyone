<?php
/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * PaxPamirEditionTwo implementation : © Julien Coignet <breddabasse@hotmail.com>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * modules/php/includes/SCTAutoLoader.inc.php
 *
 */


if (!defined('SXT_MODULES_DIR'))
{
    define('PXP_MODULES_DIR', __DIR__ . "/..");
    define('PXP_MANAGER_DIR', PXP_MODULES_DIR . "/Managers");
    define('PXP_OBJECT_DIR', PXP_MODULES_DIR . "/Objects");

    function PXPClassMapAutoloader(string $className)
    {
        $baseNameSpacePhobyJuan = "PhobyJuan\\SixtyOne";
        $classMap = [
            "$baseNameSpacePhobyJuan\\Managers\\SXTPlayerManager" => PXP_MANAGER_DIR . "/SXTPlayerManager.php",
            "$baseNameSpacePhobyJuan\\Objects\\SXTPlayer" => PXP_OBJECT_DIR . "/SXTPlayer.php",
        ];
        if (array_key_exists($className, $classMap))
        {
            require_once $classMap[$className];
        }
    }

    spl_autoload_register('PXPClassMapAutoloader', true, true);
}