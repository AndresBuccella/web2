{include file="header.tpl"}
{include file="menu.tpl"}

<form action="editarGenero" method="post">
    <h2>Categorias</h2>
    <h3>{$error}</h3>

    <ul>
        {foreach from=$categorias item=$categoria}
            <li>
                {if $sessiON}
                    <input type="checkbox" name="id_genero" value="{$categoria->id_genero}">
                {/if}
                <a href="categorias/{$categoria->id_genero}">{$categoria->genero}</a>
                {if $sessiON}
                    <br><a href="{BASE_URL}/borrarGenero/{$categoria->id_genero}">Borrar todo el genero</a>
                {/if}
                <p>Descripcion: {$categoria->descripcion_genero}</p>
            </li>

        {/foreach}
    </ul>
    {if $sessiON}
        <h3>Editar un Genero</h3>

        <input type="text" name="genero" placeholder="Genero">
        <textarea name="descripcion_genero" cols="30" rows="10" placeholder="Nueva descripcion del genero"></textarea>
        <input type="submit" class="btn-primary" value="Actualizar">
    {/if}
</form>

    {if $sessiON}
    <form action="crearGenero" method="POST">
        <h3>Agregar un Genero</h3>
        <input type="text" name="genero" placeholder="Nombre del genero">
        <textarea type="text" name="descripcion_genero" cols="30" rows="10" placeholder="Descripcion del genero"></textarea>    
    
        <input type="submit" class="btn-primary" value="Guardar">
    
    </form>
    {/if}
<!-- Proximamente se asignara la info en los correspondientes campos de actualizacion
<script src="./js/categorias.js" type="text/javascript"></script>-->
{include file="footer.tpl"}
