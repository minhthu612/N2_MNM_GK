<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccessMail;

class LaptopController2 extends Controller
{
    // Hiển thị giỏ hàng
    public function cart()
    {
        $cart = session()->get('cart', []);

        $categories = DB::table('san_pham')->get(); // hoặc bảng bạn đang dùng

        $tong = 0;
        foreach($cart as $item){
            $tong += $item['gia'] * $item['so_luong'];
        }

        return view('laptop.cart', compact('cart', 'categories', 'tong'));
    }

    // Thêm vào giỏ
    public function addCart(Request $request)
    {
        $id = $request->id;
        $so_luong = $request->so_luong;

        $sp = DB::table('san_pham')->where('id', $id)->first();

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['so_luong'] += $so_luong;
        } else {
            $cart[$id] = [
                'ten' => $sp->tieu_de,
                'gia' => $sp->gia,
                'hinh_anh' => $sp->hinh_anh,
                'so_luong' => $so_luong
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }

    // Xóa sản phẩm
    public function removeCart($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return redirect()->route('cart');
    }

    // Đặt hàng
    public function order(Request $request)
    {
        $cart = session()->get('cart', []);

        $tong = 0;
        foreach($cart as $item){
            $tong += $item['gia'] * $item['so_luong'];
        }

        $email = auth()->user()->email;

        Mail::to($email)->send(new OrderSuccessMail($cart, $tong));

        session()->forget('cart');

        return redirect()->route('cart')->with('success', 'Đặt hàng thành công!');
    }
}

