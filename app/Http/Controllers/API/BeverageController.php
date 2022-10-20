<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class BeverageController extends BaseController
{
    public function checkAllowedBeveragesConsumption(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'beverage'=>'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $leftToConsume = 500 - $request->beverage;

        $allDrinks = array(
            '75'  => 'Monster Ultra Sunrise',
            '95'  => 'Black Coffee',
            '77'  => 'Americano',
            '130' => 'Sugar free NOS',
            '200' => '5 Hour Energy'
        );

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

        return $this->sendResponse($data, 'Success');
    }
}