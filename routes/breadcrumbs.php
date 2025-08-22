<?php // routes/breadcrumbs.php



// Note: Laravel will automatically resolve `Breadcrumbs::` without

// this import. This is nice for IDE syntax and refactoring.

use Diglactic\Breadcrumbs\Breadcrumbs;



// This import is also not required, and you could replace `BreadcrumbTrail $trail`

//  with `$trail`. This is nice for IDE type checking and completion.

use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;



use App\Models\MenuAdmin;





Breadcrumbs::macro('resource', function (string $name, string $title) {

    // Home > Blog

    Breadcrumbs::for("{$name}.index", function (BreadcrumbTrail $trail) use ($name, $title) {

        $trail->parent('home');

        $trail->push($title, route("{$name}.index"));

    });



    // Home > Blog > New

    Breadcrumbs::for("{$name}.create", function (BreadcrumbTrail $trail) use ($name) {

        $trail->parent("{$name}.index");

        $trail->push('Tambah Data', route("{$name}.create"));

    });



    // Home > Blog > Post 123

    Breadcrumbs::for("{$name}.show", function (BreadcrumbTrail $trail) use ($name) {

        $trail->parent("{$name}.index");

        $trail->push('Lihat Data');

//        $trail->push($model->title, route("{$name}.show", $model));

    });



    // Home > Blog > Post 123 > Edit

    Breadcrumbs::for("{$name}.edit", function (BreadcrumbTrail $trail) use ($name) {

        $trail->parent("{$name}.index");

        $trail->push('Ubah Data');

    });

});



Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {

    $trail->push('Home', route('dashboard'));

});



Breadcrumbs::resource('menuadmin', 'Menu Admin');

Breadcrumbs::resource('user', 'User');

Breadcrumbs::resource('kekerasan', 'Jenis Kekerasan');

Breadcrumbs::resource('universitas', 'Universitas');

Breadcrumbs::resource('identitas', 'Jenis Identitas');

Breadcrumbs::resource('template', 'Template Status');

Breadcrumbs::resource('cetaklaporan', 'Cetak Laporan');

Breadcrumbs::resource('laporan', 'Laporan Masuk');


// routes/breadcrumbs.php
Breadcrumbs::for('ganti_laporan', function ($trail, $kategori) {
    // Breadcrumb utama (misalnya menuju dashboard atau halaman sebelumnya)
    $trail->parent('dashboard'); 
    
    // Menambahkan breadcrumb untuk Laporan Masuk
    $trail->push('Laporan Masuk', route('ganti_laporan', ['kategori' => $kategori]));
});









Breadcrumbs::for('photo.list', function (BreadcrumbTrail $trail) {

    $trail->push('Galeri Foto', route('photo.index'));

});

// Home

