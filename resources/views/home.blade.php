@extends('layouts.master')

@section('title')
    <title>Home</title>
@endsection

@section('content')
    <!--carousel slider-->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/slideshow_1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/slideshow_2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/slideshow_3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5">
            <div class="text-center text-white">
                <h2 class="display-6 fw-bolder">Trang chủ</h2>
                <p class="lead fw-normal text-white-50 mb-0">Khám phá web bán sách nào!</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="py-3">
                <h4 class="py-3" class="text-md">Sách mới hôm nay</h4>
            </div>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($recentBook as $book)
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
                            <div class="text-center"><a class="btn btn-outline-danger mt-auto" href="#">Add to cart</a>
                            </div>
                            <div class="text-center py-2">Đã bán: <b>{{$book['sold']}}</b></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="py-3">
                <h4 class="py-3" class="text-md">Sách bán chạy</h4>
            </div>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($bestSellerBook as $book)
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
                            <div class="text-center"><a class="btn btn-outline-danger mt-auto" href="#">Add to cart</a>
                            </div>
                            <div class="text-center py-2">Đã bán: <b>{{$book['sold']}}</b></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-1 row-cols-xl-2">
            @foreach($bookByCategory as $Category)
            <div class="col">
            <div class="py-3">
                <h4 class="py-3" class="text-md">{{$Category['category_name']}}</h4>
            </div>
            <div class="row gx-4 gx-lg-5 row-cols-2">
                @foreach ($Category['list'] as $book)
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
                            <div class="text-center"><a class="btn btn-outline-danger mt-auto" href="#">Add to cart</a>
                            </div>
                            <div class="text-center py-2">Đã bán: <b>{{$book['sold']}}</b></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            </div>
            @endforeach
            </div>
            
        </div>
    </section>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
@endsection
