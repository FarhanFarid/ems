<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

use App\Models\ArrangementDetail;
use App\Models\DetailImage;

use Carbon\Carbon;

class ArrangementController extends Controller
{
    public function index(Request $request){
        return view('apps.dashboard');
    }

    public function getArrangmentList(Request $request){

        $arrlist = ArrangementDetail::with(['images'])->get();

        return response()->json([
            'status'  => 'success',
            'data' => $arrlist
        ]);
    }

    public function saveArrangment(Request $request){

        try {

            $createarrdets                      = new ArrangementDetail();
            $createarrdets->title               = $request->title;
            $createarrdets->category            = $request->category;
            $createarrdets->type                = $request->type;
            $createarrdets->description         = $request->description;
            $createarrdets->costing             = $request->costing;
            $createarrdets->status_id           = '1';
            $createarrdets->created_at          = Carbon::now();
            $createarrdets->updated_at          = Carbon::now();
            $createarrdets->save();

            if ($request->hasFile('image')) {
                $destinationDir = $createarrdets->title . '-requirement'; // no need to prepend "public/"

                foreach ($request->file('image') as $uploadedFile) {
                    $timestamp    = now()->format('dmYHi');
                    $originalName = $uploadedFile->getClientOriginalName();
                    $newFileName  = $timestamp . '-' . $originalName;

                    // Save file into storage/app/public/...
                    $storedPath = $uploadedFile->storeAs($destinationDir, $newFileName, 'public');

                    // Save record (DB will store relative path)
                    $storeArrImage = new DetailImage();
                    $storeArrImage->arrangement_id = $createarrdets->id;
                    $storeArrImage->name           = $newFileName;
                    $storeArrImage->path           = $storedPath; // clean, relative to storage/
                    $storeArrImage->save();
                }
            }

            return response()->json([
                'status'  => 'success',
                'message' => 'Successfully saved!'
            ]);

        } catch (\Exception $e) {

            Log::error($e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'status'  => 'failed',
                'message' => 'Internal error happened. Try again'
            ]);
        }





    }
}
