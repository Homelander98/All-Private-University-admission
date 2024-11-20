<?php

if (!is_logged()) {
    flash('warning', 'Please login first to access this page.');
    redirect('login');
}


$page_title = 'Apply';

require(ROUTES_PATH . '/header.php');
?>


<div class="container form-container my-4">
    <h3 class="form-title mb-4">Application Form</h3>


    <?= render_flashes(); ?>


    <form action="<?= e_attr(uri('apply/action')); ?>" method="POST" enctype="multipart/form-data">

    <?= render_csrf_input(); ?>


        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Name <span class="text-danger">*</span> </label>
            <input type="text" id="name" name="name" class="form-control" value="<?= e_attr(old('name')); ?>" required>
        </div>

        <!-- Father's Name -->
        <div class="mb-3">
            <label for="fathers_name" class="form-label">Father's Name <span class="text-danger">*</span> </label>
            <input type="text" id="fathers_name" name="fathers_name" class="form-control" value="<?= e_attr(old('fathers_name')); ?>"  required>
        </div>

        <!-- Mother's Name -->
        <div class="mb-3">
            <label for="mothers_name" class="form-label">Mother's Name <span class="text-danger">*</span> </label>
            <input type="text" id="mothers_name" name="mothers_name" class="form-control" value="<?= e_attr(old('mothers_name')); ?>" required>
        </div>

        <!-- Nationality -->
        <div class="mb-3">
            <label for="nationality" class="form-label">Nationality <span class="text-danger">*</span> </label>
            <input type="text" id="nationality" name="nationality" value="<?= e_attr(old('nationality')); ?>" class="form-control" required>
        </div>

        <!-- Phone -->
        <div class="mb-3">
            <label for="phone" class="form-label">Phone <span class="text-danger">*</span> </label>
            <input type="tel" id="phone" name="phone" value="<?= e_attr(old('phone')); ?>" class="form-control" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span> </label>
            <input type="email" id="email" value="<?= e_attr(old('email')); ?>" name="email" class="form-control" required>
        </div>

        <!-- Present Address -->
        <div class="mb-3">
            <label for="present_address" class="form-label">Present Address <span class="text-danger">*</span> </label>
            <textarea id="present_address" name="present_address" class="form-control" rows="2" required><?= e_attr(old('present_address')); ?></textarea>
        </div>

        <!-- Permanent Address -->
        <div class="mb-3">
            <label for="permanent_address" class="form-label">Permanent Address <span class="text-danger">*</span> </label>
            <textarea id="permanent_address" name="permanent_address" class="form-control" rows="2" required><?= e_attr(old('permanent_address')); ?></textarea>
        </div>

        <!-- ID Card -->
        <div class="mb-3">
            <label for="id_card" class="form-label">ID Card <span class="text-danger">*</span> </label>
            <input type="file" id="id_card" name="id_card" class="form-control" accept=".pdf, .jpg, .jpeg, .png" required>
        </div>

        <!-- Birth Certificate -->
        <div class="mb-3">
            <label for="birth_certificate" class="form-label">Birth Certificate <span class="text-danger">*</span> </label>
            <input type="file" id="birth_certificate" name="birth_certificate" class="form-control" accept=".jpg, .jpeg, .png" required>
        </div>

        <!-- SSC Marksheet -->
        <div class="mb-3">
            <label for="ssc_marksheet" class="form-label">SSC Marksheet <span class="text-danger">*</span> </label>
            <input type="file" id="ssc_marksheet" name="ssc_marksheet" class="form-control" accept=".jpg, .jpeg, .png" required>
        </div>

        <!-- HSC Marksheet -->
        <div class="mb-3">
            <label for="hsc_marksheet" class="form-label">HSC Marksheet <span class="text-danger">*</span> </label>
            <input type="file" id="hsc_marksheet" name="hsc_marksheet" class="form-control" accept=".jpg, .jpeg, .png" required>
        </div>

        <!-- University Selection -->
        <div class="mb-3">
            <label for="university" class="form-label">Select University <span class="text-danger">*</span> </label>
            <select id="university" name="university" class="form-select" required>
                <option value="" <?= old('university') === '' ? 'selected' : '' ?> disabled>Select University</option>

                <?php foreach (get_universities() as $key => $university) : ?>
                    <option <?= old($key) === $key ? 'selected' : ''; ?>  value="<?= e_attr($key); ?>"><?= e($university); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Department Selection -->
        <div class="mb-3">
            <label for="department" class="form-label">Select Department <span class="text-danger">*</span> </label>
            <select id="department" name="department" class="form-select" required>
                <option value="" <?= old('department') === '' ? 'selected' : '' ?> disabled>Select Department</option>

                <?php foreach (get_departments() as $key => $department) : ?>
                    <option <?= old($key) === $key ? 'selected' : ''; ?>  value="<?= e_attr($key); ?>"><?= e($department); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit Application</button>
        </div>
    </form>
</div>

<?php


// Reset form and flash
clear_old();
clear_flash();

require(ROUTES_PATH . '/footer.php');
?>
