<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost
// The output -> Index
//get('/', 'index.php');

// Dynamic GET. Example with 1 variable
// The $id will be available in user.php
//get('/user/$id', 'user.php');

// Dynamic GET. Example with 2 variables
// The $name will be available in user.php
// The $last_name will be available in user.php
//get('/user/$name/$last_name', 'user.php');

// Dynamic GET. Example with 2 variables with static
// In the URL -> http://localhost/product/shoes/color/blue
// The $type will be available in product.php
// The $color will be available in product.php
//get('/product/$type/color/:color', 'product.php');

// Dynamic GET. Example with 1 variable and 1 query string
// In the URL -> http://localhost/item/car?price=10
// The $name will be available in items.php which is inside the views folder
//get('/item/$name', 'views/items.php');


// ##################################################
// ##################################################
// ##################################################
// any can be used for GETs or POSTs

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST

any('/', 'controllers/c_index.php');

any('/secretaria/$feedname', 'controllers/c_feed.php', ['allow'=>2**6]);
any('/comision/$feedname',   'controllers/c_feed.php', ['allow'=>2**7]);
any('/club/$feedname',       'controllers/c_feed.php', ['allow'=>2**8]);
any('/votos',                'controllers/c_feed.php', ['feedid'=>true]);
any('/noticias',             'controllers/c_feed.php');
any('/archivo',              'controllers/c_feed.php', ['archive'=>true]);
any('/archivo/$feedid',      'controllers/c_feed.php', ['archive'=>true]);
any('/comisiones',           'controllers/c_feed.php');
any('/clubes',               'controllers/c_feed.php');
any('/secretarias',          'controllers/c_feed.php');


any('/funcionamiento',                      'controllers/c_article.php', ['article'=>2]);
any('/estatuto',                            'controllers/c_article.php', ['article'=>5]);
any('/sitio',                               'controllers/c_article.php', ['article'=>6]);
any('/contacto',                            'controllers/c_article.php', ['article'=>3]);
any('/miembros',                            'controllers/c_article.php', ['article'=>4]);
any('/docs',                                'controllers/c_article.php', ['article'=>7]);
any('/articulo/$article',                   'controllers/c_article.php');
any('/articulo/$article/historia/$version', 'controllers/c_article.php');


any('/login',           'controllers/c_login.php');
any('/logout',          'controllers/c_logout.php');
any('/registrar',       'controllers/c_register.php');
any('/busqueda',        'controllers/c_search.php');
any('/editar/$article', 'controllers/c_edit.php');
any('/api',             'controllers/c_api.php');
any('/rss',             'controllers/c_rss.php');
any('/admin',           'controllers/c_admin.php');



    
any('/404','controllers/c_404.php');
