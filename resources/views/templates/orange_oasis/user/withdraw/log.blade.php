@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="container">
        <div class="row mb-2 justify-content-end">
            <div class="col-lg-5">
                <form>
                    <div class="input-group">
                        <input name="search" value="{{ request()->search ?? '' }}" type="text"
                            class="form--control form-control" placeholder="@lang('Search by Transaction ID')">
                        <button type="submit" class="btn btn--base input-group-text bg--base text-white">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card custom--card">
                    <div class="card-body p-0">
                        @if (!$withdraws->isEmpty())
                            <table class="table table--responsive--md">
                                <thead>
                                    <tr>
                                        <th>@lang('Transaction ID')</th>
                                        <th>@lang('Receiving Method')</th>
                                        <th>@lang('Send Amount')</th>
                                        <th>@lang('Rate')</th>
                                        <th>@lang('Receivable')</th>
                                        <th>@lang('Status')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (@$withdraws as $withdraw)
                                        <tr>
                                            <td>{{ __($withdraw->trx) }}</td>
                                            <td>{{ __($withdraw->method->name) }}</td>
                                            <td>{{ showAmount($withdraw->amount) }}</td>
                                            <td>
                                                {{ showAmount($withdraw->rate, currencyFormat: false) }}
                                                {{ __($withdraw->method->cur_sym) }}
                                            </td>
                                            <td>
                                                {{ showAmount($withdraw->final_amount, currencyFormat: false) }}
                                                {{ __($withdraw->method->cur_sym) }}
                                            </td>
                                            <td>@php echo $withdraw->statusBadge @endphp </td>
                                            <td>
                                                <button class="btn btn--outline-base btn--sm detailBtn"
                                                    data-withdraw="{{ $withdraw }}"
                                                    data-date="{{ __(showDateTime($withdraw->created_at)) }}"
                                                    data-status="{{ $withdraw->statusBadge }}">
                                                    <i class="las la-desktop"></i>
                                                    @lang('Details')
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            @include($activeTemplate . 'partials.empty', [
                                'message' => 'Withdrawals not found!',
                            ])
                        @endif
                    </div>
                </div>
                @if (@$withdraws->hasPages())
                    <div class="mt-3">
                        {{ paginateLinks(@$withdraws) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if (!$withdraws->isEmpty())
        <div class="modal trackModal" id="detailModal">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="text-center"> @lang('Withdraw Details')</h4>
                        <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="las la-times"></i>
                        </span>
                    </div>
                    <div class="modal-body p-0">
                        <div class="info-box">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="list-group custom--list-group list-group-flush">
                                        <li
                                            class="list-group-item ps-0 d-flex justify-content-between flex-wrap border-dotted">
                                            <span class="fw-bold text-muted">@lang('Status')</span>
                                            <span class="fw-bold status"></span>
                                        </li>
                                        <li
                                            class="list-group-item ps-0 d-flex justify-content-between flex-wrap border-dotted">
                                            <span class="text-muted fw-bold ">@lang('Transaction ID')</span>
                                            <span class="fw-bold trxId text--base"></span>
                                        </li>
                                        <li
                                            class="list-group-item ps-0 d-flex justify-content-between flex-wrap border-dotted">
                                            <span class="text-muted fw-bold ">@lang('Withdraw Method')</span>
                                            <span class="fw-bold withdrawMethod"></span>
                                        </li>
                                        <li
                                            class="list-group-item ps-0 d-flex justify-content-between flex-wrap border-dotted">
                                            <span class="text-muted fw-bold ">@lang('Method Currency')</span>
                                            <span class="fw-bold withdrawCurrency"></span>
                                        </li>
                                        <li
                                            class="list-group-item ps-0 d-flex justify-content-between flex-wrap border-dotted">
                                            <span class="fw-bold text-muted">@lang('Send Amount')</span>
                                            <span class="fw-bold send_amount"></span>
                                        </li>
                                        <li
                                            class="list-group-item ps-0 d-flex justify-content-between flex-wrap border-dotted">
                                            <span class="fw-bold text-muted">@lang('Get Amount')</span>
                                            <span class="fw-bold get_amount"></span>
                                        </li>
                                        <li
                                            class="list-group-item ps-0 d-flex justify-content-between flex-wrap border-dotted">
                                            <span class="fw-bold text-muted">@lang('Rate')</span>
                                            <span class="fw-bold rate"></span>
                                        </li>
                                        <li
                                            class="list-group-item ps-0 d-flex justify-content-between flex-wrap border-dotted">
                                            <span class="fw-bold text-muted">@lang('Charge')</span>
                                            <span class="fw-bold text--danger charge"></span>
                                        </li>
                                        <li
                                            class="list-group-item ps-0 d-flex justify-content-between flex-wrap border-dotted">
                                            <span class="fw-bold text-muted">@lang('Receive Amount After Charge')</span>
                                            <span class="fw-bold afterChargeReceiveAmount"></span>
                                        </li>
                                        <li
                                            class="list-group-item ps-0 d-flex justify-content-between flex-wrap border-dotted">
                                            <span class="fw-bold text-muted">@lang('Time')</span>
                                            <span class="fw-bold time"></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.detailBtn').on('click', function() {
                let modal = $('#detailModal');
                let withdraw = $(this).data('withdraw');
                let siteCurrency = '{{ __(gs('cur_text')) }}';

                modal.find('.trxId').text(withdraw.trx)
                modal.find('.withdrawMethod').text(withdraw.method.name);
                modal.find('.withdrawCurrency').text(withdraw.method.cur_sym);
                modal.find('.send_amount').text(`${parseFloat(withdraw.amount).toFixed(2)} ${siteCurrency}`);
                modal.find('.get_amount').text(
                    `${parseFloat(withdraw.final_amount).toFixed(2)} ${withdraw.method.cur_sym}`);
                modal.find('.rate').text(
                    `1 ${withdraw.method.cur_sym} = ${parseFloat(withdraw.rate).toFixed(2)} ${withdraw.currency}`
                    );
                modal.find('.charge').text(
                    `${parseFloat(withdraw.charge).toFixed(2)} ${withdraw.method.cur_sym}`);
                modal.find('.afterChargeReceiveAmount').text(
                    `${parseFloat(withdraw.after_charge).toFixed(2)} ${withdraw.method.cur_sym}`);
                modal.find('.time').text($(this).data('date'));
                modal.find('.status').html($(this).data('status'));
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
