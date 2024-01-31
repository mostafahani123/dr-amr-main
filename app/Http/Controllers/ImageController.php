<?php

namespace App\Http\Controllers;

use App\Http\Resources\imageResource;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    //
    #############Store Image ########
    public function Store(Request $request){
        $validate=Validator::make($request->all(),[
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_categories_id'=>'required|integer'
            ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        $image = $request->file('image')->store('images','dr_amr');


         Image::create([
            'image'=> $image,
            'image_categories_id'=> $request->image_categories_id,
        ]);
return 'done';
        // return imageResource::make($data);

        }
    ############ update data image##############33
    public function Update(Request $request){
        $validate=Validator::make($request->all(),[
            'image'=> 'required|image',
            'id'=>'required|integer|exists:images,id',
            'category_id'=>'required|exists:image_categories,id|integer'
            ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }


        $image=Image::findOrFail($request->id)->image;
        if ($request->hasFile('image')) {
            unlink(public_path('uploads/'. $image));
            $image=$request->file('image')->store('Image','dr_amr');
        }
        Image::find($request->id)->Update([
            'image'=> $image,
            'image_categories_id'=>$request->category_id,
        ]);

        return 'done';
    }
    #####Get all data Image ################
    public function Get(){
        $data=Image::all();
        return imageResource::collection($data);
    }

    ################Delete Image with id image ####################
    public function Delete(Request $request){
        $validate=Validator::make($request->all(),[
            'id'=>'required|exists:Image,id|integer'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        Image::find($request->id)->delete();
        return "done";
    }

}
