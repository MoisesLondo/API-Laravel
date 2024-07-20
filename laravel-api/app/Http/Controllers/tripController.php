<?php

namespace App\Http\Controllers;
use App\Models\Trip;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class tripController extends Controller
{
    public function trips(){
        $trips = Trip::all();
        $data = [
            'trips' => $trips,
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
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en los datos',
                'errors' => $validator->errors(),
                'status' => 400

            ];
            return response()->json($data,400);
        }

        $trip = Trip::create([
            'origin' => $request->origin,
            'destiny' => $request->destiny,
            'date' => $request->date,
            'hour' => $request->hour,
            'seats' => $request->seats,
            'description' => $request->description
        ]);

        if(!$trip){
            $data = [
                'message' => 'Error en la creación del viaje',
                'status' => 500

            ];
            return response()->json($data,500);
        }
        $data = [
            'trip' => $trip,
            'status' => 201

        ];
        return response()->json($data,201);
    }

    public function oneTrip($id){
        $trip = Trip::find($id);
        if(!$trip){
            $data = [
                'message' => 'El viaje no existe',
                'status' => 404
            ];
            return response()->json($data,404);

        }
        $data = [
            'trip' => $trip,
            'status' => 200
        ];
        return response()->json($data,200);
    }

    public function delete($id){
        $trip = Trip::find($id);
        if(!$trip){
            $data = [
                'message' => 'El viaje no existe',
                'status' => 404
            ];
            return response()->json($data,404);

        }
        $trip->delete();

        $data = [
            'message' => 'Viaje eliminado',
            'status' => 200
        ];
        return response()->json($data,200);
    }

    public function update(Request $request, $id){
        $trip = Trip::find($id);
        if(!$trip){
            $data = [
                'message' => 'El viaje no existe',
                'status' => 404
            ];
            return response()->json($data,404);

        }
        $validator = Validator::make($request->all(),[
            'origin' => 'required',
            'destiny' => 'required',
            'date' => 'required',
            'hour' => 'required',
            'seats' => 'required',
            'description' => 'required',
        ]);
        if($validator->fails()){
            $data = [
                'message' => 'Error en los datos',
                'errors' => $validator->errors(),
                'status' => 400

            ];
            return response()->json($data,400);
        }
        $trip->origin = $request->origin;
        $trip->destiny = $request->destiny;
        $trip->date = $request->date;
        $trip->hour = $request->hour;
        $trip->seats = $request->seats;
        $trip->description = $request->description;

        $trip->save();
        $data = [
            'message' => 'Viaje actualizado',
            'trip' => $trip,
            'status' => 200
            ];
            return response()->json($data,200);

    }

}
