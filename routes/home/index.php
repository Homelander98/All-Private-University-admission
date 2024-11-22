<?php

$page_title = config('app_name');

require(ROUTES_PATH . '/header.php');

$user = is_logged() ? get_logged_user() : [];
?>


<?= render_flashes(); ?>

<main class="main" id="top">
      <section class="py-0">
        <div class="bg-holder" style="background-image:url(assets/img/illustrations/dot.png);background-position:left;background-size:auto;margin-top:-105px;">
        </div>
        <!--/.bg-holder-->

        <div class="container position-relative">
          <div class="row align-items-center">
            <div class="col-md-5 col-lg-6 order-md-1 pt-8"><img class="img-fluid" src="assets/img/illustrations/hero-header.png" alt="" /></div>
            <div class="col-md-7 col-lg-6 text-center text-md-start pt-5 pt-md-9">
              <h1 class="mb-4 display-3 fw-bold">Your Gateway to Seamless Access to Top Private Universities<br class="d-block d-lg-none d-xl-block" /></h1><a class="btn btn-lg btn-primary rounded-pill hover-top" href="<?= e_attr(uri('/apply')); ?>" role="button">Apply Now</a>
            </div>
          </div>
        </div>
      </section>
      <section class="py-8">
        <div class="bg-holder" style="background-image:url(assets/img/illustrations/services-bg.png);background-position:center left;background-size:auto;">
        </div>
        <!--/.bg-holder-->

        <div class="bg-holder" style="background-image:url(assets/img/illustrations/dot-2.png);background-position:center right;background-size:auto;margin-left:-180px;margin-top:20px;">
        </div>
        <!--/.bg-holder-->

        <div class="container-lg">
  <div class="row justify-content-center">
    <div class="col-3 text-center">
      <h2 class="fw-bold">Our Programs</h2>
      <hr class="w-25 mx-auto text-dark" style="height:2px;" />
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-sm-9 col-xl-8 text-center">
      <p class="text-muted">
        Our mission is to simplify the university admission process, providing students with seamless access to a wide range of private universities across Bangladesh. We aim to empower prospective students by offering an intuitive platform where they can explore, apply, and secure their place in the right academic institution, all in one convenient location.
      </p>
    </div>
  </div>
  <div class="row justify-content-center mt-4">
    <div class="col-6 col-md-4 col-lg-3 text-center">
      <div class="course-card">
        <h5 class="fw-bold">Computer Science & Engineering</h5>
        <p>Explore the world of computing and technology with a degree in Computer Science & Engineering. Prepare for a career in software development, network engineering, and AI.</p>
      </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3 text-center">
      <div class="course-card">
        <h5 class="fw-bold">Business Administration</h5>
        <p>Gain expertise in business management, marketing, and leadership through a comprehensive Business Administration program designed to prepare you for top executive roles.</p>
      </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3 text-center">
      <div class="course-card">
        <h5 class="fw-bold">Electrical & Electronics Engineering</h5>
        <p>Dive into the world of electronics and electrical systems, focusing on everything from power generation to embedded systems and communication technology.</p>
      </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3 text-center">
      <div class="course-card">
        <h5 class="fw-bold">Architecture</h5>
        <p>Transform your passion for design into a career with a degree in Architecture, learning to create functional, sustainable, and aesthetic spaces.</p>
      </div>
    </div>
  </div>
</div>

<!-- Inline CSS for dynamic styles -->
<style>
  .course-card {
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .course-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
  }

  .fw-bold {
    color: #0056b3;
  }

  .text-muted {
    color: #6c757d !important;
  }
