
@extends('layouts.app')
  @section('content')
  <style>
    body {
        padding-top: 56px;
    }
    .hero-section {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 80vh; 
    background-image: url('{{ asset('images/board.jpg') }}');
    background-size: cover;
    background-position: center; 
    background-repeat: no-repeat; 
    color: white; 
    text-align: center; 
    position: relative; 
}

.hero-section .text {
    z-index: 1; 
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); 
    z-index: 0; 
}

.hero-section h1 {
    font-size: 2.5rem;
    color:white;
    font-weight: bold;
}

.hero-section p {
    font-size: 1.2rem;
    margin-top: 10px;
}

    .section-title {
        margin-top: 40px;
        margin-bottom: 20px;
        font-weight: bold;
    }
    .team-member {
        margin-bottom: 30px;
    }
    .team-member h5 {
        font-weight: bold;
    }

    .team-member {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.card {
    flex: 1; 
    display: flex;
    flex-direction: column;
}

.card-body {
    flex-grow: 1; 
    display: flex;
    flex-direction: column;
    justify-content: space-between; 
}

.card-title, .card-text {
    text-align: center;
}


.card {
    min-height: 100px; 
    

}
   
</style>


   <!-- Hero Section -->
<header class="hero-section">
    <div class="text">
        <h1>Welcome to HireX</h1>
        <p>We are here to enhance your professional connections and help you grow!</p>
    </div>
</header>


 



      <section class="text-center mt-5">
    <div class="row d-flex align-items-stretch">
        <div class="col-md-4 team-member">
            <div style="min-height:300px;" class="card">
                <div class="card-body">
                    <h5 class="card-title our">Our Vision</h5>
                    <p class="card-text">At HireX, our vision is to create a leading platform that connects individuals and companies in a new level of effectiveness and innovation.</p>
                    <p class="card-text">Our focus is on enhancing your professional network and supporting your growth with tailored solutions and opportunities that drive your career forward</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 team-member">
            <div style="min-height:300px;" class="card">
                <div class="card-body">
                    <h5 class="card-title our">Our Mission</h5>
                    <p class="card-text">Our mission is to provide users with the tools and resources to enhance their professional opportunities and continuously develop their skills.</p>
                    <p class="card-text">Expand your professional network</p>
                    <p class="card-text">Develop your skills through training and learning</p>
                    <p class="card-text">Discover new job and collaboration opportunities</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 team-member">
            <div style="min-height:300px;" class="card">
                <div class="card-body">
                    <h5 class="card-title our">Our Values</h5>
                    <p class="card-text">We are committed to values that foster innovation, transparency, and sustainable growth.</p>
                    <div >
                        <p>Innovation</p>
                        <p>Transparency</p>
                        <p>Sustainable Growth</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>










        <section class="text-center">
            <h2 class="section-title">Our Team</h2>
            <div class="row">
                <div class="col-md-4 team-member">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Sami Elsaid</h5>
                            <p class="card-text">Full Stack PHP Developer.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 team-member">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Abdelrahman Ayman</h5>
                            <p class="card-text">Full Stack PHP Developer.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 team-member">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Shrouq Eslam</h5>
                            <p class="card-text">Full Stack PHP Developer.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 team-member">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Rawan Saeed</h5>
                            <p class="card-text">Full Stack PHP Developer.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 team-member">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Omar Gamal</h5>
                            <p class="card-text">Full Stack PHP Developer.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 team-member">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Basma Mohammed</h5>
                            <p class="card-text">Full Stack PHP Developer.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection