<?php

namespace App\Http\Controllers;

use App\Http\Requests\AudioRequest;
use App\Http\Resources\AudioAllElderResource;
use App\Models\Audio;
use Illuminate\Support\Facades\Storage;

// use App\Models\Elder;

class AudioController extends Controller
{


    // Get audios from db
    public function Get_audio(){
        return Audio::get();
    }


    // get audio Using id jUST // -> details elder

    public function Get_id($id){
    $data_id =  Audio::with('elder')->findOrFail($id);
    return new AudioAllElderResource( $data_id);

  }
    // ,..................
    public function store_Audio(AudioRequest $request){

        //   handle create image
            $image = $request->file('image')->store('Audio_image', 'dr_amr');
        // handle file create
           $audio = $request->file('audio')->store('Audio','dr_amr');


       //  create data -> Audio db
        Audio::create([
       'title' => $request->title,
       'image' => $image,
       'audio' => $audio,
       'status' => $request->status,
       'elder_id'=>$request->elder_id,

        ]);
        return 'done';
    }


    // edit and update
    public function edit($id){
       return Audio::find($id);
    }
    // update Audio
    public function update_Audio(AudioRequest $request, $id){
        $request->validate([
             'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
             'audio' => 'required',
             'status' => 'required|in:public,private',
             'title' => 'required',
        ]);
       $Update_data = Audio::find($id);
     // Step 1: Remove the old file and image
      if($Update_data->image){
        $oldFilePath = unlink(public_path('uploads/'. $Update_data->image));
        if (Storage::disk('dr_amr')->exists($oldFilePath)) {
            Storage::disk('dr_amr')->delete($oldFilePath);
        }
     }

      if($Update_data->audio){
        $oldFileaudio = unlink(public_path('uploads/'. $Update_data->audio));
        if (Storage::disk('dr_amr')->exists($oldFileaudio)) {
            Storage::disk('dr_amr')->delete($oldFileaudio);
        }
      }
        //   handle create image
      $image = $request->file('image')->store('Audio_image', 'dr_amr');
      // handle file create
      $audio = $request->file('audio')->store('Audio','dr_amr');
    $Update_data->update([
        'image' => $image,
        'audio' => $audio,
        'status' => $request->status,
        'title' => $request->title
    ]);


    return "Done Update";

    }
}



