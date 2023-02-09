<?php $total = 0; ?>
<!-- by this code session get all product that user chose -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasTopLabel">Giỏ hàng</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div id="cart" class="d-flex flex-column">
            <div class="row d-flex pb-2">
                <div class="col-4 fw-bolder fs-6">Product</div>
                <div class="col-2 fw-bolder fs-6">Price</div>
                <div class="col-3 fw-bolder fs-6">Quantity</div>
                <div class="col-3 fw-bolder fs-6">Subtotal</div>
            </div>
            @if (session('cart'))
                @foreach (session('cart') as $id => $details)
                    <?php $total += $details['price'] * $details['quantity']; ?>
                    <div class="row">
                        <div class="d-flex flex-column col-4">
                            <div class="hidden-xs"><img src="http://placehold.it/60x60" alt="..."
                                    class="img-responsive" /></div>
                            <div class="">
                                {{-- <h6 class="m-0">Product 1</h6> --}}
                                <h6 class="overflow-hidden   ">{{$details['name']}}</h6>
                            </div>
                        </div>
                        <div class="col-2">{{$details['price']}}đ</div>
                        <div class="col-3">
                            <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity">
                        </div>
                        <div class="col-3 d-flex justify-content-between">
                            <div>{{ $details['price'] * $details['quantity'] }}đ</div>
                            <div class="d-flex flex-column">
                                <button class="btn btn-info btn-sm mb-1 update-cart" data-id="{{ $id }}"><i class="bi bi-arrow-clockwise"></i></button>
                                <button class="btn btn-danger btn-sm mb-1 remove-from-cart delete" data-id="{{ $id }}"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="border-bottom"></div>
                @endforeach
            @endif
            <div>
                <div class="visible-xs text-end py-2">
                    <span class="fw-bolder"><strong>Total {{$total}}đ</strong></span>
                </div>
                <div class="row">
                    <div class="col"><a href="{{ url('/') }}" class="btn btn-warning w-100"><i
                                class="fa fa-angle-left"></i> Continue Shopping</a></div>
                    <div class="col"><a href="{{ url('/payment') }}" class="btn btn-success w-100"><i
                                class="fa fa-angle-left"></i> Checkout </a></div>
                </div>
            </div>

        </div>
    </div>
</div>
@section('scripts')
@endsection