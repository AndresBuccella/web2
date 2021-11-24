{include file='templates/header.tpl'}
{include file='templates/menu.tpl'}

<h5>{$msg}</h5>
<form action="verifyLogin" method="POST">
    <h2>{$title}</h2>
    <input type="text" name="usuario" placeholder="User" required>
    <input type="password" name="clave" placeholder="Password" required>

    <input type="submit" class="btn-primary" value="Enter">

</form>

{include file='templates/footer.tpl'}