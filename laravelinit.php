#!/usr/bin/php
<?php

require './classes/Colors.class.php';
require './includes/functions.include.php';
require './includes/defines.include.php';

$output = new Colors();

// ================
// install composer
$output->println("Laravel Webadmin Generator v.0.2a","red");
$output->println("BRMobile -- eduardo.lopes@brmobile.com.br -- (CC BY 4.0) 2014","light_red");
$output->println(" ++ http://creativecommons.org/licenses/by/4.0/ ++","light_red");

$compPath1 = [];
$compPath2 = [];

// =====================
// Checking for composer
exec("which composer > /dev/null", $compPath1, $status1);
exec("which composer.phar > /dev/null", $compPath2, $status2);
$status3 = 1;
$status4 = 1;
if(file_exists("composer")) {
    $status3 = 0;
}

if(file_exists("composer.phar")) {
    $status4 = 0;
}

if ($status1 == 1 && $status2 == 1 && $status3 == 1 && $status4 == 1) {
    $output->prnt("\nComposer could not be found. Do you want to download composer?","light_blue");

    if (getOptions()) {
        system("curl -sS https://getcomposer.org/installer | php -- --filename=composer");
        $status3 = 0;
    } else {
        // TODO: asks for path of composer, and quit if not suplied
        $output->println("\nTrying to continue... may crash big time.","light_green");
    }
} else {
    $output->println("\nComposer found, continue","light_green");
}

if($status1 == 0) {
    $composer_exec = "composer";
} elseif ($status2 == 0) {
    $composer_exec = "composer.phar";
} elseif ($status3 == 0) {
    $composer_exec = __DIR__."/composer";
} elseif ($status4 == 0) {
    $composer_exec = __DIR__."/composer.phar";
}

$laravel_install_dir = DEFAULT_LARAVEL_INSTALL_DIR;
$output->prnt("\nWhich directory install laravel to? [laravel] ","light_blue");
getLineFromStdin($laravel_install_dir);

$laravel_command_line = "$composer_exec create-project laravel/laravel ".$laravel_install_dir;
system($laravel_command_line);

$output->println("\nDone installing laravel","yellow");

$output->println("\nInjecting requires","light_green");
$full_laravel_install_dir = __DIR__."/".$laravel_install_dir;
chdir($full_laravel_install_dir);

$composer_require_exec = "$composer_exec --prefer-dist require way/generators:dev-master rhumsaa/uuid:2.7.1 fzaninotto/faker:v1.4.0 aws/aws-sdk-php:dev-master loic-sharma/profiler:dev-master codeguy/upload:*";
system($composer_require_exec);

$output->println("\nDone updating composer requires","yellow");

// =============
// template copy
// ===========================
// TODO: multitemplate support
// TODO: finish user CRUD
$output->println("\nCopying files: Template  [LTE Admin]","light_green");
system("cp -R ../templates/views/lteadmin/app/views/* app/views/");

$output->println("\nCopying files: Configs","light_green");
system("cp -R ../templates/app/* app/");

$output->println("\nCopying files: public assets","light_green");
system("cp -R ../templates/views/lteadmin/public/* public/");

$output->println("\nDone copying files","yellow");

$output->println("\nConfiguring Laravel","light_green");

// ========
// App name
$app_name = "WebAdmin";
$output->prnt("\nApplication name: [$app_name] ","light_blue");
getLineFromStdin($app_name);
$content = file_get_contents("app/views/layout/header.blade.php");
$tmp     = str_replace("__VIEW__LAYOUT__HEADER__APPNAME__", $app_name, $content);
file_put_contents("app/views/layout/header.blade.php", $tmp);

$output->println("\nDone updating layout/header.blade.php","yellow");

