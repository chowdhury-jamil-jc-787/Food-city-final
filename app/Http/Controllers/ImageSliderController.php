<?php

namespace App\Http\Controllers;

use App\Models\Image_slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class ImageSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     
            // $products = Product::all();
            $images = Image_slider::latest()->get();
            return view('backend.image_slider.index',compact('images'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $images = Image_slider::all();
        return view('backend.image_slider.create', compact('images'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //dd($request->all());

        $request->validate([

            'title' =>['required'],
            'description' => ['required','max:1000'],
            'image' => ['required','mimes:jpg,png,jpeg,webp',]
                       
                    ]);
            try { 
                Image_slider::create([
                    'title'=>$request->title,
                    'description'=>$request->description,
                    'image'=>$this->uploadImage($request->file('image'))
                    //'image'=>this-> uploadImage($request->file('image'))
                    ]);
                 return redirect()->route('imageslider.list')->withMessage( 'Image Create Succesfully');
                 // return view('backend.category.store',); 
            
                }
                catch (QueryException $e) {
                    \Log::error($e->getMessage());
                     //dd($e->getMessage());
                    // echo $e->getMessage();
                    //code to handle the exception
                   
                 return redirect()->back()->withInput()->withErrors('Somthing went wroing try again letter !');
                }
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $image_slider = Image_slider::find($id);
        return view('backend.image_slider.show',compact('image_slider'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $image_slider = Image_slider::find($id);
        
        return view('backend.image_slider.edit', compact('image_slider',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([

            'title' =>['required'],
            'description' => ['required','max:1000'],
            'image' => ['required','mimes:jpg,png,jpeg,webp',]
                       
                    ]);
            try {

                Image_slider::where('id',$id)->update(['title'=>$request->title,'description'=>$request->description,'image'=>$this->uploadImage($request->file('image'))]);
                 return redirect()->route('imageslider.list')->withMessage( 'Image Create Succesfully');
                 // return view('backend.category.store',); 
            
                }
                catch (QueryException $e) {
                    \Log::error($e->getMessage());
                     //dd($e->getMessage());
                    // echo $e->getMessage();
                    //code to handle the exception
                   
                 return redirect()->back()->withInput()->withErrors('Somthing went wroing try again letter !');
                }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $image_slider = Image_slider::find($id);
        $image_slider->delete();
        return redirect()->route('imageslider.list')->withMessage('Image_slide Delete Succesfully');
    }
    public function uploadImage($file)
    {
        $fileName = time(). '.'.$file->getClientOriginalExtension();
        Image::make($file)
        ->resize(1000,430)
        ->save(storage_path().'/app/public/Image_slider/'.$fileName);
        return $fileName;
    }

    public function trash(){
        
        $trashed = Image_slider::onlyTrashed()->get();
        return view('backend.image_slider.trashed',compact('trashed'));
        
    }

    public function restore($id){
        Image_slider::onlyTrashed()->find($id)->restore();
       // $restoreData = Image_slider::find($id);
        // $restoreData->restore();
        return redirect()->route('imagesliders.trashed')->withMessage(' Succesfully product restore');

        
        
    }

    public function delete($id){
        Image_slider::onlyTrashed()->find($id)->restore();
        return redirect()->route('imagesliders.trashed')->withMessage(' Succesfully product permanently Delete');

        
        
    }
 

}
