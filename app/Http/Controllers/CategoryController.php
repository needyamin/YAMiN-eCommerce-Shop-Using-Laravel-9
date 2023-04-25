<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller; 
use App\Models\User;
use App\Models\Products;
use App\Models\category;
use App\Models\subcategory;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function AddCategory(Request $request){
        return view('dashboards.admin.AddCategory');
    }

 ######## CATEGORY FEED FETCHING ########
    public function categoryfetch(Request $request, $category) {
        $find_pdID = category::where('slug', '=', $category)->orwhere('id', '=', $category)->latest()->first();

        if(!$find_pdID){
         abort(404);
        }

        $mycatID= $find_pdID->id;

        ## category feed display all subcategory name @query
        $pCateGID = subcategory::where('category_id','=',$mycatID)->latest()->get();

        # fetch cat ID by product
        $Products=Products::where('category_id','=', $mycatID)->where('status','=',1)->latest()->paginate(12);
        $ProductsCount=Products::where('category_id','=', $mycatID)->where('status','=',1)->count();

        ///if hit all products link
        if ($request->has('all')) {
            $Products=Products::where('category_id','=', $mycatID)->where('status','=',1)->latest()->paginate(200);
            $category = category::where('id', '=', $mycatID)->latest()->first();
            return view('categorys_feed', [
                'Products' => $Products, 
                'category' => $category,
                'pCateGID' => $pCateGID,
                'ProductsCount' => $ProductsCount,
            ]);
         }


        $category = category::where('id', '=', $mycatID)->latest()->first();
        return view('categorys_feed', [
            'Products' => $Products, 
            'category' => $category,
            'pCateGID' => $pCateGID,
            'ProductsCount' => $ProductsCount,
        ]);
        
    }



 ######## SUBCATEGORY FEED FETCHING  ########
    public function subcategoryfetch(Request $request, $category) {
        ########
        $find_pdID = subcategory::where('slug', '=', $category)->orwhere('id', '=', $category)->latest()->first();

        if(!$find_pdID){
           abort(404);
        }
 
        $mycatID= $find_pdID->id;

        $Products=Products::where('subcategory_id','=', $mycatID)->latest()->paginate(12);
        $subcategory = subcategory::where('id', '=', $mycatID)->latest()->first();
        return view('subcategory_feed', [
            'Products' => $Products, 
            'subcategory' => $subcategory,
        ]);
        
    }

    //start 30-11-2022
    public function show_category_edit_view(Request $request, $id){
       $category=category::findOrFail($id);
       return view('dashboards.admin.edit_category', [
            'category' => $category, 
        ]);
    }



    ### IMAGE UPLOAD ISSUES fixed 1-12-2022 start###
    public function editupdatecategory(Request $request){
        $id=$request->id;
        $category=category::find($id);  
        $category->name= $request->input('name'); 
        $category->slug= $request->input('slug');
        $category->keywords= $request->input('keywords');
        $category->description= $request->input('description');

        $image =$request->file('image');
        if($request->hasfile('image'))
        {
            $destination='Uploads/Category/'.$category->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $extension=$image->getClientOriginalExtension();
            $product_Image_name=$category->slug.'-1-.'.$extension;
            $image->move('Uploads/Category/',$product_Image_name);
            $category->image=$product_Image_name;

        }

        $category->short_list = $request->input('short_list');
        $category->save();
        return redirect()->back()->with('status', 'Category Information Updated');
    }

       ### IMAGE UPLOAD ISSUES fixed 1-12-2022 end###
       #public function deletecategory(Request $request, $id){
           #$category=category::find($id);
           #$category->delete();
           #return redirect()->back()->with('status', 'Products Deleted');
       #}




public function showCategory(){
        return view('dashboards.admin.category');
    }

public function showSubCategory(){
    return view('dashboards.admin.SubCategory');
}    

public function AddSubCategory(){
return view('dashboards.admin.AddSubCategory');
}
    
public function updateCategory(Request $request){
    $category = new category();
    $category->name= $request->input('name'); 
    $category->product_id= '0';
    $category->slug= $request->input('slug');
    
    #$category->image= $request->input('image');
    $image1 =$request->file('image1');
           if($request->hasfile('image1')){
               $extension=$image1->getClientOriginalExtension();
               $product_Image_name=$category->slug.'-1-.'.$extension;
               $image1->move('Uploads/Category/',$product_Image_name);
               $category->image=$product_Image_name;
             }

    $category->discount_percent= $request->input('discount_percent');
    $category->short_list = $request->input('short_list');
    $category->save();
   return redirect()->back()->with('status', 'Category Information Created');

   }



   public function updateSubCategory(Request $request){
    $subcategory = new subcategory();
    $subcategory->name= $request->input('name'); 
    $subcategory->slug= $request->input('slug');
    $subcategory->keywords= $request->input('keywords');
    $subcategory->description= $request->input('description');
    $subcategory->category_id= $request->input('category_id');
    $subcategory->save();
    return redirect(route('showSubCategory'));
   }



}
