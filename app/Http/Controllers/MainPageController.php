<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use simple_html_dom;
use Scheb\YahooFinanceApi\ApiClient;


class MainPageController extends Controller
{

    public function home()
    {
        $ftse100Risers = DB::table('ftse100')->
        select('name', 'symbol', 'current_price', 'final_rating')->
        orderBy('final_rating', 'desc')->take(10)->get();

        $ftse250Risers = DB::table('ftse250')->
        select('name', 'symbol', 'current_price', 'final_rating')->
        orderBy('final_rating', 'desc')->take(10)->get();

        $ftse100Fallers = DB::table('ftse100')->
        select('name', 'symbol', 'current_price', 'final_rating')->
        having('final_rating', '>', 0)->
        orderBy('final_rating', 'asc')->take(10)->get();

        $ftse250Fallers = DB::table('ftse250')->
        select('name', 'symbol', 'current_price', 'final_rating')->
        having('final_rating', '>', 0)->
        orderBy('final_rating', 'asc')->take(10)->get();



        $ftseCurrent = $this->getFtseCurrent();



        $ftse100Movers = $this->ftse100Movers();

        return view('main_page', compact('ftse100Risers', 'ftse250Risers',
            'ftse100Fallers', 'ftse250Fallers', 'ftseCurrent', 'ftse100Movers'));
    }

    function getFtseCurrent()
    {

        $page = [];


        $url = "https://uk.finance.yahoo.com/q?s=^ftse";
        $html = new simple_html_dom();
        $html->load_file($url);
        $start = $html->find("span[id=yfs_l10_^ftse]", 0);
        $page["ftse100_price"] = $start->plaintext;
        // $ftse100_price
        $movement = $html->find("span[id=yfs_c10_^ftse]", 0);
        $page["ftse100_move"] = $movement->plaintext;
        // ftse100_move
        $change = $html->find("span[id=yfs_p20_^ftse]", 0);
        $page["ftse100_percent_change"] = $change->plaintext;
        // $ftse100_percent_change
        $prevClose = $html->find("td[class=yfnc_tabledata1]", 0);
        $page["ftse100_previous_close"] = $prevClose->plaintext;
        // ftse100_previous_close

        $url = "https://uk.finance.yahoo.com/q?s=^ftmc";
        $html = new simple_html_dom();
        $html->load_file($url);
        $start = $html->find("span[id=yfs_l10_^ftmc]", 0);
        $page["ftse250_price"] = $start->plaintext;
        // $ftse100_price
        $movement = $html->find("span[id=yfs_c10_^ftmc]", 0);
        $page["ftse250_move"] = $movement->plaintext;
        // ftse100_move
        $change = $html->find("span[id=yfs_p20_^ftmc]", 0);
        $page["ftse250_percent_change"] = $change->plaintext;
        // $ftse100_percent_change
        $prevClose = $html->find("td[class=yfnc_tabledata1]", 0);
        $page["ftse250_previous_close"] = $prevClose->plaintext;
        // ftse100_previous_close

        return $page;

    }


    function ftse100Movers()
    {
        $movers = [];
        $url = "https://uk.finance.yahoo.com/q?s=^ftse";
        $html = new simple_html_dom();
        $html->load_file($url);
        $tables = $html->find('table');
        foreach ($tables[3]->find('tr') as $j => $rows) {
            foreach ($rows->find("td") as $i => $bodies) {
                if ($i == 0) {
                    $symbol = $bodies->plaintext;
                    $symbol = str_replace('.L', '', $symbol);
                    $movers[$j]['company_name'] = DB::table('ftse100')->select('name')->where('symbol', $symbol)->get();
                    $movers[$j]['symbol'] = $symbol;
                }
                if ($i == 1) {
                    $movers[$j]['price'] = $bodies->plaintext;
                }
                if ($i == 2) {
                    $movers[$j]['percent'] = $bodies->plaintext;
                }
            }
            return $movers;
        }
    }


    function testingScheb()
    {
        $client = new ApiClient();

        try {
            $data = $client->getQuotes("tsco.L");

            $previous_close = $data["query"]["results"]["quote"]["PreviousClose"];

            return $previous_close;
        } catch (Exception $ex) {
            return 0;
        }
    }


}
