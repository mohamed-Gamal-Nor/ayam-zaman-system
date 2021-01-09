<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\sections;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = products::all();
        return view("products.products",compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $sections = sections::select('section_name','id')->get();
        return view('products.addproduct',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'product_name' => 'required|unique:products|max:255',
            'code_marker' => 'required|unique:products|max:255',
            'barcode' => 'required|unique:products|max:255',
            'section_id' => 'required',
            'product_image' => 'required',
        ],[

            'product_name.required' =>'يرجي ادخال اسم المنتج',
            'product_name.unique' =>'اسم المنتج مسجل مسبقا',
            'code_marker.required' =>'يجب ادخال كود الماركر',
            'code_marker.unique' =>'كود الماركر مستخدم مسبقا',
            'barcode.required' =>'يجب ادخال باركود',
            'barcode.unique' =>'البار كود مستخدم مسبقا',
            'section_id.required' =>'يجب اختيار القسم',
            'product_image.required' =>'يجب ارفاق صورة للمنتج',
        ]);
        $image = $request->file('product_image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images/product'),$imageName);

        products::create([
            'product_name' => $request->product_name,
            'descriprion' => $request->descriprion,
            'created_by' => (Auth::user()->user_lname),
            'code_marker' => $request->code_marker,
            'barcode' => $request->barcode,
            'product_image' => $imageName,
            'section_id' => $request->section_id

        ]);
        session()->flash('Add', 'تم اضافة المنتج بنجاح ');
        return redirect('/products/create');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sections = sections::all();
        $product = products::find($id);

		if(is_null($product)){
			return redirect('/products');
		}
		return view('products.editproduct', compact('product','sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|unique:products,product_name,'.$id.'|max:255',
            'code_marker' => 'required|unique:products,code_marker,'.$id.'|max:255',
            'barcode' => 'required|unique:products,barcode,'.$id.'|max:255',
            'section_id' => 'required',
            'product_image' => 'required|mimes:jpg,jpeg,png|max:5000',
        ],[

            'product_name.required' =>'يرجي ادخال اسم المنتج',
            'product_name.unique' =>'اسم المنتج مسجل مسبقا',
            'code_marker.required' =>'يجب ادخال كود الماركر',
            'code_marker.unique' =>'كود الماركر مستخدم مسبقا',
            'barcode.required' =>'يجب ادخال باركود',
            'barcode.unique' =>'البار كود مستخدم مسبقا',
            'section_id.required' =>'يجب اختيار القسم',
            'product_image.required' =>'يجب ارفاق صورة للمنتج',
            'product_image.mimes' => "يجب ان تكون الصورة بصيغة JPG - PNG - JPEG",
            'product_image.max' => "يجب ان لا يزيد حجم الصورة عن خمسة ميجا",
        ]);

        $products = products::find($id);
        $input= $request->all();
        if(!empty($request->file('product_image'))){
            $path = public_path().'\images\product';
            if($products->product_image != ''  && $products->product_image != null){
                 $file_old = $path.$products->product_image;
                 unlink($file_old);
            }
            $file = $request->file('product_image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move($path, $filename);
            $input['product_image'] = $filename;
        }
       $products->update($input);
        session()->flash('Edit', 'تم تعديل المنتج بنجاح ');
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $products=products::find($id);
        $path = public_path().'/images/product/';
        if($products->product_image != ''  && $products->product_image != null){
                $file_old = $path.$products->product_image;
                unlink($file_old);
        }
        products::find($id)->delete();
        session()->flash('delete','تم حذف المنتج بنجاح');
        return redirect('/products');
    }
}
