<nav class="navbar navbar-expand-md bg-light navbar-light">
    
        <!-- Brand and toggle get grouped for better mobile display -->
       
            <a class="navbar-brand" href="{{ route('product.index') }}" style="color: Blue; font-size: 24px">Farma-Line</a>

                <button 
            class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

    <span class="navbar-toggler-icon"></span>
  
                 </button>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
            
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('product.shoppingCart') }}">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Carrito
                        <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
                    </a>
                </li>

               <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Usuario <span class="caret"></span></a>

                         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if(Auth::check())
                            <a class="dropdown-item" href="{{ route('user.profile') }}">Perfil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('user.logout') }}">Salir</a>
                        @else
                            <a class="dropdown-item" href="{{ route('user.signup') }}">Registrarse</a>
                            <a class="dropdown-item" href="{{ route('user.signin') }}">Iniciar Sesión</a>
                        @endif
                        </div>
                </li>
            </ul>
    </div>
   
</nav>