<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
//use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers;
use Scheb\YahooFinanceApi\ApiClient;

class SearchController extends Controller
{

    public function index()
    {

        $search_keyword = $_POST['search_keyword'];

        $first_query = DB::table('ftse100')->select('name', 'symbol')->
        where('symbol', 'like', '%' . $search_keyword . '%')->orWhere('name', 'like', '%' . $search_keyword . '%');

        $query = DB::table('ftse250')->select('name', 'symbol')->
        where('symbol', 'like', '%' . $search_keyword . '%')->orWhere('name', 'like', '%' . $search_keyword . '%')
            ->union($first_query)->take(10)->get();


        $bold_search_keyword = '<strong>' . $search_keyword . '</strong>';

        // return view('result', compact('search_keyword', 'query', 'bold_search_keyword'));

        return view('result', array('search_keyword' => $search_keyword, 'query' => $query, 'bold_search_keyword' => $bold_search_keyword));

        /*
        if ($query) {
            foreach ($query as $rows) {
                return '<div class="show" align="left"><span class="name">' . str_ireplace
                    ($search_keyword, $bold_search_keyword, $rows['name']) . '</span></div>';
            }
        } else {
            return '<div class="show" align="left">No matching records.</div>';
        }
*/
    }

    public function search(Request $request)
    {
        // Gets the query string from our form submission
        $query = Request::input('s');

        $search_term = htmlspecialchars($query, ENT_QUOTES);

        $checking = $this->checking($search_term);

        $symbol = $checking;

        $companyPage = $this->getIndex($symbol);

        $past_trades = DB::table('dealings')->select('date', 'type', 'volume', 'trade_value')->
        where('company_symbol', $symbol)->take(10)->get();


        return view('search', compact('checking', 'companyPage', 'past_trades'));
    }

    function checking($search_term)
    {
        $first_query = DB::table('ftse100')->select('name', 'symbol')->
        where('symbol', $search_term)->orWhere('name', $search_term);

        $query = DB::table('ftse250')->select('name', 'symbol')->
        where('symbol', $search_term)->orWhere('name', $search_term)->union($first_query)->get();

        if ($query) {
            foreach ($query as $result) {
                $symbol = $result->symbol;
            }
            return $symbol;
        }
        if (!$query) {
            return "TSCO";
            //return Redirect::to('/');
        }
    }

