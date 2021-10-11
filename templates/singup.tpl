{include file='templates/header.tpl'}
<h4>{$error}</h4>
<h2>{$singup}</h2>
<form action="verifySingup" method="POST">
    <input type="text" name="usuario" id="" placeholder="User">
    <input type="mail" name="mail" id="" placeholder="Mail">
    <input type="password" name="clave" id="" placeholder="Password">

    <input type="submit" value="Enter">

</form>


{include file='templates/footer.tpl'}