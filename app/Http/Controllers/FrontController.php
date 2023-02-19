<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\FrontLoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;
use App\Models\Product;
use App\Models\Member;
use App\Models\Faq;
use App\Models\Privacy;
use App\Models\About;
use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Sitemap;
use App\Models\Slider;
use App\Models\Favorite;
use App\Models\Cart;
use App\Models\FavoriteLink;
use Carbon\Carbon;
use \Toastr;
use Redirect;
use App;

class FrontController extends Controller
{
    public function lang(Request $request){
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
  
        return redirect()->back();
    }

    public function index(){
        if(Auth::guard('member')->user()){
            $data['category'] = Category::where('is_deleted', 0)->orderBy('category_name', 'ASC')->get();
            $data['main_category'] = Category::where('parent_id', null)->where('is_deleted', 0)->orderBy('category_name', 'ASC')->get();
            $data['products'] = Product::orderBy('sku', 'ASC')->paginate(12);
            $data['slider'] = Slider::where('is_deleted', 0)->get();
        }else{
            // dd(Session::get('cart'));
            // Session::forget('cart');
            $data['category'] = Category::where('is_deleted', 0)->orderBy('category_name', 'ASC')->get();
            $data['main_category'] = Category::where('parent_id', null)->where('is_deleted', 0)->where('category_authorize', 'all')->orderBy('category_name', 'ASC')->get();
            $data['products'] = Product::where('product_authorize', 'all')->orderBy('sku', 'ASC')->paginate(12);
            $data['slider'] = Slider::where('is_deleted', 0)->get();
        }
        
        return view('frontend/index', $data);
    }

    public function singleProductDetails($id){
        $category_id = Product::join('tbl_category', 'tbl_product.category', 'tbl_category.id')
                                ->where('tbl_product.id', $id)
                                ->first(['tbl_category.id', 'tbl_category.category_name']);
        $sub_category = Product::join('tbl_category', 'tbl_product.sub_category', 'tbl_category.id')
                                ->where('tbl_product.id', $id)
                                ->first(['tbl_category.category_name']); 
        $data['category'] = $category_id->category_name;                       
        $data['sub_category'] = $sub_category->category_name;                       
        $data['product'] = Product::where('id', $id)->first();
        $data['related_product'] = Product::join('tbl_category', 'tbl_product.category', 'tbl_category.id')
                                            ->where('tbl_category.id', $category_id->id)
                                            ->inRandomOrder()
                                            ->limit(4)
                                            ->get(['tbl_product.id', 'tbl_product.name']);
        return view('frontend/single-product', $data);
    }

    public function indexLogin(){
        return view('frontend/login');
    }

    public function login(FrontLoginRequest $request){
        try{
            if(Auth::guard('member')->attempt($request->except(['_token']))){
                return redirect('/');
            }else{
                return  Redirect::back()->withErrors(['loginError' => 'Email or password is Wrong.']);
            }
        }catch(\Exception $e){
            return $e;
        }
    }

    public function logout(){
        Auth::guard('member')->logout();
        return redirect('/');
    }

    public function indexRegister(){
        return view('frontend/register');
    }

    public function register(Request $request){
        try{
            $member = new Member();
            $member->company_name = $request->company_name;
            $member->year = $request->year;
            $member->address_one = $request->address_one;
            $member->address_two = $request->address_two;
            $member->city = $request->city;
            $member->state = $request->state;
            $member->zip = $request->zip;
            $member->phone = $request->phone;
            $member->fax = $request->fax;
            $member->website = $request->website;
            $member->whatsapp = $request->whatsapp;
            $member->skype = $request->skype;
            $member->country = $request->country;
            $member->name = $request->name;
            $member->email = $request->email;
            $member->password = Hash::make($request->password);
            $member->business = $request->business;
            $member->ip_address = $request->ip();
            $member->message = $request->message;
            if($member->save()){
                Toastr::success('Welcome '. $request->name,'', ["positionClass" => "toast-top-right", "timeout" => 30000]);
                return redirect('/');
            }
        }catch(Exception $e){
            return $e;
        }
    }

    public function clickAddForProduct(Request $request){
        $count = Product::where('id', $request->product_id)->first('click');
        $data = Product::where('id', $request->product_id)->update([
            'click' => ($count->click + 1)
        ]);
        if($data){
            echo "success";
        }
    }

    public function clickAddForCertificate(Request $request){
        $count = Certificate::where('id', $request->id)->first('click');
        $data = Certificate::where('id', $request->id)->update([
            'click' => ($count->click + 1)
        ]);
        if($data){
            echo "success";
        }
    }

    public function categoryProduct($id){
        $data['category_name'] = Category::where('id', $id)->first('category_name');
        $data['product'] = Product::where('category', $id)->orWhere('sub_category', $id)->orderBy('sku', 'ASC')->paginate(12);
        return view('frontend/category', $data);
    }

