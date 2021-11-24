'use strict';


const API_URL = "api/";
let comments = document.querySelector('.comments');
document.querySelector('#btn-comentar').addEventListener('click', addComment);

getComments();
document.querySelectorAll(".btn-borrar-comentario").forEach(btn => {
    btn.addEventListener("click", deleteComment)
});

async function deleteComment(){
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
    /*
    let formData = new FormData(commForm);
    let texto = formData.get("comment");
    let puntaje = formData.get("score");

    let id_usuario = document.querySelector("#commForm").dataset.id_usuario; */
    
    let comentario = {
        "comment" : formAddComment.comment.value,
        "score" : formAddComment.score.value,
        "fk_usuario" : formAddComment.fk_usuario.value,
        "fk_producto" : formAddComment.fk_producto.value
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


function showComments(comments, comentarios){
    comments.innerHTML = '<ul>'
    for (const comentario of comentarios) {
        let ul = document.createElement("ul");
        let li = document.createElement("li");
        let div = document.createElement("div");
        div.classList.add("flex");
        let btnDelete = document.createElement("input");
        btnDelete.value = 'borrar';
        btnDelete.type = 'button';
        btnDelete.databuttonname = comentario.id_comentario;
        btnDelete.classList.add("btn-borrar-comentario");
        btnDelete.addEventListener('click', deleteComment);
        div.innerHTML = 
                `<p>${comentario.comentario}</p>
                <p>Puntaje: ${comentario.puntaje}</p>`;

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



/*
function createButton(accion, identifier, tr){
    let tdBtn = document.createElement("td");
    let btn = document.createElement("input");
    btn.type = 'submit';
    btn.value = accion;
    btn.classList.add(`btn-${accion}`);
    btn.name = identifier;
    btn.databuttonname = identifier;
    tdBtn.appendChild(btn);
    tr.appendChild(tdBtn);
    btn.addEventListener('click', deleteUser);
}

function crearCasillero(dato, tr){
    let td = document.createElement("td");
    td.innerHTML = dato;
    tr.appendChild(td);
}

function createRow(table, tr, name, mail, role, identifier){
    crearCasillero(name, tr);
    crearCasillero(mail, tr);
    crearCasillero(role, tr);
    createButton('borrar', identifier, tr);
    table.appendChild(tr);
}

function createTable(users){
    let table = document.getElementById('tablon');
    table.innerHTML = '';
    for (const user of users) { 
        let name = user.usuario;
        let mail = user.mail;
        let role = user.rol;
        let identifier = user.id;
        let tr = document.createElement('tr');
        createRow(table, tr, name, mail, role, identifier);
    }
}

async function deleteUser(){
    
}

async function getUsers(){
    try {
        let response = await fetch(API_URL + "usuarios");
        let users = await response.json();
    
        console.log(users);

        createTable(users);
    } catch (error) {
        console.log(error);
    }

}

getUsers();

*/