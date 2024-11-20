<?php

use Green\Library\Pagination;

if (!is_admin()) {
    flash('danger', 'Only admins can access this page.');
    redirect('/');
}

$page_title = 'Manage Applications';

$db = db();
$user = get_logged_user();



$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$current_page = $current_page < 1 ? 1 : $current_page;

$items_per_page = 20;

$total_items  = $db->select(['COUNT(id) as count'])->from('applications')->execute()->fetch()['count'];

$pagination  = new Pagination($total_items, $current_page, $items_per_page);

$pages = $pagination->parse();

// Get offset number
$start = $pagination->offset();



$applications = $db->select(['applications.*', 'users.name as user_name'])
->from('applications')
->leftJoin('users', 'applications.user_id', '=', 'users.id')
->orderBy('applications.id')
->limit($items_per_page, $start)
->execute()
->fetchAll();






require(ROUTES_PATH . '/header.php');
?>


<div class="container py-5">

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= e_attr(uri()); ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= e_attr(uri('/admin')); ?>">Admin Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Manage Applications</li>
  </ol>
</nav>

    <h3 class="mb-3">Manage Applications</h3>


    <?= render_flashes(); ?>



    <?php if (empty($applications)) : ?>
        No applications submitted yet.
    <?php else : ?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Applicant</th>
      <th scope="col">University & Dept.</th>
      <!--<th scope="col">Attachments</th>-->
      <th scope="col">Submitted</th>
      <th scope="col">Status</th>
      <th>
        Actions
      </th>
    </tr>
  </thead>

  <tbody>


        <?php foreach ($applications as $application) : ?>
            <tr>
                <td>

                    <?= e($application['name']); ?>
                </td>

                <td>
                    <div class="fw-medium">
                    <?= e(get_uni_name($application['university'])); ?>
                    </div>

                    <span class="d-block text-muted">

                    <?= e(get_dept_name($application['department'])); ?>
                    </span>
                </td>

                <!--
                <td>
                    <a href="<?= e_attr(upload_uri($application['id_card'])); ?>" target="_blank">
                        ID Card</a>,
                    <a href="<?= e_attr(upload_uri($application['birth_certificate'])); ?>" target="_blank">
                    Birth Certificate</a>,
                    <a href="<?= e_attr(upload_uri($application['ssc_marksheet'])); ?>" target="_blank">
                    SSC Marksheet</a>,
                    <a href="<?= e_attr(upload_uri($application['hsc_marksheet'])); ?>" target="_blank">
                    HSC Marksheet</a>
                </td>
        -->

                <td>
                    <?= date('d/m/Y h:i A', $application['created_at']); ?>
                </td>

                <td>
                    <?php if ($application['status'] === 0) : ?>
                        <span class="badge text-bg-warning bg-warning">PENDING</span>

                    <?php elseif ($application['status'] === 1) : ?>
                        <span class="badge text-bg-success bg-success">APPROVED</span>
                        <?php else: ?>
                        <span class="badge text-bg-danger bg-danger">REJECTED</span>
                    <?php endif; ?>
                </td>
                <td>

                <form action="<?= e_attr(uri('admin/applications_action')); ?>" method="POST" class="d-flex gap-2 flex-wrap">
                    <?= render_csrf_input(); ?>

                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailsModal" data-model="<?= e_attr(json_encode($application, JSON_UNESCAPED_SLASHES)); ?>" data-uri="<?= e_attr(uri("/admin/application_details?id={$application['id']}")); ?> ">Details</button>

                    <input type="hidden" name="id" value="<?= e_attr($application['id']); ?>">
                    <button name="status" value="1" type="submit" class="btn btn-sm btn-success">
                        Approve
                    </button>

                    <button name="status" value="2" type="submit" class="btn btn-sm btn-outline-danger">
                        Reject
                    </button>


                </form>

                </td>
            </tr>


        <?php endforeach; ?>

        </tbody>

