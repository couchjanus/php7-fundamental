<?php

class PostsController extends Controller {

    public function index()
    {
      $posts = Post::selectAll();
      $data['rowCount'] = count($posts);
      $data['posts'] = $posts;
      $data['title'] = 'Admin Posts Page ';
      $this->_view->render('admin/posts/index', $data);
    }

    // public function index()
    // {
    //   $posts = App::get('database')->selectAll('posts');
    //   $data['rowCount'] = count($posts);
    //   $data['posts'] = $posts;
    //   $data['title'] = 'Admin Posts Page ';
    //   $this->_view->render('admin/posts/index', $data);
    // }

    public function create()
    {
      if (isset($_POST) and !empty($_POST)) {
        $opts['title'] = trim(strip_tags($_POST['title']));
        $opts['content'] = trim($_POST['content']);
        $opts['status'] = trim(strip_tags($_POST['status']));
        App::get('database')->insert('posts', $opts);
        header('Location: /admin/posts');
        // return redirect('/admin/posts');
      }

      $data['title'] = 'Admin Add Post ';
      $this->_view->render('admin/posts/create', $data);
    }

    public function edit($vars)
    {
        extract($vars);

        // var_dump($id);
    
        // if (isset($_POST) and !empty($_POST)) {
        //   $options['title'] = trim(strip_tags($_POST['title']));
        //   $options['content'] = trim($_POST['content']);
        //   $options['status'] = trim(strip_tags($_POST['status']));
          
        //   Post::update($id, $options);

        //   $this->metas['resource_id'] = $id;
        //   $this->metas['resource'] = $this->resource;
        //   $this->metas['title'] = trim(strip_tags($_POST['meta_title']));
        //   $this->metas['description'] = trim(strip_tags($_POST['meta_description']));
        //   $this->metas['keywords'] = trim(strip_tags($_POST['meta_keywords']));
        //   $this->metas['links'] = trim(strip_tags($_POST['meta_links']));
        //   $this->redirect('/admin/posts');
    
        // }
      
        $data['title'] = 'Admin Edit Post ';
        $data['post'] = Post::getPostById($id);
        $this->_view->render('admin/posts/edit', $data);

    }

    public function delete($vars)
    {
        extract($vars);

        // var_dump($id);

        if (isset($_POST['submit'])) {

            Post::destroy($id);
            $this->redirect('/admin/posts');
          
        } elseif (isset($_POST['reset'])) {
            $this->redirect('/admin/posts');            
        }

        $data['title'] = 'Admin Delete Post ';
        $data['post'] = Post::getPostById($id);
        $this->_view->render('admin/posts/delete', $data);
    }

    public function show($vars)
    {
        extract($vars);
        // var_dump($id);
        $data['title'] = 'Admin Show Post ';
        $data['post'] = Post::getPostById($id);
        $this->_view->render('admin/posts/show', $data);

    }

  //   public function create()
  //   {
  //     //Принимаем данные из формы
  //     if (isset($_POST) and !empty($_POST)) {
  //       $opts['title'] = trim(strip_tags($_POST['title']));
  //       $opts['content'] = trim($_POST['content']);
  //       $opts['status'] = trim(strip_tags($_POST['status']));
  //       Post::store($opts);
  //       header('Location: /admin/posts');
  //     }
  //     $data['title'] = 'Admin Add Post ';
  //     $this->_view->render('admin/posts/create', $data);
  // }

}
