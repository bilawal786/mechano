<?php

namespace App;

use Carbon\Carbon;
use App\Observers\DealObserver;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{

    /* Attributes */

    private $settings;

    public function __construct()
    {
        parent::__construct();
        $this->settings = CompanySetting::first();
    }

    protected static function boot()
    {
        parent::boot();
        static::observe(DealObserver::class);
    }

    protected $appends = [
        'deal_image_url', 'applied_between_time', 'deal_detail_url'
    ];

    /* Relations */

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function services()
    {
        return $this->hasMany(DealItem::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function dealTaxes()
    {
        return $this->hasMany(ItemTax::class, 'deal_id', 'id');
    }

    /* Scopes */

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /* Accessors */

    public function getDealImageUrlAttribute()
    {
        if(is_null($this->image)){
            return asset('assets-new/media/project/project-5.png');
        }

        return asset_url('deal/'.$this->image);
    }

    public function getAppliedBetweenTimeAttribute()
    {
        return $this->open_time.' - '.$this->close_time;
    }

    public function getStartDateAttribute($value)
    {
        $date = new Carbon($value);
        return $date->format('Y-m-d h:i A');
    }

    public function getEndDateAttribute($value)
    {
        $date = new Carbon($value);
        return $date->format('Y-m-d h:i A');
    }

    public function getOpenTimeAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value)->setTimezone($this->settings->timezone)->format($this->settings->time_format);
    }

    public function getCloseTimeAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value)->setTimezone($this->settings->timezone)->format($this->settings->time_format);
    }

    public function getmaxOrderPerCustomerAttribute($value)
    {
        if($this->uses_limit == 0 && $value == 0) {
            return 'Infinite';
        }
        elseif($this->uses_limit > 0 && ($value == 0 || $value == '')) {
            return $this->uses_limit;
        }
        return $value;
    }

    public function getTotalTaxPercentAttribute()
    {
        if (!$this->dealTaxes) {
            return 0;
        }

        $taxPercent = 0;

        foreach ($this->dealTaxes as $key => $tax) {
            $taxPercent += $tax->tax->percent;
        }

        return $taxPercent;
    }

    public function getDealDetailUrlAttribute()
    {
        return route('front.dealDetail', ['dealSlug' => $this->slug, 'dealId' => $this->id]);
    }

    /* Mutator */

    public function setLocationIdAttribute($value)
    {
        $this->attributes['location_id'] = Location::where('name', $value)->first()->id;
    }

} /* end of class */
