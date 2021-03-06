<?php

namespace T4webBaseTest\Domain\Assets;

use T4webBase\Domain\Status;

class EntityStatus1 extends Status {
    
    const ACTIVE    = 1;
    const INACTIVE  = 2;
    const DELETED   = 3;
    
    /**
     * @var array
     */
    protected static $constants = array(
        self::ACTIVE    => 'Active',
        self::INACTIVE  => 'Inactive',
        self::DELETED   => 'Deleted',
    );
    
}
