{include file="header.tpl"}
{include file="menu.tpl"}
<div class="listaJuegos">
    <h2>Juegos {$genero->genero}</h2>
    
    <ul>
        {foreach from=$juegos item=$juego}
            <li><a href="juegoEspecifico/{$juego->id_producto}">{$juego->nombre}</a></li>
            
        {/foreach}
    </ul>

</div>

{include file="footer.tpl"}