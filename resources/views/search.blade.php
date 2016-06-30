@extends('layout')


@section('content')
    <div class="container">
        <section class="introduction-stripe">

        </section>
        <section>
            <hr class="heavy-line">
            <p class="hidden">
                @foreach($companyPage as $key => $value)
                    {{ $$key = $value }}
                @endforeach
            </p>
        </section>
        <section class="content-stripe">
            <div class="col-md-6">
                <h2>{{ $name }} (<span class="bold">{{ $symbol }}</span>)</h2>
                <h1><span class="bold">{{ $current_price }}</span>

                    @if ($daysChange >= 0)
                        <span class="increase bold"> ( + {{ $daysChange }}%)</span>
                        <span class="increase bold">  {{ $change }}</span>
                    @endif

                    @if ($daysChange < 0)
                        <span class="decrease bold"> ( {{ $daysChange }}%)</span>
                        <span class="decrease bold">  {{ $change }}</span>
                    @endif
                </h1>
            </div>
        </section>
        <section>
            <hr class="heavy-line">
        </section>
        <section class="content-stripe">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>Information</h3>
                        <p>Asking Price: {{ $ask }}</p>
                        <p>Bid: {{ $bid }}</p>
                        <p>Change: {{ $change }}</p>
                        <p>Day Open: {{ $daysOpen }}</p>
                        <p>Day High: {{ $daysHigh }}</p>
                        <p>Day Low: {{ $daysLow }}</p>
                        <p>Last Trade Date: {{ $lastTradeDate }}</p>
                        <p>Last Trade Time: {{ $lastTradeTime }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>Current Analyst Ratings</h3>
                        <table class="table_data">
                            <tr class="analyst-data">
                                <th>Strong Buy</th>
                                <td>{{ $strong_buy }}</td>
                            </tr>
                            <tr class="analyst-data">
                                <th>Buy</th>
                                <td>{{ $buy }}</td>
                            </tr>
                            <tr class="analyst-data">
                                <th>Hold</th>
                                <td>{{ $hold }}</td>
                            </tr>
                            <tr class="analyst-data">
                                <th>Underperform</th>
                                <td>{{ $underperform }}</td>
                            </tr>
                            <tr class="analyst-data">
                                <th>Sell</th>
                                <td>{{ $sell }}</td>
                            </tr>
                        </table>
                        <br>
                        <p>Current Price: {{ $current_price }}</p>
                        <p>Analyst Mean Price Target: {{ $price_target }}</p>
                        <p>Fifty Day Moving Average: {{ $fiftyDayMovingAverage }}</p>
                        <p>Two Hundred Moving Average: {{ $twoHundredDayMovingAverage }}</p>
                        <p>Our Rating: {{ $rating_type }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>Recent activity by {{ $symbol }} insiders</h3>
                        <table class="table_data">
                            <tr>
                                <th>Date</th>
                                <th>Buy / Sell</th>
                                <th>Volume</th>
                                <th>Value</th>
                            </tr>
                            @foreach($past_trades as $dealings)
                                <tr>
                                    <td> {{ $dealings -> date }} </td>
                                    <td> {{ $dealings -> type }} </td>
                                    <td> {{ $dealings -> volume }} </td>
                                    <td> {{ $dealings -> trade_value }} </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <hr class="heavy-line">
        </section>
        <section class="content-stripe">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>Stock Exchange: {{ $stockExchange }}</p>
                        <p>Market Capitalisation: {{ $marketCap }}</p>
                        <p>Currency: {{ $currency }}</p>
                        <p>Ex Dividend Date: {{ $exDividendDate }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>Pe Ratio: {{ $peRatio }}</p>
                        <p>PEG Ratio: {{ $pegRatio }}</p>
                        <p>EPS Current Year: {{ $priceEpsEstimateCurrentYear }}</p>
                        <p>EPS Next Year: {{ $priceEpsEstimateNextYear }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>Change from year low: {{ $changeFromYearLow }}</p>
                        <p>% Change from year low: {{ $percentChangeFromLow }}</p>
                        <p>Change from year high: {{ $changeFromYearHigh }}</p>
                        <p>% Change from year high: {{ $percentChangeFromYearHigh }}</p>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <hr class="heavy-line">
        </section>
    </div>
@stop