<?php
declare(strict_types=1);

/**
 * Test Suite
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Test\Unit;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

use Ticaje\Base\Test\Unit\BaseTest as ParentClass;

/**
 * Class BaseTest
 * @package Ticaje\Connector\Test\Unit
 */
class BaseTest extends ParentClass
{
    /** @var ObjectManager $objectManager */
    protected $objectManager;

    public function setUp()
    {
        parent::setUp();
        $this->objectManager = new ObjectManager($this);
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(ObjectManager::class, $this->objectManager, 'Assert proper service locator instance');
    }
}