    public function faq(){
        $data['faq'] = Faq::where('is_deleted', 0)->get();
        return view('frontend/faq', $data);
    }

    public function privacyPolicy(){
        $data['privacy'] = Privacy::first();
        return view('frontend/privacy-policy', $data);
    }

    public function about(){
        $data['about'] = About::first();
        return view('frontend/about-us', $data);
    }

    public function certificate(){
        $data['certificate'] = Certificate::where('is_deleted', 0)->get();
        $data['slider'] = Slider::where('is_deleted', 0)->get();
        return view('frontend/certificate', $data);
    }

    public function contact(){
        $data['contact'] = Contact::where('is_deleted', 0)->get();
        return view('frontend/contact', $data);
    }

    public function sitemap(){
        $data['sitemap'] = Sitemap::where('is_deleted', 0)->get();
        return view('frontend/sitemap', $data);
    }

    public function shop(){
        $data['product'] = Product::where('is_deleted', 0)->orderBy('sku', 'ASC')->paginate(12);
        return view('frontend/shop', $data);
    }

    public function favorite(){
        // $data['favorite'] = Favorite::join('tbl_product', 'tbl_favorite.product_id', 'tbl_product.id')
        //                             ->where('tbl_product.is_deleted', 0)
        //                             ->get(['tbl_product.*']);
        $data['favorite'] = Product::join('tbl_favorite', 'tbl_favorite.product_id', 'tbl_product.id')
                                    ->where('tbl_product.is_deleted', 0)
                                    ->get(['tbl_product.*']);
        return view('frontend/favorite', $data);
    }

    public function AddToFavorite(Request $request){
        $favorite = new Favorite();
        $favorite->product_id = $request->id;
        $favorite->created_at = Carbon::now()->timestamp;
        $favorite->save();
        echo "success";
    }
    

    public function addToCart(Request $request){
        $id = [
            "id" => $request->id,
            "total_ctn" => "",
            "requirement" => "",
        ];
        $cart = Session::has('cart') ? Session::get('cart') : [];
        if(Session::has('cart')){
            foreach(Session::get('cart') as $val){
                if(in_array($val['id'], array($request->id))) {
                    echo "failed";
                    return;
                }
            }
            array_push($cart, $id);
            Session::put('cart', $cart); 
            echo "success";
            return;
        }else{
            array_push($cart, $id);
                Session::put('cart', $cart); 
                echo "success";
                return;
        }
    }

    public function editCart(Request $request){
        $value = Cart::where('product_id', $request->id)->first(['id', 'total_ctn', 'requirement']);
        return $value;
    }

    public function cart(){
        $session_data = Session::get('cart');
        if($session_data){
            $ids = array();
        
            foreach(Session::get('cart') as $val){
                $ids[] = $val['id'];
            }
            $data = Product::where('tbl_product.is_deleted', 0)
                            ->whereIn('tbl_product.id', $ids)->get(['tbl_product.*']);
            $total_ctn = 0;
            $total_price = 0;
            foreach($data as $key => $val){
                $val->total_ctn = $session_data[$key]['total_ctn'] ? $session_data[$key]['total_ctn'] : 0;
                $val->requirement = $session_data[$key]['requirement'];
                $total_ctn += $session_data[$key]['total_ctn'] ? $session_data[$key]['total_ctn'] : 0;
                $total_price += ($val->price * $val->moq);
            }
        }else{
            $data = array();
        }
        
        return view('frontend/cart', ['data'=> $data, 'total_ctn' => $total_ctn,  'total_price' => $total_price]);
    }

    public function editCartSubmit(Request $request){
        $session_data = Session::get('cart');
        $session_data[$request->key] = [
            'id' => $request->id,
            'total_ctn' => $request->total_ctn,
            'requirement' => $request->requirement,
        ];
        Session::put('cart', $session_data);
        // Cart::where('id', $request->id)->update([
        //     'total_ctn' => $request->total_ctn,
        //     'requirement' => $request->requirement,
        // ]);
        echo "success";
    }

    public function deleteCart(Request $request){
        $session_data = Session::get('cart');
        array_splice($session_data, $request->key, 1);
        Session::put('cart', $session_data);
        // Cart::where('product_id', $id)->delete();
        // Toastr::info('Product deleted.','', ["positionClass" => "toast-top-right"]);
        // return redirect('/cart');
        echo "success";
    }

    public function addToFavoriteLink(Request $request){
        $favorite_link = new FavoriteLink();
        $favorite_link->link = $request->link;
        $favorite_link->created_at = Carbon::now()->timestamp;
        $favorite_link->save();
        echo "success";
    }

    public function deleteToFavoriteLink(Request $request){
        FavoriteLink::where('id', $request->id)->delete();
        echo "success";
    }

    // <th scope="row">
    //     <img src="{{'. $image .'}}" alt="Cart">
    // </th>

