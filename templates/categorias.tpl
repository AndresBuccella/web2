{include file="header.tpl"}
{include file="menu.tpl"}

<form action="editarGenero" method="post">

    <ul>
        {foreach from=$categorias item=$categoria}
            <li>
                {if $sessiON}
                    <input type="checkbox" name="id_genero" value="{$categoria->id_genero}" id="">
                {/if}
                <a href="categorias/{$categoria->genero}">{$categoria->genero}</a>
                
                <p class="descripcion-CategoriasTpl">Descripcion: {$categoria->descripcion_genero}</p>
                {if $sessiON}
                    <a href="{BASE_URL}/borrarGenero/{$categoria->id_genero}">Borrar todo el genero</a>
                {/if}

            </li>
        {/foreach}
    </ul>

    {if $sessiON}
        <input type="text" name="genero" id="genero" placeholder="Genero">
        <textarea name="descripcion_genero" id="descripcion_genero" cols="30" rows="10" placeholder="Nueva descripcion del genero"></textarea>
        <input type="submit" class="" value="Actualizar">
</form>
        <!--<a href="{BASE_URL}/editarGenero/{$categoria->id_genero}">Editar</a>-->
    {/if}
    {if $sessiON}
        <h3>Agregar un Genero</h3>
        <form action="crearGenero" method="POST">
            <input type="text" name="genero" id="genero" placeholder="Nombre del genero">
            <textarea type="text" name="descripcion_genero" id="descripcion_genero" cols="30" rows="10" placeholder="Descripcion del genero"></textarea>    
        
            <input type="submit" class="btn-guardar-genero btn-primary" value="Guardar">
        
        </form>
    {/if}
<!-- Proximamente se asignara la info en los correspondientes campos de actualizacion
<script src="./js/categorias.js" type="text/javascript"></script>-->
{include file="footer.tpl"}
