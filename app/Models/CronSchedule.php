<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property int $interval
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $status_badge
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronSchedule active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronSchedule inactive()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronSchedule query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronSchedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronSchedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronSchedule whereInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronSchedule whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronSchedule whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronSchedule whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CronSchedule extends Model
{
    use GlobalStatus;
}
