<?php

namespace Modules\Profile\Entities;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $table = 'profile__profiles';
    protected $fillable = [
        'display_name',
        'phone',
        'postcode',
        'address',
        'address_detail',
    ];

    /**
     * User Relation
     * @return BelongsTo
     */
    public function user()
    {
        $driver = config('asgard.user.users.driver');
        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
    }

    /**
     * Set DisplayName Attribute
     * @param string $value
     */
    public function setDisplayNameAttribute($value)
    {
        if(locale() == 'ko') {
            $this->attributes['display_name'] = "{$this->user->last_name} {$this->user->first_name}";
        }
        else {
            $this->attributes['display_name'] = "{$this->user->first_name} {$this->user->last_name}";
        }
    }
}
