@extends('layouts.master')

@section('title')
    <title>Order</title>
@endsection

@section('content')

    <section class="section wb">
        <?php $total = 0; $discountTotal = 0 ?>
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-wrapper">
                        <h2 class="breadcrumb-item active">Tạo đơn hàng</h2>

                        <form id="post_a_status" class="needs-validation" onsubmit="submit_form(event)">
                            <div class="mb-3 mt-3">
                                <b><label for="customer_name">Họ tên người nhận :</label></b>
                                <input type="text" placeholder="Nhập họ tên người nhận" name="customer_name" value="{{auth()->user() ? auth()->user()->name : ""}}"
                                    id="customer_name" class="form-control mt-2 mb-3" required>
                                <label for="customer_address">Địa chỉ:</label>
                                <input type="text" placeholder="Nhập địa chỉ" name="customer_address" value="{{auth()->user() ? auth()->user()->address : ""}}"
                                    id="customer_address" class="form-control mt-2 mb-3" required>
                                <label for="customer_contact">SDT liên lạc:</label>
                                <input type="text" placeholder="Nhập số điện thoại" name="customer_contact" value="{{auth()->user() ? auth()->user()->contact : ""}}"
                                    id="customer_contact" class="form-control mt-2 mb-3" required>
                                <div class="">
                                    Đơn hàng
                                </div>

                                @if (session('cart'))
                                    @foreach (session('cart') as $bookName => $details)
                                        <?php $total += $details['price'] * $details['quantity']; ?>
                                        <?php $discountTotal += $details['discount_price'] * $details['quantity']; ?>
                                        <div class="row">
                                            <div class="d-flex flex-column col-4">
                                                <div class="hidden-xs"><img src="http://placehold.it/60x60" alt="..."
                                                        class="img-responsive" /></div>
                                                <div class="">
                                                    {{-- <h6 class="m-0">Product 1</h6> --}}
                                                    <h6 class="overflow-hidden">{{ $bookName }}</h6>
                                                </div>
                                            </div>
                                            <div class="col-2">{{ $details['price'] }}đ</div>
                                            <div class="col-3">
                                                <input type="number" value="{{ $details['quantity'] }}"
                                                <?php $bookClassName = str_replace(" ","",$bookName)?>
                                                    class="form-control quantity {{$bookClassName}}">
                                            </div>
                                            <div class="col-3 d-flex justify-content-between">
                                                <div>{{ $details['price'] * $details['quantity'] }}đ</div>
                                                <div class="d-flex flex-column">
                                                    <button class="btn btn-info btn-sm mb-1 update-cart"
                                                        data-id="{{ $bookName }}"><i
                                                            class="bi bi-arrow-clockwise"></i></button>
                                                    <button class="btn btn-danger btn-sm mb-1 remove-from-cart delete"
                                                        data-id="{{ $bookName }}"><i class="bi bi-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-bottom"></div>
                                    @endforeach
                                @endif
                                <div>
                                    <div class="visible-xs text-end py-2">
                                        <span class="fw-bolder"><strong>Total: <span class="">{{ $total }}đ </span><br/> Discount: <span>{{$discountTotal}}đ</span></strong></span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" id="submit-btn" class="btn btn-primary">Tạo đơn hàng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php $cart = session('cart')?>
        <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            // ClassicEditor
            //     .create(document.querySelector('#ckeditor1'))
            //     .then(newEditor => {
            //         editor = newEditor;
            //     })
            //     .catch(error => {
            //         console.error(error);
            //     });
            function submit_form(event) {
                event.preventDefault();
                var cart = Object.values({{Js::from($cart)}})
                var price = {{Js::from($total)}}
                var discountPrice = {{Js::from($discountTotal)}}
                
                axios.post('/api/order', {
                    customer_name: $('#customer_name').val(),
                    customer_address: $('#customer_address').val(),
                    customer_contact: $('#customer_contact').val(),
                    price: price,
                    discount_price: discountPrice,
                    order_items_list:  JSON.stringify(cart),
                    customer_id: {{auth()->user() ? auth()->user()->id : null}}
                }).then(function(res) {
                    $('#submit-btn').attr('disabled', true);
                    if (confirm("Tạo đơn hàng thành công!")) document.location = '/';
                }).catch(function(e) {
                    console.log(e)
                })
            }
        </script>
    </section>
@endsection
