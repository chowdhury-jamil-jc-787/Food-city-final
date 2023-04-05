<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Product\StoreRequest;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete| product-show|product-trashed|product-trashed-restore|product-trashed-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
         $this->middleware('permission:product-show', ['only' => ['show']]);
         $this->middleware('permission:product-trashed', ['only' => ['trashed']]);
         $this->middleware('permission:product-trashed-restore', ['only' => ['restore']]);
         $this->middleware('permission:product-trashed-delete', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('backend.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products,name',
            'description' =>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'price' => 'required',
            'category_id' =>'required'
        ]);

        $selectedValues = [];

        if ($request->has('checkbox1')) {
            $selectedValues[] = '1';
        }
        
        if ($request->has('checkbox2')) {
            $selectedValues[] = '2';
        }
        
        if ($request->has('checkbox3')) {
            $selectedValues[] = '3';
        }
        
        $combinedValues = implode(',', $selectedValues);

    
        Product::create([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
            'price'=>$request->price,
            'image'=>$this->uploadImage($request->file('image')),
            'size' => $combinedValues

        ]);

        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('backend.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('backend.product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|unique:products,name->ignore($this->id)',
            'description' =>'required',
            'price' => 'required',
            'category_id' =>'required'
        ]);
  
        $selectedValues = [];

        if ($request->has('checkbox1')) {
            $selectedValues[] = '1';
        }
        
        if ($request->has('checkbox2')) {
            $selectedValues[] = '2';
        }
        
        if ($request->has('checkbox3')) {
            $selectedValues[] = '3';
        }
        
        $combinedValues = implode(',', $selectedValues);

        $requestData = [
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
            'price'=>$request->price,
            'size' => $combinedValues
        ];

        if ($request->hasFile('image')) {
            $requestData['image'] = $this->uploadImage(request()->file('image'));
        }

        $product->update($requestData);
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
     
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }

    public function uploadImage($file){
        $fileName = time().'.'.$file->getClientOriginalExtension();
        Image::make($file)
            ->resize(500,450)
            ->save(storage_path().'/app/public/products/'.$fileName);

            return $fileName;
    }

    public function trashed()
    {
       $trashData = Product::onlyTrashed()->get();
        return view('backend.product.trashed', compact('trashData'));
      
    }

    public function restore($id)
    {
        $restoreData =Product::onlyTrashed()->findOrFail($id);
        $restoreData->restore();
        return redirect()->route('products.trashed')
        ->with('success','Product restored successfully.');


    }
    public function delete($id)
    {
        $restoreData =Product::onlyTrashed()->findOrFail($id);
        $restoreData->forceDelete();
        return redirect()->route('products.trashed')
        ->with('success','product permanent deleted successfully.');


    }

}
