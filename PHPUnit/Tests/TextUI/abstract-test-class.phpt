--TEST--
phpunit AbstractTest ../_files/AbstractTest.php
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = 'AbstractTest';
$_SERVER['argv'][3] = dirname(dirname(__FILE__)) . '/_files/AbstractTest.php';

require_once dirname(dirname(dirname(__FILE__))) . '/TextUI/Command.php';
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann.

F

Time: %i seconds

There was 1 failure:

1) Warning(PHPUnit_Framework_Warning)
Cannot instantiate class "AbstractTest".
%s/abstract-test-class.php:%i

FAILURES!
Tests: 1, Assertions: 0, Failures: 1.
