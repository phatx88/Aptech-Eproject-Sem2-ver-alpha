@extends('main_layout')
@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('frontend/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Blog <i class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Blog</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row d-flex">
                @if($post)
                @foreach ($post as $key => $blog)
                <div class="col-lg-6 d-flex align-items-stretch ftco-animate">
                    <div class="blog-entry d-md-flex">
                        <a href="blog-single.html" class="block-20 img" style="background-image: url('{{ asset('backend/images/blogs/'. $blog->featured_image) }}');">
                        </a>
                        <div class="text p-4 bg-light">
                            <div class="meta">
                                <p><span class="fa fa-calendar"></span> {{ $blog->publishedAt }}</p>
                            </div>
                            <h3 class="heading mb-3"><a href="#">{{ $blog->title }}</a></h3>
                            <p>{{ $blog->summary }}</p>
                            <a href="{{  url('/blog/details/'.$blog->slug) }}" class="btn-custom">Continue <span class="fa fa-long-arrow-right"></span></a>

                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        <ul>
                            <li>{{ $post->appends(request()->input())->links() }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
