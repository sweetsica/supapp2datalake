{{--resources/views/lake/list.blade.php--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lake Raw Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full table-auto" style="width:420px;overflow-y:scroll">
                    <thead class="font-bold bg-gray-50 border-b-2">
                    <tr>
                        <td class="p-4">{{__('ID')}}</td>
                        <td class="p-4">{{__('Mã phiếu')}}</td>
                        <td class="p-4">{{__('Mã phiếu đặt')}}</td>
                        <td class="p-4">{{__('Ngày đặt')}}</td>
                        <td class="p-4">{{__('Ngày giao')}}</td>
                        <td class="p-4">{{__('Nhóm hoá đơn theo vùng')}}</td>
                        <td class="p-4">{{__('Mã nhân viên phụ trách')}}</td>
                        <td class="p-4">{{__('Tên nhân viên đặt')}}</td>
                        <td class="p-4">{{__('Mã tuyến')}}</td>
                        <td class="p-4">{{__('Ngày bán')}}</td>
                        <td class="p-4">{{__('Tên người bán')}}</td>
                        <td class="p-4">{{__('Mã khách hàng')}}</td>
                        <td class="p-4">{{__('Nhóm khách hàng')}}</td>
                        <td class="p-4">{{__('Loại khách hàng')}}</td>
                        <td class="p-4">{{__('Địa chỉ')}}</td>
                        <td class="p-4">{{__('SĐT')}}</td>
                        <td class="p-4">{{__('Diễn giải')}}</td>
                        <td class="p-4">{{__('Mã kho')}}</td>
                        <td class="p-4">{{__('Mã sản phẩm')}}</td>
                        <td class="p-4">{{__('Tên sản phẩm')}}</td>
                        <td class="p-4">{{__('Đơn vị tính')}}</td>
                        <td class="p-4">{{__('Số lượng')}}</td>
                        <td class="p-4">{{__('Đơn giá')}}</td>
                        <td class="p-4">{{__('Thành tiền')}}</td>
                        <td class="p-4">{{__('VAT')}}</td>
                        <td class="p-4">{{__('Tiền thuế')}}</td>
                        <td class="p-4">{{__('VAT')}}</td>
                        <td class="p-4">{{__('Chiết khấu')}}</td>
                        <td class="p-4">{{__('Thành tiền tổng')}}</td>
                        <td class="p-4">{{__('Mã số thuế')}}</td>
                        <td class="p-4">{{__('Kênh')}}</td>
                        <td class="p-4">{{__('Cổng')}}</td>
                        <td class="p-4">{{__('Trạng thái đơn')}}</td>
                        <td class="p-4">{{__('Đặc biệt')}}</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($datas as $data)
                        <tr class="border">
                            <td class='p-4'>{{$data->status_bill}}</td>
                            <td class='p-4'>{{$data->id_bill}}</td>
                            <td class='p-4'>{{$data->id_bill_taken}}</td>
                            <td class='p-4'>{{$data->bill_order_time}}</td>
                            <td class='p-4'>{{$data->bill_delivery_time}}</td>
                            <td class='p-4'>{{$data->bill_group}}</td>
                            <td class='p-4'>{{$data->carer_code}}</td>
                            <td class='p-4'>{{$data->order_name}}</td>
                            <td class='p-4'>{{$data->line_code}}</td>
                            <td class='p-4'>{{$data->sold_time}}</td>
                            <td class='p-4'>{{$data->seller_name}}</td>
                            <td class='p-4'>{{$data->customer_code}}</td>
                            <td class='p-4'>{{$data->customer_name}}</td>
                            <td class='p-4'>{{$data->customer_group}}</td>
                            <td class='p-4'>{{$data->customer_type}}</td>
                            <td class='p-4'>{{$data->customer_address}}</td>
                            <td class='p-4'>{{$data->customer_phone}}</td>
                            <td class='p-4'>{{$data->customer_description}}</td>
                            <td class='p-4'>{{$data->warehoure_code}}</td>
                            <td class='p-4'>{{$data->product_code}}</td>
                            <td class='p-4'>{{$data->product_name}}</td>
                            <td class='p-4'>{{$data->unit}}</td>
                            <td class='p-4'>{{$data->numbered}}</td>
                            <td class='p-4'>{{$data->price}}</td>
                            <td class='p-4'>{{$data->amount}}</td>
                            <td class='p-4'>{{$data->vat_percent}}</td>
                            <td class='p-4'>{{$data->vat_number}}</td>
                            <td class='p-4'>{{$data->rebate}}</td>
                            <td class='p-4'>{{$data->bill_total}}</td>
                            <td class='p-4'>{{$data->tax_code}}</td>
                            <td class='p-4'>{{$data->channel}}</td>
                            <td class='p-4'>{{$data->gate}}</td>
                            <td class='p-4'>{{$data->status}}</td>
                            <td class='p-4'>{{$data->special_note}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
