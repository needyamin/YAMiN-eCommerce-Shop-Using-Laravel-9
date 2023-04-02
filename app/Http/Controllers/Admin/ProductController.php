<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\User;
use App\Models\Products;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class ProductController extends Controller
{

    public function Store(Request $request)
    {
        $products = $request->validate([
            'url' => 'unique:products',
            'image1' => 'mimes:jpeg,png,jpg,gif,svg|max:1000',
            'image2' => 'mimes:jpeg,png,jpg,gif,svg|max:1000',
            'image3' => 'mimes:jpeg,png,jpg,gif,svg|max:1000',
            'image4' => 'mimes:jpeg,png,jpg,gif,svg|max:1000',
            'image5' => 'mimes:jpeg,png,jpg,gif,svg|max:1000',
            'image6' => 'mimes:jpeg,png,jpg,gif,svg|max:1000',
        ]);

        $products = new Products();
        $lastrecord = DB::table('products')->latest()->first();
        if ($lastrecord) {
            $id = $lastrecord->id + 1;
        } else {
            $id = $lastrecord + 1;
        }

        $products->id = $id;
        $products->name = $request->input('name');
        $products->url = $request->input('url');
        $products->description = $request->input('small_description');
        $products->price = $request->input('price');
        $products->discount = $request->input('Discount');
        $products->priority = $request->input('priority');
        $products->sku = $request->input('sku');
        $products->title = $request->input('meta_title');
        $products->meta_description = $request->input('meta_description');
        $products->keywords = $request->input('meta_keyword');

        $productscheck = $request->input('rating');
        if (!$productscheck) {
            return redirect()->back()->with('errorProductaddRating', 'Please Select Product Rating');
        }
        $products->rating = $productscheck;

        $products->delivery_charges = $request->input('delivery_charges');
        $products->additional_info = $request->input('additional_info');

        $productscheckCategory = $request->input('category_id');

        if (!$productscheckCategory) {
            return redirect()->back()->with('errorProductaddcategory', 'Please Select Category Name');
        }

        $products->category_id = $productscheckCategory;
        $products->subcategory_id = $request->input('subcategory_id');
        $products->quantity = $request->input('quantity');

        //  $products->new_arrival_products= $request->input('new_arrival_products')==true ? '1':'0';
        //  $products->featured_products= $request->input('featured_products')==true ? '1':'0';
        //  $products->popular_products= $request->input('popular_products')==true ? '1':'0';
        //  $products->offer_products= $request->input('offer_products')==true ? '1':'0';

        $products->status = $request->input('status') == true ? '1' : '0';

        ## Product Image 1
        $image1 = $request->file('image1');
        if ($request->hasfile('image1')) {
            $extension = $image1->getClientOriginalExtension();
            $product_Image_name = $products->url . '-1-.' . $extension;
            $image1->move('Uploads/Products/', $product_Image_name);
            $products->image1 = $product_Image_name;
        }

        ## Product Image 2
        $image2 = $request->file('image2');
        if ($request->hasfile('image2')) {
            $extension = $image2->getClientOriginalExtension();
            $product_Image_name = $products->url . '-2-.' . $extension;
            $image2->move('Uploads/Products/', $product_Image_name);
            $products->image2 = $product_Image_name;
        }

        ## Product Image 3
        $image3 = $request->file('image3');
        if ($request->hasfile('image3')) {
            $extension = $image3->getClientOriginalExtension();
            $product_Image_name = $products->url . '-3-.' . $extension;
            $image3->move('Uploads/Products/', $product_Image_name);
            $products->image3 = $product_Image_name;
        }

        ## Product Image 4
        $image4 = $request->file('image4');
        if ($request->hasfile('image4')) {
            $extension = $image4->getClientOriginalExtension();
            $product_Image_name = $products->url . '-4-.' . $extension;
            $image4->move('Uploads/Products/', $product_Image_name);
            $products->image4 = $product_Image_name;
        }

        ## Product Image 5
        $image5 = $request->file('image5');
        if ($request->hasfile('image5')) {
            $extension = $image5->getClientOriginalExtension();
            $product_Image_name = $products->url . '-5-.' . $extension;
            $image5->move('Uploads/Products/', $product_Image_name);
            $products->image5 = $product_Image_name;
        }

        ## Product Image 6
        $image6 = $request->file('image6');
        if ($request->hasfile('image6')) {
            $extension = $image6->getClientOriginalExtension();
            $product_Image_name = $products->url . '-6-.' . $extension;
            $image6->move('Uploads/Products/', $product_Image_name);
            $products->image6 = $product_Image_name;
        }

        $products->save();
        \LogActivity::addToLog('Product Added by Admin. Product Name: "'.$products->name .'"');
        return redirect()->back()->with('status', 'Product Added Successfully. Link:')->with('product_url', $products->url)->with('product_name', $products->name);

    }

    public function update(Request $request, $id)
    {
        $pupdate = $request->validate([
            'image1' => 'mimes:jpeg,png,jpg,gif,svg|max:1000',
            'image2' => 'mimes:jpeg,png,jpg,gif,svg|max:1000',
            'image3' => 'mimes:jpeg,png,jpg,gif,svg|max:1000',
            'image4' => 'mimes:jpeg,png,jpg,gif,svg|max:1000',
            'image5' => 'mimes:jpeg,png,jpg,gif,svg|max:1000',
            'image6' => 'mimes:jpeg,png,jpg,gif,svg|max:1000',
        ]);

        $pupdate = Products::find($id);
        $pupdate->name = $request->input('name');
        $pupdate->url = $request->input('url');
        $pupdate->description = $request->input('small_description');
        $pupdate->price = $request->input('price');
        $pupdate->discount = $request->input('Discount');
        $pupdate->rating = $request->input('rating');
        $pupdate->priority = $request->input('priority');
        $pupdate->sku = $request->input('sku');
        $pupdate->title = $request->input('meta_title');
        $pupdate->meta_description = $request->input('meta_description');
        $pupdate->keywords = $request->input('meta_keyword');
        $pupdate->status = $request->input('status') == true ? '1' : '0';
        $pupdate->delivery_charges = $request->input('delivery_charges');
        $pupdate->additional_info = $request->input('additional_info');
        $pupdate->category_id = $request->input('category_id');
        $pupdate->subcategory_id = $request->input('subcategory_id');
        $pupdate->quantity = $request->input('quantity');

        $image1 = $request->file('image1');
        if ($request->hasfile('image1')) {
            $destination = public_path('Uploads/Products/') . $pupdate->image1;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $s = uniqid(time(), true);
            $extension = $image1->getClientOriginalExtension();
            $product_Image_name1 = $pupdate->url . $s . '-1-.' . $extension;
            $image1->move(public_path('Uploads/Products/'), $product_Image_name1);
            $pupdate->image1 = $product_Image_name1;
        }


        $image2 = $request->file('image2');
        if ($request->hasfile('image2')) {
            $destination = public_path('Uploads/Products/') . $pupdate->image2;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $s = uniqid(time(), true);
            $extension = $image2->getClientOriginalExtension();
            $product_Image_name2 = $pupdate->url . $s . '-2-.' . $extension;
            $image2->move(public_path('Uploads/Products/'), $product_Image_name2);
            $pupdate->image2 = $product_Image_name2;
        }

        $image3 = $request->file('image3');
        if ($request->hasfile('image3')) {
            $destination = public_path('Uploads/Products/') . $pupdate->image3;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $extension = $image3->getClientOriginalExtension();
            $s = uniqid(time(), true);
            $product_Image_name3 = $pupdate->url . $s . '-3-.' . $extension;
            $image3->move(public_path('Uploads/Products/'), $product_Image_name3);
            $pupdate->image3 = $product_Image_name3;
        }

        $image4 = $request->file('image4');
        if ($request->hasfile('image4')) {
            $destination = public_path('Uploads/Products/') . $pupdate->image4;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $s = uniqid(time(), true);
            $extension = $image4->getClientOriginalExtension();
            $product_Image_name4 = $pupdate->url . $s . '-4-.' . $extension;
            $image4->move(public_path('Uploads/Products/'), $product_Image_name4);
            $pupdate->image4 = $product_Image_name4;
        }


        $image5 = $request->file('image5');
        if ($request->hasfile('image5')) {
            $destination = public_path('Uploads/Products/') . $pupdate->image5;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $extension = $image5->getClientOriginalExtension();
            $s = uniqid(time(), true);
            $product_Image_name5 = $pupdate->url . $s . '-5-.' . $extension;
            $image5->move(public_path('Uploads/Products/'), $product_Image_name5);
            $pupdate->image5 = $product_Image_name5;
        }


        $image6 = $request->file('image6');
        if ($request->hasfile('image6')) {
            $destination = public_path('Uploads/Products/') . $pupdate->image6;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $extension = $image6->getClientOriginalExtension();
            $s = uniqid(time(), true);
            $product_Image_name6 = $pupdate->url . $s . '-6-.' . $extension;
            $image6->move(public_path('Uploads/Products/'), $product_Image_name6);
            $pupdate->image6 = $product_Image_name6;
        }

        $pupdate->save();
        \LogActivity::addToLog('Product Info Updated. Product ID: "' .$pupdate->id . '" Name: "'. $pupdate->name .'"');
        return redirect()->back()->with('status', 'Product Information Updated Successfully');
    }


    ###########################################################################    
//seperate image delete route 
    public function image1delete(Request $request, $id)
    {
        $delete_update = Products::find($id);
        $destination = public_path('Uploads/Products/') . $delete_update->image1;
        if (File::exists($destination)) {
            File::delete($destination);
        }

        $delete_update->image1 = null;
        $delete_update->update();
        \LogActivity::addToLog('Cover Image Delete by Admin');
        return redirect()->back()->with('status', 'Product Cover Image Deleted Successfully');
    }


    public function image2delete(Request $request, $id)
    {
        $delete_update = Products::find($id);
        $destination = public_path('Uploads/Products/') . $delete_update->image2;
        if (File::exists($destination)) {
            File::delete($destination);
        }

        $delete_update->image2 = null;
        $delete_update->update();
        \LogActivity::addToLog('Image 1 Delete by Admin');
        return redirect()->back()->with('status', 'Product Image 1 Deleted Successfully');
    }


    public function image3delete(Request $request, $id)
    {
        $delete_update = Products::find($id);
        $destination = public_path('Uploads/Products/') . $delete_update->image3;
        if (File::exists($destination)) {
            File::delete($destination);
        }

        $delete_update->image3 = null;
        $delete_update->update();
        \LogActivity::addToLog('Image 2 Delete by Admin');
        return redirect()->back()->with('status', 'Product Image 2 Deleted Successfully');
    }

    public function image4delete(Request $request, $id)
    {
        $delete_update = Products::find($id);
        $destination = public_path('Uploads/Products/') . $delete_update->image4;
        if (File::exists($destination)) {
            File::delete($destination);
        }

        $delete_update->image4 = null;
        $delete_update->update();
        \LogActivity::addToLog('Image 3 Delete by Admin');
        return redirect()->back()->with('status', 'Product Image 3 Deleted Successfully');
    }


    public function image5delete(Request $request, $id)
    {
        $delete_update = Products::find($id);
        $destination = public_path('Uploads/Products/') . $delete_update->image5;
        if (File::exists($destination)) {
            File::delete($destination);
        }

        $delete_update->image5 = null;
        $delete_update->update();
        \LogActivity::addToLog('Image 4 Delete by Admin');
        return redirect()->back()->with('status', 'Product Image 4 Deleted Successfully');
    }


    public function image6delete(Request $request, $id)
    {
        $delete_update = Products::find($id);
        $destination = public_path('Uploads/Products/') . $delete_update->image6;
        if (File::exists($destination)) {
            File::delete($destination);
        }

        $delete_update->image6 = null;
        $delete_update->update();
        \LogActivity::addToLog('Image 4 Delete by Admin');
        return redirect()->back()->with('status', 'Product Image 5 Deleted Successfully');
    }
    ###########################################################################   


    public function deleteproduct(Request $request, $id)
    {
        $Products = Products::find($id);
        $Products->status = 2;

        ###status 1 is active user
        ### Status 2 is the user present in the recycle bin (inactive_User)
        $Products->update();
        \LogActivity::addToLog('Products Moved to Recycle Bin');
        return redirect()->back()->with('status', 'Products Moved to Recycle Bin');
    }


    public function restore(Request $request, $id)
    {
        $Products = Products::find($id);
        $Products->status = 1;

        ### status 1 is active user
        ### status 2 is the user present in the recycle bin (inactive_User)
        $Products->update();
        \LogActivity::addToLog('Products Restored By Admin');
        return redirect()->back()->with('status', 'Products Restored Succesfully');


    }

    public function confirmdelete(Request $request, $id)
    {
        $delete = Products::find($id);
        $delete->delete();
        \LogActivity::addToLog('Product Permanently Deleted');
        return redirect()->back()->with('status', 'Product Permanently Deleted  Successfully !!');
    }


    ### PARMENENT DELETE OLDER THAN 90 DAYS RECOARD
    public function OLDERdataDELETE(Request $request)
    {

        session()->forget('cart');
        #Products::whereDate('created_at', '<=', now()->subDays(90))->delete();
        #return redirect()->back()->with('status', 'Product Older Thand 90 days data deleted successfully');

    }

}