<html>
<head>
    <title>Checkout Transparente PagSeguro</title>
</head>
<body>
{!!  Form::open(['id' => 'form']) !!}

{!! Form::Close() !!}
<a href="" class="btn-finished">Pagar com Boleto!</a>
<div class="payments-methods"></div>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
        $(function () {
            $('.btn-finished').click(function () {
                setSessionId();
                return false;
            })
        });

        function setSessionId()
        {
            var data = $('#form').serialize();
            $.ajax({
                url: "{{route('pagseguro.transparente.code')}}",
                method: "POST",
                data: data
            }).done(function (data) {
                PagSeguroDirectPayment.setSessionId(data);

                //getPaymentMethods();
                paymentBillet();
            }).fail(function () {
                alert("Fail request... :-(");
            })
        }
        
        function getPaymentMethods() {
            PagSeguroDirectPayment.getPaymentMethods({
                success: function (response) {
                    if( response.error == false )
                    {
                        $.each(response.paymentMethods, function (key, value) {
                            $('.payments-methods').append(key+"<br />");
                        })
                    }
                },
                error: function (response) {
                    console.log(response);
                },
                complete: function (response) {
                    console.log(response);
                }
            })
        }
        
        function paymentBillet() {
            var sendHash = PagSeguroDirectPayment.getSenderHash();
            var data = $('#form').serialize()+"&sendHash="+sendHash;
            $.ajax({
                url: "{{route('pagseguro.transparente.billet')}}",
                method: "POST",
                data: data
            }).done(function (url) {
                location.href=url;
            }).fail(function () {
                alert("Fail request... :-(");
            })
        }
    </script>

    <!-- URL PagSeguro Transparent -->
    <script src="{{config('pagseguro.url_transparente_js_sandbox')}}"></script>
</body>
</html>