<?= $this->include('layouts/global/header') ?>
<!-- Begin page -->
<div id="layout-wrapper">

    <?= $this->include('layouts/global/top_header') ?>

    <!-- ========== Left Sidebar Start ========== -->
    <?= $this->include('layouts/global/sidebar') ?>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Konfirmasi Kehadiran</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Utility</a></li>
                                    <li class="breadcrumb-item active">Konfirmasi Kehadiran</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Konfirmasi Kehadiran Customer</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID Booking</th>
                                            <th>Nama Customer</th>
                                            <th>Nama Lapangan</th>
                                            <th>Tanggal Booking</th>
                                            <th>Waktu</th>
                                            <th>Status</th>
                                            <th>Status Kehadiran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($bookings)) : ?>
                                            <?php foreach ($bookings as $row) : ?>
                                                <tr>
                                                    <td><?= $row['booking_id'] ?></td>
                                                    <td><?= $row['nama_customer'] ?></td>
                                                    <td><?= $row['nama'] ?></td>
                                                    <td><?= $row['booking_date'] ?></td>
                                                    <td><?= $row['start_time'] ?> - <?= $row['end_time'] ?></td>
                                                    <td><?= $row['booking_status'] ?></td>
                                                    <td>
                                                        <button class="btn btn-success confirm-attendance" data-id="<?= $row['booking_id'] ?>">Konfirmasi Hadir</button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="6" class="text-center">Belum ada booking yang perlu dikonfirmasi.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Crafted with <i class="mdi mdi-heart text-danger"></i> by Smash Court
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<?= $this->include('layouts/global/footer') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".confirm-attendance").on("click", function() {
            let bookingId = $(this).data("id");

            Swal.fire({
                title: "Konfirmasi Kehadiran",
                text: "Apakah Anda yakin customer ini telah hadir?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, konfirmasi!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("<?= base_url('daily-booking-list/confirm-attendance/') ?>" + bookingId, function(response) {
                        if (response.status == "OK") {
                            Swal.fire("Berhasil!", "Kehadiran telah dikonfirmasi.", "success").then(() => location.reload());
                        } else {
                            Swal.fire("Gagal!", "Terjadi kesalahan, silakan coba lagi.", "error");
                        }
                    }, "json");
                }
            });
        });
    });
</script>