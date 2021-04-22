@extends('layouts.kasir')

@section('title', 'Product')

@section('content')
     <!-- Page Content -->
     <div class="page-content page-categories">
        <section class="store-trend-categories">
          <div class="container">
            <div class="row">
              <div class="col-12" data-aos="fade-up">
                <h5>All Categories</h5>
              </div>
            </div>
            <div class="row">
              @php
              $incrementCategory = 0
                @endphp
                @forelse ($categories as $category)
                <div
                class="col-6 col-md-3 col-lg-2"
                data-aos="fade-up"
                data-aos-delay="{{$incrementCategory+= 100}}">
                <a class="component-categories d-block" href="{{route('categories-details', $category->slug)}}">
                  <div class="categories-image">
                    <img
                      src="{{Storage::url($category->photos)}}"
                      alt="Gadgets Categories"
                      class="w-100"
                    />
                  </div>
                  <p class="categories-text">
                    {{$category->name}}
                  </p>
                </a>
            </div>
                @empty
                    <div class="col-12 text-center py-5" data-aos="fade-up"
                    data-aos-delay="100">
                      No Categories Found
                    </div>
                @endforelse
            </div>
          </div>
        </section>
        <section class="store-new-products">
          <div class="container">
            <div class="row">
              <div class="col-12" data-aos="fade-up">
                <h5>All Products</h5>
              </div>
            </div>
            <div class="row">
              @php
              $incrementProduct = 0
          @endphp
          @forelse ($products as $product)
          <div
            class="col-6 col-md-4 col-lg-3 mb-5"
            data-aos="fade-up"
            data-aos-delay="{{$incrementProduct+= 100}}">
            <a class="component-products d-block" href="#">
                <div class="products-thumbnail">
                    <div
                        class="products-image"
                        style="
                        @if($product->photos)
                        background-image: url('{{Storage::url($product->photos)}}');
                        @else
                            background-color: #eee
                        @endif
                        ">
                    </div>
                </div>
                <div class="products-text">
                    {{$product->name}}
                </div>
                <div class="products-price mb-2">
                    Rp.{{number_format($product->price)}}
                </div>
            </a>
            <form class="form-inline my-2 my-lg-0" action="{{route('order-product', $product->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <input class="form-control mr-sm-2 w-50 form-control mb-2" type="number" name="quantity_order">
              </div>
              <button class="btn btn-success my-2 my-sm-0  type="submit">Order</button>
            </form>
        </div>
          @empty
              <div class="col-12 text-center">
                No Products Found
              </div>
          @endforelse
            </div>
            <div class="row">
              <div class="col-12 mt-4">
                {{$products->links()}}
              </div>
            </div>
          </div>
        </section>
      </div>
@endsection
    
