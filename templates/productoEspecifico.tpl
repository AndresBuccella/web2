{include file="header.tpl"}

<h1>{$producto->nombre}</h1>

<img src="" alt="">

<ul>
    <li>Genero: {$producto->genero}</li>
    <li>Precio: {$moneda}{$producto->precio}</li>
    <li>Plataforma: {$producto->plataforma}</li>
    <li>Descripcion: {$producto->descripcion}</li>
</ul>

<h3>Editar campos</h3>

<form action="editarProducto/{$producto->id_producto}" method="POST">
    <input type="text" name="nombre" id="nombre" value="{$producto->nombre}">
    <input type="number" name="precio" id="precio" value="{$producto->precio}">
    <textarea type="text" name="descripcion" id="descripcion">{$producto->descripcion}</textarea>
    <input type="text" name="plataforma" id="plataforma" value="{$producto->plataforma}">
    <select name="fk_id_genero" id="fk_id_genero">
        {foreach from=$generos item=genero name=fk_id_genero}
            {if $producto->genero == $genero->genero}
                <option selected value="{$genero->id_genero}">{$genero->genero}</option>
            {else}
                <option value="{$genero->id_genero}">{$genero->genero}</option>
            {/if}
        {/foreach}
    
    </select>

    <input name='{$producto->id_producto}' type="submit" class="btn-actualizar-producto btn-primary" value="Actualizar">

</form>


{include file="footer.tpl"}
