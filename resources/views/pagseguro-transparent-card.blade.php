<html>
<head>
    <title>PagSeguro LightBox</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Fonts Icons -->
    <link rel="stylesheet" href="{{url('assets/css/font-awesome.css')}}">

</head>
<body>
<div class="container">
    <h1>Pagar com cartão</h1>
{!! Form::open(['id' => 'form']) !!}
    <div class="form-group">
        <label>Número do Cartão:</label>
        {!! Form::text('cardNumber', null, ['class' => 'form-control', 'Placeholder' => 'Número do cartão', 'required']) !!}
    </div>
    <div class="form-group">
        <label>Mês de Expiração:</label>
        {!! Form::text('cardExpiryMonth', null, ['class' => 'form-control', 'Placeholder' => 'Mês de expiração', 'required']) !!}
    </div>
    <div class="form-group">
        <label>Ano de Expiração:</label>
        {!! Form::text('cardExpiryYear', null, ['class' => 'form-control', 'Placeholder' => 'Ano de expiração', 'required']) !!}
    </div>
    <div class="form-group">
        <label>Código de Segurança (3 números):</label>
        {!! Form::text('cardCVV', null, ['class' => 'form-control', 'Placeholder' => 'Código de Segurança (CVC)', 'required']) !!}
    </div>
    <div class="form-group">
        {{ Form::hidden('cardName', null) }}
        {{ Form::hidden('cardToken', null) }}
        <button class="btn btn-default btn-buy">Enviar Agora</button>
    </div>
{!! Form::close() !!}
    <div class="preloader" style="display: none;">Preloader...</div>
    <div class="message" style="display: none;"></div>
</div>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- URL PagSeguro Transparent -->
<script src="{{config('pagseguro.url_transparente_js_sandbox')}}"></script>
<script>
    $(function () {
        setSessionId();
        $('#form').submit(function () {
            getBrand();
            startPreLoader("Enviando dados...");
            createCredCardToken();
            return false;
        })
    });

    function setSessionId()
    {
        var data = $('#form').serialize();
        $.ajax({
            url: "{{route('pagseguro.transparente.code')}}",
            method: "POST",
            data: data,
            beforeSend: startPreLoader("Carregando a sessão..., aguarde!")
        }).done(function (data) {
            console.log(data);
            PagSeguroDirectPayment.setSessionId(data);

        }).fail(function () {
            alert("Fail request... :-(");
        }).always(function () {
            stopPreLoader();
        });
    }

    function getBrand() {
        PagSeguroDirectPayment.getBrand({
            cardBin: $('input[name=cardNumber]').val().replace(/ /g, ''),
            success: function (response) {
                console.log("Sucesso getBrand");
                console.log(response);
                $("input[name=cardName]").val(response.brand.name);
                //createCredCardToken(response.brand.name);
            },
            error: function (response) {
                console.log("Error getBrand");
                console.log(response);
            },
            complete: function (response){
                console.log("Complete getBrand");
                console.log(response);
            }
        });
    }

    function createCredCardToken() {
        PagSeguroDirectPayment.createCardToken({
            cardNumber: $('input[name=cardNumber]').val().replace(/ /g, ''),
            brand: $('input[name=cardName]').val(),
            cvv: $('input[name=cardCVV]').val(),
            expirationMonth: $('input[name=cardExpiryMonth]').val(),
            expirationYear: $('input[name=cardExpiryYear]').val(),
            success: function (response) {
                console.log("Sucesso createCredCardToken");
                //console.log(response);
                $("input[name=cardToken]").val(response.card.token);
                createTransactionCard();
            },
            error: function (response) {
                console.log("Error createCredCardToken");
                //console.log(response);
            },
            complete: function (response){
                console.log("Complete createCredCardToken");
                //console.log(response);
                stopPreLoader();
            }
        });
    }
    function startPreLoader(msgPreloader) {
        if(msgPreloader != "")
            $('.preloader').show(msgPreloader);

        $('.preloader').show();
        $('.btn-buy').addClass('disabled');
    }

    function stopPreLoader() {
        $('.preloader').hide();
        $('.btn-buy').removeClass('disabled');
    }

    function createTransactionCard() {
        var sendHash = PagSeguroDirectPayment.getSenderHash();
        var data = $('#form').serialize()+"&sendHash="+sendHash;
        $.ajax({
            url: "{{route('pagseguro.transparente.transaction')}}",
            method: "POST",
            data: data,
            beforeSend: startPreLoader("Realizando o pagamento com o cartão..., aguarde!")
        }).done(function (code) {
            console.log(code);
            alert(code);
            $(".message").html("Código da transação: "+code);
            $(".message").show();
        }).fail(function () {
            alert("Fail request... :-(");
        }).always(function () {
            stopPreLoader();
        });
    }
</script>
</body>
</html>