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
                            <h4 class="mb-sm-0">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <!-- Total Booking -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="text-white">Total Booking</h5>
                                        <h3><?= $total_bookings ?></h3>
                                    </div>
                                    <div>
                                        <i class="mdi mdi-calendar-check mdi-48px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Hari Ini -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="text-white">Booking Hari Ini</h5>
                                        <h3><?= $today_bookings ?></h3>
                                    </div>
                                    <div>
                                        <i class="mdi mdi-calendar-today mdi-48px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Lapangan -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="text-white">Total Lapangan</h5>
                                        <h3><?= $total_fields ?></h3>
                                    </div>
                                    <div>
                                        <i class="mdi mdi-soccer-field mdi-48px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Bookings Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Booking Terbaru</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID Booking</th>
                                                <th>Nama Customer</th>
                                                <th>Lapangan</th>
                                                <th>Tanggal</th>
                                                <th>Jam</th>
                                                <th>Status Pembayaran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($recent_bookings as $booking) : ?>
                                                <tr>
                                                    <td><?= $booking['booking_id'] ?></td>
                                                    <td><?= $booking['nama_customer'] ?></td>
                                                    <td><?= $booking['field_name'] ?></td>
                                                    <td><?= $booking['booking_date'] ?></td>
                                                    <td><?= $booking['start_time'] ?> - <?= $booking['end_time'] ?></td>
                                                    <td>

                                                        <?= $booking['payment_status'] ?>

                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
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