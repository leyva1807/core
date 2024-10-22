<?php

namespace App\Models;

use App\Traits\CommonScope;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $level
 * @property string|null $percent
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Referral asc($column = 'id')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Referral desc($column = 'id')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Referral disabled()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Referral enabled()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Referral newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Referral newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Referral query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Referral whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Referral whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Referral whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Referral wherePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Referral whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Referral whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Referral extends Model
{
    use CommonScope;
}
