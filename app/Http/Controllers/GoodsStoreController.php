<?php

namespace App\Http\Controllers;

use App\Models\goodsStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class GoodsStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = goodsStore::all();
        return view("stores.storesGoods",compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'stores_name' => 'required|unique:goods_stores|max:255',
            'stores_addres' => 'required|max:999',
        ],[

            'stores_name.required' =>'يرجي ادخال اسم المخزن',
            'stores_name.unique' =>'اسم المخزن مسجل مسبقا',
            'stores_addres.required' =>'يرجي ادخال عنوان المخزن',
            'stores_addres.max' =>'العنوان لا يزيد عن 999 حرف',
        ]);

        goodsStore::create([
            'stores_name' => $request->stores_name,
            'stores_addres' => $request->stores_addres,
            'descriprion' => $request->descriprion,
            'created_by' => (Auth::user()->user_fname . " " .  Auth::user()->user_lname),

        ]);
        session()->flash('Add', 'تم اضافة المخزن بنجاح ');
        return redirect('/storesGoods');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\goodsStore  $goodsStore
     * @return \Illuminate\Http\Response
     */
    public function show(goodsStore $goodsStore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\goodsStore  $goodsStore
     * @return \Illuminate\Http\Response
     */
    public function edit(goodsStore $goodsStore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\goodsStore  $goodsStore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, goodsStore $goodsStore)
    {
        $id = $request->id;
        $validatedData = $request->validate([
            'stores_name' => 'required|unique:goods_stores,stores_name,'.$id.'|max:255',
            'stores_addres' => 'required|max:999',
        ],[

            'stores_name.required' =>'يرجي ادخال اسم المخزن',
            'stores_name.unique' =>'اسم المخزن مسجل مسبقا',
            'stores_addres.required' =>'يرجي ادخال عنوان المخزن',
            'stores_addres.max' =>'العنوان لا يزيد عن 999 حرف',
        ]);

        $stores = goodsStore::find($id);
        $stores->update([
            'stores_name' => $request->stores_name,
            'stores_addres' => $request->stores_addres,
            'descriprion' => $request->descriprion,
        ]);

        session()->flash('edit','تم تعديل المخزن بنجاج');
        return redirect('/storesGoods');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\goodsStore  $goodsStore
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        goodsStore::find($id)->delete();
        session()->flash('delete','تم حذف المخزن بنجاح');
        return redirect('/storesGoods');
    }
}
