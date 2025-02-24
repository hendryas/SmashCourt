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
                            <h4 class="mb-sm-0">Edit Lapangan</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Lapangan</a></li>
                                    <li class="breadcrumb-item active">Edit Lapangan</li>
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
                                    <form id="editLapanganForm">
                                        <input type="hidden" name="lapangan_id" value="<?= $lapangan['lapangan_id'] ?>">

                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Lapangan</label>
                                            <input type="text" class="form-control" name="nama" id="nama" value="<?= $lapangan['nama'] ?>" autocomplete="off" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="tipe_lantai" class="form-label">Tipe Lantai</label>
                                            <select class="form-select" name="tipe_lantai" id="tipe_lantai" required>
                                                <option value="Vinyl" <?= ($lapangan['tipe_lantai'] == 'Vinyl') ? 'selected' : '' ?>>Vinyl</option>
                                                <option value="Karpet" <?= ($lapangan['tipe_lantai'] == 'Karpet') ? 'selected' : '' ?>>Karpet</option>
                                                <option value="Kayu" <?= ($lapangan['tipe_lantai'] == 'Kayu') ? 'selected' : '' ?>>Kayu</option>
                                                <option value="Semen" <?= ($lapangan['tipe_lantai'] == 'Semen') ? 'selected' : '' ?>>Semen</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="harga_per_jam" class="form-label">Harga Per Jam</label>
                                            <input type="text" class="form-control harga-per-jam" name="harga_per_jam" id="harga_per_jam" value="<?= $lapangan['harga_per_jam'] ?>" autocomplete="off" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="fasilitas" class="form-label">Fasilitas</label>
                                            <textarea class="form-control" name="fasilitas" id="fasilitas" rows="3"><?= $lapangan['fasilitas'] ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="status_lapangan" class="form-label">Status</label>
                                            <select class="form-select" name="status_lapangan" id="status_lapangan">
                                                <option value="Tersedia" <?= ($lapangan['status'] == 'Tersedia') ? 'selected' : '' ?>>Tersedia</option>
                                                <option value="Tidak Tersedia" <?= ($lapangan['status'] == 'Tidak Tersedia') ? 'selected' : '' ?>>Tidak Tersedia</option>
                                            </select>
                                        </div>

                                        <button type="button" class="btn btn-primary" name="submit_edit_lapangan">Update</button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".harga-per-jam").on("input", function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $("button[name='submit_edit_lapangan']").click(function(e) {
            e.preventDefault();

            let formData = new FormData($("#editLapanganForm")[0]);

            Swal.fire({
                title: "Konfirmasi",
                text: "Apakah Anda yakin ingin memperbarui data ini?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#19A87E",
                cancelButtonColor: "#ff3d60",
                confirmButtonText: "Ya, Perbarui!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Memproses...",
                        text: "Mohon tunggu sebentar",
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: "<?= base_url('field-list/update/' . $lapangan['lapangan_id']) ?>",
                        method: "POST",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            let obj = JSON.parse(response);
                            if (obj.status === "OK") {
                                Swal.fire({
                                    title: "Sukses!",
                                    text: obj.message,
                                    icon: "success"
                                }).then(() => {
                                    window.location.href = "<?= base_url('field-list') ?>";
                                });
                            } else {
                                Swal.fire("Oops!", obj.message, "error");
                            }
                        },
                        error: function(xhr) {
                            Swal.fire("Error!", "Terjadi kesalahan saat memperbarui data.", "error");
                        }
                    });
                }
            });
        });
    });
</script>

<?= $this->include('layouts/global/footer') ?>