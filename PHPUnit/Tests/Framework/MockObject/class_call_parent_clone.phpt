--TEST--
PHPUnit_Framework_MockObject_Generator::generate('Foo', array(), 'MockFoo', TRUE)
--FILE--
<?php
class Foo
{
    public function __clone()
    {
    }
}

require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/Autoload.php';

$mock = PHPUnit_Framework_MockObject_Generator::generate(
  'Foo',
  array(),
  'MockFoo',
  TRUE
);

print $mock['code'];
?>
--EXPECTF--
class MockFoo extends Foo implements PHPUnit_Framework_MockObject_MockObject
{
    protected $invocationMocker;

    public function __clone()
    {
        $this->invocationMocker = clone $this->__phpunit_getInvocationMocker();
        parent::__clone();
    }

    public function expects(PHPUnit_Framework_MockObject_Matcher_Invocation $matcher)
    {
        return $this->__phpunit_getInvocationMocker()->expects($matcher);
    }

    public function __phpunit_getInvocationMocker()
    {
        if ($this->invocationMocker === NULL) {
            $this->invocationMocker = new PHPUnit_Framework_MockObject_InvocationMocker($this);
        }

        return $this->invocationMocker;
    }

    public function __phpunit_verify()
    {
        $this->__phpunit_getInvocationMocker()->verify();
    }

    public function __phpunit_cleanup()
    {
        $this->invocationMocker = NULL;
    }
}

