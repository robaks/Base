<?php

namespace T4webBase\Domain\Service;

use T4webBase\InputFilter\InputFilterInterface;
use T4webBase\Domain\Repository\DbRepository;
use T4webBase\Domain\Factory\EntityFactoryInterface;
use Zend\EventManager\EventManagerInterface;

class NewCreate implements NewCreateInterface {
    
    protected $inputFilter;
    
    protected $repository;
    
    protected $entityFactory;
    
    protected $eventManager;

    public function __construct(
            InputFilterInterface $inputFilter,
            DbRepository $repository,
            EntityFactoryInterface $entityFactory,
            EventManagerInterface $eventManager) {
        
        $this->inputFilter = $inputFilter;
        $this->repository = $repository;
        $this->entityFactory = $entityFactory;
        $this->eventManager = $eventManager;
    }
    
    public function create(array $data) {
        
        $this->inputFilter->setData($data);
        if (!$this->inputFilter->isValid()) {
            return false;
        }
        
        $data = $this->inputFilter->getValues();
        
        if (empty($data)) {
            throw new \RuntimeException("Cannot create entity form empty data");
        }
        
        $entity = $this->entityFactory->create($data);
        $this->repository->add($entity);
        $this->eventManager->trigger(__FUNCTION__ . ':post', $this, compact('entity'));
        
        return $entity;
    }
    
    public function getMessages() {
        return $this->inputFilter->getMessages();
    }
    
    public function getValues() {
        return $this->inputFilter->getValues();
    }
}
