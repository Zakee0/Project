<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Category;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = product::with('category')->get();
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {
        $categories = Category::all();
        return view('products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string', // Corrected validation rule
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg', // Specify valid mime types
            'category_id' => 'required|string', // Assuming category_id is an integer, use string if it is not
        ]);
    
        $data = $request->all(); // Collect all input data
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/products'), $filename);
            $data['image'] = $filename;
        }

        
    
        Product::create($data); // Use the $data array to create the product
    
        return redirect()
            ->route('products.index')
            ->with('success', 'Product created successfully'); // Fixed success message capitalization
    }
    

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string', // Corrected validation rule
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg', // Specify valid mime types
            'category_id' => 'required', // Assuming category_id is an integer, use string if it is not
        ]);
    
        $data = $request->all(); // Collect all input data
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/products'), $filename);
            $data['image'] = $filename;
        }
    
       
        $product->update($data); // Use the $data array to create the product
    
        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully'); // Fixed success message capitalization
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        $product->delete();
        return redirect()
        ->route('products.index')
        ->with('success','Product deleted successfullt');
    }
}
