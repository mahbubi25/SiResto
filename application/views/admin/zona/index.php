<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>admin"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manajemen waktu</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Manajemen waktu</h3>
                </div>
                <div class="col-lg-12">
                    <?= $this->session->flashdata('message'); ?>
                    <?php if ($this->session->flashdata('error')) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $this->session->flashdata('error') ?>
                        </div>
                    <?php
                    } ?>
                    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahzonamodal"><i class="fa fa-plus"></i> Tambah waktu</button>
                    <div class="table-responsive">
                        <table class="table table-flush dataTable" id="datatable-id" role="grid" aria-describedby="datatable-basic_info">
                            <thead class="thead-dark">
                                <tr role="row">
                                    <th>waktu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($zona as $m) {
                                ?>
                                    <tr>
                                        <td><?= $m['waktu'] ?></td>
                                        <td>
                                            <button data-toggle="modal" data-target="#editzonamodal" onclick="edit_waktu(<?= $m['id_jam'] ?>)" class="btn btn-sm btn-warning">Edit</button>
                                            <a href="<?= base_url() ?>zona/hapus_waktu/<?= $m['id_jam'] ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus waktu <?= $m['waktu'] ?>?');" class="btn btn-sm btn-danger">Hapus</a>
                                        </td>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal_zona -->
<div class="modal fade" id="tambahzonamodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah waktu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('zona/tambah_waktu') ?>" method="POST" id="tambah_form">
                    <div class="form-group">
                        <label>waktu</label>
                        <input type="text" class="form-control" placeholder="" name="waktu" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Modal_zona -->
<div class="modal fade" id="editzonamodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Waktu <span id="nomor_zona_title"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('zona/edit_waktu') ?>" method="POST" id="edit_form">
                    <div class="form-group">
                        <input type="hidden" id="idjam_edit" name="id_jam" required>
                        <label for="edit_waktu">Waktu</label>
                        <input type="text" class="form-control" id="edit_waktu" name="waktu" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function edit_waktu(id) {
        $.ajax({
            type: 'POST',
            url: `<?= base_url() ?>zona/get_zona_by_id/${id}`,
            dataType: 'json',
            success: function(hasil) {
                $('#idjam_edit').val(hasil.id_jam);
                $('#edit_waktu').val(hasil.waktu);
                $('#nomor_zona_title').html(hasil.waktu);
                $('#editzonamodal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
</script>
