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
                            <h4 class="mb-sm-0">Starter page</h4>

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

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <a href="<?= base_url('field-list/add-data'); ?>" class="btn btn-sm btn-primary mb-3">Tambah Data</a>

                                    <h4 class="card-title">Daftar Lapangan</h4>

                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Lapangan</th>
                                                <th>Tipe Lantai</th>
                                                <th>Harga Per Jam</th>
                                                <th>Fasilitas</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php foreach ($get_lapangan as $data): ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $data['nama'] ?></td>
                                                    <td><?= $data['tipe_lantai'] ?></td>
                                                    <td><?= $data['harga_per_jam'] ?></td>
                                                    <td><?= $data['fasilitas'] ?></td>
                                                    <td><?= $data['status'] ?></td>
                                                    <td>
                                                        <a href="<?= base_url('field-list/edit-data/' . $data['lapangan_id']) ?>" class="btn btn-sm btn-success">Edit</a>
                                                        <button type="button" name="delete_data" class="btn btn-sm btn-danger" data-id="<?= $data['lapangan_id']; ?>">Hapus</button>
                                                    </td>
                                                </tr>
                                                <?php $no++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

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
    $("button[name='delete_data']").click(function(e) {
        e.preventDefault();

        let id = $(this).data('id');
        console.log(id)

        let formData = new FormData();
        formData.append("id", id);

        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Data akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#19A87E",
            cancelButtonColor: "#ff3d60",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                // Tampilkan indikator loading
                Swal.fire({
                    title: "Menghapus...",
                    text: "Mohon tunggu sebentar",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: "<?= base_url('field-list/delete'); ?>",
                    method: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        let obj = JSON.parse(response);
                        console.log(response)
                        if (obj.status === "OK") {
                            Swal.fire({
                                title: "Sukses!",
                                text: obj.message,
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire("Oops!", obj.message, "error");
                        }
                    },
                    error: function(xhr) {
                        Swal.fire("Error!", "Terjadi kesalahan saat menghapus data.", "error");
                    }
                });
            }
        });
    });
</script>

<?= $this->include('layouts/global/footer') ?>