</table>


    <?php endif; ?>



    <?=  $pagination->renderHtml(); ?>



</div>

<div class="modal" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-1" id="detailsModalLabel">Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


      </div>
    </div>
  </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', () => {

        const unis = <?= json_encode(get_universities()); ?>;
        const depts = <?= json_encode(get_departments()); ?>;

    const detailsModal = document.getElementById('detailsModal')

  detailsModal.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget;
    // Extract info from data-bs-* attributes
    const model = JSON.parse(button.getAttribute('data-model'));

    const upload_uri = "<?= e_attr(upload_uri()); ?>";

    let badgeHtml = '';

if (model.status === 0) {
    badgeHtml = `<span class="badge text-bg-warning bg-warning">PENDING</span>`;
} else if (model.status === 1) {
    badgeHtml = `<span class="badge text-bg-success bg-success">APPROVED</span>`;
} else {
    badgeHtml = `<span class="badge text-bg-danger bg-danger">REJECTED</span>`;
}

const formattedDate = new Date(model.created_at * 1000)
    .toLocaleString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', hour12: true })
    .replace(',', '');

    const modalBody = detailsModal.querySelector('.modal-body');
    modalBody.innerHTML = `

    <div class="row mb-2">
    <div class="col-5"><strong>Name</strong></div>

    <div class="col-7">${e(model.name)}</div>
    </div>



    <div class="row mb-2">
    <div class="col-5"><strong>Father's Name</strong></div>

    <div class="col-7">${e(model.fathers_name)}</div>
    </div>


    <div class="row mb-2">
    <div class="col-5"><strong>Mother's Name</strong></div>

    <div class="col-7">${e(model.mothers_name)}</div>
    </div>



    <div class="row mb-2">
    <div class="col-5"><strong>Nationality</strong></div>

    <div class="col-7">${e(model.nationality)}</div>
    </div>


    <div class="row mb-2">
    <div class="col-5"><strong>Phone</strong></div>

    <div class="col-7">${e(model.phone)}</div>
    </div>

    <div class="row mb-2">
    <div class="col-5"><strong>Email</strong></div>

    <div class="col-7">${e(model.email)}</div>
    </div>

    <div class="row mb-2">
    <div class="col-5"><strong>Present Address</strong></div>

    <div class="col-7">${e(model.present_address)}</div>
    </div>

    <div class="row mb-2">
    <div class="col-5"><strong>Permanent Address</strong></div>

    <div class="col-7">${e(model.permanent_address)}</div>
    </div>

    <div class="row mb-2">
    <div class="col-5"><strong>University</strong></div>

    <div class="col-7">${e(unis[model.university])}</div>
    </div>

    <div class="row mb-2">
    <div class="col-5"><strong>Department</strong></div>

    <div class="col-7">${e(depts[model.department])}</div>
    </div>


    <div class="row mb-2">
    <div class="col-5"><strong>Status</strong></div>

    <div class="col-7">${badgeHtml}</div>
    </div>



    <div class="row mb-2">
    <div class="col-5"><strong>Attachments</strong></div>

    <div class="col-7">
    <a href="${e(`${upload_uri}${model.id_card}`)}" target="_blank">ID Card</a>,
    <a href="${e(`${upload_uri}${model.birth_certificate}`)}" target="_blank">Birth Certificate</a>,
    <a href="${e(`${upload_uri}${model.ssc_marksheet}`)}" target="_blank">SSC Marksheet</a>,
    <a href="${e(`${upload_uri}${model.hsc_marksheet}`)}" target="_blank">HSC Marksheet</a>

    </div>


    </div>


    <div class="row mb-2">
    <div class="col-5"><strong>Submitted at</strong></div>

    <div class="col-7">${formattedDate}</div>
    </div>


    `;

  });

    });


</script>

<?php
require(ROUTES_PATH . '/footer.php');

// Reset form and flash
clear_old();
clear_flash();
?>

