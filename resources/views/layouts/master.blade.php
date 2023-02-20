<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body style="overflow: unset!important">
    @include('components.navbar')
    @yield('content')
    @include('components.footer')
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        // this function is for update card
                $(".update-cart").click(function (e) {
                   e.preventDefault();
                   var ele = $(this);
                    $.ajax({
                       url: '{{ url('update-cart') }}',
                       method: "PATCH",
                       data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("div").find("." + ele.attr("data-id").replace(/\s+/g, '')).val()},
                       success: function (response) {
                           window.location.reload();
                       }
                    });
                });
                $(".remove-from-cart").click(function (e) {
                    e.preventDefault();
                    var ele = $(this);
                    if(confirm("Are you sure")) {
                        $.ajax({
                            url: '{{ url('remove-from-cart') }}',
                            method: "DELETE",
                            data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                            success: function (response) {
                                window.location.reload();
                                
                            }
                        });
                    }
                });
    </script>
    @stack('js')
</body>

</html>
