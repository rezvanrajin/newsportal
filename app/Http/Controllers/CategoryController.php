<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function categoryView()
    {
       $categories = Category::with('language')->orderBy('category_order','asc')->get();
        return view('backend.admin.category.category_view',compact('categories'));
    }

    public function categoryCreate()
    {
        return view('backend.admin.category.category_create');
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_order' => 'required',
        ]);


        $category = new Category();
        $category->category_name = $request->category_name;
        $category->show_on_menu = $request->show_on_menu;
        $category->category_order = $request->category_order;
        $category->language_id = $request->language_id;
        $category->save();
        return redirect()->back()->with('success','Your Category Add Sucessfully');
        
    }
    public function categoryEdit($id)
    {
       $category = Category::where('id',$id)->first();
        return view('backend.admin.category.category_edit',compact('category'));
    }

    public function categoryUpdate(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required',
            'category_order' => 'required',
        ]);

       $category = Category::where('id',$id)->first();
    $category->category_name = $request->category_name;
    $category->show_on_menu = $request->show_on_menu;
    $category->show_on_menu = $request->show_on_menu;
    $category->category_order = $request->category_order;
    $category->language_id = $request->language_id;

    $category->update();
     
    return redirect()->route('categoryView')->with('success','Your Category Updated Sucessfully');
    
    }

    public function categoryDelete($id)
    {
       $category = Category::where('id',$id)->first();
       $category->delete();     
        return redirect()->route('categoryView')->with('success','Your Category Deleted Sucessfully');

    }
}
