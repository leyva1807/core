<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * 
 *
 * @property int $id
 * @property string|null $act
 * @property object|null $form_data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $json_data
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Form newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Form newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Form query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Form whereAct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Form whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Form whereFormData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Form whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Form whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Form extends Model
{
    public $casts = [
        'form_data'=>'object'
    ];

    public function jsonData(): Attribute
    {
        return new Attribute(
            get: fn () => [
                'type'=>$this->type,
                'is_required'=>$this->is_required,
                'label'=>$this->name,
                'extensions'=>$this->extensions ?? 'null',
                'options'=>json_encode($this->options),
                'old_id'=>'',
            ],
        );
    }
}
