<?php

namespace App\Http\Controllers;
use App\Http\Requests\BookRequests;
use App\Http\Requests\books_Updated_Request;
use App\Http\Resources\BookElderResource;
use App\Http\Resources\elderallresource;
use App\Http\Resources\FileBookResoure;
use App\Http\Resources\IdBookResource;
use App\Models\Book;
use App\Models\Elder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

  // get all data Books
  public function Get(){
    $Get_resource =  Book::all();
    return FileBookResoure::collection($Get_resource);
}


    public function store(BookRequests $request)
    {


        // handle file create
        $file = $request->file('file')->store('books_images','dr_amr');



        // handle image create
        $image = $request->file('image')->store('books_images','dr_amr');


        //    create db data -> books
        $data_store =   Book::create([
            'name' => $request->name,
            'file' => $file,
            'image' => $image,
            'status' => $request->status,
            'elder_id' => $request->elder_id

        ]);


        return FileBookResoure::make($data_store);
    }


    // get elder -> Book
    public function Get_dataId($id){
        $data_id =  Book::with('elder')->findOrFail($id);
        return new elderallresource( $data_id);

      }


    //   Edit books and Update

    public function Edit_Book($id)
    {
        $data_id = Book::find($id);
        return IdBookResource::make($data_id);

    }
   // Update Book
    public function Update_Book(books_Updated_Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'file|mimes:pdf,doc,docx|max:2048',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:public,private',
        ]);



       $data =  Book::find($id);
       // Step 1: Remove the old file and image
          if ($data->file) {

              $oldFilePath = unlink(public_path('uploads/'. $data->file));

              if (Storage::disk('dr_amr')->exists($oldFilePath)) {
                  Storage::disk('dr_amr')->delete($oldFilePath);
              }
          }

          if ($data->image) {
              $oldImagePath = unlink(public_path('uploads/'. $data->image));
              if (Storage::disk('dr_amr')->exists($oldImagePath)) {
                  Storage::disk('dr_amr')->delete($oldImagePath);
              }
          }




        // handle file update
        $file = $request->file('file')->store('books_images','dr_amr');

        // handle image update
        $image = $request->file('image')->store('books_images','dr_amr');


        $data->update([
            'name' => $request->name,
            'file' => $file,
            'image' => $image,
            'status' => $request->status,
        ]);

       return FileBookResoure::make($data);
    }
}



