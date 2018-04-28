<?php

$router->get('', 'HomeController@index');

$router->get('about', 'AboutController@index');
$router->get('contact', 'ContactController@index');

$router->get('guestbook', 'GuestbookController@index');

$router->get('blog', 'BlogController@index');
$router->post('blog/search', 'BlogController@search');

$router->get('blog/{slug}', 'BlogController@show');

$router->get('blog/{id}', 'BlogController@view');

$router->get('404', 'PagesController@notFound');

$router->get('admin', 'Admin\DashboardController@index');

$router->get('admin/products', 'Admin\shop\ProductsController@index');
$router->get('admin/products/create', 'Admin\shop\ProductsController@create');
$router->post('admin/products/store', 'Admin\shop\ProductsController@store');
$router->get('admin/products/edit/{id}', 'Admin\shop\ProductsController@edit');
$router->post('admin/products/edit/{id}', 'Admin\shop\ProductsController@edit');

$router->get('admin/products/delete/{id}', 'Admin\shop\ProductsController@delete');
$router->post('admin/products/delete/{id}', 'Admin\shop\ProductsController@delete');

$router->get('admin/products/show/{id}', 'Admin\shop\ProductsController@show');


$router->get('admin/categories', 'Admin\shop\CategoriesController@index');
$router->get('admin/categories/create', 'Admin\shop\CategoriesController@create');
$router->post('admin/categories/create', 'Admin\shop\CategoriesController@create');
$router->get('admin/categories/edit/{id}', 'Admin\shop\CategoriesController@edit');
$router->post('admin/categories/edit/{id}', 'Admin\shop\CategoriesController@edit');
$router->get('admin/categories/delete/{id}', 'Admin\shop\CategoriesController@delete');
$router->post('admin/categories/delete/{id}', 'AdminCategoriesController@delete');

$router->get('admin/posts', 'Admin\blog\PostsController@index');
$router->get('admin/posts/create', 'Admin\blog\PostsController@create');
$router->get('admin/posts/edit/{id}', 'Admin\blog\PostsController@edit');
$router->get('admin/posts/delete/{id}', 'Admin\blog\PostsController@delete');
$router->post('admin/posts/store', 'Admin\blog\PostsController@store');
$router->post('admin/posts/update/{id}', 'Admin\blog\PostsController@update');
$router->post('admin/posts/delete/{id}', 'Admin\blog\PostsController@delete');

$router->get('api/shop', 'HomeController@getProduct');


$router->get('admin/roles', 'Admin\acl\RolesController@index');
$router->get('admin/roles/create', 'Admin\acl\RolesController@create');
$router->get('admin/roles/edit/{id}', 'Admin\acl\RolesController@edit');
$router->get('admin/roles/delete/{id}', 'Admin\acl\RolesController@delete');

$router->post('admin/roles/create', 'Admin\acl\RolesController@create');
$router->post('admin/roles/edit/{id}', 'Admin\acl\RolesController@edit');
$router->post('admin/roles/delete/{id}', 'Admin\acl\RolesController@delete');


$router->get('admin/permissions', 'Admin\acl\PermissionsController@index');
$router->get('admin/permissions/create', 'Admin\acl\PermissionsController@create');
$router->get('admin/permissions/edit/{id}', 'Admin\acl\PermissionsController@edit');
$router->get('admin/permissions/delete/{id}', 'Admin\acl\PermissionsController@delete');

$router->post('admin/permissions/create', 'Admin\acl\PermissionsController@create');
$router->post('admin/permissions/edit/{id}', 'Admin\acl\PermissionsController@edit');
$router->post('admin/permissions/delete/{id}', 'Admin\acl\PermissionsController@delete');


$router->get('admin/users', 'Admin\users\UsersController@index');
$router->get('admin/users/create', 'Admin\users\UsersController@create');
$router->post('admin/users/create', 'Admin\users\UsersController@create');

$router->get('admin/users/edit/{id}', 'Admin\users\UsersController@edit');
$router->post('admin/users/edit/{id}', 'Admin\users\UsersController@edit');

$router->get('admin/users/delete/{id}', 'Admin\users\UsersController@delete');
$router->post('admin/users/delete/{id}', 'Admin\users\UsersController@delete');

$router->get('register', 'UsersController@signup');
$router->post('register', 'UsersController@signup');

$router->get('login', 'UsersController@login');
$router->post('login', 'UsersController@login');

$router->get('logout', 'UsersController@logout');
$router->post('logout', 'UsersController@logout');
