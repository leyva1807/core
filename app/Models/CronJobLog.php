<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $cron_job_id
 * @property string|null $start_at
 * @property string|null $end_at
 * @property int $duration
 * @property string|null $error
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronJobLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronJobLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronJobLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronJobLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronJobLog whereCronJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronJobLog whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronJobLog whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronJobLog whereError($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronJobLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronJobLog whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CronJobLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CronJobLog extends Model
{
}
