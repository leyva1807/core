<?php

namespace App\Models;

use App\Traits\ApiQuery;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $user_type
 * @property string|null $sender
 * @property string|null $sent_from
 * @property string|null $sent_to
 * @property string|null $subject
 * @property string|null $message
 * @property string|null $notification_type
 * @property string|null $image
 * @property int $user_read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationLog apiQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationLog whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationLog whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationLog whereNotificationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationLog whereSender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationLog whereSentFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationLog whereSentTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationLog whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationLog whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationLog whereUserRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationLog whereUserType($value)
 * @mixin \Eloquent
 */
class NotificationLog extends Model
{
    use ApiQuery;

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
