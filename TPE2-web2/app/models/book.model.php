<?php
class BookModel {

    private $db;
    
    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_tpe;charset=utf8' , 'root', '');
    }

    //Devuelve la lista de tareas completa
    function getAllBooks(){
        //1. Abro la conexion

        //2.Enviar la consulta(2 sub pasos: prepare y execte)
        $query = $this->db->prepare("SELECT * FROM books");
        $query->execute();

        //3. Obtengo la respuesta con un fetchAll(porque)
        $books = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos

        return $books;
    }

    //Obtiene una tarea determinada por su id
    function getBook($id){
        $query = $this->db->prepare('SELECT * FROM books WHERE id = ?');
        $query->execute([$id]);
        $books = $query->fetch(PDO::FETCH_OBJ);
        return $books;
    }

    // function getRegisterBookById($id){
    //     $query = $this->db->prepare("SELECT * FROM books where `id`=$id");
    //     $query->execute();
    //     $bookRegister = $query->fetchAll(PDO::FETCH_OBJ);
    //     return $bookRegister;
    // }

    //Inserta una tarea en la base de datos.

    public function insertBook($title, $genre) {

        $query = $this->db->prepare("INSERT INTO books (title, genre) VALUES (?, ?)");
        $query->execute([$title, $genre]);

        return $this->db->lastInsertId();
    }

    public function insertEditBook($title, $genre, $id_author){        
            $query = $this->db->prepare("UPDATE `books` SET title=?, genre=? WHERE id=?");
            $query->execute([$title, $genre, $id_author]);
    }

    //Elimina una tarea dado su id
    function deleteBookById($id){
        $query = $this->db->prepare('DELETE FROM books WHERE id = ?');
        $query->execute([$id]);
        
    }
    
}

