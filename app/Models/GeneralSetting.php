<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $site_name
 * @property string|null $cur_text currency text
 * @property string|null $cur_sym currency symbol
 * @property string|null $email_from
 * @property string|null $email_from_name
 * @property string|null $email_template
 * @property string|null $sms_template
 * @property string|null $sms_from
 * @property string|null $push_title
 * @property string|null $push_template
 * @property string|null $base_color
 * @property object|null $mail_config email configuration
 * @property object|null $sms_config
 * @property object|null $global_shortcodes
 * @property int $kv
 * @property int $ev email verification, 0 - dont check, 1 - check
 * @property int $en email notification, 0 - dont send, 1 - send
 * @property int $sv mobile verication, 0 - dont check, 1 - check
 * @property int $sn sms notification, 0 - dont send, 1 - send
 * @property int $pn
 * @property object|null $socialite_credentials
 * @property string|null $trustpilot_widget_code
 * @property int $force_ssl
 * @property int $maintenance_mode
 * @property int $secure_password
 * @property int $agree
 * @property int $system_customized
 * @property int $paginate_number
 * @property int $currency_format 1=>Both
 * 2=>Text Only
 * 3=>Symbol Only
 * @property int $registration 0: Off	, 1: On
 * @property string|null $active_template
 * @property int $exchange_commission Exchange Commission
 * @property int $show_notice_bar
 * @property int $multi_language
 * @property int $show_number_after_decimal
 * @property object|null $firebase_config
 * @property string|null $currency_api_key
 * @property string|null $last_cron
 * @property string|null $available_version
 * @property int $automatic_currency_rate_update
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting siteName($pageTitle)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereActiveTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereAgree($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereAutomaticCurrencyRateUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereAvailableVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereBaseColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereCurSym($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereCurText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereCurrencyApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereCurrencyFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereEmailFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereEmailFromName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereEmailTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereEv($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereExchangeCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereFirebaseConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereForceSsl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereGlobalShortcodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereKv($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereLastCron($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereMailConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereMaintenanceMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereMultiLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting wherePaginateNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting wherePn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting wherePushTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting wherePushTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereRegistration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereSecurePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereShowNoticeBar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereShowNumberAfterDecimal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereSiteName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereSmsConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereSmsFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereSmsTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereSn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereSocialiteCredentials($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereSv($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereSystemCustomized($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereTrustpilotWidgetCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GeneralSetting extends Model
{
    protected $casts = [
        'mail_config' => 'object',
        'sms_config' => 'object',
        'global_shortcodes' => 'object',
        'socialite_credentials' => 'object',
        'firebase_config' => 'object',
    ];

    protected $hidden = ['email_template', 'mail_config', 'sms_config', 'system_info'];

    public function scopeSiteName($query, $pageTitle)
    {
        $pageTitle = empty($pageTitle) ? '' : ' - ' . $pageTitle;
        return $this->site_name . $pageTitle;
    }

    protected static function boot()
    {
        parent::boot();
        static::saved(function () {
            \Cache::forget('GeneralSetting');
        });
    }
}