    function getIndex($symbol)
    {
        $client = new ApiClient();


        $page = [];

        //$page['name'] = $name;
        $page['symbol'] = $symbol;
        try {
            $data = $client->getQuotes("$symbol.L");
            $page['ask'] = $data["query"]["results"]["quote"]["Ask"];
            $page['bid'] = $data["query"]["results"]["quote"]["Bid"];
            $page['currency'] = $data["query"]["results"]["quote"]["Currency"];
            $page['yearLow'] = $data["query"]["results"]["quote"]["YearLow"];
            $page['yearHigh'] = $data["query"]["results"]["quote"]["YearHigh"];
            $page['marketCap'] = $data["query"]["results"]["quote"]["MarketCapitalization"];
            $page['changeFromYearLow'] = $data["query"]["results"]["quote"]["ChangeFromYearLow"];
            $page['percentChangeFromLow'] = $data["query"]["results"]["quote"]["PercentChangeFromYearLow"];

            $page['changeFromYearHigh'] = $data["query"]["results"]["quote"]["ChangeFromYearHigh"];
            $page['percentChangeFromYearHigh'] = $data["query"]["results"]["quote"]["PercebtChangeFromYearHigh"];
            //split day range into two varibales and round down to 2
            $page['daysRange'] = $data["query"]["results"]["quote"]["DaysRange"];
            $page['fiftyDayMovingAverage'] = $data["query"]["results"]["quote"]["FiftydayMovingAverage"];
            $page['twoHundredDayMovingAverage'] = $data["query"]["results"]["quote"]["TwoHundreddayMovingAverage"];
            $page['open'] = $data["query"]["results"]["quote"]["Open"];
            $page['previousClose'] = $data["query"]["results"]["quote"]["PreviousClose"];
            $page['peRatio'] = $data["query"]["results"]["quote"]["PERatio"];
            $page['exDividendDate'] = $data["query"]["results"]["quote"]["ExDividendDate"];
            $page['pegRatio'] = $data["query"]["results"]["quote"]["PEGRatio"];
            $page['priceEpsEstimateCurrentYear'] = $data["query"]["results"]["quote"]["PriceEPSEstimateCurrentYear"];
            $page['priceEpsEstimateNextYear'] = $data["query"]["results"]["quote"]["PriceEPSEstimateNextYear"];
            $page['stockExchange'] = $data["query"]["results"]["quote"]["StockExchange"];
        } catch
        (Exception $ex) {
            return false;
        }
        // $data = $client->getQuotes("$symbol.L");
        /*
                $page['ask'] = $data["query"]["results"]["quote"]["Ask"];
                $page['bid'] = $data["query"]["results"]["quote"]["Bid"];
                $page['currency'] = $data["query"]["results"]["quote"]["Currency"];
                $page['yearLow'] = $data["query"]["results"]["quote"]["YearLow"];
                $page['yearHigh'] = $data["query"]["results"]["quote"]["YearHigh"];
                $page['marketCap'] = $data["query"]["results"]["quote"]["MarketCapitalization"];
                $page['changeFromYearLow'] = $data["query"]["results"]["quote"]["ChangeFromYearLow"];
                $page['percentChangeFromLow'] = $data["query"]["results"]["quote"]["PercentChangeFromYearLow"];

                $page['changeFromYearHigh'] = $data["query"]["results"]["quote"]["ChangeFromYearHigh"];
                $page['percentChangeFromYearHigh'] = $data["query"]["results"]["quote"]["PercebtChangeFromYearHigh"];
                //split day range into two varibales and round down to 2
                $page['daysRange'] = $data["query"]["results"]["quote"]["DaysRange"];
                $page['fiftyDayMovingAverage'] = $data["query"]["results"]["quote"]["FiftydayMovingAverage"];
                $page['twoHundredDayMovingAverage'] = $data["query"]["results"]["quote"]["TwoHundreddayMovingAverage"];
                $page['open'] = $data["query"]["results"]["quote"]["Open"];
                $page['previousClose'] = $data["query"]["results"]["quote"]["PreviousClose"];
                $page['peRatio'] = $data["query"]["results"]["quote"]["PERatio"];
                $page['exDividendDate'] = $data["query"]["results"]["quote"]["ExDividendDate"];
                $page['pegRatio'] = $data["query"]["results"]["quote"]["PEGRatio"];
                $page['priceEpsEstimateCurrentYear'] = $data["query"]["results"]["quote"]["PriceEPSEstimateCurrentYear"];
                $page['priceEpsEstimateNextYear'] = $data["query"]["results"]["quote"]["PriceEPSEstimateNextYear"];
                $page['stockExchange'] = $data["query"]["results"]["quote"]["StockExchange"]; */

        try {
            $data = $client->getQuotesList("$symbol.L");
            $page['lastTradeDate'] = $data["query"]["results"]["quote"]["LastTradeDate"];
            $page['lastTradeTime'] = $data["query"]["results"]["quote"]["LastTradeTime"];
            $page['change'] = $data["query"]["results"]["quote"]["Change"];
            $page['daysOpen'] = $data["query"]["results"]["quote"]["Open"];
            $page['daysHigh'] = $data["query"]["results"]["quote"]["DaysHigh"];
            $page['daysLow'] = $data["query"]["results"]["quote"]["DaysLow"];
            $page['current_price'] = $data["query"]["results"]["quote"]["LastTradePriceOnly"];
        } catch
        (Exception $ex) {
            return false;
        }

        $current_price = $page['current_price'];
        $previous_close = $page['previousClose'];
        $percent_change = $this->percentChange($current_price, $previous_close);
        $page['daysChange'] = $percent_change;

        $first_ratings = DB::table('ftse100')->
        select('name', 'symbol', 'price_target', 'strong_buy', 'buy', 'hold', 'underperform', 'sell', 'final_rating')->
        where('symbol', $symbol);

        $main_ratings = DB::table('ftse250')->
        select('name', 'symbol', 'price_target', 'strong_buy', 'buy', 'hold', 'underperform', 'sell', 'final_rating')->
        where('symbol', $symbol)->union($first_ratings)->get();

        foreach ($main_ratings as $rating) {
            $page['name'] = $rating->name;
            $page['symbol'] = $rating->symbol;
            $page['price_target'] = $rating->price_target;
            $page['strong_buy'] = $rating->strong_buy;
            $page['buy'] = $rating->buy;
            $page['hold'] = $rating->hold;
            $page['underperform'] = $rating->underperform;
            $page['sell'] = $rating->sell;
            $page['final_rating'] = $rating->final_rating;
        }

        if ($page['final_rating'] == 0) {
            $page['rating_type'] = "Not enough data to provide accurate rating";
        }
        if ($page['final_rating'] > 0 && $page['final_rating'] < 3) {
            $page['rating_type'] = "Sell";
        }
        if ($page['final_rating'] >= 3 && $page['final_rating'] < 5) {
            $page['rating_type'] = "Underperform";
        }
        if ($page['final_rating'] == 5) {
            $page['rating_type'] = "Hold";
        }
        if ($page['final_rating'] > 5 && $page['final_rating'] < 9) {
            $page['rating_type'] = "Buy";
        }
        if ($page['final_rating'] >= 9 && $page['final_rating'] <= 10) {
            $page['rating_type'] = "Strong Buy";
        }


        return $page;
    }

    function percentChange($current_price, $previous_close)
    {
        if ($previous_close != 0 && $current_price != 0) {
            $day_range = ($current_price / $previous_close) * 100;

            if ($day_range > 100) {
                $perc_increase = $day_range - 100;
                $percent_change = round($perc_increase, 2);
            }
            if ($day_range < 100) {
                $perc_decrease = $day_range - 100;
                $percent_change = round($perc_decrease, 2);
            }
            if ($day_range == 100) {
                $percent_change = 0;
            }
        }
        if ($previous_close == 0 && $current_price == 0) {
            $percent_change = 0;
        }
        return $percent_change;
    }
}