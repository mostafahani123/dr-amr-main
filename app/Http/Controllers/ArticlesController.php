<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticlesRequest;
use App\Http\Resources\ArticlsResource;
use App\Http\Resources\RelationArticlsResource;
use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{

     // get all data Books
  public function Get(){
    $Get_resource = Articles::all();
    return ArticlsResource::collection($Get_resource);
}
   public function Store(ArticlesRequest $request){
          //   handle create image
          $image = $request->file('image')->store('Audio_image', 'dr_amr');


         //  create data -> Audio db
          Articles::create([
         'title' => $request->title,
         'image' => $image,
         'content'=> $request->content,
         'elder_id'=>$request->elder_id,

          ]);
          return 'done';
        }

        public function Update(Request $request,$id){
            $request->validate([
                'title' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'content' => 'required',
        
                      ]);
            $data =  Articles::find($id);


               if ($data->image) {
                   $oldImagePath = unlink(public_path('uploads/'. $data->image));
                   if (Storage::disk('dr_amr')->exists($oldImagePath)) {
                       Storage::disk('dr_amr')->delete($oldImagePath);
                   }
               }
             // handle image update
             $image = $request->file('image')->store('images','dr_amr');


             $data->update([
                 'title' =>$request->title,
                 'image' => $image,
                 'content' => $request->content,
             ]);

          return 'done';
       }


         // get elder -> Book
    public function Get_dataId($id){
        $data_id  = Articles::with('elder')->findOrFail($id);
        return new RelationArticlsResource( $data_id);

      }
}
