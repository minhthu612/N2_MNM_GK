<x-laptop-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <div class="container mt-4">

        <div class="row">
            <!-- Hình -->
            <div class="col-md-4 text-center">
                <img src="{{ asset('storage/image/'.$laptop->hinh_anh) }}" 
                     class="img-fluid border"
                     style="max-height:280px; padding:10px;">
            </div>

            <!-- TOÀN BỘ BÊN PHẢI -->
            <div class="col-md-8">

                <h5 class="mb-2" style="font-weight:600;">
                    {{ $laptop->tieu_de }}
                </h5>

                <!-- Thông tin chính -->
                <div style="font-size:14px; line-height:1.6">
                    <div><b>CPU:</b> {{ $laptop->cpu }}</div>
                    <div><b>RAM:</b> {{ $laptop->ram }}</div>
                    <div><b>Ổ cứng:</b> {{ $laptop->luu_tru }}</div>
                    <div><b>Chip đồ họa:</b> {{ $laptop->chip_do_hoa }}</div>
                    <div><b>Nhu cầu:</b> {{ $laptop->nhu_cau }}</div>
                    <div><b>Màn hình:</b> {{ $laptop->man_hinh }}</div>
                    <div><b>Hệ điều hành:</b> {{ $laptop->he_dieu_hanh }}</div>
                </div>

                <!-- Giá -->
                <div class="mt-2 mb-2" style="color:red; font-weight:700; font-size:16px;">
                    Giá: {{ number_format($laptop->gia) }} VND
                </div>

                
                <!-- Số lượng + thêm giỏ -->
            <form action="{{ route('cart.add') }}" method="POST"
                style="display:flex; align-items:center; gap:10px; margin-top:10px;">
                @csrf

                <span style="font-size:14px; color:black; display:inline-block;">
                    Số lượng mua:
                </span>

                <input type="hidden" name="id" value="{{ $laptop->id }}">

                <input type="number" name="so_luong" value="1" min="1"
                    style="width:60px; height:32px; padding:2px 5px;">

                <button class="btn btn-primary btn-sm">
                    Thêm vào giỏ hàng
                </button>
            </form>

                <!-- LINE NGĂN -->
                <hr style="margin:20px 0">

                <!-- THÔNG TIN KHÁC (GIỜ NẰM TRONG COL-8) -->
                <h6 style="font-weight:600; margin-bottom:10px;">
                    Thông tin khác
                </h6>

                <div style="font-size:14px; line-height:1.6">
                    <div><b>Khối lượng:</b> {{ $laptop->khoi_luong }}</div>
                    <div><b>Webcam:</b> {{ $laptop->webcam }}</div>
                    <div><b>Pin:</b> {{ $laptop->pin }}</div>
                    <div><b>Kết nối không dây:</b> {{ $laptop->ket_noi_khong_day }}</div>
                    <div><b>Bàn phím:</b> {{ $laptop->ban_phim }}</div>
                    <div><b>Cổng kết nối:</b> {{ $laptop->cong_ket_noi }}</div>
                </div>

            </div>
        </div>

    </div>
</x-laptop-layout>