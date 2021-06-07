@extends('layouts.main')
@push('css')
<link rel="stylesheet" href="{{ asset('css/frontend/blog.css')}}">
@endpush
@section('content')
<div class="blog-area pt-20 pb-120">
            <div class="container">
                <div class="row">
                    @foreach($post as $item)
                    <div class="col-lg-4 col-md-6 col-12 col-sm-6">
                        <div class="blog-wrap mb-40">
                            <div class="blog-img mb-20">
                                <a href="{{ asset('/blog/details/'.$item->id)}}"><img width="90%" height="270px" src="{{ asset($item->post_image)}}" alt="blog-img"></a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <ul>
                                        <li><a href="#">{{ $item->category_name}}</a></li>
                                        <li>
                                            {{
                                                date('d-m-Y', strtotime($item->created_at)) 
                                            }}
                                        </li>
                                    </ul>
                                </div>
                                <h1><a href="{{ asset('/blog/details/'.$item->id)}}">{{ $item->post_title}}</a></h1>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-12 text-center justify-content-center">
                        <div class="text-center justify-content-center">
                            <!-- <ul>
                                <li><a class="prev" href="#"><i class="icon-arrow-left"></i></a></li>
                                <li><a class="active" href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a class="next" href="#"><i class="icon-arrow-right"></i></a></li>
                            </ul> -->
                            {!!$post->links()!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('js')
<script src="{{ asset('js/frontend/cart.js')}}"></script>
@endpush