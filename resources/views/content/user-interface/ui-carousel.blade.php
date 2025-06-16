@extends('layouts/contentNavbarLayout')

@section('title', 'Carousel - UI elements')

@section('content')
<div class="row">
  <!-- Bootstrap carousel -->
  <div class="col-md">
    <h5 class="mb-3">Dashboard</h5>

    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="{{asset('assets/img/elements/13.jpg')}}" alt="First slide" />
          <div class="carousel-caption d-none d-md-block">
            <h3>As Yours</h3>
            <p style="text-align: justify;">
              As a Regional Director, I have witnessed firsthand the 
              transformative power of effective leadership and teamwork
               within our organization. Over the past year, our region has 
               faced numerous challenges, from adapting to new technologies
                to navigating the complexities of a rapidly changing workforce.
                 Through it all, our team has demonstrated resilience, innovation, 
                 and a steadfast commitment to our shared mission. I am continually 
                 inspired by the dedication and professionalism of our staff, who 
                 consistently go above and beyond to serve our clients and communities.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="{{asset('assets/img/elements/2.jpg')}}" alt="Second slide" />
          <div class="carousel-caption d-none d-md-block">
            <h3>As Me</h3>
            <p style="text-align: justify;">
              One particular story stands out to me—a project that required collaboration 
              across multiple departments and locations. Despite tight deadlines and limited resources, 
              our team members communicated openly, leveraged each other's strengths, and maintained 
              a positive attitude throughout the process. Their collective efforts not only resulted 
              n the successful completion of the project but also strengthened relationships and 
              fostered a culture of mutual respect and support. This experience reinforced my 
              belief that our greatest asset is our people.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="{{asset('assets/img/elements/18.jpg')}}" alt="Third slide" />
          <div class="carousel-caption d-none d-md-block">
            <h3>To the Life</h3>
            <p style="text-align: justify;">
               Looking ahead, I am confident that our region will continue to thrive by embracing change 
               and pursuing excellence in all that we do. I encourage everyone to remain proactive, 
               seek opportunities for growth, and support one another as we work toward our goals. 
               Together, we can overcome any obstacle and achieve remarkable results for our organization 
               and the communities we serve.
            </p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </a>
    </div>
  </div>
  <!-- Bootstrap crossfade carousel -->
</div>@endsection