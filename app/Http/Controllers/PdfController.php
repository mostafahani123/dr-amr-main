<?php
// app/Http/Controllers/PdfController.php

namespace App\Http\Controllers;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function createPdf()
    {


    Storage::disk('local')->put('test.pdf', 'test');
     return "Done";
    //  $path=$request->file('file')->store('Book', 'ADXA');

    //  PdfDocument::create([
    //     'title'=>$request->title,
    //     'file'=>$path,
    //     'elder_id'=>$request->elder_id,
    //  ]);

//    return view('pdf.index');
    }


}
