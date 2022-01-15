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
                <h6 class="m-0 font-weight-bold text-primary">Berkas Pengumuman SPEKTA</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="tabelmember">
                    <thead class="thead-light">
                        <tr>
                            <th>Nomor</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Berkas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nomor</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Berkas</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $query2 = "SELECT * FROM tb_files";
                        $result2 = $conn->query($query2);
                        while ($row2 = $result2->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row2['no_file'] ?></td>
                            <td><?php echo strtoupper($row2['name_file']) ?></td>
                            <td><?php echo tgl_indo($row2['date_file']) ?></td>
                            <td><?php echo $row2['file_berkas'] ?></td>
                            <td> <a href="javascript:void(0);" data-toggle="modal"
                                    data-target="#modalberkas<?php echo $row2['id_files'] ?>"
                                    class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="javascript:void(0);" onclick="delfile()" class="btn btn-danger btn-sm"><i
                                        class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <script>
                        function delfile() {

                            const swalWithBootstrapButtons = Swal.mixin({
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                    cancelButton: 'btn btn-danger'
                                },
                                buttonsStyling: false
                            })

                            swalWithBootstrapButtons.fire({
                                title: 'Apa anda yakin?',
                                text: "data akan dihapus",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Hapus Berkas!',
                                cancelButtonText: 'Batalkan',
                                reverseButtons: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        "<?php echo $url_config . 'delfile.php?idfile=' . $row2['id_files'] ?>";
                                } else if (
                                    /* Read more about handling dismissals below */
                                    result.dismiss === Swal.DismissReason.cancel
                                ) {
                                    swalWithBootstrapButtons.fire(
                                        'Dibatalkan',
                                        'Penghapusan berkas dibatalkan',
                                        'success'
                                    )
                                }
                            })
                        }
                        </script>
                        <div class="modal fade" id="modalberkas<?php echo $row2['id_files'] ?>" tabindex="-1"
                            aria-labelledby="modalberkasLabel" aria-hidden="true">
                            <form action="<?php echo $url_config . 'file.php' ?>" method="POST"
                                enctype="multipart/form-data" class="form-sample needs-validation " novalidate
                                onSubmit="return validasi(this);">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data
                                                <?php echo $row2['name_file'] ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nofile" class="form-label">Nomor Berkas</label>
                                                <p style="color: red">dapat dikosongi jika tidak terdapat nomor berkas
                                                </p>
                                                <input type="hidden" name="idfile" id="idfile"
                                                    value="<?php echo $row2['id_files'] ?>">
                                                <input type="text" class="form-control" id="nofile" name="nofile"
                                                    value="<?php echo $row2['no_file'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="namefile" class="form-label">Nama Berkas *</label>
                                                <input type="text" class="form-control" id="namefile" name="namefile"
                                                    value="<?php echo strtoupper($row2['name_file']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="datefile" class="form-label">Tanggal Berkas *</label>
                                                <input type="date" class="form-control" id="datefile" name="datefile"
                                                    value="<?php echo $row2['date_file'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="namefile" class="form-label">Data Berkas</label>
                                                <p><?php echo $row2['file_berkas'] ?> </p>
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
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="editfile"
                                                class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
            <!-- Modal -->
            <div class="d-block text-center card-footer">
                <a href="javascript:void(0);" class="btn-wide btn btn-primary" data-toggle="modal"
                    data-target="#addberkas">UNGGAH BERKAS</a>
            </div>
            <div class="modal fade" id="addberkas" tabindex="-1" aria-labelledby="addberkasLabel" aria-hidden="true">
                <form action="<?php echo $url_config . 'file.php' ?>" method="post" enctype="multipart/form-data"
                    class="form-sample needs-validation " novalidate onSubmit="return validasi(this);">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">UNGGAH BERKAS</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
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
                                <button type="button" class="btn btn-outline-primary"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" name="addfile" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    require_once 'foot.php';
    ?>