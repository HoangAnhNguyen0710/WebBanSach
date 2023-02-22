@extends('layouts.master')

@section('title')
    <title>Order List</title>
@endsection

@section('content')
    <div class="container-fluid py-5 my-5">
        <h3 class="py-2">Danh sách đơn hàng</h3>
        <table class="table">
            <thead>
                <tr class="table-info">
                    <th class="col-2">Mã đơn hàng</th>
                    <th class="col-5">Ngày tạo đơn</th>
                    <th class="col-2">Thành tiền</th>
                    <th class="col-2">Trạng thái</th>
                    <th class="col-1"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderList as $order)
                    <tr class="border-1 relative">
                        <th scope="row" class="">{{ $order['id'] }}</th>
                        <td class="">{{ $order['created_at'] }}</td>
                        <td class="">{{ $order['discount_price'] }} đ</td>
                        @if ($order['status'] == 1)
                            <td class="bg-success text-white badge my-2 ">Thành công</td>
                        @endif
                        @if ($order['status'] == 9)
                            <td class="bg-danger text-white badge my-2  ">Thất bại</td>
                        @endif
                        <td>
                            <button type="button" class="btn collapse_{{ $order['id'] }}" type="button"  onclick="HandleOpen('collapse_{{ $order['id'] }}')">
                                <i class="bi bi-eye-fill"></i>
                            </button>
                        </td>
                        <div class="collapse" id="collapse_{{ $order['id'] }}">
                            <div class="mb-3 mt-3">
                                <div>
                                    <b><span>Họ tên người nhận :</span></b>
                                    <span>{{ $order['customer_name'] }}</span>
                                </div>
                                <div>
                                    <b><span>Địa chỉ:</span></b>
                                    <span>{{ $order['customer_address'] }}</span>
                                </div>
                                <div>
                                    <b><span>SDT liên hệ :</span></b>
                                    <span>{{ $order['customer_contact'] }}</span>
                                </div>
                                <div class="">
                                    Sản phẩm
                                </div>
                                @if ($order['items'] != [])
                                    @foreach ($order['items'] as $offset => $details)
                                        <div class="row">
                                            <div class="d-flex flex-column col-4">
                                                <div class="hidden-xs"><img src="http://placehold.it/60x60" alt="..."
                                                        class="img-responsive" /></div>
                                                <div class="">
                                                    {{-- <h6 class="m-0">Product 1</h6> --}}
                                                </div>
                                            </div>
                                            <div class="col-2">{{ $details['book']['price'] }}đ</div>
                                            <div class="col-3">
                                                <div>Số lượng: {{ $details['quantity'] }}</div>
                                            </div>
                                            <div class="col-3 d-flex justify-content-between">
                                                <div>
                                                    {{ $details['book']['price'] * $details['quantity'] }}đ
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-bottom"></div>
                                    @endforeach
                                @else
                                    <div>Đơn hàng có sản phẩm bị hết hàng hoặc quá số lượng còn lại trong
                                        kho!</div>
                                @endif
                                <div>
                                    <div class="visible-xs text-end py-2">
                                        <span class="fw-bolder"><strong>Total: <span class="">{{ $order['price'] }}đ
                                                </span><br />
                                                Discount:
                                                <span>{{ $order['discount_price'] }}đ</span></strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                    {{-- <tr> --}}
                        
                    {{-- </tr> --}}
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
       function HandleOpen(id) {
            if($('#' + id).hasClass('show')){
                $('#' + id).removeClass('show')
            }
            else $('#' + id).addClass('show')
       }
    </script>
@endsection
