<?php
require_once './app/models/book.model.php';
require_once './app/views/apiView.php';


class ApiBookController {
    private $model;
    private $view;
    private $data;

    function __construct(){
        $this->model = new BookModel();
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
    }

    private function getData(){
        return json_decode($this->data);
    }

    public function getBooks($params = null){
        $books = $this->model->getAllBooks();
        $this->view->response($books, 200);
    }

    public function getBook($params = null){
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $book = $this->model->getBook($id);
        
        if ($book)
        $this->view->response($book);
        else
        $this->view->response("Book id=$id not found", 404);
        
    }

    public function insertBook($params = null){
        $book = $this->getData();

        if (empty($book->title) || empty($book->genre)) {
            $this->view->response("Complete los datos solicitados", 400);
        } else {
            $id = $this->model->insert($book->title, $book->genre);
            $book = $this->model->getBook($id);
            $this->view->response($book, 201);
        }
    

    }

    public function removeBook($params = null) {
        $id = $params[':ID'];

        $book = $this->model->getBook($id);
        if ($book) {
            $this->model->deleteBookById($id);
            $this->view->response($book);
        } else 
            $this->view->response("El libro con el id=$id no existe", 404);
    }

}