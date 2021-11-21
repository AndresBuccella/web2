{include file='templates/header.tpl'}
{include file="menu.tpl"}
<h4>{$error}</h4>
<form action="addUser" method="POST">
    <h2>Sign up</h2>
    <input type="text" name="usuario" placeholder="User">
    <input type="mail" name="mail" placeholder="Mail">
    <input type="password" name="clave" placeholder="Password">

    <input type="submit" class="btn-primary" value="Enter">

</form>


{include file='templates/footer.tpl'}