    // $image = url('products/'.$val->image->image);
    public function cartDetails(Request $request){
        $session_data = Session::get('cart');
        if($session_data){
            $ids = array();
            foreach(Session::get('cart') as $val){
                $ids[] = $val['id'];
            }
            $data = Product::leftJoin('tbl_product_image_gallery', 'tbl_product_image_gallery.product_id', 'tbl_product.id')
                            ->where('tbl_product.is_deleted', 0)
                            ->whereIn('tbl_product.id', $ids)
                            ->distinct()
                            ->get(['tbl_product.id', 'tbl_product.name', 'tbl_product_image_gallery.image']);
            $count = count($data);
            $html = '';
            $html .= '
                    <div class="modal-header">
                        <h2>Shopping Cart <span>'. $count .'</span></h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="cart-table">
                            <table class="table">
                                <tbody>';
                                foreach($data as $key => $val){
                                $image = url('products/'.$val->image);
                                $url = url('/cart');
                                $html .='<tr>
                                        <th scope="row">
                                            <img src="'. $image .'">
                                        </th>
                                        <td>
                                            <h3>'. $val->name .'</h3>
                                        </td>
                                        <td>
                                            <a class="close" href="javascript:void(0)" onclick="cartDelete('. $val->id .','. $key .')">
                                                <i class="bx bx-x"></i>
                                            </a>
                                        </td>
                                    </tr>';
                                }
                                
                                
            $html .=            '</tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="'. $url .'" >
                        <button type="submit" class="btn common-btn">
                            Proceed To Checkout
                            <img src="assets/images/shape1.png" alt="Shape">
                            <img src="assets/images/shape2.png" alt="Shape">
                        </button>
                        </a>
                    </div>
                    ';
        }else{
            $html = '';
            $html .= '
                    <div class="modal-header">
                        <h2>Shopping Cart <span>0</span></h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="cart-table">
                            <table class="table">
                                <tbody>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    ';
        }
        echo $html;
    }

    public function cartCount(){
        $session_data = Session::get('cart');
        if($session_data){
            $ids = array();
            foreach(Session::get('cart') as $val){
                $ids[] = $val['id'];
            }
            $data = Product::whereIn('tbl_product.id', $ids)
                            ->get(['tbl_product.id']);
            $count = count($data);
            echo $count;
            return;
        }else{
            echo 0;
            return;
        }
    }

    public function cartWithRegister(Request $request){
        $member = new Member();
        $member->company_name = $request->company_name;
        $member->year = $request->year;
        $member->address_one = $request->address_one;
        $member->address_two = $request->address_two;
        $member->city = $request->city;
        $member->state = $request->state;
        $member->zip = $request->zip;
        $member->phone = $request->phone;
        $member->fax = $request->fax;
        $member->website = $request->website;
        $member->whatsapp = $request->whatsapp;
        $member->skype = $request->skype;
        $member->country = $request->country;
        $member->name = $request->name;
        $member->email = $request->email;
        $member->password = Hash::make($request->password);
        $member->business = $request->business;
        $member->ip_address = $request->ip();
        $member->message = $request->message;
        if($member->save()){
            if(Session::has('cart')){
                foreach(Session::get('cart') as $val){
                    $cart = new Cart();
                    $cart->product_id = $val['id'];
                    $cart->total_ctn = $val['total_ctn'];
                    $cart->requirement = $val['requirement'];
                    $cart->user_id = $member->id;
                    $cart->save();
                }
            }
        }
        $detail['id'] = $member->id;
        $detail['time'] = date('H:i:s');
        $detail['date'] = date('Y-m-d');
        $user['email'] = "sales@company.com";
        Mail::send('Frontend/inquiry-email', $detail, function($message) use($user){
            $message->date(\DateTime::createFromFormat('d-m-Y H:i', '25-12-2001 20:30'));
            $message->to($user['email']);
            $message->subject('Online Inquiry List-'.date('d-m-Y H:i').'-Level C');
        });
        Session::flush('cart');
        echo "Success";
    }

    public function cartForRegisterUser(Request $request){
        Member::where('id', Auth::guard('member')->user()->id)->update([
            'message' => $request->message
        ]);
        
        if(Session::has('cart')){
            foreach(Session::get('cart') as $val){
                $cart = new Cart();
                $cart->product_id = $val['id'];
                $cart->total_ctn = $val['total_ctn'];
                $cart->requirement = $val['requirement'];
                $cart->user_id = Auth::guard('member')->user()->id;
                $cart->save();
            }
        }
        $detail['id'] = Auth::guard('member')->user()->id;
        $detail['time'] = date('H:i:s');
        $detail['date'] = date('Y-m-d');
        $user['email'] = "sales@company.com";
        Mail::send('Frontend/inquiry-email', $detail, function($message) use($user){
            $message->date(\DateTime::createFromFormat('d-m-Y H:i', '25-12-2001 20:30'));
            $message->to($user['email']);
            $message->subject('Online Inquiry List-'.date('d-m-Y H:i').'-Level C');
        });
        Session::flush('cart');
        echo "Success";
    }
}


