--TEST--
phpunit --process-isolation --filter testBalanceIsInitiallyZero BankAccountTest ../../Samples/BankAccount/BankAccountTest.php
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--process-isolation';
$_SERVER['argv'][3] = '--filter';
$_SERVER['argv'][4] = 'testBalanceIsInitiallyZero';
$_SERVER['argv'][5] = 'BankAccountTest';
$_SERVER['argv'][6] = '../Samples/BankAccount/BankAccountTest.php';

require_once dirname(dirname(dirname(__FILE__))) . '/Autoload.php';
PHPUnit_TextUI_Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann.

.

Time: %i %s, Memory: %sMb

OK (1 test, 1 assertion)
