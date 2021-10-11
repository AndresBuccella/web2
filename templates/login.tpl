{include file='templates/header.tpl'}

<h2>{$titulo}</h2>
<form action="verify" method="POST">
    <input type="text" name="user" id="" placeholder="User">
    <input type="mail" name="mail" id="" placeholder="Mail">
    <input type="text" name="password" id="" placeholder="Password">

    <input type="submit" value="Enter">

</form>







{include file='templates/footer.tpl'}