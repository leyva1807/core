<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $email
 * @property string|null $token
 * @property int $status
 * @property string|null $created_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminPasswordReset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminPasswordReset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminPasswordReset query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminPasswordReset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminPasswordReset whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminPasswordReset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminPasswordReset whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminPasswordReset whereToken($value)
 * @mixin \Eloquent
 */
class AdminPasswordReset extends Model
{
    protected $table = "admin_password_resets";
    protected $guarded = ['id'];
    public $timestamps = false;
}
