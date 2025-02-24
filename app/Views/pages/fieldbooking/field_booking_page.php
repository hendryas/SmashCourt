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
                            <h4 class="mb-sm-0">Booking Lapangan</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Utility</a></li>
                                    <li class="breadcrumb-item active">Starter page</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <?php if (!empty($get_lapangan)) : ?>
                        <?php foreach ($get_lapangan as $lapangan) : ?>
                            <div class="col-md-4">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="card-title mb-0">Lapangan ID: <?= $lapangan['lapangan_id'] ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text"><strong>Lapangan:</strong> <?= $lapangan['nama'] ?></p>
                                        <p class="card-text"><strong>Tipe Lantai:</strong> <?= $lapangan['tipe_lantai'] ?></p>
                                        <p class="card-text"><strong>Harga Per Jam:</strong> Rp <?= number_format($lapangan['harga_per_jam'], 0) ?></p>
                                        <p class="card-text"><strong>Fasilitas:</strong> <?= $lapangan['fasilitas'] ?></p>
                                        <p class="card-text"><strong>Status:</strong>
                                            <?php if ($lapangan['booking_status'] == 'Booked') : ?>
                                                <span class="badge bg-danger">
                                                    Booked
                                                </span>
                                            <?php else : ?>
                                                <span class="badge <?= $lapangan['status'] == 'Tersedia' ? 'bg-success' : 'bg-warning' ?>">
                                                    <?= $lapangan['status'] ?>
                                                </span>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <div class="card-footer text-end">
                                        <?php if ($lapangan['status'] == 'Tersedia') : ?>
                                            <?php if ($lapangan['booking_status'] == 'Booked') : ?>
                                                <button class="btn btn-sm btn-secondary" disabled>Tidak Tersedia</button>
                                            <?php else : ?>
                                                <a href="<?= base_url('field-booking/form-booking/' . $lapangan['lapangan_id']) ?>" class="btn btn-sm btn-info">Pesan</a>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <button class="btn btn-sm btn-secondary" disabled>Tidak Tersedia</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="col-12">
                            <div class="alert alert-warning text-center" role="alert">
                                <h5>Belum ada data lapangan tersedia.</h5>
                                <p>Silakan tambahkan data lapangan terlebih dahulu.</p>
                                <a href="<?= base_url('field-list') ?>" class="btn btn-primary">Tambah Lapangan</a>
                            </div>
                        </div>
                    <?php endif; ?>
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