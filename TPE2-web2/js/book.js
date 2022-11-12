"use strict"

const URL = "api/books/";

let books = [];

let form = document.querySelector('#book-form');
form.addEventListener('submit', insertTask);

/**
 * Obtiene todas las tareas de la API REST
 */
async function insertBook() {
    try {
        let response = await fetch(URL);
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }
        books = await response.json();
        showBooks();
    } catch (e) {
        console.log(e);
    }

}

/**
 * Inserta la tarea via API REST
 */
async function insertBook(e) {
    e.preventDefault();

    let data = new FormData(form);
    let book = {
        titulo: data.get('titulo'),
        genero: data.get('genero')
    };

    try {
        let response = await fetch(URL, {
            method: "POST",
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(book)
        });
        if (!response.ok) {
            throw new Error('Error del servidor');
        }

        let nuevoBook = await response.json();

        //inserto la nueva tarea
        books.push(nuevoBook);
        showBooks();

        form.reset();
    } catch (e) {
        console.log(e);
    }
}

async function removeBook(e) {
    e.preventDefault();
    try {
        let id = e.target.dataset.book;
        let response = await fetch(URL + id, { method: 'DELETE' });
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }

        //eliminar la tarea del arreglo global
        books = books.filter(book => book.id != id);
        showBooks();
    } catch (e) {
        console.log(e);
    }
}

function showBooks() {
    let ul = document.quetSelector("#book-list");
    ul.innerHTML = "";
    for (const book of books) {
        let html = `
        // <li class='
        //             list-group-item d-flex justify-content-between align-items-center
        //             ${ task.finalizada == 1 ? 'finalizada' : ''}
        //         '>
        //         <span> <b>${task.titulo}</b> - ${task.descripcion} (prioridad ${task.prioridad}) </span>
        //         <div class="ml-auto">
        //             ${task.finalizada != 1 ? `<a href='#' data-task="${task.id}" type='button' class='btn btn-success btn-finalize'>Finalizar</a>` : ''}
        //             <a href='#' data-task="${task.id}" type='button' class='btn btn-danger btn-delete'>Borrar</a>
        //         </div>
        //     </li>
                `;

        ul.innerHTML += html;
    }

    //asigno event listener para los botones
    const btnDelete = document.querySelectorAll('a.btn-delete');
    for (const btn of btnDelete) {
        btn.addEventListener('click', removeBook);
    }
}

getAllBooks();