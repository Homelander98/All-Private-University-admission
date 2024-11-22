<?php

$page_title = 'Browse Programs';

require(ROUTES_PATH . '/header.php');
?>

<style>
    /* General Styles */
    body {
        font-family: 'Google Sans', sans-serif;
        background-color: #f9f9f9;
    }

    .program-page-header {
        background-color: #0056b3;
        color: #ffffff;
        padding: 60px 20px;
        text-align: center;
    }

    .program-page-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .program-page-header p {
        font-size: 1.2rem;
        margin-top: 10px;
        color: #e0e0e0;
    }

    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .card {
        background-color: #ffffff;
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        max-width: 360px;
        width: 100%;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0056b3;
        margin-bottom: 10px;
    }

    .rating {
        color: #f39c12;
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .program-list {
        padding-left: 20px;
        margin-bottom: 15px;
        font-size: 0.95rem;
        color: #555;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        width: 100%;
        padding: 10px;
        font-size: 1rem;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    @media (max-width: 768px) {
        .program-page-header h1 {
            font-size: 2rem;
        }

        .program-page-header p {
            font-size: 1rem;
        }
    }
</style>

<div class="program-page-header">
    <h1>Browse Programs - Top Private Universities</h1>
    <p>Explore a range of programs from top institutions and find your ideal course.</p>
</div>

<div class="container my-5">
    <div class="card-container">
        <!-- BRAC University -->
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">BRAC University</h2>
                <p><strong>Location:</strong> Dhaka, Bangladesh</p>
                <p class="rating">★ 4.8</p>
                <p><strong>Programs Offered:</strong></p>
                <ul class="program-list">
                    <li>Bachelor of Business Administration</li>
                    <li>Bachelor of Science in Computer Science</li>
                    <li>Bachelor of Laws</li>
                    <li>Master of Development Studies</li>
                </ul>
                <button class="btn btn-primary" onclick="window.location.href='https://www.bracu.ac.bd';">Browse</button>
            </div>
        </div>

        <!-- North South University -->
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">North South University</h2>
                <p><strong>Location:</strong> Dhaka, Bangladesh</p>
                <p class="rating">★ 4.7</p>
                <p><strong>Programs Offered:</strong></p>
                <ul class="program-list">
                    <li>Bachelor of Architecture</li>
                    <li>Bachelor of Pharmacy</li>
                    <li>Bachelor of Science in Environmental Science</li>
                    <li>Master of Public Health</li>
                </ul>
                <button class="btn btn-primary" onclick="window.location.href='https://www.northsouth.edu/';">Browse</button>
            </div>
        </div>

        <!-- Independent University Bangladesh -->
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Independent University Bangladesh</h2>
                <p><strong>Location:</strong> Dhaka, Bangladesh</p>
                <p class="rating">★ 4.6</p>
                <p><strong>Programs Offered:</strong></p>
                <ul class="program-list">
                    <li>Bachelor of Environmental Science and Management</li>
                    <li>Bachelor of Business Administration</li>
                    <li>Bachelor of Science in Computer Science</li>
                    <li>Master of Business Administration</li>
                </ul>
                <button class="btn btn-primary" onclick="window.location.href='https://iub.ac.bd/';">Browse</button>
            </div>
        </div>
    </div>
</div>

<?php
require(ROUTES_PATH . '/footer.php');

clear_old();
clear_flash();
?>
