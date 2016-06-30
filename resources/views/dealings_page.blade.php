@extends('layout')

@section('content')
    <div class="container">
        <section class="introduction-stripe">
            <h2 class="center">Director Dealings</h2>
            <br>
            <p class="center">Keep track of all major trades being made by company insiders</p>
        </section>
        <section class="content-stripe">
            <h2>Recent Large Director Buys</h2>
            <table class="table_data">
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Symbol</th>
                    <th>Volume</th>
                    <th>Price</th>
                    <th>Trade Value</th>
                </tr>
                @foreach($buys as $buy)
                    <tr>
                        <td> {{ $buy -> date }} </td>
                        <td> {{ $buy -> company_name }} </td>
                        <td> {{ $buy -> company_symbol }} </td>
                        <td> {{ $buy -> volume }} </td>
                        <td> {{ $buy -> price }} </td>
                        <td> {{ $buy -> trade_value }} </td>
                    </tr>
                @endforeach


            </table>
        </section>
        <section class="content-stripe">
            <h2>Recent Large Director Sells</h2>
            <table class="table_data">
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Symbol</th>
                    <th>Volume</th>
                    <th>Price</th>
                    <th>Trade Value</th>
                </tr>
                @foreach($sells as $sell)
                    <tr>
                        <td> {{ $sell -> date }} </td>
                        <td> {{ $sell -> company_name }} </td>
                        <td> {{ $sell -> company_symbol }} </td>
                        <td> {{ $sell -> volume }} </td>
                        <td> {{ $sell -> price }} </td>
                        <td> {{ $sell -> trade_value }} </td>
                    </tr>
                @endforeach

            </table>
        </section>
    </div>

@stop