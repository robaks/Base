<?php


namespace T4webBaseTest\Domain\Criteria;

class AbstractCriteriaEmptyTest extends \PHPUnit_Framework_TestCase {
    
    protected $testClass = 'T4webBaseTest\Domain\Criteria\TestAsset\FooCriteria';
    protected $testTable = 'fooTable';
    
    public function testAttributes() {
        $criteria = new $this->testClass();
        
        $this->assertAttributeEquals($this->testTable, 'table', $criteria);
    }
    
    public function testBuild() {
        $criteria = new $this->testClass();
        
        $queryBuilderMock = $this->getMock('T4webBase\Db\QueryBuilderInterface');
        $queryBuilderMock->expects($this->once())
                ->method('from')
                ->with($this->equalTo($this->testTable));
        
        $criteria->build($queryBuilderMock);
    }
    
    public function testBuildAsForeign() {
        $criteria = new $this->testClass();
        $criteria->setAsForeign();
        
        $queryBuilderMock = $this->getMock('T4webBase\Db\QueryBuilderInterface');
        $queryBuilderMock->expects($this->never())->method('from');
        
        $criteria->build($queryBuilderMock);
    }
    
}