{include file="header.tpl"}
{include file="menu.tpl"}
<table>

    {foreach from=$users item=$user}
        <tr>
            <td>{$user->usuario}</td>
            <td>{$user->mail}</td>
            <td>
                {if $user->rol == 1}
                    <p>1- Normal user </p>
                    <a href="updateLicense/{$user->id}">to admin</a>   
                {else}
                    <p>2- Admin user</p> 
                    <a href="updateLicense/{$user->id}">to normal</a>
                {/if}
            </td>
            <td>
                <a href="deleteUser/{$user->id}">delete</a>
            </td>

        </tr>
    {/foreach}
</table>
{include file="footer.tpl"}