<?php

namespace App\Http\Controllers;

use App\Models\purchases;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PurchasesController extends Controller
{
    public $timestamps = true;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data =  purchases::groupBy('material_id')->orderBy("created_at","DESC")->get();
        $data =  DB::table('purchases as m')
        ->select('m.*','materials.materials_name','suppliers.supplier_name','stores.stores_name')
        ->leftJoin('materials','materials.id','=','m.material_id')
        ->leftJoin('suppliers','suppliers.id','=','m.supplier_id')
        ->leftJoin('stores','stores.id','=','m.store_id')
        ->leftJoin('purchases as m1', function ($join) {
              $join->on('m.material_id', '=', 'm1.material_id')
                   ->whereRaw(DB::raw('m.purche_data  < m1.purche_data '));
         })
         ->whereNull('m1.material_id')->orderBy('m.purche_data', 'DESC')->get();
        $count = $data->count();
        return view("purchases.index",compact("data","count"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function show(purchases $purchases)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function edit(purchases $purchases)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, purchases $purchases)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function destroy(purchases $purchases)
    {
        //
    }

}
