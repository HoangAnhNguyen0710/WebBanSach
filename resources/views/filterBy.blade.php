@extends('layouts.master')

@section('title')
    <title>Tên filter và giá trị filter ở đây<!--ví dụ: NXB: NXB Trẻ--></title>
@endsection

@section('content')
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5">
            <div class="text-center text-white">
                <h2 class="display-6 fw-bolder">{{$filterValue}} <!--ví dụ: NXB Trẻ--></h2>
                <p class="lead fw-normal text-white-50 mb-0">Khám phá web bán sách nào!</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
                @foreach ($bookList as $book)
                <div class="col mb-5">
                    <div class="card h-100 fs-6">
                        <!-- Sale badge-->
                        <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale
                        </div>
                        <!-- Category badge-->
                        <div class="badge bg-warning text-white position-absolute" style="top: 0.5rem; left: 0">{{$book['category']['category_name']}}
                        </div>
                        <!-- Product image-->
                        <img class="card-img-top" src="https://dummyimage.com/400x400/dee2e6/6c757d.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-2">
                            <div class="d-flex flex-column p-2 justify-content-center align-items-center">
                                <!-- Product name-->
                                <div class="w-100"><h6 class="fw-bolder pb-1"><a class="text-decoration-none" href="books/{{$book['id']}}">{{$book['name']}}</a></h6></div>
                                <span class="fs-6 pb-2"></span>
                                <!-- Product price-->
                                <div class="d-flex flex-column justify-content-start w-100"><span class="text-success"> {{$book['discount_price']}}đ</span><span class="text-muted text-decoration-line-through ">{{$book['price']}}đ</span></div>
                                
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-2 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-danger mt-auto" href="{{ url('add-to-cart/'.$book['id']) }}">Add to cart</a>
                            </div>
                            <div class="text-center py-2">Đã bán: <b>{{$book['sold']}}</b></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center py-4">
            @if($bookList)
                {{ $bookList->withQueryString()->onEachSide(1)->links() }}
            @endif
            </div>
        </div>
    </section>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
@endsection
