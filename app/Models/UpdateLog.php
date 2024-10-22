<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $version
 * @property object|null $update_log
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UpdateLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UpdateLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UpdateLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UpdateLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UpdateLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UpdateLog whereUpdateLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UpdateLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UpdateLog whereVersion($value)
 * @mixin \Eloquent
 */
class UpdateLog extends Model
{
    protected $casts = ['update_log' => 'object'];
}
