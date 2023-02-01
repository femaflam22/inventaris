<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Lending;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ItemsExportMapping;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::with('category', 'lendings')->get();
        return view('admin.items', compact('items'));
    }

    public function operator()
    {
        $items = Item::with('category', 'lendings')->get();
        return view('operator.items', compact('items'));
    }

    public function lending($item)
    {
        $lendings = Lending::with('item', 'user')->where('item_id', $item)->get();
        return view('admin.lending-detail', compact('lendings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.add-item', compact('categories'));
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
            'name' => 'required|min:2',
            'category_id' => 'required',
            'total' => 'required|numeric|min:1',
        ]);

        $request['available_total'] = $request->total;
        $request['repair_total'] = 0;
        Item::create($request->all());

        return redirect()->route('admin.items.index')->with('success', 'Success add new item!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        $categories = Category::all();
        return view('admin.edit-item', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:2',
            'category_id' => 'required',
            'total' => 'required|numeric|min:1',
            'repair_total' => 'required',
        ]);

        $item = Item::where('id', $id)->first();

        $lendings = Lending::where('item_id', $id)->get();
        $used = 0;
        if (count($lendings) > 0) {
            foreach($lendings as $lending){
                $used += (int)$lending['total_item'];
            }
        }

        if ($request->total < $used) {
            return redirect()->back()->with('error', 'The new total is less than the number of items currently in use');
        }else {
            if ($request->repair_total == 0) {
                $repair_total = $item['repair_total'];
            }else {
                $repair_total = (int)$item['repair_total'] + (int)$request->repair_total;
                if ($request->repair_total > $request->total) {
                    return redirect()->back()->with('error', 'The additional repair item is more than the number of total items');
                }
            }
            
            $item->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'total' =>  $request->total,
                'available_total' => (int)$request->total - (int)$used - (int)$repair_total,
                'repair_total' => $repair_total,
            ]);
    
            return redirect()->route('admin.items.index')->with('success', 'Success update data item!');
        }
    }

    public function export_mapping() {
       return Excel::download(new ItemsExportMapping(), 'items.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Success removed item!');
    }
}
