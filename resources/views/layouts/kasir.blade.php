<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @stack('prepend-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="/style/main.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
    <link rel="stylesheet" href="{{asset('font-awesome/css/all.css')}}">
    @stack('addon-style')
  </head>    

  <body>
    <div class="page-dashboard">
      <div class="d-flex" id="wrapper" data-aos="fade-right">
        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
          <div class="sidebar-heading text-center">
            <h2>Cart <i class="fas fa-shopping-cart"></i></h2>
          </div>
          <table class="table text-center">
            <thead>
              <tr>
                <th scope="col">Nama</th>
                <th>Jumlah</th>
                <th>Cancel</th>
              </tr>
            </thead>
            @php
                $totalPrice = 0
            @endphp
            @php
                 $carts = \App\Cart::with(['product'])->get();
            @endphp
            <tbody>
              @forelse ($carts as $cart)
              <tr>
                <td>
                  {{$cart->product->name}}
                </td>
                <td>
                  {{$cart->quantity_order}}
                </td>
                <td>
                 <form action="{{route('cart-delete', $cart->id)}}" method="POST">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-remove-cart">
                    <i class="fas fa-times" style="color:red"></i>
                  </button>
                 </form>
                </td>
              </tr>
              @php $totalPrice += $cart->total_price @endphp
              @empty
                  <div class="text-center">No Order</div>     
              @endforelse
            </tbody>
            <tbody>
              @php
              $carts = \App\Cart::with(['product'])->get();
            @endphp
             <form action="{{route('checkout')}}" enctype="multipart/form-data" method="POST">
              @csrf
              <input type="hidden" name="total_price" value="{{$totalPrice}}">
            <tr>
                <td>Total:</td>
                <td></td>
                <td style="color: seagreen; font-weight:bold">
                  Rp.{{number_format($totalPrice)}}
                </td>
            </tr>     
            <tr>
              <td></td>
              <td></td>
              <td>
                <button
                  type="submit"
                  class="btn btn-success"
                >
                  Checkout Now
                </button> </td> 
            </tr>       
            </tbody>
          </form>
          </table>
          <div class="list-group list-group-flush">
           
          </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
          <nav
            class="navbar navbar-store navbar-expand-lg navbar-light fixed-top"
            data-aos="fade-down">
            <button
              class="btn btn-secondary d-md-none mr-auto mr-2"
              id="menu-toggle"
            >
              &laquo; Menu
            </button>

            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto d-none d-lg-flex">
                <li class="nav-item">
                    <a href="{{route('dashboard-kasir')}}" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('product-kasir')}}" class="nav-link">Products</a>
                </li>
            </ul>
              <ul class="navbar-nav ml-auto d-none d-lg-flex">
                <li class="nav-item dropdown">
                  <a
                    class="nav-link"
                    href="#"
                    id="navbarDropdown"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    <img
                      src="/images/icon-user.png"
                      alt=""
                      class="rounded-circle mr-2 profile-picture"
                    />
                    Hi, {{Auth::user()->name}}
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"">Logout</a>
          
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </div>
                </li>
              </ul>
              <!-- Mobile Menu -->
              <ul class="navbar-nav d-block d-lg-none mt-3">
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    Hi, {{Auth::user()->name}}
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-inline-block" href="#">
                    Cart
                  </a>
                </li>
              </ul>
            </div>
          </nav>
          @yield('content')
        </div>
        <!-- /#page-content-wrapper --> 
      </div>
    </div>
    
    <!-- Bootstrap core JavaScript -->
    @stack('prepend-script')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('font-awesome/js/all.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <!-- Menu Toggle Script -->
    <script>
      $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>
    @stack('addon-script')
  </body>
</html>
