<nav class="navbar navbar-default menu-header">
    <div class="container">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('home')}}">
                    <img src="{{url('assets/imgs/logo-especializati.png')}}" alt="Curso de Laravel com PagSeguro"
                         class="logo">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{route('cart')}}">Carrinho <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <span class="badge">
                                @if( Session::has('cart') )
                                    {{ Session::get('cart')->getTotalItems() }}
                                @else
                                    0
                                @endif
                            </span></a>
                    </li>
                    @if( auth()->check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">{{auth()->user()->name}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('profile')}}">Meu Perfil</a></li>
                            <li><a href="{{route('password')}}">Minha Senha</a></li>
                            <li><a href="{{route('my.orders')}}">Meus Pedidos</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{route('logout')}}">Sair</a></li>
                        </ul>
                    </li>
                    @else
                        <li>
                            <a href="{{route('login')}}">Login</a>
                        </li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </div>
</nav>