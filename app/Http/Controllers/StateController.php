<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegionRequest;
use App\Models\Region;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Warehouse;
use App\Models\WarehouseStates;
use App\Models\Zone;
use NunoMaduro\Collision\Adapters\Phpunit\State as PhpunitState;
use Yajra\DataTables\DataTables;

class StateController extends Controller
{
    //
    public function __constructor()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = WarehouseStates::orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function(WarehouseStates $data){
                    if($data->status == 1){
                        $status = '<span class="badge badge-success">Active</span>';
                    }
                    else{
                        $status = '<span class="badge badge-danger">Inactivate</span>';
                    }
                    return $status;
                })
                ->addColumn('zone_id', function(WarehouseStates $data){
                    $zonehouse = $data->zoneHouse->name;
                    return $zonehouse;
                })
                ->addColumn('region_id', function(WarehouseStates $data){
                    $zones = Zone::find($data->zone_id);
                    $regionsId = $zones->region_id;
                    $regionsN = Region::find($regionsId);
                    $regionsName = $regionsN->name;
                    return $regionsName;
                })
                ->addColumn('warehouse_id', function(WarehouseStates $data){
                    $zones = Zone::find($data->zone_id);
                    $regionsId = $zones->region_id;
                    $regionsN = Region::find($regionsId);
                    $regionsName = $regionsN->name;
                    $warehouseId = $regionsN->warehouse_id;
                    $warehouseN = Warehouse::find($warehouseId);
                    $warehouseName = $warehouseN->name;
                    return $warehouseName;
                })
                ->addColumn('action', function(WarehouseStates $data){
                    $btn1 = '<a data-id="'.$data->id.'" data-tab="states" data-url="state/delete" 
                    href="javascript:void(0)" class="del_btn btn btn-sm btn-danger">Delete</a>';
                    $btn2 = '<button data-id="'.$data->id.'" class="btn btn-sm btn-primary state_edit" >Edit</button>';
                     //$btn3 = '<a href="'.route('distributor.detail', $data->id).'" class="btn btn-primary btn-sm"> Detail </a>';     
                    if($data->status == 1){
                        $status = '<a onclick="changeStateStatus('.$data->id.',0)" href="javascript:void(0)" class="btn btn-sm btn-danger" style ="margin-top:5px;">Inactivate</a>';
                    }
                    else{
                        $status = '<a onclick="changeStateStatus('.$data->id.',1)" href="javascript:void(0)" class="btn btn-sm btn-success" style ="margin-top:5px;">Activate</a>';
                    }   

                    return $btn2.' '.$status.' '.$btn1;
                })
                ->rawColumns(['action','zone_id','region_id','warehouse_id','status'])
                ->make(true);
        }
        $warehouses= Warehouse::where('status',1)->get();
        $regions = Region::orderBy('id', 'DESC')->get();
        $zones = Zone::orderBy('id', 'DESC')->get();
        return view('admin.warehouse.index',compact('regions','warehouses', 'zones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $data = WarehouseStates::updateOrCreate($request->except('_token'));
        return redirect()->route('state.index')->with('success', 'State added successfully.');
    }

    public function destroy($id)
    {
        $product = WarehouseStates::findOrFail($id);
        $product->delete();
        return response()->json(array(
            'data' => true,
            'message' => 'State Successfully Deleted',
            'status' => 'success',
        ));
    }

    public function getState(Request $request)
    {
        $request->validate([
            'id'=> 'required'
        ]);
        $warestates=WarehouseStates::findOrFail($request->id);
        $zones= Zone::all();
        return response()->json([
            'html' => view('admin.warehouse.state_edit', compact('warestates','zones'))->render()
            ,200, ['Content-Type' => 'application/json']
        ]);

    }

    public function update(Request $request, $id)
    {
        $product = WarehouseStates::find($id)->update($request->except('_token'));
        return redirect()->route('warehouse.index')->with('success', 'Record updated successfully.');
    }

    public function statestatus(Request $request)
    {
        $distributor = WarehouseStates::findOrFail($request->id);
        if (empty($distributor)) {
            return redirect()->back()->with('error', 'No Record Found.');
        }
        $distributor->update(['status'=> $request->input('status')]);
        $status = $distributor->status;
        return response()->json(['status'=>$status,'message'=>'Status Changed Successfully']);
    }
}
