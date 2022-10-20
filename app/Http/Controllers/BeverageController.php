<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Beverages;
use App\Models\Results;
use Carbon\Carbon;

class BeverageController extends Controller
{
    public function getBeverages(){

        $data = Beverages::all();

        return view('index', [
            'data' => $data->toArray(),
        ]);
    }

    public function checkBeveragesConsumption(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'beverage'=>'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $leftToConsume = 500 - $request->beverage;

        $allBeverages = Beverages::all();

        foreach ($allBeverages->toArray() as $key => $row){
            $allDrinks[$row['level']] = $row['name'];
        }

        $selectedBeverageWas[] = $request->beverage;
        $selectedBeverageWas[] = $allDrinks[$request->beverage];

        unset($allDrinks[$request->beverage]);

        $results = [];
        foreach ($allDrinks as $drinkLimit => $drinkName)
        {
            $sum = 0;
            $iter = 1;
            foreach ($allDrinks as $key => $val)
            {
                if($drinkLimit != $key) {
                    $tempSum = $key + $sum;
                    if($tempSum <= $leftToConsume){
                        $sum += $key;
                        $results[$drinkLimit][$key] = $val;
                    }
                }
                $iter++;
            }
        }

        $data = [];
        foreach($results as $key=>$res){
            $sum = 0;
            foreach ($res as $k => $v){
                $sum = $sum + $k;
            }

            $data[$key]['sum']  = $sum;
            $data[$key]['data'] = $res;
        }

        usort($data, function ($item1, $item2) {
            return $item2['sum'] <=> $item1['sum'];
        });

        $resultsArray = [];
        $selectedBeverageId = Beverages::where('level', $request->beverage)->pluck('id');

        $i = 0;
        foreach($data[0]['data'] as $level => $name){
            $relatedBeverageId = Beverages::where('level', $level)->pluck('id');

            $resultsArray[$i]['beverage_id'] = $selectedBeverageId[0];
            $resultsArray[$i]['can_consume_beverage_id'] = $relatedBeverageId[0];
            $resultsArray[$i]['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $resultsArray[$i]['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $i++;
        }

        Results::insert($resultsArray);

        return view('show', [
            'data' => $data,
            'selectedBeverageWas' => $selectedBeverageWas
        ]);
    }
}