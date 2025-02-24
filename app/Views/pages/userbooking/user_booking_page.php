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
                            <h4 class="mb-sm-0">Konfirmasi Pembayaran</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Booking</a></li>
                                    <li class="breadcrumb-item active">Konfirmasi Pembayaran</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Daftar Booking Lapangan</h4>
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
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($get_booking_field as $booking) : ?>
                                                <tr>
                                                    <td><?= $booking['booking_id'] ?></td>
                                                    <td><?= $booking['nama_customer'] ?></td>
                                                    <td><?= $booking['nama'] ?></td>
                                                    <td><?= $booking['booking_date'] ?></td>
                                                    <td><?= $booking['start_time'] ?> - <?= $booking['end_time'] ?> WIB</td>
                                                    <td>
                                                        <?= ucfirst($booking['payment_status']) ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($booking['payment_status'] == 'Pending') : ?>
                                                            <button class="btn btn-success btn-sm confirm-payment" data-id="<?= $booking['booking_id'] ?>">Konfirmasi</button>
                                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#buktiTransferModal" data-id="<?= $booking['booking_id'] ?>" data-img="<?= base_url($booking['bukti_transfer']) ?>">Cek Bukti</button>
                                                        <?php else : ?>
                                                            <button class="btn btn-secondary btn-sm" disabled>Terkonfirmasi</button>
                                                        <?php endif; ?>
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

                <!-- Modal Bukti Transfer -->
                <div class="modal fade" id="buktiTransferModal" tabindex="-1" aria-labelledby="buktiTransferModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="buktiTransferModalLabel">Bukti Transfer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img id="buktiTransferImg" src="" alt="Bukti Transfer" class="img-fluid rounded">
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

<script>
    $(document).ready(function() {
        $(".confirm-payment").on("click", function() {
            let bookingId = $(this).data("id");

            Swal.fire({
                title: "Konfirmasi Pembayaran",
                text: "Apakah Anda yakin ingin mengonfirmasi pembayaran ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, konfirmasi!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("<?= base_url('user-booking/confirm-payment/') ?>" + bookingId, function(response) {
                        if (response.status == "OK") {
                            Swal.fire("Berhasil!", "Pembayaran telah dikonfirmasi.", "success").then(() => location.reload());
                        } else {
                            Swal.fire("Gagal!", "Terjadi kesalahan, silakan coba lagi.", "error");
                        }
                    }, "json");
                }
            });
        });
    });
</script>

<script>
    const buktiTransferModal = document.getElementById('buktiTransferModal');
    buktiTransferModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const imgSrc = button.getAttribute('data-img');
        const imgElement = document.getElementById('buktiTransferImg');
        imgElement.src = imgSrc;
    });
</script>

<?= $this->include('layouts/global/footer') ?>