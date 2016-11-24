<script src="{{ asset('/template/ethersmine/js/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/template/ethersmine/js/bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('/template/ethersmine/js/bootsnav.js') }}" type="text/javascript"></script>
<script src="{{ asset('/template/ethersmine/js/custom.js') }}" type="text/javascript"></script>
<script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
<script src="{{ asset('/js/app.js?t='.time()) }}"></script>
<script>
    var BASE_URL = '{{ url("/")  }}'
</script>
@section('game-product')
@show