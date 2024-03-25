<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarCategory;


class HomePageController extends Controller
{
    public function HomePageView()
    {
        return view('frontend.homepage');
    }

    public function getPrice(Request $request)
{
    
    $origin = $request->input('origin');
    $destination = $request->input('destination');
    $selectedTime = $request->input('selectedTime');
    $carId = $request->input('carId');
    // dd($request->all());

    // Sử dụng API Google Maps để tính toán khoảng cách và thời gian
    $apiKey = 'AIzaSyDIfSyryL0vRpxCCDilpmgnYhC98A_E8EQ'; 
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origin&destinations=$destination&key=$apiKey";
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    
    if ($data['status'] === 'OK') {
        $distance = $data['rows'][0]['elements'][0]['distance']['value'] / 1000; // Khoảng cách tính bằng kilometer
        dd($distance);
        // Tính giá cước dựa trên khoảng cách, thời gian và loại xe
        $fare = $this->calculateFare($distance, $selectedTime, $carId);
        
        // Trả về kết quả
        return response()->json(['fare' => $fare]);
    } else {
        return response()->json(['error' => 'Không thể tính toán khoảng cách']);
    }
}

private function calculateFare($distance, $selectedTime, $carId)
{
    
    $carCategory = CarCategory::find($carId);

    $fare = 0.0;

    // Kiểm tra khoảng cách
    if ($distance < 30) {
        $car_fare_under_30 = floatval($carCategory->car_fare_under_30);
      
        $fare = $car_fare_under_30 * $distance;
    } else {
        $car_fare_up_30 = floatval($carCategory->car_fare_up_30);
        
        $fare = $car_fare_up_30 * $distance;
    }

    // Kiểm tra thời gian đi
    $hour = date('H', strtotime($selectedTime));

  
    if (($hour >= 16 && $hour <= 20) || ($hour >= 22 || $hour <= 5)) {
     
        $fare += 10; // 10,000 VND
    }

    
    return $fare;
}
       
        
    
}