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
                            <h4 class="mb-sm-0">Form Booking Lapangan</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Utility</a></li>
                                    <li class="breadcrumb-item active">Form Booking</li>
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
                                <h4 class="card-title">Booking Lapangan</h4>
                                <form action="<?= base_url('field-booking/save') ?>" method="post">
                                    <input type="text" class="form-control" name="lapangan_id" value="<?= $get_lapangan['lapangan_id'] ?>" hidden>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lapangan</label>
                                        <input type="text" class="form-control" name="nama_lapangan" value="<?= $get_lapangan['nama'] ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Customer</label>
                                        <input type="text" class="form-control" name="nama_customer" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Telefon Customer</label>
                                        <input type="text" class="form-control" name="nomor_telefon_customer" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email Customer</label>
                                        <input type="email" class="form-control" name="email_customer">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Booking</label>
                                        <input type="date" class="form-control" name="booking_date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Waktu Mulai</label>
                                        <input type="time" class="form-control" name="start_time" id="start_time" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Waktu Selesai</label>
                                        <input type="time" class="form-control" name="end_time" id="end_time" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Harga Per Jam</label>
                                        <input type="number" class="form-control" name="harga_per_jam" id="harga_per_jam" value="<?= $get_lapangan['harga_per_jam'] ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Total Harga</label>
                                        <input type="number" class="form-control" name="total_price" id="total_price" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Metode Pembayaran</label>
                                        <select class="form-control" name="payment_method" id="payment_method" required>
                                            <option value="Tunai">Tunai</option>
                                            <option value="Transfer">Transfer</option>
                                        </select>
                                    </div>
                                    <div class="mb-3" id="bukti_pembayaran_wrapper" style="display: none;">
                                        <label class="form-label">Bukti Pembayaran</label>
                                        <input type="file" class="form-control" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/*">
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" name="submit_add_data" class="btn btn-primary">Submit Booking</button>
                                    </div>
                                </form>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Show/Hide Bukti Pembayaran based on Payment Method
        $('#payment_method').on('change', function() {
            if ($(this).val() === 'Transfer') {
                $('#bukti_pembayaran_wrapper').show();
            } else {
                $('#bukti_pembayaran_wrapper').hide();
                $('#bukti_pembayaran').val(''); // Clear file input if switched to Tunai
            }
        });

        // Function to Calculate Total Price
        function calculateTotalPrice() {
            let startTime = $('#start_time').val();
            let endTime = $('#end_time').val();
            let hargaPerJam = parseFloat($('#harga_per_jam').val()) || 0;

            if (startTime && endTime && hargaPerJam) {
                let start = new Date("1970-01-01T" + startTime + "Z");
                let end = new Date("1970-01-01T" + endTime + "Z");
                let hours = (end - start) / (1000 * 60 * 60);
                let totalPrice = Math.max(hours * hargaPerJam, 0);
                $('#total_price').val(totalPrice.toFixed(2));
            }
        }

        $('#start_time, #end_time, #harga_per_jam').on('input change', calculateTotalPrice);

        // Submit Form
        $("button[name='submit_add_data']").click(function(e) {
            e.preventDefault();

            // Ambil nilai form
            let lapangan_id = $('input[name="lapangan_id"]').val();
            let nama_customer = $('input[name="nama_customer"]').val();
            let nomor_telefon_customer = $('input[name="nomor_telefon_customer"]').val();
            let email_customer = $('input[name="email_customer"]').val();
            let booking_date = $('input[name="booking_date"]').val();
            let start_time = $('input[name="start_time"]').val();
            let end_time = $('input[name="end_time"]').val();
            let harga_per_jam = $('input[name="harga_per_jam"]').val();
            let total_price = $('input[name="total_price"]').val();
            let payment_method = $('#payment_method').val();
            let bukti_pembayaran = $('#bukti_pembayaran')[0].files[0];

            console.log(bukti_pembayaran);

            // Validasi form
            if (!nama_customer) return Swal.fire("Inputan Kosong!", "Kolom Nama Customer tidak boleh kosong!", "warning");
            if (!nomor_telefon_customer) return Swal.fire("Inputan Kosong!", "Kolom Nomor Telefon Customer tidak boleh kosong!", "warning");
            if (!email_customer) return Swal.fire("Inputan Kosong!", "Kolom Email Customer tidak boleh kosong!", "warning");
            if (!booking_date) return Swal.fire("Inputan Kosong!", "Kolom Booking Date tidak boleh kosong!", "warning");
            if (!start_time) return Swal.fire("Inputan Kosong!", "Kolom Start Time tidak boleh kosong!", "warning");
            if (!end_time) return Swal.fire("Inputan Kosong!", "Kolom End Time tidak boleh kosong!", "warning");
            if (!harga_per_jam) return Swal.fire("Inputan Kosong!", "Kolom Harga Per Jam tidak boleh kosong!", "warning");
            if (!total_price) return Swal.fire("Inputan Kosong!", "Kolom Total Harga tidak boleh kosong!", "warning");

            // Validasi Bukti Pembayaran jika Transfer
            if (payment_method === 'Transfer' && !bukti_pembayaran) {
                return Swal.fire("Bukti Pembayaran Wajib!", "Silakan unggah bukti pembayaran untuk metode Transfer.", "warning");
            }

            // FormData untuk submit data dan file
            let formData = new FormData();
            formData.append("lapangan_id", lapangan_id);
            formData.append("nama_customer", nama_customer);
            formData.append("nomor_telefon_customer", nomor_telefon_customer);
            formData.append("email_customer", email_customer);
            formData.append("booking_date", booking_date);
            formData.append("start_time", start_time);
            formData.append("end_time", end_time);
            formData.append("harga_per_jam", harga_per_jam);
            formData.append("total_price", total_price);
            formData.append("payment_method", payment_method);
            if (bukti_pembayaran) {
                formData.append("bukti_pembayaran", bukti_pembayaran);
            }

            // Konfirmasi sebelum submit
            Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Data akan disimpan!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#19A87E",
                cancelButtonColor: "#ff3d60",
                confirmButtonText: "Ya, Simpan!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('field-booking/save'); ?>",
                        method: "POST",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            Swal.fire({
                                title: "Menyimpan...",
                                text: "Mohon tunggu sebentar",
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        },
                        success: function(response) {
                            let obj = response;

                            if (obj.status === "OK") {
                                Swal.fire("Sukses!", obj.message, "success").then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire("Oops!", obj.message, "error");
                            }
                        },
                        error: function() {
                            Swal.fire("Error!", "Terjadi kesalahan saat menyimpan data.", "error");
                        }
                    });
                }
            });
        });
    });
</script>