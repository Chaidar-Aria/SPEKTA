<?php
session_start();
session_unset();
session_destroy();
setcookie('email', '', 0, '/');
header("location:../pages/auth/login?pesan=berhasil_logout");