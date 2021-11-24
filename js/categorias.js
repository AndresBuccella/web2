'use strict'


document.addEventListener('click', ()=>{

    document.getElementsByName('id_genero').forEach(genero => {
        if (genero.checked){
            document.getElementById('genero').value = genero.value;
            document.getElementById('descripcion_genero1').innerHTML = genero.value;
        }
    })

})