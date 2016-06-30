@extends('layout')

@section('content')

    <div class="container">
        <section class="introduction-stripe">
            <div class="col-md-12">
                <h1 class="center">FTSE Ventures</h1>
                <h3 class="center">FTSE Ventures tries to predict how companies listed on the FTSE 100 & 250 will
                    perform.</h3>
                <p class="center">To accomplish this our program examines the Analyst Recommendations, 50 & 200 Day
                    Moving
                    Averages and Director Dealings.</p>
                <p class="center">This is a simple first Beta version to test the concept and research how these
                    parameters
                    effect a companies movement.</p>
                <p class="center">Don't take the recommendations too seriously.</p>
            </div>
        </section>
        <section class="content-stripe">
            <hr class="heavy-line">
        </section>
        <section class="content-stripe">

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>FTSE 100</h3>
                        <p class="hidden">
                            @foreach($ftseCurrent as $key => $value)
                                {{ $$key = $value }}
                            @endforeach
                        </p>

                        <h2>
                            {{ $ftse100_price }}
                            @if($ftse100_price > $ftse100_previous_close)
                                <span class="increase">{{$ftse100_move}}</span>
                                <span class="increase">{{$ftse100_percent_change}}</span>
                            @endif
                            @if($ftse100_price < $ftse100_previous_close)
                                <span class="decrease">{{$ftse100_move}}</span>
                                <span class="decrease">{{$ftse100_percent_change}}</span>
                            @endif
                        </h2>
                        <hr class="heavy-line">
                        <h3 class="center">Top Movers</h3>

                        <table class="table_data">
                            <tr>
                                <th>Name</th>
                                <th>Symbol</th>
                                <th>Price</th>
                                <th>% Change</th>
                            </tr>

                        </table>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>FTSE 250</h3>
                        <h2>
                            {{ $ftse250_price }}
                            @if($ftse250_price > $ftse250_previous_close)
                                <span class="increase">{{$ftse250_move}}</span>
                                <span class="increase">{{$ftse250_percent_change}}</span>
                            @endif
                            @if($ftse250_price < $ftse250_previous_close)
                                <span class="decrease">{{$ftse250_move}}</span>
                                <span class="decrease">{{$ftse250_percent_change}}</span>
                            @endif
                        </h2>
                        <hr class="heavy-line">
                        <h3 class="center">Top Movers</h3>

                        <table class="table_data">
                            <tr>
                                <th>Symbol</th>
                                <th>Price</th>
                                <th>% Change</th>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </section>
        <section class="content-stripe">
            <hr class="heavy-line">
        </section>

        <section class="content-stripe">
            <h3 class="center">Top recommendations from the FTSE 100 and 250.</h3>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table_data">
                            <tr>
                                <th>FTSE 100 Listed Company Name</th>
                                <th>Symbol</th>
                                <th>Price</th>
                                <th>Our Score</th>
                            </tr>
                            @foreach($ftse100Risers as $rising)
                                <tr>
                                    <td> {{ $rising -> name }} </td>
                                    <td> {{ $rising -> symbol }} </td>
                                    <td> {{ $rising -> current_price }} </td>
                                    <td> {{ $rising -> final_rating }} </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table_data">
                            <tr>
                                <th>FTSE 250 Listed Company Name</th>
                                <th>Symbol</th>
                                <th>Price</th>
                                <th>Our Score</th>
                            </tr>
                            @foreach($ftse250Risers as $rising)
                                <tr>
                                    <td> {{ $rising -> name }} </td>
                                    <td> {{ $rising -> symbol }} </td>
                                    <td> {{ $rising -> current_price }} </td>
                                    <td> {{ $rising -> final_rating }} </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <section class="content-stripe">
            <hr class="heavy-line">
        </section>
        <section class="content-stripe">
            <h3 class="center">FTSE 100 and 250 companies to hold or sell.</h3>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table_data">
                            <tr>
                                <th>FTSE 100 Listed Company Name</th>
                                <th>Symbol</th>
                                <th>Price</th>
                                <th>Our Score</th>
                            </tr>
                            @foreach($ftse100Fallers as $falling)
                                <tr>
                                    <td> {{ $falling -> name }} </td>
                                    <td> {{ $falling -> symbol }} </td>
                                    <td> {{ $falling -> current_price }} </td>
                                    <td> {{ $falling -> final_rating }} </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table_data">
                            <tr>
                                <th>FTSE 250 Listed Company Name</th>
                                <th>Symbol</th>
                                <th>Price</th>
                                <th>Our Score</th>
                            </tr>
                            @foreach($ftse250Fallers as $falling)
                                <tr>
                                    <td> {{ $falling -> name }} </td>
                                    <td> {{ $falling -> symbol }} </td>
                                    <td> {{ $falling -> current_price }} </td>
                                    <td> {{ $falling -> final_rating }} </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <section class="content-stripe">
            <hr class="heavy-line">
        </section>
    </div>
@stop