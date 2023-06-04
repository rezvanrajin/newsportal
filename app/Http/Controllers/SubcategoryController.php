<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;


class SubcategoryController extends Controller
{
    //
    public function Subcategory()
    {
        $subcategories = Subcategory::with(['category','language'])->orderBy('subcategory_order','asc')->get();
        return view('backend.admin.subcategory.subcategory_view',compact('subcategories'));
    }

    public function SubcategoryCreate()
    {
        $category = Category::orderBy('category_order', 'asc')->get();
        return view('backend.admin.subcategory.subcategory_create',compact('category'));

    }

    public function SubcategoryStore(Request $request)
    {
        $request->validate([
            'subcategory_name' => 'required',
            'category_id' => 'required',
            'subcategory_order' => 'required',
        ]);


        $subcategory = new Subcategory();
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->category_id = $request->category_id;
        $subcategory->show_on_menu = $request->show_on_menu;
        $subcategory->show_on_home = $request->show_on_home;
        $subcategory->subcategory_order = $request->subcategory_order;
        $subcategory->language_id = $request->language_id;
        $subcategory->save();
        return redirect()->route('Subcategory')->with('success','Your Sub Category Add Sucessfully');
    }

    public function SubcategoryEdit($id)
    {
        $subcategory = Subcategory::where('id',$id)->first();
        $category = Category::orderBy('category_order', 'asc')->get();
        return view('backend.admin.subcategory.subcategory_edit',compact('subcategory','category'));
    }
    public function SubcategoryUpdate(Request $request, $id)
    {
        $request->validate([
            'subcategory_name' => 'required',
            'subcategory_order' => 'required',
        ]);

        $subcategory = Subcategory::where('id',$id)->first();
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->category_id = $request->category_id;
        $subcategory->show_on_menu = $request->show_on_menu;
        $subcategory->show_on_home = $request->show_on_home;
        $subcategory->subcategory_order = $request->subcategory_order;
        $subcategory->language_id = $request->language_id;
        $subcategory->update();
        return redirect()->route('Subcategory')->with('success','Your Sub Category Updated Sucessfully');
    
    }
    public function SubcategoryDelete($id)
    {
        $subcategory = Subcategory::where('id',$id)->first();
       $subcategory->delete();     
        return redirect()->route('Subcategory')->with('success','Your Sub Category Deleted Sucessfully');
    }
}
