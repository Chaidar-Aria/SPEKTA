<?php

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://localhost/ui_spekta";

// BASE URL

$base_url_public = $actual_link;
$base_url_app =  $actual_link . "/app/";

// URL PUBLIC
$url_assets =  $actual_link .  "/assets/";

// URL APP
$url_config = $actual_link .  "/config/";
$url_template = $actual_link .  "/app/config/template/";
$url_vendor = $actual_link . "/app/config/vendor/";

//URL PAGES
$url_page = $actual_link .  "/pages/";

//URL LOGIN
$url_login = $url_page . "auth/login";

//URL REGIS
$url_regis = $url_page . "auth/regis";

//URL FORGOT
$url_forgot = $url_page . "auth/forgot";

// URL CSS
$url_css = $actual_link . "/css/";
// URL VENDORS
$url_vendors = $actual_link . "/vendor/";
// URL NODE MODULES
$url_nodemodules = $actual_link . "/node_modules/";

//URL JS
$url_js = $actual_link . "/js/";
// URL IMAGES
$url_images = $actual_link . "/img/";

//URL SUPERADMIN
$url_superadmin = $url_page . "superadmin/";

//URL ADMIN
$url_admin = $url_page . "admin/";

//URL TEACHER
$url_teacher = $url_page . "teacher/";

//URL USERS
$url_users = $url_page . "users/";


// URL WEB
$url_web_public = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://web_pramuka.test/";
$url_web_assets = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://web_pramuka.test/assets/";;
$url_web_app = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://web_pramuka.test/app/";;
