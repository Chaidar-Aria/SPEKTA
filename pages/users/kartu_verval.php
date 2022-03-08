<?php
session_start();
require_once '../../app/helper/base_url.php';
require_once '../../app/helper/tgl_indo.php';
require_once '../../config/koneksi.php';
$email = $_SESSION['email'];
$c_email = "SELECT * FROM tb_account WHERE email = '$email'";
$r_email = mysqli_query($conn, $c_email) or die(mysqli_error($conn));
while ($r = mysqli_fetch_array($r_email)) {
    $id_acc = $r['id_acc'];
    if ($r['is_active'] == '0') { ?>
<script>
window.location.href = "pending";
</script>
<?php }
}
$sql = "SELECT * FROM tb_users
        INNER JOIN tb_users_address ON tb_users.id_users = tb_users_address.id_users
        INNER JOIN tb_users_utility ON tb_users.id_users = tb_users_utility.id_users
        INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
        INNER JOIN tb_religion ON tb_users.id_religion = tb_religion.id_religion
        INNER JOIN tb_class ON tb_users.id_class = tb_class.id_class
        INNER JOIN tb_account ON tb_users.id_acc = tb_account.id_acc
        WHERE tb_account.id_acc = '$id_acc'
        ";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
while ($d = mysqli_fetch_array($result)) {
    if ($d['is_verval'] == '0') { ?>
<script>
window.location.href = "index?mes=data_null";
</script>
<?php
    }
    ?>

<!doctype html>
<html lang="id">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>KARTU VERVAL | Sistem Pencatatan Keuangan dan Keanggotaaan Ekstrakurikuler SMA Negeri 1 Mejayan
    </title>

    <style>
    .txt-center {
        text-align: center;
    }

    .border- {
        border: 1px solid #000 !important;
    }

    .padding {
        padding: 15px;
    }

    .mar-bot {
        margin-bottom: 15px;
    }

    .admit-card {
        border: 2px solid #000;
        padding: 15px;
        margin: 20px 0;
    }

    .BoxA h5,
    .BoxA p {
        margin: 0;
    }

    h5 {
        text-transform: uppercase;
    }

    table img {
        width: 100%;
        margin: 0 auto;
    }

    .table-bordered td,
    .table-bordered th,
    .table thead th {
        border: 1px solid #000000 !important;
    }

    @page {
        size: legal;
        margin: 5px 0px 0px 0px;

    }

    @media print {
        .tombol-aksi {
            display: none;
            overflow: hidden !important
        }

        .toolbar {
            display: none;
        }

        body {
            margin: 0mm;
        }

    }
    </style>

</head>

<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false">

    <section>
        <div class="container">
            <div class="tombol-aksi text-center">
                <button onclick="window.print()" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
                <a href="./"><button class="btn btn-info"><i class="fa fa-arrow-left"></i>
                        Kembali</button></a>
            </div>
            <div class="admit-card">
                <div class="BoxA border- padding mar-bot">
                    <div class="row">
                        <div class="col-sm-4">
                            <h5>SMA NEGERI 1 MEJAYAN</h5>
                            <p>Jl.P.Sudirman, No.82, <br>Mejayan, Kab.Madiun 63153</p>
                        </div>
                        <div class="col-sm-4 txt-center">
                            <img src="../../assets/img/logo_smansa.png" width="100px;" />
                        </div>
                        <div class="col-sm-4">
                            <h5>SPEKTA SMANSA</h5>
                            <p>KARTU VERVAL SPEKTA</p>
                        </div>
                    </div>
                </div>
                <div class="BoxD border- padding mar-bot">
                    <div class="row">
                        <div class="col-sm-10">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><b>Nama: </b><?php echo $d['name'] ?></td>
                                        <td><b>Jenis Kelamin:
                                            </b><?php if ($d['gender'] == "L") {
                                                        echo "LAKI-LAKI";
                                                    } else {
                                                        echo "PEREMPUAN";
                                                    } ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Tempat Lahir: </b><?php echo $d['birth_place'] ?> <br><b>Tanggal Lahir:
                                            </b><?php echo tgl_indo($d['birth_date']) ?></td>
                                        <td><b>Waktu simpan:</b> <?php echo $d['permanent_at'] ?>
                                            <br>
                                            <b>Waktu verval:</b> <?php echo $d['verval_at'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="    height: 125px;">Bahwa saya telah dengan sadar
                                            mengisikan data diri saya pada aplikasi pendaftaran SPEKTA SMANSA dan saya
                                            menyatakan bahwa data yang saya
                                            isikan adalah benar. Jika dikemudian hari terdapat kekeliruan atau kesalahan
                                            data
                                            saya siap dikenakan sanksi sesuai aturan yang berlaku. <br><br><br>
                                            <b>
                                                <p style="text-align: right;"> Mejayan,
                                                    <?php echo tgl_indo(date("Y-m-d")) ?>
                                                <p style="text-align: right; margin-top:-15px;"> Yang membuat pernyataan
                                                    <br><br><br>
                                                    <?php echo $d['name'] ?>
                                                </p>
                                            </b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-2 txt-center">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row txt-center">
                                            <?php if ($d['foto_users'] == NULL) { ?>
                                            <img src="<?php echo $actual_link . '/assets/img/Logo SS.png' ?>"
                                                alt="img user" width="150px">
                                            <?php } else { ?>
                                            <img src="<?php echo $actual_link . '/assets/img/user/' . $d['foto_users']; ?>"
                                                alt="img user" wwidth="150px">
                                            <?php } ?>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <footer class="txt-center">
                    <p>PANITIA SELEKSI SPEKTA SMA NEGERI 1 MEJAYAN</p>
                    <p>Sistem Pencatatan Keuangan dan Keanggotaaan Ekstrakurikuler SMA Negeri 1 Mejayan</p>
                </footer>

            </div>
        </div>

    </section>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>
    document.addEventListener('contextmenu', event => event.preventDefault());

    // To disable F12 options
    document.onkeypress = function(event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
            return false;
        }
    }
    document.onmousedown = function(event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
            return false;
        }
    }
    document.onkeydown = function(event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
            return false;
        }
    }

    // To To Disable ctrl + c, ctrl + u

    jQuery(document).ready(function($) {
        $(document).keydown(function(event) {
            var pressedKey = String.fromCharCode(event.keyCode).toLowerCase();

            if (event.ctrlKey && (pressedKey == "c" || pressedKey == "u")) {
                //disable key press porcessing
                return false;
            }
        });
    });

    function getkey(e) {
        if (window.event)
            return window.event.keyCode;
        else if (e)
            return e.which;
        else
            return null;
    }

    function goodchars(e, goods, field) {
        var key, keychar;
        key = getkey(e);
        if (key == null) return true;

        keychar = String.fromCharCode(key);
        keychar = keychar.toLowerCase();
        goods = goods.toLowerCase();

        // check goodkeys
        if (goods.indexOf(keychar) != -1)
            return true;
        // control keys
        if (key == null || key == 0 || key == 8 || key == 9 || key == 27)
            return true;

        if (key == 13) {
            var i;
            for (i = 0; i < field.form.elements.length; i++)
                if (field == field.form.elements[i])
                    break;
            i = (i + 1) % field.form.elements.length;
            field.form.elements[i].focus();
            return false;
        };
        // else return false
        return false;
    }
    </script>

</body>

</html>
<?php } ?>