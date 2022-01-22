<?php
namespace App\Traits;

trait SelfRef{
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');

    }
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }


}
