<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\CommonScope;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $send_currency_id
 * @property int $receive_currency_id
 * @property string $sending_amount
 * @property string $receiving_amount
 * @property string|null $sending_charge
 * @property string $receiving_charge
 * @property object|null $charge
 * @property string $buy_rate
 * @property string $sell_rate
 * @property string $refund_amount
 * @property int $status 0=Initial, 1=approved,2=pending,3=refund,9=cancel
 * @property int $automatic_payment_status
 * @property string|null $wallet_id
 * @property string|null $exchange_id
 * @property string|null $user_proof
 * @property string|null $admin_trx_no
 * @property string|null $admin_feedback
 * @property object|null $user_data
 * @property object|null $transaction_proof_data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Deposit|null $deposit
 * @property-read \App\Models\Currency|null $receivedCurrency
 * @property-read \App\Models\Currency|null $sendCurrency
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange approved()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange asc($column = 'id')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange canceled()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange desc($column = 'id')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange disabled()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange enabled()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange initiated()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange list()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange pending()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange refunded()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereAdminFeedback($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereAdminTrxNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereAutomaticPaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereBuyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereExchangeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereReceiveCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereReceivingAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereReceivingCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereRefundAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereSellRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereSendCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereSendingAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereSendingCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereTransactionProofData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereUserData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereUserProof($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exchange whereWalletId($value)
 * @mixin \Eloquent
 */
class Exchange extends Model
{
    use CommonScope;

    protected $guarded = ['id'];

    protected $casts = [
        'user_data'               => 'object',
        'transaction_proof_data' => 'object',
        'charge'                  => 'object',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sendCurrency()
    {
        return $this->belongsTo(Currency::class, 'send_currency_id');
    }

    public function receivedCurrency()
    {
        return $this->belongsTo(Currency::class, 'receive_currency_id');
    }

    public function deposit()
    {
        return $this->hasOne(Deposit::class);
    }

    public function scopeList($query)
    {
        return $query->whereIn('status', Status::EXCHANGE_ALL_STATUS);
    }

    public function scopeInitiated($query)
    {
        return $query->where('status', Status::EXCHANGE_INITIAL);
    }

    public function scopePending($query)
    {
        return $query->where('status', Status::EXCHANGE_PENDING);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', Status::EXCHANGE_APPROVED);
    }

    public function scopeCanceled($query)
    {
        return $query->where('status', Status::EXCHANGE_CANCEL);
    }

    public function scopeRefunded($query)
    {
        return $query->where('status', Status::EXCHANGE_REFUND);
    }

    public function badgeData($showTime = true)
    {
        $html = '';
        if ($this->status == Status::EXCHANGE_PENDING) {
            $html = '<span class="badge badge--warning">' . trans('Pending') . '</span>';
        } elseif ($this->status == Status::EXCHANGE_APPROVED) {
            $html = '<span><span class="badge badge--success">' . trans('Approved') . '</span>';
            if ($showTime) $html .= '<br>' . diffForHumans($this->updated_at);
            $html .= '</span>';
        } elseif ($this->status == Status::EXCHANGE_CANCEL) {
            $html = '<span class="badge badge--danger">' . trans('Canceled') . '</span>';
        } elseif ($this->status == Status::EXCHANGE_REFUND) {
            $html = '<span><span class="badge badge--warning">' . trans('Refunded') . '</span>';
            if ($showTime) $html .= '<br>' . diffForHumans($this->updated_at);
            $html .= '</span>';
        } elseif ($this->status == Status::EXCHANGE_INITIAL) {
            $html = '<span><span class="badge badge--primary">' . trans('Initiated') . '</span>';
            if ($showTime) $html .= '<br>' . diffForHumans($this->updated_at);
            $html .= '</span>';
        }
        return $html;
    }
}
