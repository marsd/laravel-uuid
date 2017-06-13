<?php
namespace marsd\Uuid;

use MysqlUuid\Formats\ReorderedString;
use MysqlUuid\Uuid as MysqlUuid;
use Ramsey\Uuid\Uuid;

class UUIDManager
{
    
    /**
     * @type string
     */
    private $uuid;
    
    
    public function __construct()
    {
        $uuid = $this->generate();
        
        $this->uuid = $uuid;
        
        return $uuid;
    }
    
    /*    public function __toString()
        {
            return $this->uuid;
        }*/
    
    /**
     *
     * This function will return a UUID
     *
     * @return type string
     */
    public static function generate()
    {
        /**
         * We use a special re-ordered UUID v1 for much more optimized indexing of keys
         */
        $uuid      = Uuid::uuid1()->toString();
        $reordered = new MysqlUuid($uuid);
        
        return str_replace('-', '', $reordered->toFormat(new ReorderedString()));
    }
} 