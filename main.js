"use strict";
document.getElementById("dropdown-menu").addEventListener("click", view);

let htmlTeachers = document.getElementById("btn-add-teacher");
let htmlHome = document.getElementById("btn-checkIn");
let viewLinks = document.querySelector(".view");
function view (){
    viewLinks.classList.toggle("view");
    viewLinks.classList.toggle("menu");
}

if (htmlHome != null) {
    htmlHome.addEventListener("click", verificar);
    document.getElementById("update-captcha").addEventListener("click", numeroAleatorio);
    numeroAleatorio()
}

function numeroAleatorio(){
    let random = Math.floor(Math.random()*10000+1);
    document.querySelector(".random-code").innerHTML = random;
}

function verificar(){
    
    let captcha = document.querySelector(".random-code").innerHTML;
    let nuevoTexto = document.querySelector(".confirm-captcha");
    let captchaIngresado = document.querySelector(".box-captcha").value;
    let userName = document.getElementById("name").value;
    let userLastName = document.getElementById("lastName").value;
    let dni = document.getElementById("dni").value;
    let mail = document.getElementById("mail").value;

    if ((userName != "") && (userLastName != "") && (dni != "") && (mail != "")) {
        if (captcha == captchaIngresado){
            nuevoTexto.innerHTML = "Registro exitoso";
        }else{
            nuevoTexto.innerHTML = "Intentelo de nuevo";
        }
    }else{
        nuevoTexto.innerHTML = "Por favor, complete todos los campos";
    }
}



