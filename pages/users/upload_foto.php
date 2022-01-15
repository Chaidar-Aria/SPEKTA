<?php
require_once 'head.php';
require_once '../../config/koneksi.php';
$email = $_SESSION['email'];

?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Verifikasi dan Validasi</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Administrasi</li>
            <li class="breadcrumb-item active" aria-current="page">Verifikasi dan Validasi</li>
        </ol>
    </div>
    <?php
    $sql = "SELECT * FROM tb_users
        INNER JOIN tb_account ON tb_users.id_acc = tb_account.id_acc
        INNER JOIN tb_users_status ON tb_users.id_users = tb_users_status.id_users
        WHERE tb_account.email = '$email'
        ";
    $r = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    while ($d = mysqli_fetch_array($r)) {
        $id_users = $d['id_users'];
        if ($d['is_verval'] != '0' | $d['isi_foto'] == '1') {
    ?>
    <script>
    window.location.href = "verval"
    </script>
    <?php
        }
    }
    ?>

    <form class="needs-validation text-start" novalidate
        action="<?php echo $url_config . 'verval.php?id_users=' . $id_users ?>" method="POST"
        enctype="multipart/form-data" autocomplete="off" spellcheck="false">
        <div class="col-12 grid-margin ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Berkas Data Diri Anggota</h4>
                    <p class="card-description">
                        Foto Anggota
                    </p>
                    <div class="drop-zone ml-3">
                        <span class="drop-zone__prompt">Drop file here or click to upload</span>
                        <input type="file" name="fotousers" id="fotousers" class="drop-zone__input" accept=".jpg,.jpeg"
                            required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" name="uploadFoto" id="uploadFoto"
                            class="btn btn-success btn-lg btn-block">
                            SIMPAN DATA</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script type="text/javascript">
    document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
        const dropZoneElement = inputElement.closest(".drop-zone");

        dropZoneElement.addEventListener("click", (e) => {
            inputElement.click();
        });

        inputElement.addEventListener("change", (e) => {
            if (inputElement.files.length) {
                updateThumbnail(dropZoneElement, inputElement.files[0]);
            }
        });

        dropZoneElement.addEventListener("dragover", (e) => {
            e.preventDefault();
            dropZoneElement.classList.add("drop-zone--over");
        });

        ["dragleave", "dragend"].forEach((type) => {
            dropZoneElement.addEventListener(type, (e) => {
                dropZoneElement.classList.remove("drop-zone--over");
            });
        });

        dropZoneElement.addEventListener("drop", (e) => {
            e.preventDefault();

            if (e.dataTransfer.files.length) {
                inputElement.files = e.dataTransfer.files;
                updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
            }

            dropZoneElement.classList.remove("drop-zone--over");
        });
    });

    /**
     * Updates the thumbnail on a drop zone element.
     *
     * @param {HTMLElement} dropZoneElement
     * @param {File} file
     */
    function updateThumbnail(dropZoneElement, file) {
        let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

        // First time - remove the prompt
        if (dropZoneElement.querySelector(".drop-zone__prompt")) {
            dropZoneElement.querySelector(".drop-zone__prompt").remove();
        }

        // First time - there is no thumbnail element, so lets create it
        if (!thumbnailElement) {
            thumbnailElement = document.createElement("div");
            thumbnailElement.classList.add("drop-zone__thumb");
            dropZoneElement.appendChild(thumbnailElement);
        }

        thumbnailElement.dataset.label = file.name;

        // Show thumbnail for image files
        if (file.type.startsWith("image/")) {
            const reader = new FileReader();

            reader.readAsDataURL(file);
            reader.onload = () => {
                thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
            };
        } else {
            thumbnailElement.style.backgroundImage = null;
        }
    }



    $('#serahbtn').click(function() {
        $('#name').text($('#cname').val());
    });
    </script>
    <?php
    require_once 'foot.php';
    ?>