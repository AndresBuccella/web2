'use strict';


const API_URL = "api/";
let comments = document.querySelector('.comments');
document.querySelector('#btn-comentar').addEventListener('click', addComment);

getComments();

async function deleteComment(e){
    e.preventDefault();
    try {
        let res = await fetch(`${API_URL}comentario/${this.databuttonname}`,{
            'method': 'DELETE'
        })
        if (res.status === 200) {
            console.log('Borrado con éxito');
        };
    } catch (error) {
        console.log(error);
    }
    getComments();
}

async function addComment(error){
    error.preventDefault();
    let formData = new FormData(formAddComment)
    if (formData.get("comment") != '') {
        let comentario = {
            "comment" : formData.get("comment"),
            "score" : formData.get("score"),
            "fk_usuario" : formData.get("fk_usuario"),
            "fk_producto" : formData.get("fk_producto")
        }
        try {
            let response = await fetch(API_URL + 'comentario', {
                'method': 'POST',
                'headers': {'Content-type': 'application/json'},
                'body': JSON.stringify(comentario) 
            });
            
            if (response.status === 200){
                getComments();
        
            }else{
                console.log('no');
            }
            
        } catch (error) {
            console.log(error);
        }
        
    }
}


function showComments(comments, comentarios){
    comments.innerHTML = '<ul>'
    for (const comentario of comentarios) {
        let ul = document.createElement("ul");
        let li = document.createElement("li");
        let div = document.createElement("div");
        div.classList.add("flex");
        let btnDelete = document.createElement("input");
        btnDelete.value = 'borrar';
        btnDelete.type = 'submit';
        btnDelete.databuttonname = comentario.id_comentario;
        btnDelete.classList.add("btn-borrar-comentario");
        btnDelete.addEventListener('click', deleteComment);
        div.innerHTML = 
                `<p>${comentario.comentario}</p>
                <p>Puntaje: ${comentario.puntaje}</p>
                `;

        li.appendChild(div);
        li.appendChild(btnDelete);
        ul.appendChild(li);
        comments.appendChild(ul);
    }
    comments += '</ul>'
}
async function getComments(){
    let comments = document.querySelector('.comments');
    comments.innerHTML = '';
            
        
    let id = comments.dataset.productid;
    try {
        let response = await fetch(API_URL + 'comentarios/' + id);
        
        if (response.status === 200) {
            let comentarios = await response.json();
            showComments(comments, comentarios);
        }else{
            comments.innerHTML = 'No hay comentarios sobre este videojuego';
        }
        
    } catch (error) {
        console.log(error);
    }
}