<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Item2;

class ListController extends Controller
{
    public function index() {
    	$items = Item::all();
    	$items2 = Item2::all();
    	//return $items;
    	return view('list', compact('items', 'items2'));
    }

    public function create(Request $request) {
    	$item = new Item;
    	$item->item = $request->text; // ->item from DB
    	$item->save();
    	return 'Done';
    }

    public function delete(Request $request) {
    	Item::where('id', $request->id)->delete();
    	return $request->all();
    }

    public function update(Request $request) {
    	$this->validate($request, array(
            // rules 
            'value'         => 'required|min:3|max:255'
        ));
    	$item = Item::find($request->id);
    	$item->item = $request->value;
    	$item->save();
    	return $request->all();
    }

    public function create2(Request $request) {
    	$item2 = new Item2;
    	//return $request->text;
    	$item2->item = $request->text2; // ->item from DB
    	$item2->save();
    	return 'Done';
    }

    public function delete2(Request $request) {
    	Item2::where('id', $request->id)->delete();
    	return $request->all();
    }

    public function update2(Request $request) {
    	$item2 = Item2::find($request->id);
    	$item2->item = $request->value2;
    	$item2->save();
    	return $request->all();
    }
}