if (htmlTeachers != null) {
    document.querySelector('#precio-maximo').addEventListener('keyup', filtrarPrecio);
    htmlTeachers.addEventListener("click", addOneTeacher);
    
    const url = ('https://60ca66cf772a760017205fa5.mockapi.io/teachers');
    let maxPrice = 99999999;
    let paraEditar = false; //cuando se pasa por parámetro se modifica permanentemente
    let variableVacia;
    
    mostrarTabla(variableVacia, paraEditar, maxPrice);

    async function mostrarTabla(profesoresLocales, paraEditar, maxPrice){ //CAMBIAR POR MOSTRAR TABLA
        try {
            if (paraEditar) {
                mostrarTablaLocal(profesoresLocales, maxPrice);
            } else {
                let promise = await fetch(url);
                var profesoresDescargados = await promise.json();
                mostrarTablaLocal(profesoresDescargados, maxPrice);
            }            
        } catch (error) {
            console.log(error);
        }
    }
    function mostrarTablaLocal(profesores, maxPrice){
        let tabla = document.getElementById("new-user");
        let borrar = 'borrar';
        let editar = 'editar';
        let moneda = '$ ';
        tabla.innerHTML = '';
        for(let indice=0; indice < profesores.length; indice++){

            let name = profesores[indice].name;
            let instrument = profesores[indice].instrument;
            let price = moneda + profesores[indice].price;
            let identifier = profesores[indice].id;
            let precioUsuario = Number(maxPrice);
            let precioProfesor = Number(profesores[indice].price)
            let tr = document.createElement("tr");
            /* if ((maxPrice != (/^[0-9]+$/)) && (maxPrice != '')) {
                crearTabla(tabla, tr, name, instrument, price, identifier, borrar, editar);
                console.log('1')
            }else */ 
            if ((precioUsuario >= precioProfesor) || (maxPrice == '')) {
                crearFila(tabla, tr, name, instrument, price, identifier, borrar, editar);
            }else{
                crearFila(tabla, tr, name, instrument, price, identifier, borrar, editar);
                tr.classList.add('ocultar');
            }
            if (precioProfesor < 500) {
                tr.classList.add('resaltar');
            }

        }
    }

    function crearFila(tabla, tr, name, instrument, price, identifier, borrar, editar){
        crearCasillero(name, tr);
        crearCasillero(instrument, tr);
        crearCasillero(price, tr);
        createButton(borrar, identifier, tr);
        createButton(editar, identifier, tr);
        tabla.appendChild(tr);
    }

    function crearCasillero(dato, tr){
        let td = document.createElement("td");
        td.innerHTML = dato;
        tr.appendChild(td);
    }

    function createButton(accion, identifier, tr){
        let tdBtn = document.createElement("td");
        let btn = document.createElement("input");
        btn.type = 'button';
        btn.value = accion;
        btn.classList.add(`btn-${accion}`);
        btn.name = identifier;
        btn.databuttonname = identifier;
        tdBtn.appendChild(btn);
        tr.appendChild(tdBtn);
        if (accion == 'borrar') {
            btn.addEventListener('click', deleteTeacher);
        }else{
            btn.addEventListener('click', editTeacher);
        }
    }

    function filtrarPrecio() {
        let profesores;
        paraEditar = false; //Hay que definirla porque sino despues de editar una fila, se vuelve true y no funciona más
        let precioMax = document.querySelector('#precio-maximo').value;
        //profesores sólo está definido porque lo pide mostrarTabla
        mostrarTabla(profesores, paraEditar, precioMax);
    }

    async function addOneTeacher (){
        let promise = await fetch(url);
        let profesores = await promise.json();
        let id = nuevoId(profesores);
        let name = document.getElementById("name-teacher");
        let instrument = document.getElementById("instrument-teacher");
        let price = document.getElementById("price-teacher");
        let profesorIngresado = {
            'name': name.value,
            'instrument': instrument.value,
            'price': price.value,
            'id': id
        }

        try {
            let promise = await fetch(url, {
                'method': 'POST',
                'headers': {'Content-type': 'application/json'},
                'body': JSON.stringify(profesorIngresado) 
            });
            if (promise.status === 201) {
                console.log('Creado correctamente'); //Mostrarlo en HTML
            }
        } catch (error) {
            console.log(error);
        }
        paraEditar = false;
        mostrarTabla(profesores, paraEditar, maxPrice);
    } 

    function nuevoId(profesores) {
        let cantProfes = profesores.length;
        if (cantProfes != 0){
            return Number(profesores[cantProfes - 1].id + 1);
        }
        else{
            return 1;
        }
    }
    
    async function deleteTeacher(){
        try {
            let res = await fetch(`${url}/${this.databuttonname}`,{
                'method': 'DELETE'
            })
            if (res.status === 200) {
                console.log('Borrado con éxito');
            };
        } catch (error) {
            console.log(error);
        }
        let profesores;
        paraEditar = false;
        mostrarTabla(profesores, paraEditar, maxPrice);
    }

    async function editTeacher(){
        document.querySelector('#btn-modify').classList.remove('ocultar');
        paraEditar = true;
         
        try {
            let id = this.databuttonname;
            let promise = await fetch(url);
            let profesores = await promise.json();

            textoAInput(profesores, id, paraEditar)
            document.querySelector('#btn-modify').addEventListener('click', async()=>
            {
                let profesorEditado = inputATexto(profesores, id, paraEditar);

                //mostrarTabla(profesores, paraEditar, maxPrice)
                
                let promise2 = await fetch(`${url}/${id}`,{
                    'method': 'PUT',
                    'headers': {'Content-type':'application/json'},
                    'body': JSON.stringify(profesorEditado)
                })
                modificacionExitosa((promise2.status === 200));

            })
        } catch (error) {
            console.log('get: '+error)
        }
    } 
    function modificacionExitosa(ok){
        if (ok) {
            window.location.reload();
        }else{
            console.log('Hubo un error')
        }
    }
   
    
    function textoAInput(profesores, id, paraEditar) {
        for (const profesor of profesores) {
            if (profesor.id == id) {
                document.querySelector('#name-teacher').value = profesor.name;
                document.querySelector('#instrument-teacher').value = profesor.instrument;
                document.querySelector('#price-teacher').value = profesor.price;
            }
        }
        mostrarTabla(profesores, paraEditar, maxPrice);
    }
    function inputATexto(profesores, id) {
        let name = document.querySelector('#name-teacher');
        let instrumento = document.querySelector('#instrument-teacher');
        let precio = document.querySelector('#price-teacher');
        for (const profesor of profesores) {
            if (profesor.id == id) {
            profesor.name = name.value;
            profesor.instrument = instrumento.value;
            profesor.price = precio.value;
            return profesor
            }
        }
    }
}