<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Item;
use DB;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
      
    public function loginConfirm(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->withSuccess('Signed in');
        }
        return redirect("login")->withSuccess('Login details are not valid');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
    
    public function dashboard()
    {
        if(Auth::check()){
            $orders = Order::orderBy('id', 'DESC')->get()->toArray();
            $restaurants = Restaurant::orderBy('id', 'DESC')->get()->toArray();
            return view('dashboard',['orders'=>$orders, 'restaurants'=>$restaurants]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function restaurantIndex()
    {
        if(Auth::check()){
            $restaurants = Restaurant::orderBy('id', 'DESC')->get()->toArray();
            return view('restaurantIndex',['restaurants'=>$restaurants]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function restaurantInsert()
    {
        if(Auth::check()){
            return view('restaurantInsert');
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function restaurantInsertConfirm(Request $request)
    {
        if(Auth::check()){
            $request->validate([
                'restaurant_name' => 'required',
                'restaurant_status' => 'required'
            ]);
            $restaurant = Restaurant::create(['restaurant_name'=>$request->input('restaurant_name'), 'restaurant_status'=>$request->input('restaurant_status')]);
            return redirect()->route('restaurant.select', ['id'=>$restaurant->id]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function restaurantSelect($id)
    {
        if(Auth::check()){
            $main = Menu::where('restaurant_id', $id)->get();
            $restaurant = Restaurant::where('id', $id)->first();
            $orderItems = Item::with(['menu' => function ($query){$query->select('id', 'menu_name', 'menu_price');}])
                ->with(['order' => function ($query){$query->select('id', 'order_cost', 'order_status');}])
                ->whereIn('menu_id', Menu::select('id')->where('restaurant_id', $id)->get()->toArray())
                ->get()->toArray();
            return view('restaurantSelect',['restaurant'=>$restaurant, 'main'=>$main, 'orderItems'=>$orderItems]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
      
    public function restaurantUpdate($id)
    {
        if(Auth::check()){
            $restaurant = Restaurant::where('id', $id)->first();
            return view('restaurantUpdate',['restaurant'=>$restaurant]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function restaurantUpdateConfirm(Request $request)
    {
        if(Auth::check()){
            $request->validate([
                'restaurant_name' => 'required',
                'restaurant_status' => 'required',
                'restaurant_id' => 'required'
            ]);
            Restaurant::where('id', $request->input('restaurant_id'))->update([
                'restaurant_name' => $request->input('restaurant_name'),
                'restaurant_status' => $request->input('restaurant_status')
            ]);
            return redirect()->route('restaurant.select', ['id'=>$request->input('restaurant_id')]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function menuInsert($rid)
    {
        if(Auth::check()){
            $restaurant = Restaurant::where('id', $rid)->first();
            return view('menuInsert',['restaurant'=>$restaurant]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function menuInsertConfirm(Request $request)
    {
        if(Auth::check()){
            $request->validate([
                'restaurant_id' => 'required', 
                'menu_name' => 'required',
                'menu_price' => 'required',
                'menu_status' => 'required'
            ]);
            $menu = Menu::create([
                'restaurant_id' => $request->input('restaurant_id'), 
                'menu_name' => $request->input('menu_name'),
                'menu_price' => $request->input('menu_price'),
                'menu_status' => $request->input('menu_status')
            ]);
            
            return redirect()->route('menu.select', ['id'=>$menu->id]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function menuSelect($id)
    {
        if(Auth::check()){
            $menu = Menu::where('id', $id)->first();
            $restaurant = Restaurant::where('id', $menu->restaurant_id)->first();
            $orderItems = Item::with(['menu' => function ($query){$query->select('id', 'menu_name', 'menu_price');}])
                ->with(['order' => function ($query){$query->select('id', 'order_cost', 'order_status');}])
                ->whereIn('menu_id', Menu::select('id')->where('id', $id)->get()->toArray())
                ->get()->toArray();
            return view('menuSelect',[ 'restaurant'=>$restaurant,'menu'=>$menu, 'orderItems'=>$orderItems]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
      
    public function menuUpdate($id)
    {
        if(Auth::check()){
            $menu = Menu::where('id', $id)->first();
            $restaurant = Restaurant::where('id', $menu->restaurant_id)->first();
            return view('menuUpdate',['restaurant'=>$restaurant,'menu'=>$menu]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function menuUpdateConfirm(Request $request)
    {
        if(Auth::check()){
            $request->validate([
                'menu_id' => 'required', 
                'restaurant_id' => 'required', 
                'menu_name' => 'required',
                'menu_price' => 'required',
                'menu_status' => 'required'
            ]);
            Menu::where('id', $request->input('menu_id'))->update([
                'menu_name' => $request->input('menu_name'),
                'menu_price' => $request->input('menu_price'),
                'menu_status' => $request->input('menu_status')
            ]);
            return redirect()->route('menu.select', ['id'=>$request->input('menu_id')]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function orderIndex()
    {
        if(Auth::check()){
            $orders = Order::orderBy('id', 'DESC')->get()->toArray();
            return view('orderIndex',['orders'=>$orders]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function orderInsert()
    {
        if(Auth::check()){
            $main = Menu::select('menu_name', 'id')->get();
            return view('orderInsert',['main'=>$main]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function orderInsertConfirm(Request $request)
    {
        if(Auth::check()){
            $request->validate([
                'item' => 'required',
            ]);
            $menu = Menu::where('id', $request->input('item'))->first();
            $order = Order::create(['order_cost'=>$menu->menu_price, 'order_status'=>true]);
            Item::create(['order_id'=> $order->id, 'menu_id'=>  $request->input('item')]);
            return redirect()->route('order.select', ['id'=>$order->id]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function orderSelect($id)
    {
        if(Auth::check()){
            $main = Menu::select('menu_name', 'id')->get();
            $orderItems = Item::where('order_id', $id)->with(['menu' => function ($query) {
                $query->select('id', 'menu_name', 'menu_price');
            }])->get()->toArray();
            $order = Order::where('id', $id)->first();
            return view('orderSelect',['order'=>$order,'main'=>$main, 'orderItems'=>$orderItems]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function orderItemInsert(Request $request)
    {
        if(Auth::check()){
            $request->validate([
                'item' => 'required',
                'order_id' => 'required',
            ]);
            Item::create(['order_id'=> $request->input('order_id'), 'menu_id'=>  $request->input('item')]);
            $orderItems = Item::where('order_id', $request->input('order_id'))->get();
            $total = 0;
            foreach($orderItems as $item){
                $menu = Menu::where('id', $item->menu_id)->first();
                $total = $total + $menu->menu_price;
            }
            Order::where('id', $request->input('order_id'))->update([
                'order_cost' => $total
            ]);
            return redirect()->route('order.select', ['id'=>$request->input('order_id')]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function orderItemDelete(Request $request)
    {
        if(Auth::check()){
            $request->validate([
                'item_id' => 'required',
                'order_id' => 'required'
            ]);
            Item::where('id', $request->input('item_id'))->delete();
            $orderItems = Item::where('order_id', $request->input('order_id'))->get();
            $total = 0;
            foreach($orderItems as $item){
                $menu = Menu::where('id', $item->menu_id)->first();
                $total = $total + $menu->menu_price;
            }
            Order::where('id', $request->input('order_id'))->update([
                'order_cost' => $total
            ]);
            return redirect()->route('order.select', ['id'=>$request->input('order_id')]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function orderUpdate($id)
    {
        if(Auth::check()){
            $order = Order::where('id', $id)->first();
            return view('orderUpdate',['order'=>$order]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function orderUpdateConfirm(Request $request)
    {
        if(Auth::check()){
            $request->validate([
                'order_status' => 'required',
                'order_id' => 'required',
            ]);
            Order::where('id', $request->input('order_id'))->update([
                'order_status' => $request->input('order_status')
            ]);
            return redirect()->route('order.select', ['id'=>$request->input('order_id')]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
}
