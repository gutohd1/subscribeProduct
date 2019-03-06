<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Phone;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function subscribe(Request $input)
    {
        $validator = Validator::make($input->all(), [
            'msisdn' => 'required|numeric',
            'product_id' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return ['error' => 'true', 'message' => 'Field is required'];
        }
        $service = Service::find($input->post('product_id'));
        if(!$service){
            return ['error' => 'true', 'message' => 'Invalid product'];
        }
        $phone = Phone::where('msisdn', $input->post('msisdn'))->first();
        try {
            if(!$phone){
                $phone = new Phone;
                $phone->msisdn = $input->post('msisdn');
                $phone->save();    
            }
            $phone_id = $phone->id;
            $service->phone()->attach($phone_id);

            return ['error' => 'false', 'message' => 'Subscribed Successfully'];
        } catch (\Exception $e) {
            return ['error' => 'true', 'message' => 'Not able to subscribe'];
        }
        
    }
    public function unsubscribe(Request $input)
    {
        $validator = Validator::make($input->all(), [
            'msisdn' => 'required|numeric',
            'product_id' => 'numeric'
        ]);
        if ($validator->fails()) {
            return ['error' => 'true', 'message' => 'Field is required'];
        }
        $phone = Phone::where('msisdn', $input->post('msisdn'))->first();
        $phone->get_services();
        $success = Array();
        $fail = Array();
        $qtdServices = count($phone->services);
        if($qtdServices > 0){
            foreach($phone->services as $service){
                if(!$input->has('product_id') || ($input->has('product_id') && $service->id == $input->post('product_id'))){
                    if($phone->service()->detach($service->id)){
                        array_push($success, $service);       
                    }else{
                        array_push($fail, $service);       
                    }
                }
            }
            if($input->has('product_id')){
                if(count($success) == 1){
                    return  ['error' => 'false', 'message' => 'Phone unsubscribed successfully'];
                }
            }
            if($qtdServices == count($success)){
                return  ['error' => 'false', 'message' => 'Phone unsubscribed successfully'];
            }
            return ['error' => 'true', 'message' => 'Fail to unsibscribe'];
        }else{
            return ['error' => 'true', 'message' => 'Phone not assigned to any product'];
        }
    }
}
