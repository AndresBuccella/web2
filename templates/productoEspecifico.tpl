{include file="header.tpl"}
{include file="menu.tpl"}


<div class="contenedorProductoEspecifico">
    <h1>{$producto->nombre}</h1>
    <ul>
        <li>Genero: {$producto->genero}</li>
        <li>Precio: {$moneda}{$producto->precio}</li>
        <li>Plataforma: {$producto->plataforma}</li>
        <li>Descripcion: {$producto->descripcion}</li>
    </ul>

</div>

{if $sessiON}
<form action="editarProducto/{$producto->id_producto}" method="POST">
    <h3>Editar campos</h3>
    <input type="text" name="nombre" value="{$producto->nombre}">
    <input type="number" name="precio" value="{$producto->precio}">
    <textarea type="text" name="descripcion">{$producto->descripcion}</textarea>
    <input type="text" name="plataforma" value="{$producto->plataforma}">
    
    <select name="fk_id_genero">
        {foreach from=$generos item=genero name=fk_id_genero}
            {if $producto->genero == $genero->genero}
                <option selected value="{$genero->id_genero}">{$genero->genero}</option>
            {else}
                <option value="{$genero->id_genero}">{$genero->genero}</option>
            {/if}
        {/foreach}
    
    </select>

    <input name='{$producto->id_producto}' type="submit" class="btn-primary" value="Actualizar">
</form>
{/if}


{include file="footer.tpl"}
