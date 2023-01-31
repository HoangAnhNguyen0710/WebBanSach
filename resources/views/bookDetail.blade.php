@extends('layouts.master')

@section('title')
    <title>Tên filter và giá trị filter ở đây<!--ví dụ: NXB: NXB Trẻ--></title>
@endsection

@section('content')
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5">
            <div class="text-center text-white">
                <h2 class="display-6 fw-bolder">Tên sách <!--ví dụ: NXB Trẻ--></h2>
                <p class="lead fw-normal text-white-50 mb-0">Tên NXB    </p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-12 col-md-6 col-lg-7 mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="img-thumbnail w-100" src="https://dummyimage.com/450x600/dee2e6/6c757d.jpg" alt="ảnh tương ứng của book ở đây" />
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
                                <h5 class="fw-bolder mb-4"><i class="bi bi-book-half"></i> Tên sách ở đây</h5>
                                <span class="fs-6 mb-1">Đơn vị xuất bản: <a href="#">NXB XXX</a></span>
                                <span class="fs-6 mb-1">Tác giả: <a href="#">Nguyễn Văn A</a></span>
                                <span class="fs-6 mb-1">Ngôn ngữ: Tiếng Lào</span>
                                <span class="fs-6 mb-1">Số trang: 10000</span>
                                <span class="fs-6 mb-1">Tình trạng: <span class="text-success">Còn hàng</span></span>
                                <span class="fs-6 mb-1">Kho: 1</span>
                                <span class="fs-6 mb-1">Đã bán: 9999</span>
                                <div class="lh-base">
                                    <i class="bi bi-bookmark-star-fill"></i>
                                    mô tả sách ở đây
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
                                <a class="btn btn-outline-dark mt-auto" href="#">Thêm vào giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
@endsection
