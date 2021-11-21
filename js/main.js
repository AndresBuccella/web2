'use strict';

const API_URL = "http://localhost/web2/TPE/api/";


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

