<?php

namespace App\Models;

use App\Constants\Status;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $ticket
 * @property string|null $subject
 * @property int $status 0: Open, 1: Answered, 2: Replied, 3: Closed
 * @property int $priority 1 = Low, 2 = medium, 3 = heigh
 * @property string|null $last_reply
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $fullname
 * @property-read mixed $priority_badge
 * @property-read mixed $status_badge
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SupportMessage> $supportMessage
 * @property-read int|null $support_message_count
 * @property-read \App\Models\User|null $user
 * @property-read mixed $username
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportTicket answered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportTicket closed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportTicket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportTicket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportTicket pending()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportTicket query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportTicket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportTicket whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportTicket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportTicket whereLastReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportTicket whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportTicket wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportTicket whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportTicket whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportTicket whereTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportTicket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportTicket whereUserId($value)
 * @mixin \Eloquent
 */
class SupportTicket extends Model
{
    public function fullname(): Attribute
    {
        return new Attribute(
            get: fn () => $this->name,
        );
    }

    public function username(): Attribute
    {
        return new Attribute(
            get: fn () => $this->email,
        );
    }

    public function statusBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';
            if ($this->status == Status::TICKET_OPEN) {
                $html = '<span class="badge badge--success">' . trans("Open") . '</span>';
            } elseif ($this->status == Status::TICKET_ANSWER) {
                $html = '<span class="badge badge--primary">' . trans("Answered") . '</span>';
            } elseif ($this->status == Status::TICKET_REPLY) {
                $html = '<span class="badge badge--warning">' . trans("Customer Reply") . '</span>';
            } elseif ($this->status == Status::TICKET_CLOSE) {
                $html = '<span class="badge badge--dark">' . trans("Closed") . '</span>';
            }
            return $html;
        });
    }

    public function priorityBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';
            if ($this->priority == Status::PRIORITY_LOW) {
                $html = '<span class="badge badge--dark">' . trans("Low") . '</span>';
            } elseif ($this->priority == Status::PRIORITY_MEDIUM) {
                $html = '<span class="badge badge--success">' . trans("Medium") . '</span>';
            } elseif ($this->priority == Status::PRIORITY_HIGH) {
                $html = '<span class="badge badge--primary">' . trans("High") . '</span>';
            }
            return $html;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supportMessage()
    {
        return $this->hasMany(SupportMessage::class);
    }

    public function scopePending($query)
    {
        return $query->whereIn('status', [Status::TICKET_OPEN, Status::TICKET_REPLY]);
    }

    public function scopeClosed($query)
    {
        return $query->where('status', Status::TICKET_CLOSE);
    }

    public function scopeAnswered($query)
    {
        return $query->where('status', Status::TICKET_ANSWER);
    }
}
