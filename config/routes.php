<?php

return [
   'contact' => 'ContactController@index',
   'about' => 'AboutController@index',
   'blog' => 'BlogController@index',
   'guest' => 'GuestbookController@index',
   'admin' => 'Admin\DashboardController@index',
   
   'admin/categories' => 'Admin\shop\CategoriesController@index',
   'admin/categories/create' => 'Admin\shop\CategoriesController@create',
   'admin/categories/edit/{id}' => 'Admin\shop\CategoriesController@edit',
   'admin/categories/delete/{id}' => 'Admin\shop\CategoriesController@delete',


   'admin/posts' => 'Admin\blog\PostsController@index',
   'admin/posts/create' => 'Admin\blog\PostsController@create',
   'admin/posts/edit/{id}' => 'Admin\blog\PostsController@edit',
   'admin/posts/delete/{id}'=> 'Admin\blog\PostsController@delete',
   'admin/posts/show/{id}'=> 'Admin\blog\PostsController@show',

   'admin/products' => 'Admin\shop\ProductsController@index',
   'admin/products/create' => 'Admin\shop\ProductsController@create',
   'admin/products/edit/{id}' => 'Admin\shop\ProductsController@edit',
   'admin/products/delete/{id}'=> 'Admin\shop\ProductsController@delete',
   'admin/products/show/{id}'=> 'Admin\shop\ProductsController@show',

   //Главаня страница
   'index.php' => 'HomeController@index',
   '' => 'HomeController@index',
];