</style>


 <!-- <div class="row justify-content-center h-100 pt-7 g-4">
            <div class="col-sm-9 col-md-4">
              <div class="card h-100 w-100 shadow rounded-lg p-3 p-md-2 p-lg-3 p-xl-5">
                <div class="card-body text-center text-md-start">
                  <div class="py-3"><img class="img-fluid" src="assets/img/illustrations/search.png" height="90" alt="" /></div>
                  <div class="py-3">
                    <h4 class="fw-bold card-title">7000+ Students</h4>
                    <p class="card-text">Chose your preferable university for higher education</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-9 col-md-4">
              <div class="card h-100 w-100 shadow rounded-lg p-3 p-md-2 p-lg-3 p-xl-5">
                <div class="card-body text-center text-md-start">
                  <div class="py-3"><img class="img-fluid" src="assets/img/illustrations/online-pharmacy.png" height="90" alt="" /></div>
                  <div class="py-3">
                    <h4 class="fw-bold card-title">300+ Faculty</h4>
                    <p class="card-text">Best Faculties </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-9 col-md-4">
              <div class="card h-100 w-100 shadow rounded-lg p-3 p-md-2 p-lg-3 p-xl-5">
                <div class="card-body text-center text-md-start">
                  <div class="py-3"><img class="img-fluid" src="assets/img/illustrations/consultation.png" height="90" alt="" /></div>
                  <div class="py-3">
                    <h4 class="fw-bold card-title">8000+ Graduates</h4>
                    <p class="card-text"> Get the best recomendations</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-9 col-md-4">
              <div class="card h-100 w-100 shadow rounded-lg p-3 p-md-2 p-lg-3 p-xl-5">
                <div class="card-body text-center text-md-start">
                  <div class="py-3"><img class="img-fluid" src="assets/img/illustrations/details-info.png" height="90" alt="" /></div>
                  <div class="py-3">
                    <h4 class="fw-bold card-title">Details info</h4>
                    <p class="card-text">We provide guidence </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-9 col-md-4">
              <div class="card h-100 w-100 shadow rounded-lg p-3 p-md-2 p-lg-3 p-xl-5">
                <div class="card-body text-center text-md-start">
                  <div class="py-3"><img class="img-fluid" src="assets/img/illustrations/emergency-care.png" height="90" alt="" /></div>
                  <div class="py-3">
                    <h4 class="fw-bold card-title">600+ Research Papers</h4>
                    <p class="card-text">All over the Private universities </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-9 col-md-4">
              <div class="card h-100 w-100 shadow rounded-lg p-3 p-md-2 p-lg-3 p-xl-5">
                <div class="card-body text-center text-md-start">
                  <div class="py-3"><img class="img-fluid" src="assets/img/illustrations/tracking.png" height="90" alt="" /></div>
                  <div class="py-3">
                    <h4 class="fw-bold card-title">Tracking</h4>
                    <p class="card-text">Locations</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center py-4">
              <button class="btn btn-lg btn-outline-primary rounded-pill" type="submit">Learn more </button>
            </div>
          </div>
        </div> -->
      </section>


      <section class="py-8" id="testimonial">
        <div class="container">
          <div class="bg-holder z-index-1" style="background-image:url(assets/img/illustrations/dot.png);background-position:right top;background-size:auto;margin-left:-30px;margin-top:10px;filter:contrast(1.5);">
          </div>
          <!--/.bg-holder-->

          <div class="bg-holder z-index-1" style="background-image:url(assets/img/illustrations/dot-2.png);background-position:left bottom;background-size:auto;margin-left:-35px;margin-top:-65px;filter:contrast(1.5);">
          </div>
          <!--/.bg-holder-->

          <div class="carousel slide" id="carouselExampleDark" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="10000">
                <div class="row h-100">
                  <div class="col-12">
                    <div class="card text-white bg-primary-gradient">
                      <div class="card-body p-4 p-md-4 p-lg-7">
                        <h2 class="fw-bold text-white text-center">VC Messages</h2>
                        <hr class="mx-auto" style="height:2px;width:50px" />
                        <div class="d-md-flex align-items-md-center mt-5 text-center text-md-start"><img class="img-fluid me-4 me-md-3 me-lg-4" src="assets/img/gallery/user-1.png" width="100" alt="" />
                          <div class="w-md-25 my-3">
                            <h5 class="mb-0 fw-medium text-white">Edward Newgate</h5>
                            <p class="fw-normal mb-0">VC Brac University</p>
                          </div>
                          <div class="w-md-75">
                            <p class="card-text ms-md-5">“At BRAC University, we are committed to fostering innovation and excellence in education. Through a blend of academic rigor and practical exposure, we prepare our students to meet the challenges of a rapidly changing world. Join us in shaping the leaders of tomorrow.”</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <div class="row h-100">
                  <div class="col-12">
                    <div class="card text-white bg-primary-gradient">
                      <div class="card-body p-4 p-md-4 p-lg-7">
                        <h2 class="fw-bold text-white text-center">Message from
the Pro Vice Chancellor</h2>
                        <hr class="mx-auto" style="height:2px;width:50px" />
                        <div class="d-md-flex align-items-md-center mt-5 text-center text-md-start"><img class="img-fluid me-4 me-md-3 me-lg-4" src="assets/img/gallery/user-2.png" width="100" alt="" />
                          <div class="w-md-25 my-3">
                            <h5 class="mb-0 fw-medium text-white">Jhon Doe</h5>
                            <p class="fw-normal mb-0">North South University</p>
                          </div>
                          <div class="w-md-75">
                            <p class="card-text ms-md-5">“North South University stands at the forefront of providing world-class education. With cutting-edge programs, a global faculty, and a focus on research, we ensure our students are equipped with the knowledge and skills to succeed in an interconnected world.”</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="row h-100">
                  <div class="col-12">
                    <div class="card text-white bg-primary-gradient">
                      <div class="card-body p-4 p-md-4 p-lg-7">
                        <h2 class="fw-bold text-white text-center">Message from
