{include file="header.tpl"}
{include file="menu.tpl"}
<div class="catalogo">

    <h2>Catalogo</h2>
    <table>
        <thead>
            <tr>
                <td>Juego</td>
                <td>Precio</td>
                <td>Descripcion</td>
                <td>Plataforma</td>
                <td>Genero</td>
                <td>DescGen</td>
            </tr>
        </thead>
        
        {foreach from=$productos item=$producto}
            <tr>
                <td class="td tdName"><a href="juegoEspecifico/{$producto->id_producto}">{$producto->nombre}</a></td>
                <td class="td">{$moneda}{$producto->precio}</td>
                <td class="td">{$producto->descripcion}</td>
                <td class="td">{$producto->plataforma}</td>
                <td class="td">{$producto->genero}</td>
                <td class="td">{$producto->descripcion_genero}</td>
                {if $sessiON}
                    <td><a href="borrarProducto/{$producto->id_producto}">Borrar</a></td>
                {/if}
            </tr>
        {/foreach}
    </table>
    {if $sessiON}
        <h3>Agregar un juego</h3>
    
        <form action="crearProducto" method="POST">
            <input type="text" name="nombre" id="nombre" placeholder="Nombre del juego">
            <input type="number" name="precio" id="precio" placeholder="Precio">
            <textarea type="text" name="descripcion" id="descripcion" placeholder="Descripcion del producto"></textarea>
            <input type="text" name="plataforma" id="plataforma" placeholder="Plataforma">
            <select name="fk_id_genero" id="fk_id_genero">
                {foreach from=$generos item=papa name="fk_id_genero"}
                    <option name="fk_id_genero" value="{$papa->id_genero}">{$papa->genero}</option>
                {/foreach}
            
            </select>
    
            <input type="submit" class="btn-guardar-producto btn-primary" value="Guardar">
    
        </form>
    {/if}
</div>


{include file="footer.tpl"}