<?php 

namespace blog\controler;

use \App;
use blog\controler\Controler;

class PostsControler extends Controler {

	public function __construct() {
		parent::__construct();
		$this->loadModel('post');
		$this->loadModel('category');
	}

	public function index() {
		$posts = $this->post->getList();
		$categories = $this->category->all();
		$this->render('posts.index', compact('posts', 'categories'));
	}

	public function categories() {
		$categorie = $this->category->find($_GET['id']);
		if($categorie === false) {
			$this->notFound();
		}
		$posts = $this->post->byCategory($_GET['id']);
		$listCategories = $this->category->all();
		$this->render('posts.category', compact('categorie', 'posts', 'listCategories'));
	}

	public function single() {
		$app = App::getInstance();
		$post = $this->post->findWithCategory($_GET['id']);
		if ($post === false) {
			$this->notFound();
		}

		$app->title = $post->title;
		$this->render('posts.single', compact('post', 'app'));
	}
}
