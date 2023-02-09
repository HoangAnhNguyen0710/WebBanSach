<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#!">Web bán sách</a>
        <button class="navbar-toggler" type="button"><span
                class="navbar-toggler-icon" onclick=changeVisibility()></span></button>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="/">Sách bán chạy</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">Danh mục</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Danh mục</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                        <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex">
                <div class="input-group input-group-sm pe-3">
                    <button class="btn btn-outline-secondary" id="basic-addon1"><i
                            class="bi bi-search-heart"></i></button>
                    <input type="text" class="form-control" placeholder="Tìm sách...." aria-label="search-book"
                        aria-describedby="basic-addon1">
                </div>
            </form>
            <form class="d-flex">
                <button class="btn btn-outline-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">{{count(session('cart'))}}</span>
                </button>
            </form>
        </div>
        @extends('components.cart')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        function changeVisibility() {
            if(!$("#navbarSupportedContent").hasClass('show')) {
                $("#navbarSupportedContent").addClass("show")
            }
            else $("#navbarSupportedContent").removeClass("show")
        }
    </script>
</nav>
