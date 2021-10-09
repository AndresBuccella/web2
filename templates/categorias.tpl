{include file="header.tpl"}

<ul>
    {foreach from=$categorias item=$categoria}
        <li>
            <a href="categorias/{$categoria->genero}">{$categoria->genero}</a>
            
            Descripcion: {$categoria->descripcion_genero}
            <a href="{BASE_URL}/borrarGenero/{$categoria->id_genero}">Borrar todo el genero</a>
            <form action="editarGenero" method="post">
                <input type="text" name="genero" id="genero" placeholder="Genero">
                <textarea name="descripcion_genero" id="descripcion_genero" cols="30" rows="10">{$categoria->descripcion_genero}</textarea>
                <input hidden type="text" name="id_genero" value="{$categoria->id_genero}">
                <input type="submit" class="" value="Actualizar">
            </form>
            <!--<a href="{BASE_URL}/editarGenero/{$categoria->id_genero}">Editar</a>-->
        </li>
    {/foreach}
    <h3>Agregar un Genero</h3>
    
    <form action="crearGenero" method="POST">
        <input type="text" name="genero" id="genero" placeholder="Nombre del genero">
        <textarea type="text" name="descripcion_genero" id="descripcion_genero" cols="30" rows="10" placeholder="Descripcion del genero"></textarea>    
    
        <input type="submit" class="btn-guardar-genero btn-primary" value="Guardar">
    
    </form>
</ul>

{include file="footer.tpl"}
