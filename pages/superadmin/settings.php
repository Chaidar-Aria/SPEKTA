<?php
require_once 'head.php';
require_once '../../config/koneksi.php';
$query = "SELECT * FROM tb_auth_settings";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $query2 = "SELECT * FROM tb_web_settings";
    $result2 = $conn->query($query2);
    while ($row2 = $result2->fetch_assoc()) {
        $query3 = "SELECT * FROM tb_app_settings";
        $result3 = $conn->query($query3);
        while ($row3 = $result3->fetch_assoc()) {
            $query4 = "SELECT * FROM tb_data_sekolah";
            $result4 = $conn->query($query4);
            while ($row4 = $result4->fetch_assoc()) {
?>
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <strong>Setelan Aplikasi</strong>
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $url_superadmin ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Setelan Aplikasi</li>
        </ol>
    </div>
    <div class="row mb-3 mt-3">
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title">Data Tentang Aplikasi</h4>
                    <p>Diperbarui terakhir pada <?php echo $row3['updated_at'] ?></p>
                    <form class="form-sample needs-validation text-start" novalidate onSubmit="return validasi(this);"
                        action="<?php echo $url_config . 'settings.php' ?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Versi Aplikasi</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="verapp" id="verapp" step="any"
                                            required value="<?php echo $row3['app_version'] ?>" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tanggal Rilis Aplikasi</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="releasedate" id="releasedate"
                                            min="<?php echo $row3['release_date'] ?>"
                                            value="<?php echo $row3['release_date'] ?>" required autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tentang Aplikasi</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="aboutapp" id="aboutapp" rows="10" required
                                            autocomplete="off"><?php echo $row2['about_spekta']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="card-description">
                            Aksi
                        </p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" name="appsettings" id="appsettings"
                                            class="btn btn-success btn-lg btn-block">
                                            SIMPAN DATA</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3 mt-3">
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title">Registrasi Akun</h4>
                    <p>Diperbarui terakhir pada <?php echo $row['updated_at'] ?></p>
                    <p style="color: red">SETIAP AGENDA DIMULAI DAN DITUTUP PADA PUKUL 00.00</p>
                    <form class="form-sample needs-validation text-start" novalidate onSubmit="return validasi(this);"
                        action="<?php echo $url_config . 'settings.php' ?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tanggal Pembukaan Pendaftaran
                                        SPEKTA</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="dateoprec" id="dateoprec"
                                            min="<?php echo date("Y-m-d") ?>"
                                            value="<?php echo $row['date_open_reg'] ?>" required autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tanggal Penutupan Pendaftaran
                                        SPEKTA</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="datecloserec" id="datecloserec"
                                            min="<?php echo date("Y-m-d") ?>"
                                            value="<?php echo $row['date_close_reg'] ?>" required autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Pengumuman Pendaftaran Akun
                                        SPEKTA</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="annc" id="annc" rows="10" required
                                            autocomplete="off"><?php echo $row3['about_app']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="card-description">
                            Aksi
                        </p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" name="authsettings" id="authsettings"
                                            class="btn btn-success btn-lg btn-block">
                                            SIMPAN DATA</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3 mt-3">
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title">Data Sekolah</h4>
                    <p>Diperbarui terakhir pada <?php echo $row4['updated_at'] ?></p>
                    <form class="form-sample needs-validation text-start" novalidate onSubmit="return validasi(this);"
                        action="<?php echo $url_config . 'settings.php' ?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Sekolah</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="id" value="<?php echo $row4['id_data_sekolah'] ?>">

                                        <input type="text" class="form-control" name="nameschool" id="nameschool"
                                            required value="<?php echo $row4['nama_sekolah'] ?>" autocomplete="off"
                                            autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Alamat Sekolah <p style="color: red">
                                            jalan, nomor jalan, desa/kelurahan, kecamatan/distrik,
                                            kabupaten/kota, serta kodepos</p></label>
                                    <div class="col-sm-9">
                                        <textarea name="alamatsekolah" id="alamatsekolah" class="form-control" rows="5"
                                            autocomplete="off"><?php echo $row4['alamat_sekolah'] ?></textarea>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email Sekolah</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" name="emailsekolah" id="emailsekolah"
                                            required value="<?php echo $row4['email_sekolah'] ?>" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nomor Telepon Sekolah</label>
                                    <div class="col-sm-9">
                                        <input type="tel" class="form-control" name="notelpsekolah" id="notelpsekolah"
                                            required value="<?php echo $row4['no_telp_sekolah'] ?>"
                                            autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Kepala Sekolah</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="kepsek" id="kepsek" required
                                            value="<?php echo $row4['kepala_sekolah'] ?>" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">NIP Kepala Sekolah</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nipkepsek" id="nipkepsek" required
                                            value="<?php echo $row4['nip_kepsek'] ?>" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Wakil Kepala Sekolah Bidang Kurikulum</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="wakakurikulum" id="wakakurikulum"
                                            required value="<?php echo $row4['waka_kurikulum'] ?>" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">NIP Wakil Kepala Sekolah Nidang
                                        Kurikulum</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nipwakakurikulum"
                                            id="nipwakakurikulum" required
                                            value="<?php echo $row4['nip_waka_kurikulum'] ?>" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Asisten Wakil Kepala Sekolah Bidang
                                        Kurikulum</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="asswakakurikulum"
                                            id="asswakakurikulum" required
                                            value="<?php echo $row4['ass_waka_kurikulum'] ?>" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">NIP Asisten Wakil Kepala Sekolah Nidang
                                        Kurikulum</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nipasswakakurikulum"
                                            id="nipasswakakurikulum" required
                                            value="<?php echo $row4['nip_ass_waka_kurikulum'] ?>" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Wakil Kepala Sekolah Bidang Kesiswaan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="wakakesiswaan" id="wakakesiswaan"
                                            required value="<?php echo $row4['waka_kesiswaan'] ?>" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">NIP Wakil Kepala Sekolah Bidang
                                        Kesiswaan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nipwakakesiswaan"
                                            id="wakakesiswaan" required
                                            value="<?php echo $row4['nip_waka_kesiswaan'] ?>" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Asisten Wakil Kepala Sekolah Bidang
                                        Kesiswaan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="asswakakesiswaan"
                                            id="asswakakesiswaan" required
                                            value="<?php echo $row4['ass_waka_kesiswaan'] ?>" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">NIP Asisten Wakil Kepala Sekolah Bidang
                                        Kesiswaan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nipasswakakesiswaan"
                                            id="nipasswakakesiswaan" required
                                            value="<?php echo $row4['nip_ass_waka_kesiswaan'] ?>" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="card-description">
                            Aksi
                        </p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" name="datasekolah" id="datasekolah"
                                            class="btn btn-success btn-lg btn-block">
                                            SIMPAN DATA</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->
    <script>
    CKEDITOR.replace('aboutapp');
    CKEDITOR.replace('annc');
    </script>


    <?php
                require_once 'foot.php';
            }
        }
    }
}
    ?>