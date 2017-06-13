<?php
namespace marsd\Uuid;

use Emadadly\LaravelUuid\UUIDManager;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait UUIDModel
{
    
    /**
     * Boot function from laravel.
     */
    protected static function bootUUIDModel()
    {
        static::creating(function ($model) {
            $model->{config('uuid.default_uuid_column')} = UUIDManager::generate();
        });
        
        static::saving(function ($model) {
            $original_uuid = $model->getOriginal(config('uuid.default_uuid_column'));
            if ($original_uuid !== $model->{config('uuid.default_uuid_column')}) {
                $model->{config('uuid.default_uuid_column')} = $original_uuid;
            }
        });
    }
    
    
    /**
     * Scope  by uuid
     *
     * @param  string  uuid of the model.
     *
     */
    public function scopeUuid($query, $uuid, $first = true)
    {
        $match = preg_match('/^[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/', $uuid);
        
        if (!is_string($uuid) || $match !== 1) {
            throw (new ModelNotFoundException)->setModel(get_class($this));
        }
        
        $results = $query->where(config('uuid.default_uuid_column'), $uuid);
        
        return $first ? $results->firstOrFail() : $results;
    }
    
}