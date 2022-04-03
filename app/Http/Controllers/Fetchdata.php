<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Complaintype;
use Exception;

class Fetchdata extends Controller
{
    public function getArea()
    {
        try {
            return Area::all()->toArray();
        } catch (Exception $th) {
            return response()->json(['status' => 'Failed', 'message' => 'No Data Found'], 500);
        }
    }

    public function getComplainType()
    {
        try {
            return Complaintype::all()->toArray();
        } catch (Exception $th) {
            return response()->json(['status' => 'Failed', 'message' => 'No Data Found'], 500);
        }
    }
}
