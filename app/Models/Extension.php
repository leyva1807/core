<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $act
 * @property string|null $name
 * @property string|null $description
 * @property string|null $image
 * @property string|null $script
 * @property object|null $shortcode object
 * @property string|null $support help section
 * @property int $status 1=>enable, 2=>disable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $status_badge
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extension active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extension generateScript()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extension inactive()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extension newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extension newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extension query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extension whereAct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extension whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extension whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extension whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extension whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extension whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extension whereScript($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extension whereShortcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extension whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extension whereSupport($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Extension whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Extension extends Model
{
    use GlobalStatus;

    protected $casts = [
        'shortcode' => 'object',
    ];

    protected $hidden = ['script','shortcode'];

    public function scopeGenerateScript()
    {
        $script = $this->script;
        foreach ($this->shortcode as $key => $item) {
            $script = str_replace('{{' . $key . '}}', $item->value, $script);
        }
        return $script;
    }
}
