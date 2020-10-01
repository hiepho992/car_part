<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = new Product();
        $products->id = 1;
        $products->name = "Đĩa phanh trước Suzuki 5 tạ, Camry";
        $products->description = "Sản xuất bởi Suzuki Oem, phụ tùng chính hãng, giá tốt nhất. Đĩa phanh trước Suzuki 5 tạ, Carry được sản xuất tại Đài Loan";
        $products->price = 380000;
        $products->brand = "Suzuki Oem";
        $products->manufacturing_data = "2019-11-10";
        $products->category_id = 3;
        $products->save();

        $products = new Product();
        $products->id = 2;
        $products->name = "Lốp xe ô tô MILESTAR";
        $products->description = "MILESTAR MS932 Sport được thiết kế với công nghệ hiện đại cho khả năng vận hành êm ái, độ bám đường tuyệt vời trong mọi điều kiện thời tiết,";
        $products->price = 1200000;
        $products->brand = "CASUMINA";
        $products->manufacturing_data = "2019-11-10";
        $products->category_id = 2;
        $products->save();

        $products = new Product();
        $products->id = 3;
        $products->name = "Bóng led H4";
        $products->description = "Bóng led H4 tích hợp bi cầu mini có cos vàng - pha trắng";
        $products->price = 100000;
        $products->brand = "No Brand";
        $products->manufacturing_data = "2019-11-10";
        $products->category_id = 1;
        $products->save();
    }
}
