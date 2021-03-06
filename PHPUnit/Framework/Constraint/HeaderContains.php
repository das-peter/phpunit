<?php
/**
 * PHPUnit
 *
 * Copyright (c) 2002-2009, Sebastian Bergmann <sb@sebastian-bergmann.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category   Testing
 * @package    PHPUnit
 * @author     Peter Philipp <info@das-peter.ch>
 * @copyright  2010 Swisscom Schweiz AG
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    SVN: $Id: HeaderContains.php 5164 2009-08-29 10:38:39Z sb $
 * @link       http://www.phpunit.de/
 * @since      File available since Release 3.x
 */

require_once 'PHPUnit/Framework.php';
require_once 'PHPUnit/Util/Filter.php';
require_once 'PHPUnit/Util/Type.php';

PHPUnit_Util_Filter::addFileToFilter(__FILE__, 'PHPUNIT');

/**
 * Constraint that asserts that the sent headers contains a string
 *
 * The needle is passed in the constructor.
 *
 * @category   Testing
 * @package    PHPUnit
 * @author     Peter Philipp <info@das-peter.ch>
 * @copyright  2010 Swisscom Schweiz AG
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: 3.x
 * @link       http://www.phpunit.de/
 * @since      Class available since Release 3.x
 */
class PHPUnit_Framework_Constraint_HeaderContains extends PHPUnit_Framework_Constraint
{
    /**
     * @var string
     */
    protected $string;

    /**
     * @var boolean
     */
    protected $ignoreCase;
    
    /**
     * @var boolean
     */
    protected $exactFit;

    /**
     * @param string  $string
     * @param boolean $ignoreCase
     * @param boolean $exactFit
     */
    public function __construct($string, $ignoreCase = FALSE, $exactFit = FALSE)
    {
        $this->string     = $string;
        $this->ignoreCase = $ignoreCase;
        $this->exactFit = $exactFit;
    }

    /**
     * Evaluates the constraint for parameter $other. Returns TRUE if the
     * constraint is met, FALSE otherwise.
     *
     * @param mixed $other Value or object to evaluate.
     * @return bool
     */
    public function evaluate($other)
    {
        foreach($other as $headerItem){
            
            switch(true){
                case !$this->exactFit && !$this->ignoreCase:
                    if(strpos($headerItem, $this->string) !== FALSE){
                        return true;
                    }
                    break;
                    
                case !$this->exactFit && $this->ignoreCase:
                    if(stripos($headerItem, $this->string) !== FALSE){
                        return true;
                    }
                    break;
                    
                case $this->exactFit && $this->ignoreCase:
                    if(strtolower($headerItem)===strtolower($this->string)){
                        return true;
                    }
                    break;
                    
                case $this->exactFit && !$this->ignoreCase:
                    if($headerItem===$this->string){
                        return true;
                    }
                    break;
            }  
        }
        return false;
    }

    /**
     * Returns a string representation of the constraint.
     *
     * @return string
     */
    public function toString()
    {
        return (($this->exactFit)?'fits exact to ':'contains the string ') . PHPUnit_Util_Type::toString($this->string);
    }

    /**
     * @param mixed   $other
     * @param string  $description
     * @param boolean $not
     */
    protected function customFailureDescription($other, $description, $not)
    {
        return sprintf(
          'Failed asserting that there\'s a header which %s.',

           $this->toString()
        );
    }
}
?>
