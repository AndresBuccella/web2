{include file="header.tpl"}
{include file="menu.tpl"}
<div class="listaJuegos">
    <h2>Juegos {$juegos[0]->genero}</h2>
    
    <ul>
        {foreach from=$juegos item=$juego}
            <li><a href="{BASE_URL}juegoEspecifico/{$juego->id_producto}">{$juego->nombre}</a></li>
        {/foreach}
    </ul>

</div>

{include file="footer.tpl"}