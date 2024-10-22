<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $user_ip
 * @property string|null $city
 * @property string|null $country
 * @property string|null $country_code
 * @property string|null $longitude
 * @property string|null $latitude
 * @property string|null $browser
 * @property string|null $os
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLogin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLogin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLogin query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLogin whereBrowser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLogin whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLogin whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLogin whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLogin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLogin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLogin whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLogin whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLogin whereOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLogin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLogin whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLogin whereUserIp($value)
 * @mixin \Eloquent
 */
class UserLogin extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
