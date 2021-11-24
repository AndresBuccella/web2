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

{if $admin}
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
{if $smarty.session}
    <form action="" method="post" id="formAddComment">
        <input type="text" name="comment" placeholder="Comentar" value="">
        <label for="">Puntaje: </label>
        <select name="score" id="score">
            <option name="score" value="1">1</option>
            <option name="score" value="2">2</option>
            <option name="score" value="3">3</option>
            <option name="score" value="4">4</option>
            <option name="score" value="5">5</option>
        </select>
        <input type="text" name="fk_usuario" value="{$smarty.session['id']}" hidden>
        <input type="text" name="fk_producto" value="{$producto->id_producto}" hidden>
        <input type="submit" id="btn-comentar" value="Comentar">
    </form>
{/if}

<div class="comments" data-productId="{$producto->id_producto}">

</div>


<script src="./js/main.js"></script>
{include file="footer.tpl"}
