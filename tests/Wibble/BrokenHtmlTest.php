<?php
/**
 * Wibble
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://github.com/padraic/wibble/blob/master/LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to padraic@php.net so we can send you a copy immediately.
 *
 * @category   Mockery
 * @package    Mockery
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2010 Pádraic Brady (http://blog.astrumfutura.com)
 * @license    http://github.com/padraic/wibble/blob/master/LICENSE New BSD License
 */

/**
 * @namespace
 */
namespace WibbleTest;
use Wibble;

class BrokenHtmlTest extends \PHPUnit_Framework_TestCase
{

    public function testUnclosedTagIsClosedWhenLoaded()
    {
        $fragment = new Wibble\HTML\Fragment('This is <strong>Sparta!');
        $fragment->filter(array('strong'=>array()));
        $this->assertEquals('This is <strong>Sparta!</strong>', $fragment->toString());
    }
    
    public function testBrokenLoneTagShouldGreedilyStripAllPotentialTag()
    {
        $fragment = new Wibble\HTML\Fragment('This is <strongSparta!</strong>');
        $fragment->filter(array('strong'=>array()));
        $this->assertEquals('This is', $fragment->toString());
    }
    
    public function testBrokenTagShouldGreedilyStripAllPotentialTagUntilNextValidTag()
    {
        $fragment = new Wibble\HTML\Fragment('This is <strongSparta!</strong><em>Sparta!!!</em>');
        $fragment->filter(array('strong'=>array(),'em'=>array()));
        $this->assertEquals('This is <em>Sparta!!!</em>', $fragment->toString());
    }

}
