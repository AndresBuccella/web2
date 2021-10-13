
<nav class="navMenuPpal">
    <img class="logoPpal" src="./imgs/joystick.png" alt="joystick">
    <ul class="listaMenuPpal">
        <li><a class="itemMenu" href="{BASE_URL}home">Home</a></li>
        <li><a class="itemMenu" href="{BASE_URL}catalogue">Catalogue</a></li>
        <li><a class="itemMenu" href="{BASE_URL}categorias">Category</a></li>
    </ul>

    <ul class="listaMenuLogin">
        {if !$sessiON}
            <li><a class="itemMenu" href="{BASE_URL}loginUser">Login</a></li>
            <!--<li><a href="{BASE_URL}singUp">Registrarse</a></li>-->
        {else}
            <li><a class="itemMenu" href={BASE_URL}logout>Logout</a></li>
        {/if}
                
    </ul>
    
</nav>