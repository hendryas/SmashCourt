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
                            <h4 class="mb-sm-0">History Booking</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Utility</a></li>
                                    <li class="breadcrumb-item active">History Booking</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Riwayat Booking</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID Booking</th>
                                            <th>Nama Customer</th>
                                            <th>Nama Lapangan</th>
                                            <th>Tanggal Booking</th>
                                            <th>Waktu</th>
                                            <th>Total Harga</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($history)) : ?>
                                            <?php foreach ($history as $row) : ?>
                                                <tr>
                                                    <td><?= $row['booking_id'] ?></td>
                                                    <td><?= $row['nama_customer'] ?></td>
                                                    <td><?= $row['nama'] ?></td>
                                                    <td><?= $row['booking_date'] ?></td>
                                                    <td><?= $row['start_time'] ?> - <?= $row['end_time'] ?></td>
                                                    <td><?= number_format($row['total_price'], 2) ?></td>
                                                    <td>
                                                        <span class="badge <?= $row['booking_status'] == 'Completed' ? 'bg-success' : ($row['booking_status'] == 'Cancelled' ? 'bg-danger' : 'bg-warning') ?>">
                                                            <?= $row['booking_status'] ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="7" class="text-center">Belum ada riwayat booking.</td>
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