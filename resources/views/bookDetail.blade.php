@extends('layouts.master')

@section('title')
    <title>
        @if(isset($book)) {{$book['name']}}
        @endif

        @if(isset($message)) 404 NOT FOUND
        @endif
    </title>
@endsection

@section('content')
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5">
            <div class="text-center text-white">
                <h2 class="display-6 fw-bolder">
                    @if(isset($book)) {{$book['name']}}
                    @endif
            
                    @if(isset($message)) 404 NOT FOUND
                    @endif
                </h2>
                <p class="lead fw-normal text-white-50 mb-0">
                    @if(isset($book)) {{$book['publisher']['publisher_name']}}
                    @endif
            
                    @if(isset($message)) {{$message}}
                    @endif
                </p>
            </div>
        </div>
    </header>
    <!-- Section-->
    @if(isset($book)) 
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-12 col-md-6 col-lg-7 mb-5">
                    <div class="card h-100">
                        <!-- Product image (phần này sẽ phát triển trong tương lai sau)-->
                        {{-- https://dummyimage.com/450x600/dee2e6/6c757d.jpg --}}
                        <img class="img img-thumbnail w-100" src="{{asset("images/naruto_72_demo.jpg")}}" alt="ảnh tương ứng của book ở đây" />
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-5 mb-5">
                    <div class="card h-100">
                        <!-- Infor badge-->
                        <div class="badge bg-danger text-white p-3" style="top: 0.5rem; right: 0.5rem">Thông tin sản phẩm
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex flex-column text-start">
                                <!-- Product detail-->
                                <h5 class="fw-bolder text-uppercase mb-4"><i class="bi bi-book-half"></i> {{$book['name']}}</h5>
                                <span class="fs-6 mb-1">Đơn vị xuất bản: <a href="#">{{$book['publisher']['publisher_name']}}</a></span>
                                <span class="fs-6 mb-1">Tác giả: <a href="#">{{$book['author_name']}}</a></span>
                                <span class="fs-6 mb-1">Ngôn ngữ: {{$book['language']}}</span>
                                <span class="fs-6 mb-1">Số trang: {{$book['pages']}}</span>
                                <span class="fs-6 mb-1">Tình trạng: 
                                    @if($book['in_stock'] == 0) <span class="text-danger">Hết hàng</span>
                                    @else <span class="text-success">Còn hàng</span>
                                    @endif
                                </span>
                                <span class="fs-6 mb-1">Kho: {{$book['in_stock']}}</span>
                                <span class="fs-6 mb-1">Đã bán: {{$book['sold']}}</span>
                                <div class="lh-base">
                                    <i class="bi bi-bookmark-star-fill"></i>
                                    {{$book['description']}}
                                </div>
                                <!-- Product reviews-->
                                {{-- <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div> --}}
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="d-flex flex-column">
                                <!-- Product price-->
                                <span class="fs-4">
                                    <span class="text-muted text-decoration-line-through mb-3">
                                        $20.00</span>
                                    <b class="fw-bold"> $18.00</b>
                                </span>
                                <a class="btn btn-outline-danger mt-auto" href="#">Thêm vào giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <div class="py-5 mt-5 bg-white h-100"></div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
@endsection
