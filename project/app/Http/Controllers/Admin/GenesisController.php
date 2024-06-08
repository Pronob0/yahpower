<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bible;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GenesisController extends Controller
{
    public function index()
    {
        $bibles = Bible::orderby('genesis', 'asc')->paginate(15);
        return view('admin.bible.index', compact('bibles'));
    }

    public function store(Request $request)
    {

        $this->storeData($request, new Bible());
        return back()->with('success', __('Text added successfully'));
    }

    public function update(Request $request, $id)
    {
        $bcategory = Bible::findOrFail($id);
        $this->storeData($request, $bcategory, $id);
        return back()->with('success', __('Bible updated successfully'));
    }

    public function storeData($request, $data, $id = null)
    {
        $request->validate([
            'text' => 'required|string|max:255|unique:bibles,text,' . $id,
        ]);
        

        $data->text = $request->text;
        $data->genesis = $request->genesis;
        $data->save();

    }

    public function destroy(Request $request)
    {
        $bcategory = Bible::findOrFail($request->id);
        $bcategory->delete();
        return back()->with('success', __('Category deleted successfully'));
    }
}
