<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LendingsExportMapping;

class LendingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lendings = Lending::with('item', 'user')->get();
        return view('operator.lendings', compact('lendings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::all();
        return view('operator.add-lending', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'item_id' => 'required',
            'total_item' => 'required',
            'ket' => 'required|min:5',
        ]);

        for ($i=0; $i < count($request->item_id); $i++) { 
            $itemCheck = Item::where('id', $request->item_id[$i])->first();
            if ((int)$request->total_item[$i] > (int)$itemCheck['available_total']) {
                return redirect()->back()->with('error', 'Total item more than available!');
            }
        }

        for ($a=0; $a < count($request->item_id); $a++) { 
            $item = Item::where('id', $request->item_id[$a])->first();

            Lending::create([
                'name' => $request->name,
                'item_id' => $request->item_id[$a],
                'total_item' => $request->total_item[$a],
                'ket' => $request->ket,
                'date' => \Carbon\Carbon::now(),
                'user_id' => Auth::user()->id,
            ]);

            $available = (int)$item['available_total'] - (int)$request->total_item[$a];
            $item->update(['available_total' => $available]);
        }

        return redirect()->route('operator.lendings.index')->with('success', 'Success add new lending item!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function show(Lending $lending)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function edit(Lending $lending)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lending = Lending::where('id', $id)->first();
        $lending->update([
            'return_date' => \Carbon\Carbon::now(),
            'user_id' => Auth::user()->id,
        ]);
        $item = Item::where('id', $lending['item_id'])->first();
        $available = $item['available_total'] + $lending['total_item'];
        $item->update(['available_total' => $available]);
        return redirect()->back()->with('success', 'Item is returned!');
    }

    public function export_mapping() {
        return Excel::download(new LendingsExportMapping(), 'lendings.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lending = Lending::where('id', $id)->first();
        if (is_null($lending['return_date'])) {
            $item = Item::where('id', $lending['item_id'])->first();
            $item->update(['available_total' => (int)$item['available_total'] + (int)$lending['total_item'] ]);
        }
        $lending->delete();
        return redirect()->back()->with('deleted', 'Success deleted one data lending!');
    }
}
