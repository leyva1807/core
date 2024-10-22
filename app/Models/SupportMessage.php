<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $support_ticket_id
 * @property int $admin_id
 * @property string|null $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Admin|null $admin
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SupportAttachment> $attachments
 * @property-read int|null $attachments_count
 * @property-read \App\Models\SupportTicket|null $ticket
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportMessage whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportMessage whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportMessage whereSupportTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SupportMessage extends Model
{
    public function ticket()
    {
        return $this->belongsTo(SupportTicket::class, 'support_ticket_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany(SupportAttachment::class, 'support_message_id', 'id');
    }
}
