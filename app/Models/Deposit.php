<?php

namespace App\Models;

use App\Constants\Status;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $exchange_id
 * @property int $method_code
 * @property string $amount
 * @property string|null $method_currency
 * @property string $charge
 * @property string $rate
 * @property string $final_amount
 * @property object|null $detail
 * @property string|null $btc_amount
 * @property string|null $btc_wallet
 * @property string|null $trx
 * @property int $try
 * @property int $status 1=>success, 2=>pending, 3=>cancel
 * @property int $from_api
 * @property string|null $admin_feedback
 * @property string|null $success_url
 * @property string|null $failed_url
 * @property int|null $last_cron
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Exchange|null $exchange
 * @property-read \App\Models\Gateway|null $gateway
 * @property-read mixed $status_badge
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit approved()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit initiated()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit pending()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit rejected()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit successful()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereAdminFeedback($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereBtcAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereBtcWallet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereExchangeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereFailedUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereFinalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereFromApi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereLastCron($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereMethodCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereMethodCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereSuccessUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereTrx($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereTry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereUserId($value)
 * @mixin \Eloquent
 */
class Deposit extends Model
{
    protected $casts = [
        'detail' => 'object'
    ];

    protected $hidden = ['detail'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function gateway()
    {
        return $this->belongsTo(Gateway::class, 'method_code', 'code');
    }

    public function exchange()
    {
        return $this->belongsTo(Exchange::class, 'exchange_id');
    }

    public function methodName()
    {
        if ($this->method_code < 5000) {
            $methodName = @$this->gatewayCurrency()->name;
        } else {
            $methodName = 'Google Pay';
        }
        return $methodName;
    }

    public function statusBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';
            if ($this->status == Status::PAYMENT_PENDING) {
                $html = '<span class="badge badge--warning">' . trans('Pending') . '</span>';
            } elseif ($this->status == Status::PAYMENT_SUCCESS && $this->method_code >= 1000 && $this->method_code <= 5000) {
                $html = '<span><span class="badge badge--success">' . trans('Approved') . '</span><br>' . diffForHumans($this->updated_at) . '</span>';
            } elseif ($this->status == Status::PAYMENT_SUCCESS && ($this->method_code < 1000 || $this->method_code >= 5000)) {
                $html = '<span class="badge badge--success">' . trans('Succeed') . '</span>';
            } elseif ($this->status == Status::PAYMENT_REJECT) {
                $html = '<span><span class="badge badge--danger">' . trans('Rejected') . '</span><br>' . diffForHumans($this->updated_at) . '</span>';
            } else {
                $html = '<span class="badge badge--dark">' . trans('Initiated') . '</span>';
            }
            return $html;
        });
    }

    // scope
    public function gatewayCurrency()
    {
        return GatewayCurrency::where('method_code', $this->method_code)->where('currency', $this->method_currency)->first();
    }

    public function baseCurrency()
    {
        return @$this->gateway->crypto == Status::ENABLE ? 'USD' : $this->method_currency;
    }

    public function scopePending($query)
    {
        return $query->where('method_code', '>=', 1000)->where('status', Status::PAYMENT_PENDING);
    }

    public function scopeRejected($query)
    {
        return $query->where('method_code', '>=', 1000)->where('status', Status::PAYMENT_REJECT);
    }

    public function scopeApproved($query)
    {
        return $query->where('method_code', '>=', 1000)->where('method_code', '<', 5000)->where('status', Status::PAYMENT_SUCCESS);
    }

    public function scopeSuccessful($query)
    {
        return $query->where('status', Status::PAYMENT_SUCCESS);
    }

    public function scopeInitiated($query)
    {
        return $query->where('status', Status::PAYMENT_INITIATE);
    }
}
