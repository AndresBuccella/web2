{include file="header.tpl"}
{include file="menu.tpl"}

<ul>
    {foreach from=$juegos item=$juego}
        <li><a href="{BASE_URL}juegoEspecifico/{$juego->id_producto}">{$juego->nombre}</a></li>
    {/foreach}
</ul>

{include file="footer.tpl"}