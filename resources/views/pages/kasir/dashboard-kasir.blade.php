@extends('layouts.kasir')

@section('title', 'Store Dashboard')
    
@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up" >
    <div class="dashboard-content" style="margin-top: 100px">
        <div class="row">
        <div class="col-md-4">
            <div class="card mb-2">
            <div class="card-body">
                <div class="dashboard-card-title">
                Revenue
                </div>
                <div class="dashboard-card-subtitle">
                Rp. {{number_format($revenue)}}
                </div>
            </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-2">
            <div class="card-body">
                <div class="dashboard-card-title">
                Transaction
                </div>
                <div class="dashboard-card-subtitle">
                {{$total_transaction}}
                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="row mt-3">
        <div class="col-12 mt-2">
            <h5 class="mb-3">Recent Transactions</h5>
            @foreach ($transactions as $transaction)
            <a
            class="card card-list d-block"
            href="#">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-4">
                        {{$transaction->code ?? ''}}
                    </div>
                    <div class="col-md-3">
                        Rp. {{number_format($transaction->total_price) ?? ''}}
                    </div>
                    <div class="col-md-3">
                        {{$transaction->created_at ?? ''}}
                    </div>
                    <div class="col-md-1 d-none d-md-block">
                        <img
                        src="/images/dashboard-arrow-right.svg"
                        alt=""
                        />
                    </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        {{ $transactions->links() }}
        </div>
    </div>
    </div>
</div>
@endsection