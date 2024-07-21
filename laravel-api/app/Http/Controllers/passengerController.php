<?php

namespace App\Http\Controllers;
use App\Models\Passenger;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class passengerController extends Controller
{
    public function passenger(){
        $passenger = Passenger::all();
        $data = [
            'passenger' => $passenger,
            'status'=> 200
        ];
        return response()->json($data,200);
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(),[
            'origin' => 'required',
            'destiny' => 'required',
            'date' => 'required',
            'hour' => 'required',
            'seats' => 'required',
            'description' => 'required',
            'trip_id' => 'required'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en los datos',
                'errors' => $validator->errors(),
                'status' => 400

            ];
            return response()->json($data,400);
        }

        $passenger = Passenger::create([
            'origin' => $request->origin,
            'destiny' => $request->destiny,
            'date' => $request->date,
            'hour' => $request->hour,
            'seats' => $request->seats,
            'description' => $request->description,
            'trip_id' => $request->trip_id
        ]);

        if(!$passenger){
            $data = [
                'message' => 'Error en la creación del viaje',
                'status' => 500

            ];
            return response()->json($data,500);
        }
        $data = [
            'passenger' => $passenger,
            'status' => 201

        ];
        return response()->json($data,201);
}
public function delete($id){
    $passenger = Passenger::find($id);
    if(!$passenger){
        $data = [
            'message' => 'El viaje no existe',
            'status' => 404
        ];
        return response()->json($data,404);

    }
    $passenger->delete();

    $data = [
        'message' => 'Viaje eliminado',
        'status' => 200
    ];
    return response()->json($data,200);
}
}
