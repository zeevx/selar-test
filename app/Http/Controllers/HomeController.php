<?php

namespace App\Http\Controllers;

use App\Product;
use App\Purchase;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class HomeController extends Controller
{
    public function home(Request $request)
    {
        $from = $request->has('from') ? Carbon::parse($request->from, 'UTC') : Carbon::now('UTC')->subWeek();
        $to = $request->has('to') ? Carbon::parse($request->to, 'UTC') : Carbon::now('UTC');
        $diffHumans = $from->diffForHumans($to);

        $users = User::all();
        $products = Product::all();
        $purchases = Purchase::query()->where('status','paid')
        ->selectRaw('SUM(totalamount) as total_amount')
        ->selectRaw('SUM(selar_profit) as profit')
        ->selectRaw('currency as cur')
        ->groupBy(['cur'])
        ->get();

        $average = $this->getAverage($from, $to);

        $new_merchants = User::newMerchants($from, $to);
        $unique_merchants = User::uniqueMerchants($from, $to);

        $new_sellers = User::newSellers($from, $to);
        $unique_sellers = User::uniqueSellers($from, $to);

        return view('home', [
            'from' => $from,
            'to' => $to,
            'diffHumans' => $diffHumans,
            'users' => $users,
            'products' => $products,
            'purchases' => $purchases,
            'new_merchants' => $new_merchants,
            'unique_merchants' => $unique_merchants,
            'new_sellers' => $new_sellers,
            'unique_sellers' => $unique_sellers,
            'average' => $average
        ]);
    }

    public function getAverage($from, $to)
    {
        $purchases = Purchase::query()
            ->whereBetween('created_at', [$from, $to])
            ->where('status','paid')
            ->selectRaw('SUM(totalamount) as total_amount')
            ->selectRaw('SUM(selar_profit) as profit')
            ->selectRaw('currency as cur')
            ->groupBy(['cur'])
            ->get();
        $amt = 0;
        foreach($purchases as $purchase)
        {
            if ($purchase->cur == 'USD')
            {
                $conv = $this->convertCurrency('USD', 'NGN');
                $amt += $purchase->total_amount * $conv;
            }
            elseif ($purchase->cur == 'GHS'){
                $conv = $this->convertCurrency('GHS', 'NGN');
                $amt += $purchase->total_amount * $conv;
            }
            if ($purchase->cur == 'GBP')
            {
                $conv = $this->convertCurrency('GBP', 'NGN');
                $amt += $purchase->total_amount * $conv;
            }
            elseif ($purchase->cur == 'KES')
            {
                $conv = $this->convertCurrency('KES', 'NGN');
                $amt += $purchase->total_amount * $conv;
            }
            elseif ($purchase->cur == 'UGX')
            {
                $conv = $this->convertCurrency('UGX', 'NGN');
                $amt += $purchase->total_amount * $conv;
            }
            elseif ($purchase->cur == 'ZAR')
            {
                $conv = $this->convertCurrency('ZAR', 'NGN');
                $amt += $purchase->total_amount * $conv;
            }
            else
            {
                $amt += $purchase->total_amount;
            }
        }

        return count($purchases) == 0 ? 0 : $amt/count($purchases);
    }

    public function convertCurrency($old, $new)
    {
        try {
            $apikey = '845da35b657edac8ae32';
            $from_Currency = urlencode($old);
            $to_Currency = urlencode($new);
            $query = "{$from_Currency}_{$to_Currency}";
            $json = Http::get("https://free.currconv.com/api/v7/convert?q=$query&compact=ultra&apiKey=$apikey");
            $obj = json_decode($json, true);

            return $obj["$query"];
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            return 0;
        }
    }
}
