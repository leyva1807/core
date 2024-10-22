<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $ip_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlockedIp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlockedIp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlockedIp query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlockedIp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlockedIp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlockedIp whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlockedIp whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BlockedIp extends Model
{
    protected $fillable = [
        'ip_address'
    ];
}
