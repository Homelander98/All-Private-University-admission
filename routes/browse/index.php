<?php

$page_title = 'Browse Programs';

require(ROUTES_PATH . '/header.php');
?>

<style>
    /* Custom styles for enhanced visual appeal */
    body {
        font-family: 'Google Sans', sans-serif;
    }

    .program-page-header {
        background-color: #007bff;
        color: #ffffff;
        padding: 40px 0;
    }

    .program-page-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
    }

    .card {
        border: none;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .card h2 {
        font-size: 1.5rem;
        font-weight: 700;
    }

    .card p, .card ul {
        font-size: 0.95rem;
        color: #555;
    }

    .program-list {
        padding-left: 15px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>

<div class="container-fluid program-page-header text-center ">
    <h1 class="text-white">Browse Programs - Top Private Universities in Bangladesh</h1>
    <p class="mt-2">Explore a range of programs from top institutions and find your ideal course.</p>
</div>

<div class="container-fluid my-5">
    <div class="row justify-content-center">
        <!-- BRAC University -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h2 class="card-title">BRAC University</h2>
                    <p><strong>Location:</strong> Dhaka, Bangladesh</p>
                    <p><strong>Faculties:</strong> School of Engineering, School of Business, School of Humanities</p>
                    <p><strong>Programs Offered:</strong></p>
                    <ul class="program-list">
                        <li>Bachelor of Business Administration</li>
                        <li>Bachelor of Science in Computer Science</li>
                        <li>Bachelor of Laws</li>
                        <li>Master of Development Studies</li>
                    </ul>
                    <form onsubmit="window.location.href='https://www.bracu.ac.bd'; return false;">
                    <input type="hidden" name="university" value="BRAC University">
                     <button type="submit" class="btn btn-primary btn-block">Browse</button>
                     </form>


                </div>
            </div>
        </div>

        <!-- North South University -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h2 class="card-title">North South University</h2>
                    <p><strong>Location:</strong> Dhaka, Bangladesh</p>
                    <p><strong>Faculties:</strong> School of Engineering, School of Business, School of Social Sciences</p>
                    <p><strong>Programs Offered:</strong></p>
                    <ul class="program-list">
                        <li>Bachelor of Architecture</li>
                        <li>Bachelor of Pharmacy</li>
                        <li>Bachelor of Science in Environmental Science</li>
                        <li>Master of Public Health</li>
                    </ul>
                    <form onsubmit="window.location.href='https://www.northsouth.edu/'; return false;">
                    <input type="hidden" name="university" value="BRAC University">
                     <button type="submit" class="btn btn-primary btn-block">Browse</button>
                     </form>

                </div>
            </div>
        </div>

        <!-- Independent University Bangladesh -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h2 class="card-title">Independent University Bangladesh</h2>
                    <p><strong>Location:</strong> Dhaka, Bangladesh</p>
                    <p><strong>Faculties:</strong> School of Environmental Science, School of Business, School of Engineering</p>
                    <p><strong>Programs Offered:</strong></p>
                    <ul class="program-list">
                        <li>Bachelor of Environmental Science and Management</li>
                        <li>Bachelor of Business Administration</li>
                        <li>Bachelor of Science in Computer Science</li>
                        <li>Master of Business Administration</li>
                    </ul>
                    <form onsubmit="window.location.href='https://iub.ac.bd/'; return false;">
                    <input type="hidden" name="university" value="BRAC University">
                     <button type="submit" class="btn btn-primary btn-block">Browse</button>
                     </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
require(ROUTES_PATH . '/footer.php');

clear_old();
clear_flash();
?>
