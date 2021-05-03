@extends('main_layout')
@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url({{asset('frontend/images/bg_2.jpg')}});" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-end justify-content-center">
        <div class="col-md-9 ftco-animate mb-5 text-center">
            <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span class="mr-2"><a href="blog.html">Blog <i class="fa fa-chevron-right"></i></a></span> <span>Blog Single <i class="fa fa-chevron-right"></i></span></p>
          <h2 class="mb-0 bread">Blog Single</h2>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-degree-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 ftco-animate">

             {!! $post_details->content !!}


          <div class="tag-widget post-tag-container mb-5 mt-5">
            <div class="tagcloud">
                @foreach ($post_tag as $key => $tag)
              <a href="#" class="tag-cloud-link">{{ $tag->tag->tag_name }}</a>
                @endforeach
            </div>
          </div>

          <div class="about-author d-flex p-4 bg-light">
            <div class="bio mr-5">
              <img src="{{asset('frontend/images/profile/'.$post_details->user->profile_pic)}}" alt="Image placeholder" width="150px" height="150px" class="img-fluid mb-4">
            </div>
            <div class="desc">
              <h2>Author: {{ $post_details->user->name }}</h2>
              {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p> --}}
            </div>
          </div>

        <form action="{{ url('/comment/blog') }}" method="POST">
                @csrf
            @if(Auth::check())
                <div class="row p-4">
                    <h3 class="mb-4">Your Review</h3>
                    <div class="review">

                {{-- USER IMAGE --}}
                {{-- <div class="user-img"
                                    style="background-image: url(frontend/images/person_1.jpg)">
                                </div> --}}
                    <div class="desc pr-5">
                        {{-- AJax load error messages --}}
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        {{-- AJax load error messages --}}


                            <input type="hidden" class="blog-id" name="blog_id" value="{{ $post_details->id }}">



                                <div class="row">
                                    <div class="col-sm-6">
                                        <input  type="hidden" name="user_id" class="form-control mt-4 user-id"
                                            placeholder="Name*" value="{{ Auth::user()->id }}">
                                    </div>
                                    <div class="col-sm-6">
                                            <input type="hidden" name="email" class="form-control mt-4"
                                                placeholder="Email*" value="{{ Auth::user()->email }}">
                                        </div>
                                    <div class="col-sm-6">
                                        <span class="my-rating"></span> <span class="live-rating-span"></span>
                                                <input type="hidden" class="live-rating " id="star-rating" name="star" value="">

                                    </div>
                                    <div class="col-12">
                                        <textarea name="description" class="form-control mt-4 post-comment-description"
                                            placeholder="Description*" rows="5"></textarea>
                                    </div>
                                </div>
                        <input type="submit" class="btn btn-primary mt-4" id="submitPost" value="Post">
                        </div>
                    </div>
                    </div>
            @endif
        </form>
            @if($comments)

                {{-- comment --}}
            <ul class="comment-list">
                @foreach($comments as $key => $comment)
                <li>
                <div class="vcard bio">
                    <img style="" src="{{ asset('frontend/images/profile/' . $comment->user->profile_pic) }}" alt="Avatar" >
                  </div>


                <div class="comment-body">
                    <h4>
                        <span class="text-left">{{ $comment->name }}</span>
                        <span class="text-right">{{ $comment->createdAt	 }}</span>
                    </h4>
                    <p class="star">
                    <div class="my-rating-posted" data-rating="{{ $comment->star }}">
                    </div>
                    </p>
            <p>{{ $comment->content }}</p>
                </div>
            </li>
            @endforeach
            </ul>

            @endif

        {{-- comment --}}
        </div> <!-- .col-md-8 -->
        <div class="col-lg-4 sidebar pl-lg-5 ftco-animate">
          <div class="sidebar-box">
            <form action="#" class="search-form">
              <div class="form-group">
                <span class="fa fa-search"></span>
                <input type="text" class="form-control" placeholder="T  er">
              </div>
            </form>
          </div>
          {{-- <div class="sidebar-box ftco-animate">
            <div class="categories">
              <h3>Services</h3>
              <li><a href="#">Relation Problem <span class="fa fa-chevron-right"></span></a></li>
              <li><a href="#">Couples Counseling <span class="fa fa-chevron-right"></span></a></li>
              <li><a href="#">Depression Treatment <span class="fa fa-chevron-right"></span></a></li>
              <li><a href="#">Family Problem <span class="fa fa-chevron-right"></span></a></li>
              <li><a href="#">Personal Problem <span class="fa fa-chevron-right"></span></a></li>
              <li><a href="#">Business Problem <span class="fa fa-chevron-right"></span></a></li>
            </div>
          </div> --}}

          <div class="sidebar-box ftco-animate">
            <h3>Recent Blog</h3>
            <div class="block-21 mb-4 d-flex">
              <a class="blog-img mr-4" style="background-image: url({{asset('frontend/images/image_1.jpg')}});"></a>
              <div class="text">
                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                <div class="meta">
                  <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                  <div><a href="#"><span class="fa fa-user"></span> Admin</a></div>
                  <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                </div>
              </div>
            </div>
            <div class="block-21 mb-4 d-flex">
              <a class="blog-img mr-4" style="background-image: url({{asset('frontend/images/image_2.jpg')}});"></a>
              <div class="text">
                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                <div class="meta">
                  <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                  <div><a href="#"><span class="fa fa-user"></span> Admin</a></div>
                  <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                </div>
              </div>
            </div>
            <div class="block-21 mb-4 d-flex">
              <a class="blog-img mr-4" style="background-image: url({{asset('frontend/images/image_3.jpg')}});"></a>
              <div class="text">
                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                <div class="meta">
                  <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                  <div><a href="#"><span class="fa fa-user"></span> Admin</a></div>
                  <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                </div>
              </div>
            </div>
          </div>

          <div class="sidebar-box ftco-animate">
            <h3>Tag Cloud</h3>
            <div class="tagcloud">
                @foreach ($tag_list as $key => $tag_cloud)
              <a href="#" class="tag-cloud-link">{{ $tag_cloud->tag_name }}</a>
                @endforeach
            </div>
          </div>

          <div class="sidebar-box ftco-animate">
            <h3>Paragraph</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
          </div>
        </div>

      </div>
    </div>
  </section> <!-- .section -->

@endsection
@section('scripts')
<script type="text/javascript">

    $(document).ready(function() {
        updateAnsweredRating();
    });

    $(".my-rating").starRating({
        strokeColor: '#894A00',
        strokeWidth: 10,
        starSize: 25,
        disableAfterRate: true,
        onHover: function(currentIndex, currentRating, $el) {
            $('.live-rating').val(currentIndex);
            $('.live-rating-span').text(currentIndex);
        },
        onLeave: function(currentIndex, currentRating, $el) {
            $('.live-rating').val(currentRating);
            $('.live-rating-span').text(currentRating);
        },
    });

    function updateAnsweredRating() {
            $(".my-rating-posted").starRating({
                activeColor: 'crimson',
                starSize: 20,
                readOnly: true,
            });
        };
</script>



@endsection
