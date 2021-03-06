<?php

namespace T4webBaseTest\Domain\Factory;

use T4webBase\Domain\Factory\EntityFactory;

class EntityFactoryTest extends \PHPUnit_Framework_TestCase {
    
    /**
     * @dataProvider providerCreate
     */
    public function testCreate($entityClassName, $collectionClassName) {
        $EntityFactory = new EntityFactory($entityClassName, $collectionClassName);
        
        $actualEntity = $EntityFactory->create(array('id' => 'foo'));
        
        $this->assertInstanceOf($entityClassName, $actualEntity);
        $this->assertAttributeEquals('foo', 'id', $actualEntity);
    }
    
    /**
     * @dataProvider providerCreate
     */
    public function testCreateCollection($entityClassName, $collectionClassName) {
        $EntityFactory = new EntityFactory($entityClassName, $collectionClassName);
        
        $actualCollection = $EntityFactory->createCollection(array(
            array('id' => 'bar'),
            array('id' => 'foo')
            ));
        
        $this->assertInstanceOf($collectionClassName, $actualCollection);
        $this->assertInstanceOf($entityClassName, $actualCollection['bar']);
        $this->assertAttributeEquals('bar', 'id', $actualCollection['bar']);
        $this->assertAttributeEquals('foo', 'id', $actualCollection['foo']);
    }
    
    public function providerCreate() {
        return array(
            array('T4webBase\Domain\Entity', 'T4webBase\Domain\Collection'),
            array('T4webBase\Domain\Entity', 'ArrayObject'),
        );
    }
    
}
