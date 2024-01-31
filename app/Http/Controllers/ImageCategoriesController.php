<?php

namespace App\Http\Controllers;

use App\Http\Resources\imagecategoriesResource;
use App\Http\Resources\ImageCategoryResource;
use App\Models\Image;
use App\Models\Image_Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageCategoriesController extends Controller
{
    //
    ############ Add category title #####################3
    public function Store(Request $request){
        $validate=Validator::make($request->all(),[
            'title'=> 'required'
            ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        Image_Categories::create([
            'title'=>$request->title,
        ]);
        return $this->handelResponse('','The category has been added successfully');
    }
    ############## Get all image categories ##################
    public function Get(){
        $data = Image_Categories::all();
        return ImageCategoryResource::collection( $data );

    }

    // this Get iamges from table images Model Image
    public function Get_data_from_Images($id){

    $data =  Image_Categories::with('Image')->findOrFail($id);

    // return new imagecategoriesResource($data);
}


    ############ Update image category data #################
    public function Update(Request $request){
        $validate=Validator::make($request->all(),[
            'title'=> 'required',
            'id'=>'required|exists:image_categories,id|integer'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        Image_Categories::find($request->id)->update([

            'title'=>$request->title,
        ]);
        return $this->handelResponse('','The category has been updated successfully');
    }
    ################# Delete image category #################################
    public function Delete(Request $request){
        $validate=Validator::make($request->all(),[
            'id'=>'required|exists:image_categories,id|integer'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        Image_Categories::find($request->id)->delete();
        return $this->handelResponse('','The category has been successfully deleted');
    }



}
