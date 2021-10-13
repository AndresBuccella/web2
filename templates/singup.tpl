{include file='templates/header.tpl'}
<h4>{$error}</h4>
<h2>{$singup}</h2>
<form action="verifySingup" method="POST">
    <input type="text" name="usuario" placeholder="User">
    <input type="mail" name="mail" placeholder="Mail">
    <input type="password" name="clave" placeholder="Password">

    <input type="submit" class="btn-primary" value="Enter">

</form>


{include file='templates/footer.tpl'}