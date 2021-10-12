
<nav>
    <ul>
        <li><a href="{BASE_URL}home">Inicio</a></li>
        <li><a href="{BASE_URL}catalogue">Catalogo</a></li>
        <li><a href="{BASE_URL}categorias">Categorias</a></li>
        <li><a href="{BASE_URL}"></a></li>
        <li><a href="{BASE_URL}"></a></li>
    </ul>
    
    <ul>
        {if !$sessiON}
            <li><a href="loginUser">Iniciar sesion</a></li>
            <li><a href="singUp">Registrarse</a></li>
        {else}
            <li><a href="logout">Salir</a></li>
        {/if}
                
    </ul>
</nav>