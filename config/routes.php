<?php


return [
   'contact' => 'ContactController@index',
   'about' => 'AboutController@index',
   'blog' => 'BlogController@index',
   'guest' => 'GuestbookController@index',
   'admin' => 'Admin\DashboardController@index',
   'admin/categories' => 'Admin\shop\CategoriesController@index',
   'admin/categories/create' => 'Admin\shop\CategoriesController@create',

   'admin/products' => 'Admin\shop\ProductsController@index',
   'admin/products/create' => 'Admin\shop\ProductsController@create',

   'admin/posts' => 'Admin\blog\PostsController@index',
   'admin/posts/create' => 'Admin\blog\PostsController@create',
   //Главаня страница
   'index.php' => 'HomeController@index',
   '' => 'HomeController@index',
];