// ==============================================================
// start modifying default files, taken from latest laravel build
// ==================
// app/config/app.php
$ip = getHostByName(getHostName());
$output->prnt("\nServer host name: [$ip] ","light_blue");
getLineFromStdin($ip);
$content = file_get_contents("app/config/app.php");
$tmp     = str_replace("__CONFIG__APP__URL__", $ip, $content);
file_put_contents("app/config/app.php", $tmp);
$output->println("\nRefreshing cypher key.","light_green");
system("./artisan key:generate");

$output->println("\nDone updating app.php","yellow");

// =======================
// app/config/database.php
// ========================================
// TODO: support other databases than MySQL
$output->println("\nConfiguring MySQL settings","light_green");
$db_host = "localhost";
$output->prnt("\nMySQL host name: [$db_host] ","light_blue");
getLineFromStdin($db_host);
$db_database = "test";
$output->prnt("MySQL host name: [$db_database] ","light_blue");
getLineFromStdin($db_database);
$db_username = "root";
$output->prnt("MySQL user name: [$db_username] ","light_blue");
getLineFromStdin($db_username);
$db_password = "root";
$output->prnt("MySQL password: [$db_password] ","light_blue");
getLineFromStdin($db_password);
$db_charset = "utf8";
$output->prnt("MySQL charset: [$db_charset] ","light_blue");
getLineFromStdin($db_charset);
$db_collation = "utf8_unicode_ci";
$output->prnt("MySQL collation: [$db_collation] ","light_blue");
getLineFromStdin($db_collation);
$db_prefix = "";
$output->prnt("MySQL prefix: [$db_prefix] ","light_blue");
getLineFromStdin($db_prefix);

$content = file_get_contents("app/config/database.php");
$tmp     = str_replace("__APP__CONFIG__DATABASE__HOST__", $db_host, $content);
$tmp     = str_replace("__APP__CONFIG__DATABASE__DATABASE__", $db_database, $tmp);
$tmp     = str_replace("__APP__CONFIG__DATABASE__USERNAME__", $db_username, $tmp);
$tmp     = str_replace("__APP__CONFIG__DATABASE__PASSWORD__", $db_password, $tmp);
$tmp     = str_replace("__APP__CONFIG__DATABASE__CHARSET__", $db_charset, $tmp);
$tmp     = str_replace("__APP__CONFIG__DATABASE__COLLATION__", $db_collation, $tmp);
$tmp     = str_replace("__APP__CONFIG__DATABASE__PREFIX__", $db_prefix, $tmp);
file_put_contents("app/config/database.php", $tmp);

$output->println("\nDone updating database.php","yellow");

// =========
// user seed
$output->println("\nConfiguring main admin account","light_green");
$admin_username = "admin";
$output->prnt("Name: [$admin_username] ","light_blue");
getLineFromStdin($admin_username);
$admin_email = "";
$output->prnt("Email: [$admin_email] ","light_blue");
getLineFromStdin($admin_email);
$admin_password = "";
$output->prnt("Password: [$admin_password] ","light_blue");
getLineFromStdin($admin_password);

$content = file_get_contents("app/database/seeds/UsersTableSeeder.php");
$tmp     = str_replace("__APP__DATABASE__SEEDS__NAME__", $admin_username, $content);
$tmp     = str_replace("__APP__DATABASE__SEEDS__PASSWORD__", $admin_password, $tmp);
$tmp     = str_replace("__APP__DATABASE__SEEDS__EMAIL__", $admin_email, $tmp);
file_put_contents("app/database/seeds/UsersTableSeeder.php", $tmp);

$output->println("\nDone configuring main account","yellow");

// ==============================================
// database related tasks: migrations and seeding
$output->println("\nRunning migrations and seeding db","light_green");
system("./artisan -n migrate");
system("./artisan -n db:seed");
$output->println("\nDone with database","yellow");

// ==========================
// update storage permissions
// ===============================================
// TODO: get user:group to chown instead of 777ing
$output->println("\nUpdating permissions","light_green");
system("chmod -R 777 app/storage/");

$output->println("\nDone with all. Enjoy.","yellow");