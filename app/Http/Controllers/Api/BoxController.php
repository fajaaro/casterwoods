<?php

namespace App\Http\Controllers\Api;

use App\Box;
use App\Http\Controllers\Controller;
use App\Http\Requests\Box\StoreBox;
use App\Http\Requests\Box\UpdateBox;
use App\Http\Resources\Box as BoxResource;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoxController extends Controller
{
    public function __construct()
    {
        $this->middleware('restricted')->only(['index', 'show']);
        $this->middleware(['auth:api', 'admin'])->except(['index', 'show']);
    }

    public function index() 
    {
        $boxes = BoxResource::collection(
            Box::withRelations()->get()
        );

        return response()->json([
            'status' => 'Success get all box data!',
            'boxes' => $boxes,
        ]);
    }

    // only admin
    public function store(StoreBox $request)
    {
        $newBox = Box::create($request->all());

        $numberOfImages = count($request->file('images'));        
        for ($i = 0; $i < $numberOfImages; $i++) {
            $url = Storage::putFile('images/boxes', $request->file('images')[$i]);

            $newBox->images()->create([
                'url' => $url,
            ]);
        }
        

        $box = new BoxResource(
            Box::withRelations()->where('id', $newBox->id)->first()
        ); 

        return response()->json([
            'status' => 'Success create new box!',
            'box' => $box,
        ]);
    }

    public function show($id) 
    {
        $box = new BoxResource(
            Box::withRelations()->where('id', $id)->first()
        );

        return response()->json([
            'status' => 'Success get box data!',
            'box' => $box,
        ]);        
    }

    // only admin
    // use request: post, body: form-data and addition field _method: put. 
    public function update(UpdateBox $request, $id)
    {
        $box = Box::find($id);

        $box->fill($request->all());
        $box->save();

        if ($request->hasFile('images')) {
            $numberOfImages = count($request->file('images'));
            for ($i = 0; $i < $numberOfImages; $i++) {
                $url = Storage::putFile('images/boxes', $request->file('images')[$i]);

                $box->images()->create([
                    'url' => $url,
                ]);
            }            
        }

        $box = new BoxResource(
            Box::withRelations()->where('id', $id)->first()
        );

        return response()->json([
            'status' => 'Success update box data!',
            'box' => $box,
        ]);                
    }

    // only admin
    public function destroy($id)
    {
        $box = Box::find($id);

        // Kalo pas nge-eksekusi kode line 81 gagal, bakal kena error: ErrorException.
        $box->category_id;

        // Kalo pas nge-eksekusi kode line 81 berhasil, model bakalan di delete.
        foreach ($box->images as $image) {
            Storage::delete($image->url);
        }
        $box->delete();

        return response()->json([
            'status' => "Success delete box with id {$id}!",
        ]);        
    }
}