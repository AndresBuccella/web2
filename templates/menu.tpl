
<nav class="navMenuPpal">
    <img class="logoPpal" src="./imgs/joystick.png" alt="joystick">
    <ul class="listaMenuPpal">
        <li><a class="itemMenu" href="home">Home</a></li>
        <li><a class="itemMenu" href="catalogue">Catalogue</a></li>
        <li><a class="itemMenu" href="categorias">Category</a></li>
    </ul>

    <ul class="listaMenuLogin">
        {if !$sessiON}
            <li><a class="itemMenu" href="loginUser">Login</a></li>
            <!--<li><a href="{BASE_URL}singUp">Registrarse</a></li>-->
        {else}
            <li><a class="itemMenu" href=logout>Logout</a></li>
        {/if}
                
    </ul>
    
</nav>