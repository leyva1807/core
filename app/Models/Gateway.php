<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $form_id
 * @property string|null $code
 * @property string|null $name
 * @property string $alias
 * @property int $status 1=>enable, 2=>disable
 * @property string|null $gateway_parameters
 * @property object|null $supported_currencies
 * @property int $crypto 0: fiat currency, 1: crypto currency
 * @property object|null $extra
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\GatewayCurrency> $currencies
 * @property-read int|null $currencies_count
 * @property-read \App\Models\Form|null $form
 * @property-read \App\Models\GatewayCurrency|null $singleCurrency
 * @property-read mixed $status_badge
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway automatic()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway crypto()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway inactive()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway manual()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway whereCrypto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway whereExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway whereGatewayParameters($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway whereSupportedCurrencies($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gateway whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Gateway extends Model
{
    use GlobalStatus;

    protected $hidden = [
        'gateway_parameters','extra'
    ];

    protected $casts = [
        'code' => 'string',
        'extra' => 'object',
        'input_form'=> 'object',
        'supported_currencies'=>'object'
    ];

    public function currencies()
    {
        return $this->hasMany(GatewayCurrency::class, 'method_code', 'code');
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function singleCurrency()
    {
        return $this->hasOne(GatewayCurrency::class, 'method_code', 'code')->orderBy('id','desc');
    }

    public function scopeCrypto()
    {
        return $this->crypto == Status::ENABLE ? 'crypto' : 'fiat';
    }

    public function scopeAutomatic($query)
    {
        return $query->where('code', '<', 1000);
    }

    public function scopeManual($query)
    {
        return $query->where('code', '>=', 1000);
    }
}
