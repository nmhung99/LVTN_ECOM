<?php

namespace App\Http\Controllers;
use Cart;
use DB;
use Session;



use Illuminate\Http\Request;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     // $this->middleware('verified');
    // }
    public function productView($id, $product_name)
    {
    	$product = DB::table('products')
    				->leftJoin('categories','products.category_id','categories.id')
    				->leftJoin('subcategories','products.subcategory_id','subcategories.id')
    				->leftJoin('brands','products.brand_id','brands.id')
    				->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')
    				->where('products.id',$id)
    				->first();
    	$color = $product->product_color;
    	$product_color = explode(',', $color);

    	return view('pages.product_details',['product'=>$product,'product_color'=>$product_color]);
    }

    public function addCart($id, Request $request)
    {
        
        $product = DB::table('products')->where('id',$id)->first();
        $product_color = $request->productcolor;
        $quantity = $request->qtybutton;
        $data = [];
        $image = json_decode($product->image);
        if ($product->discount_price == NULL) {
            $data = [
                'id'        => $product->id,
                'name'      => $product->product_name,
                'qty'       => $quantity,
                'weight'    => 1,
                'price'     => $product->selling_price,
                'options'   => ['image' =>$image[0], 'color' => $product_color]
            ];
            Cart::add($data);
            return response()->json([
                  'status' => true,
                  'message' => 'Thêm Vào Giỏ Hàng Thành Công'
              ], 200); 
        } 
        else {
            $data = [
                'id'        => $product->id,
                'name'      => $product->product_name,
                'qty'       => $quantity,
                'weight'    => 1,
                'price'     => $product->discount_price,
                'options'   => ['image' =>$image[0], 'color' => $product_color]
            ];
            Cart::add($data);
            return response()->json([
                  'status' => true,
                  'message' => 'Thêm Vào Giỏ Hàng Thành Công'
              ], 200); 
        }
    }

    public function productPage($id, Request $request)
    {

        $order = $request->order;
        $min = (int)$request->minprice;
        $max = (int)$request->maxprice;
        if (!empty($min) && !empty($max)) {
          if (!empty($order)) {
            if ($order == 'name_desc') {
              $products = DB::table('products')->where('brand_id',$id)->where(DB::raw('CAST(final_price AS INT)'),'>=',$min)->where(DB::raw('CAST(final_price AS INT)'),'<=',$max)->orderBy('product_name','DESC')->paginate(12);
              $cat = DB::table('brands')->where('id',$id)->first();
              Session::forget('brandcat');
              Session::forget('brandsubcat');
              $check = 'hasrangeprice';
              return view('pages.all_products',['products'=>$products,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
            } 
            elseif ($order == 'name_asc') {
              $products = DB::table('products')->where('brand_id',$id)->where(DB::raw('CAST(final_price AS INT)'),'>=',$min)->where(DB::raw('CAST(final_price AS INT)'),'<=',$max)->orderBy('product_name','ASC')->paginate(12);
              $cat = DB::table('brands')->where('id',$id)->first();
              Session::forget('brandcat');
              Session::forget('brandsubcat');
              $check = 'hasrangeprice';
              return view('pages.all_products',['products'=>$products,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
            } 
            elseif ($order == 'price_asc') {
              $query = "CAST(final_price AS DECIMAL(10,2)) ASC";
              $products = DB::table('products')->where('brand_id',$id)->where(DB::raw('CAST(final_price AS INT)'),'>=',$min)->where(DB::raw('CAST(final_price AS INT)'),'<=',$max)->orderByRaw($query)->paginate(12);
              $cat = DB::table('brands')->where('id',$id)->first();
              Session::forget('brandcat');
              Session::forget('brandsubcat');
              $check = 'hasrangeprice';
              return view('pages.all_products',['products'=>$products,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
                
            }
            elseif ($order == 'price_desc') {
              $query = "CAST(final_price AS DECIMAL(10,2)) DESC";
                $products = DB::table('products')->where('brand_id',$id)->where(DB::raw('CAST(final_price AS INT)'),'>=',$min)->where(DB::raw('CAST(final_price AS INT)'),'<=',$max)->orderByRaw($query)->paginate(12);
                $cat = DB::table('brands')->where('id',$id)->first();
                Session::forget('brandcat');
                Session::forget('brandsubcat');
                $check = 'hasrangeprice';
              return view('pages.all_products',['products'=>$products,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
            }
            
          } else {
           $products = DB::table('products')->where('brand_id',$id)->where(DB::raw('CAST(final_price AS INT)'),'>=',$min)->where(DB::raw('CAST(final_price AS INT)'),'<=',$max)->paginate(12);
           $cat = DB::table('brands')->where('id',$id)->first();
        // Session::put('brandcat','brandcat');
           Session::forget('brandcat');
           Session::forget('brandsubcat');
           $check = 'hasrangeprice';
              return view('pages.all_products',['products'=>$products,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
         }
        } else {
          if (!empty($order)) {
            if ($order == 'name_desc') {
              $products = DB::table('products')->where('brand_id',$id)->orderBy('product_name','DESC')->paginate(12);
              $cat = DB::table('brands')->where('id',$id)->first();
              Session::forget('brandcat');
              Session::forget('brandsubcat');
              $check = 'norangeprice';
              return view('pages.all_products',['products'=>$products,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
            } 
            elseif ($order == 'name_asc') {
              $products = DB::table('products')->where('brand_id',$id)->orderBy('product_name','ASC')->paginate(12);
              $cat = DB::table('brands')->where('id',$id)->first();
              Session::forget('brandcat');
              Session::forget('brandsubcat');
              $check = 'norangeprice';
              return view('pages.all_products',['products'=>$products,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
            } 
            elseif ($order == 'price_asc') {
              $query = "CAST(final_price AS DECIMAL(10,2)) ASC";
              $products = DB::table('products')->where('brand_id',$id)->orderByRaw($query)->paginate(12);
              $cat = DB::table('brands')->where('id',$id)->first();
              Session::forget('brandcat');
              Session::forget('brandsubcat');
              $check = 'norangeprice';
              return view('pages.all_products',['products'=>$products,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
                
            }
            elseif ($order == 'price_desc') {
              $query = "CAST(final_price AS DECIMAL(10,2)) DESC";
                $products = DB::table('products')->where('brand_id',$id)->orderByRaw($query)->paginate(12);
                $cat = DB::table('brands')->where('id',$id)->first();
                Session::forget('brandcat');
                Session::forget('brandsubcat');
                $check = 'norangeprice';
              return view('pages.all_products',['products'=>$products,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
            }
            
          } else {
           $products = DB::table('products')->where('brand_id',$id)->paginate(12);
           $cat = DB::table('brands')->where('id',$id)->first();
        // Session::put('brandcat','brandcat');
           Session::forget('brandcat');
           Session::forget('brandsubcat');
           $check = 'norangeprice';
              return view('pages.all_products',['products'=>$products,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
         }
       }
        

        
    }

    public function productPageSub($id, Request $request)
    {
        $order = $request->order;
        $min = (int)$request->minprice;
        $max = (int)$request->maxprice;
        if (!empty($min) && !empty($max)) {
          if (!empty($order)) {
            if ($order == 'name_desc') {
                $products = DB::table('products')->where('subcategory_id',$id)->where(DB::raw('CAST(final_price AS INT)'),'>=',$min)->where(DB::raw('CAST(final_price AS INT)'),'<=',$max)->orderBy('product_name','DESC')->paginate(12);

                $cat = DB::table('subcategories')->where('id',$id)->first();
                Session::forget('brandcat');
                Session::put('brandsubcat','brandsubcat');
                $brands =  DB::table('products')->where('subcategory_id',$id)->select('brand_id')->groupBy('brand_id')->get();
                
                $check = 'hasrangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]); 
            } 
            elseif ($order == 'name_asc') {
               $products = DB::table('products')->where('subcategory_id',$id)->where(DB::raw('CAST(final_price AS INT)'),'>=',$min)->where(DB::raw('CAST(final_price AS INT)'),'<=',$max)->orderBy('product_name','ASC')->paginate(12);

                $cat = DB::table('subcategories')->where('id',$id)->first();
                Session::forget('brandcat');
                Session::put('brandsubcat','brandsubcat');
                $brands =  DB::table('products')->where('subcategory_id',$id)->select('brand_id')->groupBy('brand_id')->get();
                
                $check = 'hasrangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]); 
            } 
            elseif ($order == 'price_asc') {
              $query = "CAST(final_price AS DECIMAL(10,2)) ASC";
                $products = DB::table('products')->where('subcategory_id',$id)->where(DB::raw('CAST(final_price AS INT)'),'>=',$min)->where(DB::raw('CAST(final_price AS INT)'),'<=',$max)->orderByRaw($query)->paginate(12);

                $cat = DB::table('subcategories')->where('id',$id)->first();
                Session::forget('brandcat');
                Session::put('brandsubcat','brandsubcat');
                $brands =  DB::table('products')->where('subcategory_id',$id)->select('brand_id')->groupBy('brand_id')->get();
                
                $check = 'hasrangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]); 
            }
            elseif ($order == 'price_desc') {
              $query = "CAST(final_price AS DECIMAL(10,2)) DESC";
                $products = DB::table('products')->where('subcategory_id',$id)->where(DB::raw('CAST(final_price AS INT)'),'>=',$min)->where(DB::raw('CAST(final_price AS INT)'),'<=',$max)->orderByRaw($query)->paginate(12);

                $cat = DB::table('subcategories')->where('id',$id)->first();
                Session::forget('brandcat');
                Session::put('brandsubcat','brandsubcat');
                $brands =  DB::table('products')->where('subcategory_id',$id)->select('brand_id')->groupBy('brand_id')->get();
                
                $check = 'hasrangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]); 
            }
            
          } else {
           $products = DB::table('products')->where('subcategory_id',$id)->where(DB::raw('CAST(final_price AS INT)'),'>=',$min)->where(DB::raw('CAST(final_price AS INT)'),'<=',$max)->paginate(12);

           $cat = DB::table('subcategories')->where('id',$id)->first();
        // $idcat = DB::table('subcategories')->where('id',$id)->first();
        // $idbrandsubcat = DB::table('brands')->where('category_id',$idbrand->category_id)->first();
           Session::forget('brandcat');
           Session::put('brandsubcat','brandsubcat');
        // Session::put('brandsubcat',['idcat'=>$idcat->category_id]);
           $brands =  DB::table('products')->where('subcategory_id',$id)->select('brand_id')->groupBy('brand_id')->get();
           
                $check = 'hasrangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
         }
        } else {
          if (!empty($order)) {
            if ($order == 'name_desc') {
                $products = DB::table('products')->where('subcategory_id',$id)->orderBy('product_name','DESC')->paginate(12);

                $cat = DB::table('subcategories')->where('id',$id)->first();
                Session::forget('brandcat');
                Session::put('brandsubcat','brandsubcat');
                $brands =  DB::table('products')->where('subcategory_id',$id)->select('brand_id')->groupBy('brand_id')->get();
                $check = 'norangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]); 
            } 
            elseif ($order == 'name_asc') {
               $products = DB::table('products')->where('subcategory_id',$id)->orderBy('product_name','ASC')->paginate(12);

                $cat = DB::table('subcategories')->where('id',$id)->first();
                Session::forget('brandcat');
                Session::put('brandsubcat','brandsubcat');
                $brands =  DB::table('products')->where('subcategory_id',$id)->select('brand_id')->groupBy('brand_id')->get();
                $check = 'norangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]); 
            } 
            elseif ($order == 'price_asc') {
              $query = "CAST(final_price AS DECIMAL(10,2)) ASC";
                $products = DB::table('products')->where('subcategory_id',$id)->orderByRaw($query)->paginate(12);

                $cat = DB::table('subcategories')->where('id',$id)->first();
                Session::forget('brandcat');
                Session::put('brandsubcat','brandsubcat');
                $brands =  DB::table('products')->where('subcategory_id',$id)->select('brand_id')->groupBy('brand_id')->get();
                $check = 'norangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]); 
            }
            elseif ($order == 'price_desc') {
              $query = "CAST(final_price AS DECIMAL(10,2)) DESC";
                $products = DB::table('products')->where('subcategory_id',$id)->orderByRaw($query)->paginate(12);

                $cat = DB::table('subcategories')->where('id',$id)->first();
                Session::forget('brandcat');
                Session::put('brandsubcat','brandsubcat');
                $brands =  DB::table('products')->where('subcategory_id',$id)->select('brand_id')->groupBy('brand_id')->get();
                $check = 'norangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]); 
            }
            
          } else {
           $products = DB::table('products')->where('subcategory_id',$id)->paginate(12);

           $cat = DB::table('subcategories')->where('id',$id)->first();
        // $idcat = DB::table('subcategories')->where('id',$id)->first();
        // $idbrandsubcat = DB::table('brands')->where('category_id',$idbrand->category_id)->first();
           Session::forget('brandcat');
           Session::put('brandsubcat','brandsubcat');
        // Session::put('brandsubcat',['idcat'=>$idcat->category_id]);
           $brands =  DB::table('products')->where('subcategory_id',$id)->select('brand_id')->groupBy('brand_id')->get();
           $check = 'norangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
         }
       }
        

       
    }

    public function productPageCat($id, Request $request)
    {
        $order = $request->order;
        $min = (int)$request->minprice;
        $max = (int)$request->maxprice;
        if (!empty($min) && !empty($max)) {
          if (!empty($order)) {
            if ($order == 'name_desc') {
                $products = DB::table('products')->where('category_id',$id)->where(DB::raw('CAST(final_price AS INT)'),'>=',$min)->where(DB::raw('CAST(final_price AS INT)'),'<=',$max)->orderBy('product_name','DESC')->paginate(12);
                $cat = DB::table('categories')->where('id',$id)->first();
                $brands   = DB::table('products')->where('category_id',$id)->select('brand_id')->groupBy('brand_id')->get();
                Session::forget('brandsubcat');
                Session::put('brandcat','brandcat');
                $check = 'hasrangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
            } 
            elseif ($order == 'name_asc') {
                $products = DB::table('products')->where('category_id',$id)->where(DB::raw('CAST(final_price AS INT)'),'>=',$min)->where(DB::raw('CAST(final_price AS INT)'),'<=',$max)->orderBy('product_name','ASC')->paginate(12);
                $cat = DB::table('categories')->where('id',$id)->first();
                $brands   = DB::table('products')->where('category_id',$id)->select('brand_id')->groupBy('brand_id')->get();
                Session::forget('brandsubcat');
                Session::put('brandcat','brandcat');
                $check = 'hasrangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
            } 
            elseif ($order == 'price_asc') {
              $query = "CAST(final_price AS DECIMAL(10,2)) ASC";
                $products = DB::table('products')->where('category_id',$id)->where(DB::raw('CAST(final_price AS INT)'),'>=',$min)->where(DB::raw('CAST(final_price AS INT)'),'<=',$max)->orderByRaw($query)->paginate(12);
                $cat = DB::table('categories')->where('id',$id)->first();
                $brands   = DB::table('products')->where('category_id',$id)->select('brand_id')->groupBy('brand_id')->get();
                Session::forget('brandsubcat');
                Session::put('brandcat','brandcat');
                $check = 'hasrangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
            }
            elseif ($order == 'price_desc') {
              $query = "CAST(final_price AS DECIMAL(10,2)) DESC";
                $products = DB::table('products')->where('category_id',$id)->where(DB::raw('CAST(final_price AS INT)'),'>=',$min)->where(DB::raw('CAST(final_price AS INT)'),'<=',$max)->orderByRaw($query)->paginate(12);
                $cat = DB::table('categories')->where('id',$id)->first();
                $brands   = DB::table('products')->where('category_id',$id)->select('brand_id')->groupBy('brand_id')->get();
                Session::forget('brandsubcat');
                Session::put('brandcat','brandcat');
                $check = 'hasrangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
            }
            
          } else {
            $final_price= "CAST(final_price AS INT)";
            $products = DB::table('products')->where('category_id',$id)->where(DB::raw('CAST(final_price AS INT)'),'>=',$min)->where(DB::raw('CAST(final_price AS INT)'),'<=',$max)->paginate(12);
            $cat = DB::table('categories')->where('id',$id)->first();
            $brands   = DB::table('products')->where('category_id',$id)->select('brand_id')->groupBy('brand_id')->get();
            Session::forget('brandsubcat');
            Session::put('brandcat','brandcat');
                $check = 'hasrangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
          }
        } else {
          if (!empty($order)) {
            if ($order == 'name_desc') {
                $products = DB::table('products')->where('category_id',$id)->orderBy('product_name','DESC')->paginate(12);
                $cat = DB::table('categories')->where('id',$id)->first();
                $brands   = DB::table('products')->where('category_id',$id)->select('brand_id')->groupBy('brand_id')->get();
                Session::forget('brandsubcat');
                Session::put('brandcat','brandcat');
                $check = 'norangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
            } 
            elseif ($order == 'name_asc') {
                $products = DB::table('products')->where('category_id',$id)->orderBy('product_name','ASC')->paginate(12);
                $cat = DB::table('categories')->where('id',$id)->first();
                $brands   = DB::table('products')->where('category_id',$id)->select('brand_id')->groupBy('brand_id')->get();
                Session::forget('brandsubcat');
                Session::put('brandcat','brandcat');
                $check = 'norangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
            } 
            elseif ($order == 'price_asc') {
              $query = "CAST(final_price AS DECIMAL(10,2)) ASC";
                $products = DB::table('products')->where('category_id',$id)->orderByRaw($query)->paginate(12);
                $cat = DB::table('categories')->where('id',$id)->first();
                $brands   = DB::table('products')->where('category_id',$id)->select('brand_id')->groupBy('brand_id')->get();
                Session::forget('brandsubcat');
                Session::put('brandcat','brandcat');
                $check = 'norangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
            }
            elseif ($order == 'price_desc') {
              $query = "CAST(final_price AS DECIMAL(10,2)) DESC";
                $products = DB::table('products')->where('category_id',$id)->orderByRaw($query)->paginate(12);
                $cat = DB::table('categories')->where('id',$id)->first();
                $brands   = DB::table('products')->where('category_id',$id)->select('brand_id')->groupBy('brand_id')->get();
                Session::forget('brandsubcat');
                Session::put('brandcat','brandcat');
                $check = 'norangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
            }
            
          } else {
            $products = DB::table('products')->where('category_id',$id)->paginate(12);
            $cat = DB::table('categories')->where('id',$id)->first();
            $brands   = DB::table('products')->where('category_id',$id)->select('brand_id')->groupBy('brand_id')->get();
            Session::forget('brandsubcat');
            Session::put('brandcat','brandcat');
                $check = 'norangeprice';
                return view('pages.all_products',['products'=>$products,'brands'=>$brands,'cat'=>$cat,'check'=>$check,'min'=>$min,'max'=>$max]);
          }
        }
        
        
    }
}
