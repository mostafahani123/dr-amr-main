<?php

namespace App\Http\Controllers;
use App\Http\Requests\ElderRequests;
use App\Http\Resources\AudioAllElderResource;
use App\Http\Resources\ELderAllAudioResource;
use App\Http\Resources\ElderAllBooksCollection;
use App\Http\Resources\ELderAllBooksResource;
use App\Http\Resources\ElderResource;
use App\Http\Resources\RelationArticlsElderResource;
use App\Models\Audio;
use App\Models\Elder;
use Illuminate\Support\Facades\Storage;

class ElderController extends Controller

{
    public function store(ElderRequests $request)
    {
    // handle image create
    $image = $request->file('image')->store('elders_images','dr_amr');


    //    create db data -> books
     Elder::create([
        'name' => $request->name,
        'image' => $image,
        'email' =>$request->email,
        'phone_number'=>$request->phone_number,
    ]);
    // return ElderResource::make($store_Elder);
    // return "done";
}



    // this all data from database
    public function Get(){

        $data_elder = Elder::all();
        return ElderResource::collection($data_elder);
    }

    // get elder just data id .
    public function Id_Data_elder($id){
        $data_elder_id =  Elder::findOrFail($id);
      return ElderResource::make($data_elder_id);
    }

    // this create data with database


     // this get id Book ->  Elder
    public function Get_id($id){
      $get_id =  Elder::with('books')->findOrFail($id);
      return new ELderAllBooksResource( $get_id );

    }
             // this get Audio -> elder -> ID
        public function Get_Audio_Id_Elder($id){
           $data_Audio = Elder::with('Audio')->findOrFail($id);
           return new ELderAllAudioResource( $data_Audio);
        }




    //  Edit Elder and Update
    public function Edit_Elder($id){
        $data_id_just =  Elder::find($id);
        return ElderResource::make($data_id_just);
    }

    public function Update_Elder(ElderRequests $request, $id){

        $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'

              ]);

             $data =  Elder::find($id);

 // Step 1: Remove the old file and image

         if ($data->image) {
            $oldImagePath = unlink(public_path('uploads/'. $data->image));

            if (Storage::disk('dr_amr')->exists($oldImagePath)) {
                Storage::disk('dr_amr')->delete($oldImagePath);
            }
        }

         // handle update IMAGE elder
         $image = $request->file('image')->store('elders_images','dr_amr');

        $data->update([
            'name' => $request->name,
            'image' => $image,
        ]);

        return ElderResource::make($data);
    }


    public function get_Articles($id){
        $data_id  = Elder::with('Article')->findOrFail($id);
        return new RelationArticlsElderResource($data_id);
    }
}
