@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container-fluid p-0">
    <div class="position-relative" style="height: 650px;">
        <img class="img-fluid" src="{{ asset('images/phomef.jpg') }}" style="width: 100%; height: 650px;"
            alt="Job Search Image">
        <div class="position-absolute top-0 start-0 w-100 d-flex align-items-center"
            style="background: rgba(43, 57, 64, .5); height: 650px;">
            <div class="container">
                <div class="row justify-content-start">
                    <div class="col-10 col-lg-8 mb-4">
                        <h1 class="display-3 text-white mb-4">Find The Perfect Job That You Deserve</h1>
                        <p class="fs-5 fw-medium text-white mb-4 pb-2">Endless Possibilities, One Career</p>

                        @auth
                        @php
                        $user = auth()->user();
                        $isEmployer = $user->role == 2;
                        $isCandidate = $user->role == 3 && $user->candidate()->exists();
                        @endphp

                        @if($user->role != 1)
                        @if($isEmployer)
                        <a href="{{ route('jobs.create') }}" class="btn btn-primary mt-5 py-md-3 px-md-5">Create a
                            Job</a>
                        @elseif($isCandidate)
                        <a href="{{ route('jobs.index') }}" class="btn btn-primary mt-4 py-md-3 px-md-5 me-3">View
                            Available Jobs</a>
                        @else
                        <a href="{{ route('candidates.create') }}"
                            class="btn btn-primary mt-4 py-md-3 px-md-5 me-3">Find a Job</a>
                        <a href="{{ route('employers.create') }}" class="btn btn-primary mt-4 py-md-3 px-md-5">Post a
                            Job</a>
                        @endif
                        @endif

                        @else
                        <a href="{{ route('login') }}" class="btn btn-primary mt-4 py-md-3 px-md-5 me-3">Find a Job</a>
                        <a href="{{ route('login') }}" class="btn btn-primary mt-4 py-md-3 px-md-5">Post a Job</a>
                        @endauth

                    </div>

                    <div class="container " style=" margin-top:95px;width:70%">
                        <form action="{{ route('jobs.search') }}" method="GET">
                            <div class="row g-2">
                                <div class="col-md-10">
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <input type="text" name="keyword" class="form-control border-0"
                                                placeholder="Keyword" />
                                        </div>
                                        <div class="col-md-4">
                                            <select name="category" class="form-select border-0">
                                                <option value="">Category</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="location" class="form-select border-0">
                                                <option value="">Location</option>
                                                @foreach($locations as $location)
                                                <option value="{{ $location->location }}">{{ $location->location }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-4 col-12 mb-3">
                                    <button type="submit" class="btn btn-primary border-0 w-100">Search</button>
                                </div>
                            </div>
                        </form>

                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Search End -->

</div>
<!-- Static Image Section End -->




<div class="container-xxl py-5" id="category">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp">Explore By Category</h1>
        <div class="row g-4" style=" border-radius:30px;">
            @foreach($categories as $index => $category)
            <div class="col-lg-3 col-sm-6 wow fadeInUp">
                <a class="cat-item rounded p-4" style="box-shadow: 0px 4px 10px var(--primary) ; "
                    href="{{ route('jobs.jobbycategory', ['categoryId' => $category->id]) }}">
                    <i class="fa fa-3x fa-mail-bulk text-primary mb-4{{ $category->icon_class }}  "></i>
                    <h6 class="mb-3">{{ $category->name }}</h6>
                    <p class="mb-0">{{ $category->jobs_count }} Categories</p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Category End -->

<!-- About Start -->
<div class="container-xxl py-5" id="about">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="row g-0 about-bg rounded overflow-hidden">
                    <div class=" text-start">
                        <img class="img-fluid w-100" src="{{asset('images/board.jpg')}}">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="mb-4">We Help To Get The Best Job And Find A Talent</h1>
                <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet
                    diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna
                    dolore erat amet</p>
                <p><i class="fa fa-check text-primary me-3"></i>Tempor erat elitr rebum at clita</p>
                <p><i class="fa fa-check text-primary me-3"></i>Aliqu diam amet diam et eos</p>
                <p><i class="fa fa-check text-primary me-3"></i>Clita duo justo magna dolore erat amet</p>
                <a class="btn btn-primary py-3 px-5 mt-3" href="{{route('aboutus')}}">Read More</a>
                @if(auth()->check() && auth()->user()->role == 3)
                <a class="btn btn-info py-3 px-5 mt-3" href="{{route('candidatePack')}}">Check Our Packages</a>
                @endif
                @if(auth()->check() && auth()->user()->role == 2)
                <a class="btn btn-info py-3 px-5 mt-3" href="{{route('employerPack')}}">Check Our Packages</a>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Jobs Start -->
<div class="container-xxl py-5" id="alljobs">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Job Listings</h1>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @foreach ($jobs as $job)
                <div class="card job-item mb-4 shadow-sm wow fadeInUp" data-wow-delay="0.2s"
                    style="border-radius: 8px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="card-body p-4" onclick="window.location.href='{{ route('jobs.show', $job->id) }}'"
                        style="cursor: pointer; background-color: var(--light); border-radius: 6px;">
                        <div class="row align-items-center">
                            <div class="col-md-2 text-center company-logo">
                                <img class="img-fluid border rounded-circle" src="{{ $job->logo ? asset('storage/' . $job->logo) : asset('images/placeholder.jpeg') }}"
                                    alt="" style="width: 80px; height: 80px; border: 2px solid #ddd;">
                            </div>
                            <div class="col-md-7 job-details">
                                <h4 class="job-title mb-1">{{ $job->title }}</h4>
                                <p class="text-muted mb-2">{{ $job->location }} | {{ $job->job_type }}</p>
                                <p class="text-primary font-weight-bold mb-0">
                                    <i class="far fa-money-bill-alt"></i> ${{ $job->salary }}
                                </p>
                            </div>
                            <div class="col-md-3 text-end">
                                @auth
                                @if(auth()->user()->role == 3)
                                <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-outline-primary px-4 py-2">
                                    <i class="fas fa-info-circle"></i> View Details
                                </a>
                                @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="text-center mt-4">
                    <a href="{{ route('jobs.index') }}" class="btn btn-outline-primary py-3 px-5">View More Jobs</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jobs End -->






<!-- Testimonial Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="text-center mb-5">Our Clients Say!!!</h1>
        <a href="{{route('feedback.create')}}" class="btn btn-primary mb-3 ">Leave your Feedback</a>
        <div class="owl-carousel testimonial-carousel">
        @foreach($feedback as $fb)
            <div class="testimonial-item bg-light rounded p-4">
                <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                <p>{{$fb->feedback}}
                    </p>
                <div class="d-flex align-items-center"
                        style="width: 50px; height: 50px;">
                    <div class="ps-3">
                        <h5 class="mb-1">{{$fb->name}}</h5>
                    </div>
                </div>
            </div>
   @endforeach
        </div>
    </div>
</div>
<!-- Testimonial End -->


<!-- Footer Start -->
<footer class="bg-primary text-white pt-5 pb-4">
    <div class="container text-center text-md-left">
        <div class="row text-center text-md-left">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 text-white font-weight-bold">HireX</h5>
                <p class="text-white">Your ultimate job search and talent discovery platform. We bridge the gap between
                    top employers and qualified candidates.</p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 text-white font-weight-bold">Quick Links</h5>
                <p class="text-white">
                    <a href="{{ route('jobs.index') }}" class="text-white">Find Jobs</a>
                </p>
                <p class="text-white">
                    <a href="{{ route('employers.create') }}" class="text-white">Post a Job</a>
                </p>
                <p class="text-white">
                    <a href="#" class="text-white">About Us</a>
                </p>
                <p class="text-white">
                    <a href="#" class="text-white">Contact</a>
                </p>
            </div>

            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 text-white font-weight-bold">Categories</h5>
                <p>
                    <a href="#" class="text-white">IT & Software</a>
                </p>
                <p>
                    <a href="#" class="text-white">Finance</a>
                </p>
                <p>
                    <a href="#" class="text-white">Healthcare</a>
                </p>
                <p>
                    <a href="#" class="text-white">Marketing</a>
                </p>
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 text-white font-weight-bold">Contact Us</h5>
                <p>
                    <i class="fas fa-home mr-3"></i> 123 HireX St., Cairo , Egypt
                </p>
                <p>
                    <i class="fas fa-envelope mr-3"></i> info@hirex.com
                </p>
                <p class="text-white">
                    <i class="fas fa-phone mr-3"></i> +1 234 567 8901
                </p>
            </div>
        </div>

        <hr class="mb-4">

        <div class="row align-items-center">
            <div class="col-md-7 col-lg-8">
                <p class="text-white">© 2024 HireX. All rights reserved.</p>
            </div>
            <div class="col-md-5 col-lg-4">
                <div class="text-center text-md-right">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End -->



<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

@endsection
