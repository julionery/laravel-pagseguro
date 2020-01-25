<html>
<head>
    <title>PagSeguro LightBox</title>
</head>
<body>
<a href="#" class="btn-buy">Finalizar Compra!</a>

{!! csrf_field() !!}

<div class="msg-return"></div>
<div class="preloader" style="display: none;">Carregando...</div>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    $(function () {
        $('.btn-buy').click(function () {
            $.ajax({
                url: "{{route('pagseguro.lightbox.code')}}",
                method: "POST",
                data: {
                    _token: $('input[name=_token]').val()
                },
                beforeSend: startPreLoader()
            }).done(function (code) {
                lightbox(code);
            }).fail(function () {
                alert("Erro inesperado, tente novamente!");
            }).always(function () {
                stopPreLoader();
            });
            return false;
        })
    });

    function lightbox(code) {
        var isOpenLightbox = PagSeguroLightbox({
            code: code
        }, {
            success: function (transactionCode) {
                $('.msg-return').html("Pedido realizado com sucesso: " + transactionCode);
            },
            abort: function () {
                alert("Compra Cancelada!");
            }
        });

        if (!isOpenLightbox) {
            location.href = "{{config('pagseguro.url_redirect_after_request')}}" + code;
        }
    }

    function startPreLoader() {
        $('.preloader').show();
    }

    function stopPreLoader() {
        $('.preloader').hide();
    }
</script>
<script src="{{config('pagseguro.url_lightbox_sandbox')}}"></script>
</body>
</html>