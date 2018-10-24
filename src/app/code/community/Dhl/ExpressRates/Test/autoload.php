<?php
/**
 * See LICENSE.md for license details.
 */

// NOTE: bootstrapping is done before module configs are processed.
require_once __DIR__ . '/../Helper/Autoloader.php';
$autoloader = new Dhl_ExpressRates_Helper_Autoloader();

$autoloader->addNamespace(
    "Psr\\", // prefix
    sprintf('%s/Dhl/ExpressRates/Psr/', Mage::getBaseDir('lib'))
);

$autoloader->addNamespace(
    "Dhl\\Express\\", // prefix
    sprintf('%s/Dhl/ExpressRates/SdkApiExpress/', Mage::getBaseDir('lib'))
);

$autoloader->register();
