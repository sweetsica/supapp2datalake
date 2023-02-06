<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_data', function (Blueprint $table) {
            $table->id();
            $table->integer('status_bill')->nullable();//Trạng thái - enum
            $table->string('id_bill')->nullable();//Mã phiếu
            $table->string('id_bill_taken')->nullable();//Mã phiếu đặt
            $table->dateTime('bill_order_time')->nullable();//Ngày đặt
            $table->dateTime('bill_delivery_time')->nullable();//Ngày giao
            $table->string('bill_group')->nullable();//Nhóm hoá đơn theo vùng - enum
            $table->string('carer_code')->nullable();//Mã nhân viên phụ trách
            $table->string('order_name')->nullable();//Tên nhân viên đặt
            $table->string('line_code')->nullable();//Mã tuyến
            $table->dateTime('sold_time')->nullable();//Ngày bán
            $table->string('seller_name')->nullable();//Tên người bán
            $table->string('customer_code')->nullable();//Mã khách hàng
            $table->string('customer_name')->nullable();//Tên khách hàng
            $table->string('customer_group')->nullable();//Nhóm khách hàng - table
            $table->string('customer_type')->nullable();//Loại khách hàng
            $table->string('customer_address')->nullable();//Địa chỉ
            $table->string('customer_phone')->nullable();//SĐT
            $table->text('customer_description')->nullable();//Diễn giải
            $table->string('warehoure_code')->nullable();//Mã kho
            $table->string('product_code')->nullable();//Mã sản phẩm - table
            $table->string('product_name')->nullable();//Tên sản phẩm
            $table->string('unit')->nullable();//Đơn vị tính - enum
            $table->integer('quantity')->nullable();//Số lượng
            $table->integer('price')->nullable(); // Đơn giá
            $table->bigInteger('amount')->nullable();//Thành tiền ( price x quantity )
            $table->integer('vat_percent')->nullable();//VAT
            $table->bigInteger('vat_number')->nullable();//Tiền thuế
            $table->bigInteger('rebate')->nullable();//Chiết khấu
            $table->bigInteger('bill_total')->nullable();// Tổng tiền ( amount + vat_number - rebate )
            $table->string('tax_code')->nullable();//Mã số thuế
            $table->integer('channel')->nullable();//Kênh
            $table->integer('gate')->nullable();//Cổng
            $table->boolean('status')->default('1');//Trạng thái đơn
            $table->integer('special_note')->nullable();//có các thay đổi đặc biệt
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raw_data');
    }
};