the Vice Chancellor</h2>
                        <hr class="mx-auto" style="height:2px;width:50px" />
                        <div class="d-md-flex align-items-md-center mt-5 text-center text-md-start"><img class="img-fluid me-4 me-md-3 me-lg-4" src="assets/img/gallery/user-3.png" width="100" alt="" />
                          <div class="w-md-25 my-3">
                            <h5 class="mb-0 fw-medium text-white">Jeny Doe</h5>
                            <p class="fw-normal mb-0">Bangladesh University of Professionals</p>
                          </div>
                          <div class="w-md-75">
                            <p class="card-text ms-md-5">“At BUP, we emphasize holistic development, blending academic excellence with leadership and discipline. We aim to equip our students with the tools to excel in both military and civilian careers, making a meaningful impact in our society.”</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-4 flex-center">
              <div class="col-4 col-sm-5 text-end position-relative z-index-2"><a class="carousel-control-prev carousel-icon z-index-2" href="#carouselExampleDark" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></a></div>
              <div class="col-auto position-relative z-index-2">
                <ol class="carousel-indicators">
                  <li class="active" data-bs-target="#carouselExampleDark" data-bs-slide-to="0"></li>
                  <li data-bs-target="#carouselExampleDark" data-bs-slide-to="1"></li>
                  <li data-bs-target="#carouselExampleDark" data-bs-slide-to="2"></li>
                </ol>
              </div>
              <div class="col-4 col-sm-5 position-relative z-index-2"><a class="carousel-control-next carousel-icon z-index-2" href="#carouselExampleDark" role="button" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></a></div>
            </div>
          </div>
        </div>
      </section>

      <section>
  <style>
    /* CSS for images inside cards */
    .card-img-top {
      width: 100%;   /* Ensure the image spans the full width of the card */
      height: auto;  /* Maintain the aspect ratio */
      object-fit: cover; /* Ensures the image covers the area while maintaining aspect ratio */
    }
  </style>

  <div class="bg-holder" style="background-image:url(assets/img/illustrations/article-bg.png);background-position:right center;background-size:auto;">
  </div>
  <!--/.bg-holder-->

  <div class="container-lg">
    <div class="bg-holder" style="background-image:url(assets/img/illustrations/dot-2.png);background-position:left top;background-size:initial;margin-top:120px;margin-left:-35px;">
    </div>
    <!--/.bg-holder-->

    <div class="row flex-center">
      <div class="col-auto text-center">
        <h2 class="fw-bold">Research & Publication</h2>
        <hr class="mx-auto text-dark" style="height:2px;width:50px" />
      </div>
    </div>
    
    <!-- Cards Section -->
    <div class="row justify-content-center pt-6">
      <!-- First Card -->
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
        <div class="card h-100 rounded-3 shadow">
          <a href="https://files.eric.ed.gov/fulltext/EJ1026722.pdf" target="_blank" class="stretched-link"></a>
          <img class="card-img-top" src="assets/img/gallery/article-one.png" alt="" />
          <div class="card-body p-4 text-center text-md-start">
            <h5 class="fw-bold">The Future of University Admissions: A Technological Revolution</h5>
            <p class="card-text">This paper explores how emerging technologies, such as artificial intelligence and machine learning, are transforming university admissions.</p>
            <button class="btn btn-link p-0 text-decoration-none">
              Read more
              <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Second Card -->
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
        <div class="card h-100 rounded-3 shadow">
          <a href="https://www.urbeuniversity.edu/future-university-research" target="_blank" class="stretched-link"></a>
          <img class="card-img-top" src="assets/img/gallery/article-two.png" alt="" />
          <div class="card-body p-4 text-center text-md-start">
            <h5 class="fw-bold">Personalized Education through Data Analytics in University Admissions</h5>
            <p class="card-text">This research focuses on how data analytics is being utilized to personalize university admissions processes.</p>
            <button class="btn btn-link p-0 text-decoration-none">
              Read more
              <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Third Card -->
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
        <div class="card h-100 rounded-3 shadow">
          <a href="https://www.urbeuniversity.edu/ai-in-higher-education" target="_blank" class="stretched-link"></a>
          <img class="card-img-top" src="assets/img/gallery/article-three.png" alt="" />
          <div class="card-body p-4 text-center text-md-start">
            <h5 class="fw-bold">AI in Higher Education: Enhancing the Admission and Enrollment Experience</h5>
            <p class="card-text">The paper investigates the application of artificial intelligence in streamlining university admissions and enrollment processes.</p>
            <button class="btn btn-link p-0 text-decoration-none">
              Read more
              <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Button Section -->
      <div class="text-center pt-4 z-index-2">
        <button class="btn btn-lg btn-outline-primary rounded-pill z-index-2 hover-top" type="button">View all</button>
      </div>
    </div>
  </div>
</section>






    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->


<?php

require(ROUTES_PATH . '/footer.php');

// Reset form and flash
clear_old();
clear_flash();
