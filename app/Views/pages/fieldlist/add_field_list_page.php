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
                            <h4 class="mb-sm-0">Add Lapangan</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Lapangan</a></li>
                                    <li class="breadcrumb-item active">Add Lapangan</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form>
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Lapangan</label>
                                            <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="tipe_lantai" class="form-label">Tipe Lantai</label>
                                            <select class="form-select" name="tipe_lantai" id="tipe_lantai" required>
                                                <option value="Vinyl">Vinyl</option>
                                                <option value="Karpet">Karpet</option>
                                                <option value="Kayu">Kayu</option>
                                                <option value="Semen">Semen</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="harga_per_jam" class="form-label">Harga Per Jam</label>
                                            <input type="text" class="form-control harga-per-jam" name="harga_per_jam" id="harga_per_jam" autocomplete="off" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="fasilitas" class="form-label">Fasilitas</label>
                                            <textarea class="form-control" name="fasilitas" id="fasilitas" rows="3"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="status_lapangan" class="form-label">Status</label>
                                            <select class="form-select" name="status_lapangan" id="status_lapangan">
                                                <option value="Tersedia">Tersedia</option>
                                                <option value="Tidak Tersedia">Tidak Tersedia</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary" type="button" name="submit_add_data">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
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
        $(".harga-per-jam").on("input", function() {
            // Menghapus karakter selain angka
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $(".harga-per-jam").on("input", function() {
            this.value = this.value.replace(/[^0-9.]/g, ''); // Hanya angka & titik
            this.value = this.value.replace(/(\..*)\./g, '$1'); // Mencegah lebih dari satu titik
        });

        $("button[name='submit_add_data']").click(function(e) {
            e.preventDefault();

            // Ambil nilai dari input form
            let nama = $('input[name="nama"]').val();
            let tipe_lantai = $('select[name="tipe_lantai"]').val();
            let harga_per_jam = $('input[name="harga_per_jam"]').val();
            let fasilitas = $('textarea[name="fasilitas"]').val();
            let status_lapangan = $('select[name="status_lapangan"]').val();

            let formData = new FormData();
            formData.append("nama", nama);
            formData.append("tipe_lantai", tipe_lantai);
            formData.append("harga_per_jam", harga_per_jam);
            formData.append("fasilitas", fasilitas);
            formData.append("status_lapangan", status_lapangan);

            // Validasi input tidak boleh kosong
            if (nama.trim() === "") {
                Swal.fire({
                    title: "Inputan Kosong!",
                    text: "Kolom Nama Lapangan tidak boleh kosong!",
                    icon: "warning",
                    confirmButtonColor: "#5664d2",
                });
            } else if (tipe_lantai === null || tipe_lantai === "") {
                Swal.fire({
                    title: "Inputan Kosong!",
                    text: "Kolom Tipe Lantai harus dipilih!",
                    icon: "warning",
                    confirmButtonColor: "#5664d2",
                });
            } else if (harga_per_jam.trim() === "" || isNaN(harga_per_jam)) {
                Swal.fire({
                    title: "Inputan Kosong!",
                    text: "Kolom Harga Per Jam harus diisi dengan angka!",
                    icon: "warning",
                    confirmButtonColor: "#5664d2",
                });
            } else {
                // Konfirmasi submit menggunakan SweetAlert2
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
                            url: "<?= base_url('field-list/save'); ?>",
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
                            error: function(xhr) {
                                Swal.fire("Error!", "Terjadi kesalahan saat menyimpan data.", "error");
                            }
                        });
                    }
                });
            }
        });
    });
</script>

<?= $this->include('layouts/global/footer') ?>