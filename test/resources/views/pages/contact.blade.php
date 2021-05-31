@extends('main_layout')
@section('content')
    <style>
        /* Styling for Autocomplete search bar */
    #pac-card {
      background-color: #fff;
      border-radius: 2px 0 0 2px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      box-sizing: border-box;
      font-family: Roboto;
      margin: 10px 10px 0 0;
      -moz-box-sizing: border-box;
      outline: none;
    }
    
    #pac-container {
      padding-top: 12px;
      padding-bottom: 12px;
      margin-right: 12px;
    }
    
    #pac-input {
      background-color: #fff;
      font-family: Roboto;
      font-size: 15px;
      font-weight: 300;
      margin-left: 12px;
      padding: 0 11px 0 13px;
      text-overflow: ellipsis;
      width: 400px;
    }
    
    #pac-input:focus {
      border-color: #4d90fe;
    }
    
    #title {
      color: #fff;
      background-color: #acbcc9;
      font-size: 18px;
      font-weight: 400;
      padding: 6px 12px;
    }
    
    .hidden {
      display: none;
    }

    /* Styling for an info pane that slides out from the left. 
     * Hidden by default. */
    #panel {
      height: 100%;
      width: null;
      background-color: white;
      position: fixed;
      z-index: 1;
      overflow-x: hidden;
      transition: all .2s ease-out;
    }
    
    .open {
      width: 250px;
    }
    
    .place {
      font-family: 'open sans', arial, sans-serif;
      font-size: 1.2em;
      font-weight: 500;
      margin-block-end: 0px;
      padding-left: 18px;
      padding-right: 18px;
    }
    
    .distanceText {
      color: silver;
      font-family: 'open sans', arial, sans-serif;
      font-size: 1em;
      font-weight: 400;
      margin-block-start: 0.25em;
      padding-left: 18px;
      padding-right: 18px;
    }
  </style>
    </style>


    <section class="hero-wrap hero-wrap-2" style="background-image: url('frontend/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Contact Us <i class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Contact Us</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="wrapper px-md-4">
                        <div class="row mb-5">
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-map-marker"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>Address:</span> 198 West 21th Street, Suite 721 New York NY 10016</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-phone"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>Phone:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-paper-plane"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-globe"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>Website</span> <a href="#">yoursite.com</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row no-gutters" >
                            <div class="col-12">
                                <div id="map" class="map" style="height: 500px;"></div>
                                {{-- <div class="contact-wrap w-100 h-100 p-md-5 p-4"> --}}
                                    {{-- <h3 class="mb-4">Contact Us</h3>
                                    <form method="POST" id="contactForm" name="contactForm" class="contactForm">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="name">Full Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="email">Email Address</label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="label" for="subject">Subject</label>
                                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="label" for="#">Message</label>
                                                    <textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Message"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="submit" value="Send Message" class="btn btn-primary">
                                                    <div class="submitting"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form> --}}
                                {{-- </div> --}}
                            </div>
                            {{-- <div class="col-md-5 order-md-first d-flex align-items-stretch">
                                <div id="map" class="map"></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><section class="hero-wrap hero-wrap-2" style="background-image: url('frontend/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Contact Us <i class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Contact Us</h2>
                </div>
            </div>
        </div>
    </section>



@endsection
@section('scripts')
<script src="{{ asset('frontend/js/app.js') }}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwww3EMQjptptBrloFxaIYJFGkQkuWLLE&libraries=places&callback=initMap">
</script>
@endsection