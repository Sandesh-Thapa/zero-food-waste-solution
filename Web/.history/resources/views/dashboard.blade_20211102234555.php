@extends('layouts.app', ['pageSlug' => 'dashboard', 'page' => 'Dashboard', 'section' => ''])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Total sales</h5>
                            <h2 class="card-title">Request And Donation Status</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row p-3">
                        <div class="col-lg-2">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <h3 class="card-title text-center"><i class="tim-icons icon-money-coins text-primary"></i>Total Requests</h3>
                                </div>
                                <div class="card-body">
                                    <h3 class="text-center">{{ $total_requests }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <h3 class="card-title text-center"><i class="tim-icons icon-money-coins text-primary"></i>Total Donations</h3>
                                </div>
                                <div class="card-body">
                                    <h3 class="text-center">{{ $total_donations }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <h3 class="card-title text-center"><i class="tim-icons icon-paper text-success"></i>Total Donors</h3>
                                </div>
                                <div class="card-body">
                                    <h3 class="text-center">{{ $total_donors }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="row">
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">New</h5>
                    <h3 class="card-title"><i class="tim-icons icon-money-coins text-primary"></i>{{-- format_money($semesterincomes) --}}test</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartLinePurple"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Ongoing</h5>
                    <h3 class="card-title"><i class="tim-icons icon-bank text-info"></i> {{-- format_money($monthlybalance) --}}test</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="CountryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Completed</h5>
                    <h3 class="card-title"><i class="tim-icons icon-paper text-success"></i> {{-- format_money($semesterexpenses) --}}test</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartLineGreen"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card card-tasks">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Upcoming Requests</h4>
                        </div>
                        <!-- <div class="col-4 text-right">
                            <a href="#" class="btn btn-sm btn-primary">New Sale</a>
                        </div> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        S.N.
                                    </th>
                                    <th>
                                        Items
                                    </th>

                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($next_request as $key=>$next_request_item)
                                    <tr>
                                        {{-- <td>{{ date('d-m-y', strtotime($sale->created_at)) }}</td> --}}
                                        {{-- <td><a href="">{{ $sale->client->name }}<br>{{ $sale->client->document_type }}-{{ $sale->client->document_id }}</a></td> --}}
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $next_request_item }}</td>
                                        {{-- <td>{{ format_money($sale->transactions->sum('amount')) }}</td> --}}
                                        {{-- <td>{{ format_money($sale->products->sum('total_amount')) }}</td> --}}
                                        <td class="td-actions text-right">
                                            {{-- <a href="#" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="View Sale">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card card-tasks">
                <div class="card-header">
                <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Upcoming Donations</h4>
                        </div>
                        <!-- <div class="col-4 text-right">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#transactionModal">
                                New Transaction
                            </button>
                        </div> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        S.N
                                    </th>
                                    <th>
                                        Items
                                    </th>

                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($next_donation as $key=>$next_request_item)
                                    <tr>
                                        {{-- <td>{{ date('d-m-y', strtotime($sale->created_at)) }}</td> --}}
                                        {{-- <td><a href="">{{ $sale->client->name }}<br>{{ $sale->client->document_type }}-{{ $sale->client->document_id }}</a></td> --}}
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $next_request_item }}</td>
                                        {{-- <td>{{ format_money($sale->transactions->sum('amount')) }}</td> --}}
                                        {{-- <td>{{ format_money($sale->products->sum('total_amount')) }}</td> --}}
                                        <td class="td-actions text-right">
                                            {{-- <a href="#" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="View Sale">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="transactionModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <a href="#" class="btn btn-sm btn-primary">Payment</a>
                        <a href="#" class="btn btn-sm btn-primary">Income</a>
                        <a href="#" class="btn btn-sm btn-primary">Expense</a>
                        <a href="#" class="btn btn-sm btn-primary">Sale</a>
                        <a href="#" class="btn btn-sm btn-primary">Transfer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>

    {{-- <script>
        var lastmonths = [];

        @foreach ($lastmonths as $id => $month)
            lastmonths.push('{{ strtoupper($month) }}')
        @endforeach

        var lastincomes = {{ $lastincomes }};
        var lastexpenses = {{ $lastexpenses }};
        var anualsales = {{ $anualsales }};
        var anualclients = {{ $anualclients }};
        var anualproducts = {{ $anualproducts }};
        var methods = [];
        var methods_stats = [];

        @foreach($monthlybalancebymethod as $method => $balance)
            methods.push('{{ $method }}');
            methods_stats.push('{{ $balance }}');
        @endforeach

        $(document).ready(function() {
            demo.initDashboardPageCharts();
        });
    </script> --}}
@endpush
