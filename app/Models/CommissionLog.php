<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $who
 * @property string|null $level
 * @property string $amount
 * @property string $main_amo
 * @property string|null $title
 * @property string|null $trx
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $userFrom
 * @property-read \App\Models\User|null $userTo
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommissionLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommissionLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommissionLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommissionLog whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommissionLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommissionLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommissionLog whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommissionLog whereMainAmo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommissionLog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommissionLog whereTrx($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommissionLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommissionLog whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CommissionLog whereWho($value)
 * @mixin \Eloquent
 */
class CommissionLog extends Model
{
    public function userTo()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userFrom()
    {
        return $this->belongsTo(User::class, 'who');
    }
}
