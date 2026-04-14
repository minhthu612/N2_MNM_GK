<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    
    public function index(Request $request)
    {
        $query = DB::table('san_pham')
            ->select('id', 'tieu_de', 'gia', 'hinh_anh');

        // thêm sort
        if ($request->sort == 'asc') {
            $query->orderBy('gia', 'asc');
        } elseif ($request->sort == 'desc') {
            $query->orderBy('gia', 'desc');
        } else {
            $query->orderBy('created_at');
        }

        $laptops = $query->limit(20)->get();

        $categories = DB::table('danh_muc_laptop')->get();

        return view('laptop.index', [
            'laptops' => $laptops,
            'categories' => $categories,
            'title' => 'Trang chủ'
        ]);
    }
    // Lọc theo danh mục (Dell, Asus,...)
    public function theoDanhMuc(Request $request, $id)
{
    $query = DB::table('san_pham')
        ->where('id_danh_muc', $id);

    // 👉 xử lý sort theo giá
    if ($request->sort == 'asc') {
        $query->orderBy('gia', 'asc');
    } elseif ($request->sort == 'desc') {
        $query->orderBy('gia', 'desc');
    }

    $laptops = $query->get();

    $categories = DB::table('danh_muc_laptop')->get();

    $category = DB::table('danh_muc_laptop')
        ->where('id', $id)
        ->first();

    return view('laptop.index', [
        'laptops' => $laptops,
        'categories' => $categories,
        'title' => $category ? $category->ten_danh_muc : 'Danh mục'
    ]);
}
    public function chiTiet($id)
{
    $laptop = DB::table('san_pham')
        ->where('id', $id)
        ->first();

    $categories = DB::table('danh_muc_laptop')->get();

    return view('laptop.detail', [
        'laptop' => $laptop,
        'categories' => $categories,
        'title' => $laptop->tieu_de
    ]);
}
    public function add(Request $request)
{
    // ❌ CHƯA LOGIN → KHÔNG CHO THÊM
    if (!Auth::check()) {
        return redirect()->route('login')
            ->with('error', 'Bạn phải đăng nhập để thêm vào giỏ hàng');
    }

    $id = $request->id;
    $qty = $request->so_luong;

    $product = DB::table('san_pham')->where('id', $id)->first();

    if (!$product) {
        return redirect()->back();
    }

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['so_luong'] += $qty;
    } else {
        $cart[$id] = [
            'ten' => $product->tieu_de,
            'hinh_anh' => $product->hinh_anh,
            'gia' => $product->gia,
            'so_luong' => $qty
        ];
    }

    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng');
}

public function timKiem(Request $request)
    {
        $keyword = $request->keyword;

        $laptops = DB::table('san_pham')
            ->where('tieu_de', 'like', '%' . $keyword . '%')
            ->get();

        $categories = DB::table('danh_muc_laptop')->get();

        return view('laptop.index', [
            'laptops' => $laptops,
            'categories' => $categories,
            'title' => 'Kết quả tìm kiếm: ' . $keyword
        ]);
    }
}