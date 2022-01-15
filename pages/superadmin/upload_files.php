<?php
require_once 'head.php';
require_once '../../config/koneksi.php';
?>


<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Berkas Pengumuman SPEKTA</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Berkas</li>
            <li class="breadcrumb-item active" aria-current="page">Berkas Pengumuman</li>
        </ol>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Unggah Berkas Pengumuman SPEKTA</h6>
            </div>
            <form action="<?php echo $url_config . 'file.php' ?>" method="post" enctype="multipart/form-data"
                class="form-sample needs-validation " novalidate onSubmit="return validasi(this);">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nofile" class="form-label">Nomor Berkas</label>
                        <p style="color: red">dapat dikosongi jika tidak terdapat nomor berkas</p>
                        <input type="text" class="form-control" id="nofile" name="nofile">
                    </div>
                    <div class="mb-3">
                        <label for="namefile" class="form-label">Nama Berkas *</label>
                        <input type="text" class="form-control" id="namefile" name="namefile" required>
                    </div>
                    <div class="mb-3">
                        <label for="datefile" class="form-label">Tanggal Berkas *</label>
                        <input type="date" class="form-control" id="datefile" name="datefile" required>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Unggah Berkas *</label>
                        <p style="color: red">berkas yang diunggah harus berekstensi PDF, DOCX,
                            DOC, XLSX, XLS</p>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>
                    <p style="color: red">* = wajib diisi
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="addfile" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    require_once 'foot.php';
    ?>