{include file='templates/header.tpl'}
{include file='templates/menu.tpl'}

<h4>{$okSingup}</h4>
<h2>{$title}</h2>
<form action="verifyLogin" method="POST">
    <input type="text" name="usuario" id="" placeholder="User" required>
    <input type="password" name="clave" id="" placeholder="Password" required>

    <input type="submit" class="btn-primary" value="Enter">

</form>

{include file='templates/footer.tpl'}