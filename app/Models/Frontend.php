<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $data_keys
 * @property object|null $data_values
 * @property object|null $seo_content
 * @property string|null $tempname
 * @property string|null $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Frontend getContent()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Frontend newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Frontend newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Frontend query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Frontend whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Frontend whereDataKeys($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Frontend whereDataValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Frontend whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Frontend whereSeoContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Frontend whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Frontend whereTempname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Frontend whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Frontend extends Model
{
    protected $casts = [
        'data_values' => 'object',
        'seo_content'=>'object'
    ];

    public static function scopeGetContent($data_keys)
    {
        return Frontend::where('data_keys', $data_keys);
    }
}
