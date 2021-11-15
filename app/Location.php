<?php

namespace App;

use App\Observers\LocationObserver;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /* Attributes */

    protected static function boot()
    {
        parent::boot();
        static::observe(LocationObserver::class);
    }

    /* Relations */

    public function services()
    {
        return $this->hasMany(BusinessService::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function deals()
    {
        return $this->belongsToMany(Deal::class);
    }

} /* end of class */
