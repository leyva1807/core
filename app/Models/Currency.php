<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\CommonScope;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $gateway_id 0 = manual
 * @property string|null $name
 * @property string|null $cur_sym
 * @property string $conversion_rate
 * @property string $percent_decrease
 * @property string $percent_increase
 * @property string|null $sell_at
 * @property string $buy_at
 * @property string $fixed_charge_for_sell
 * @property string $percent_charge_for_sell
 * @property string $fixed_charge_for_buy
 * @property string $percent_charge_for_buy
 * @property string $reserve
 * @property string $minimum_limit_for_sell
 * @property string $maximum_limit_for_sell
 * @property string $minimum_limit_for_buy
 * @property string $maximum_limit_for_buy
 * @property int $user_detail_form_id
 * @property string|null $instruction
 * @property string|null $image
 * @property int $available_for_sell
 * @property int $available_for_buy
 * @property int $show_rate
 * @property int $status 1=enabled,0=disabled
 * @property int $trx_proof_form_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Gateway|null $gatewayCurrency
 * @property-read mixed $status_badge
 * @property-read \App\Models\Form|null $transactionProvedData
 * @property-read \App\Models\Form|null $userDetailsData
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency asc($column = 'id')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency availableForBuy()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency availableForSell()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency desc($column = 'id')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency disabled()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency enabled()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency inactive()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereAvailableForBuy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereAvailableForSell($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereBuyAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereConversionRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereCurSym($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereFixedChargeForBuy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereFixedChargeForSell($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereGatewayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereInstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereMaximumLimitForBuy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereMaximumLimitForSell($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereMinimumLimitForBuy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereMinimumLimitForSell($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency wherePercentChargeForBuy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency wherePercentChargeForSell($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency wherePercentDecrease($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency wherePercentIncrease($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereReserve($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereSellAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereShowRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereTrxProofFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereUserDetailFormId($value)
 * @mixin \Eloquent
 */
class Currency extends Model
{
    use CommonScope, GlobalStatus;

    public function gatewayCurrency()
    {
        return $this->belongsTo(Gateway::class, 'gateway_id');
    }

    public function userDetailsData()
    {
        return $this->belongsTo(Form::class, 'user_detail_form_id');
    }

    public function transactionProvedData()
    {
        return $this->belongsTo(Form::class, 'trx_proof_form_id');
    }

    public function scopeAvailableForSell($query)
    {
        return $query->where('available_for_sell', Status::YES);
    }

    public function scopeAvailableForBuy($query)
    {
        return $query->where('available_for_buy', Status::YES);
    }
}
