@extends('layouts.main')

@section('content')
<div class="cart-main-area pt-115 pb-120">
            <div class="container">
                <h3 class="cart-page-title">Danh Sách Yêu Thích</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <form action="#">
                            <div class="table-content table-responsive cart-table-content">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Ảnh Sản Phẩm</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Đơn Giá</th>
                                            <th>Số Lượng</th>
                                            <th>Tạm Tính</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($product as $item)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <?php 
                                                    $image = json_decode($item->image)
                                                 ?>
                                                <a href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}"><img width="100%" src="{{ $image[0] }}" alt=""></a>
                                            </td>
                                            <td class="product-name"><a href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></td>
                                            <td class="product-price-cart">
                                                @if($item->discount_price == NULL)
                                                    <span class="amount">{{number_format($item->selling_price)}} ₫</span>
                                                @else
                                                    <span class="amount">{{number_format($item->discount_price)}} ₫</span>
                                                @endif
                                            </td>
                                            <td class="product-quantity pro-details-quality">
                                                <!-- <div class="text-center"> -->
                                                    <input class="text-center" style="background-color: white; border: none;" class="" type="text" disabled="" name="{{'qtybutton'.$item->id}}" value="1">
                                                <!-- </div> -->
                                            </td>
                                            <td class="product-subtotal">
                                                @if($item->discount_price == NULL)
                                                    <span class="amount">{{number_format($item->selling_price)}} ₫</span>
                                                @else
                                                    <span class="amount">{{number_format($item->discount_price)}} ₫</span>
                                                @endif
                                            </td>
                                            <td class="product-wishlist-cart">
                                                <a type="button" class="addcart" data-id="{{($item->id)}}">thêm vào giỏ</a>
                                                <a type="button" id="{{($item->id)}}" onclick="deleteWishlist(this.id)">Xóa</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('js')
<script src="{{ asset('js/frontend/wishlist.js')}}"></script>
@endpush