<?php

$page_title = 'Browse Programs';

require(ROUTES_PATH . '/header.php');

// Define university and department data
$universities = [
    [
        'name' => 'BRAC University',
        'price_range' => [300000, 500000],
        'departments' => [
            'Computer Science & Engineering',
            'Business Administration',
            'Law',
            'Economics',
            'Architecture'
        ]
    ],
    [
        'name' => 'North South University',
        'price_range' => [350000, 450000],
        'departments' => [
            'Pharmacy',
            'Environmental Science',
            'Electrical Engineering',
            'Marketing',
            'Public Health'
        ]
    ],
    [
        'name' => 'Independent University Bangladesh',
        'price_range' => [320000, 470000],
        'departments' => [
            'Environmental Science',
            'Media & Communication',
            'Finance',
            'Civil Engineering',
            'Software Engineering'
        ]
    ],
    [
        'name' => 'American International University-Bangladesh',
        'price_range' => [250000, 400000],
        'departments' => [
            'Artificial Intelligence',
            'Accounting',
            'Mechanical Engineering',
            'Digital Marketing',
            'Statistics'
        ]
    ],
    [
        'name' => 'University of Asia Pacific',
        'price_range' => [270000, 380000],
        'departments' => [
            'Robotics',
            'Supply Chain Management',
            'Telecommunication Engineering',
            'International Relations',
            'Sociology'
        ]
    ]
];

?>

<style>
    /* General Styles */
    body {
        font-family: 'Google Sans', sans-serif;
        background-color: #f9f9f9;
    }

    .program-header {
        background-color: #0056b3;
        color: #ffffff;
        padding: 60px 20px;
        text-align: center;
    }

    .program-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .slider-container {
        margin: 30px 0;
    }

    .slider-label {
        font-size: 1.2rem;
        font-weight: bold;
        color: #0056b3;
    }

    .budget-slider {
        width: 100%;
        appearance: none;
        height: 8px;
        background: #e0e0e0;
        outline: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .budget-slider::-webkit-slider-thumb {
        appearance: none;
        width: 20px;
        height: 20px;
        background: cyan;
        border-radius: 50%;
        cursor: pointer;
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
</style>

<div class="program-header">
    <h1>Select Your Budget and Preferences</h1>
    <p>We will suggest the best university and department for you.</p>
</div>

<div class="container my-5">
    <form id="universityForm" method="POST">
        <div class="slider-container">
            <label for="budgetSlider" class="slider-label">Select your Budget</label>
            <input
                type="range"
                id="budgetSlider"
                name="budget"
                class="budget-slider"
                min="250000"
                max="500000"
                step="5000"
                value="375000"
                oninput="updateBudgetLabel(this.value)"
            />
            <p>Selected Budget: BDT <span id="budgetLabel">375000</span></p>
        </div>

        <div class="form-group">
            <label for="departmentSelect">Select a Department</label>
            <select id="departmentSelect" name="department" class="form-control">
                <option value="">-- Choose Department --</option>
                <?php
                $departments = array_unique(array_merge(...array_column($universities, 'departments')));
                foreach ($departments as $department) {
                    echo "<option value=\"$department\">$department</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="gpaInput">Enter Combined GPA (SSC + HSC)</label>
            <input type="number" id="gpaInput" name="gpa" class="form-control" step="0.01" placeholder="Enter GPA (e.g., 10.00)" />
        </div>

        <button type="button" class="btn btn-primary" onclick="suggestUniversity()">Suggest University</button>
    </form>

    <div id="suggestionBox" class="mt-4" style="display: none;">
        <h3>Suggested University</h3>
        <p id="suggestionText"></p>
        <a id="applyButton" href="#" class="btn btn-primary w-100" style="display: none;">Apply Now</a>
    </div>
</div>

<script>
    function updateBudgetLabel(value) {
        document.getElementById("budgetLabel").textContent = value;
    }

    function suggestUniversity() {
        const budget = parseInt(document.getElementById("budgetSlider").value);
        const department = document.getElementById("departmentSelect").value;
        const gpa = parseFloat(document.getElementById("gpaInput").value);
        const suggestionBox = document.getElementById("suggestionBox");
        const suggestionText = document.getElementById("suggestionText");
        const applyButton = document.getElementById("applyButton");

        if (!department || isNaN(gpa)) {
            alert("Please select a department and enter your GPA.");
            return;
        }

        let suggestedUniversity = null;
        let reducedPrice = null;

        for (const uni of <?= json_encode($universities) ?>) {
            if (
                uni.departments.includes(department) &&
                budget >= uni.price_range[0] &&
                budget <= uni.price_range[1]
            ) {
                suggestedUniversity = uni.name;
                const avgPrice = (uni.price_range[0] + uni.price_range[1]) / 2;
                reducedPrice = gpa === 10 ? avgPrice * 0.7 : avgPrice;
                break;
            }
        }

        if (suggestedUniversity) {
            suggestionText.innerHTML = `We recommend <strong>${suggestedUniversity}</strong> for the <strong>${department}</strong> department. Estimated fees: <strong>BDT ${reducedPrice.toFixed(0)}</strong>`;
            applyButton.style.display = "block";
            // Dynamically set the Apply Now button's href
            applyButton.href = "<?= e_attr(uri('/apply')) ?>?university=" + encodeURIComponent(suggestedUniversity) + "&department=" + encodeURIComponent(department) + "&fees=" + reducedPrice.toFixed(0);
        } else {
            suggestionText.innerHTML = "No university matches your criteria.";
            applyButton.style.display = "none";
        }

        suggestionBox.style.display = "block";
    }
</script>

<?php
require(ROUTES_PATH . '/footer.php');
?>
