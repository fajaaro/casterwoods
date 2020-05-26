<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PremadeBox\StorePremadeBox;
use App\Http\Requests\PremadeBox\UpdatePremadeBox;
use App\Http\Resources\PremadeBox as PremadeBoxResource;
use App\PremadeBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PremadeBoxController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'admin'])->except(['index', 'show']);
    }

    public function index() 
    {
        $premadeBoxes = PremadeBoxResource::collection(
            PremadeBox::withRelations()->get()
        );

        return response()->json([
            'status' => 'Success get all premade box data!',
            'premade_boxes' => $premadeBoxes,
        ]);
    }

    // only admin
    public function store(StorePremadeBox $request)
    {
        $newPremadeBox = PremadeBox::create($request->all());

        $numberOfImages = count($request->file('images'));        
        for ($i = 0; $i < $numberOfImages; $i++) {
            $url = Storage::putFile('images/premade_boxes', $request->file('images')[$i]);

            $newPremadeBox->images()->create([
                'url' => $url,
            ]);
        }

        $premadeBox = new PremadeBoxResource(
            PremadeBox::withRelations()->where('id', $newPremadeBox->id)->first()
        ); 

        return response()->json([
            'status' => 'Success create new premade box!',
            'premadeBox' => $premadeBox,
        ]);
    }

    public function show($id) 
    {
        $premadeBox = new PremadeBoxResource(
            PremadeBox::withRelations()->where('id', $id)->first()
        );

        return response()->json([
            'status' => 'Success get premade box data!',
            'premadeBox' => $premadeBox,
        ]);        
    }

    // only admin
    // use request: post, body: form-data and addition field _method: put. 
    public function update(UpdatePremadeBox $request, $id)
    {
        $premadeBox = PremadeBox::find($id);

        $premadeBox->fill($request->all());
        $premadeBox->save();

        if ($request->hasFile('images')) {
            $numberOfImages = count($request->file('images'));
            for ($i = 0; $i < $numberOfImages; $i++) {
                $url = Storage::putFile('images/premade_boxes', $request->file('images')[$i]);

                $premadeBox->images()->create([
                    'url' => $url,
                ]);
            }            
        }

        $premadeBox = new PremadeBoxResource(
            PremadeBox::withRelations()->where('id', $id)->first()
        );

        return response()->json([
            'status' => 'Success update premade box data!',
            'premadeBox' => $premadeBox,
        ]);                
    }

    // only admin
    public function destroy($id)
    {
        $premadeBox = PremadeBox::find($id);

        // Kalo pas nge-eksekusi kode line 81 gagal, bakal kena error: ErrorException.
        $premadeBox->type;

        // Kalo pas nge-eksekusi kode line 81 berhasil, model bakalan di delete.
        foreach ($premadeBox->images as $image) {
            Storage::delete($image->url);
        }
        $premadeBox->delete();

        return response()->json([
            'status' => "Success delete premade  box with id {$id}!",
        ]);        
    }
}
