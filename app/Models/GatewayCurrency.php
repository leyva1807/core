<?php

namespace App\Models;

use App\Constants\Status;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property string $currency
 * @property string $symbol
 * @property int|null $method_code
 * @property string|null $gateway_alias
 * @property string $rate
 * @property string|null $gateway_parameter
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Gateway|null $method
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GatewayCurrency baseCurrency()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GatewayCurrency baseSymbol()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GatewayCurrency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GatewayCurrency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GatewayCurrency query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GatewayCurrency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GatewayCurrency whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GatewayCurrency whereGatewayAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GatewayCurrency whereGatewayParameter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GatewayCurrency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GatewayCurrency whereMethodCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GatewayCurrency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GatewayCurrency whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GatewayCurrency whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GatewayCurrency whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GatewayCurrency extends Model
{
    protected $hidden = [
        'gateway_parameter'
    ];

    protected $casts = ['status' => 'boolean'];

    // Relation
    public function method()
    {
        return $this->belongsTo(Gateway::class, 'method_code', 'code');
    }

    public function currencyIdentifier()
    {
        return $this->name ?? $this->method->name . ' ' . $this->currency;
    }

    public function scopeBaseCurrency()
    {
        return $this->method->crypto == Status::ENABLE ? 'USD' : $this->currency;
    }

    public function scopeBaseSymbol()
    {
        return $this->method->crypto == Status::ENABLE ? '$' : $this->symbol;
    }
}
