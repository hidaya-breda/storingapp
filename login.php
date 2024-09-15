<?php
session_start();
?>


<!doctype html>
<html lang="nl">

<?php require_once 'resources/views/components/head.php'; ?>

<body>

    <div class="container home">
        <form action="app/Http/Controllers/loginController.php" method="POST">

            <div class="form-group">
                <label for="username">Username: </label>
                <input type="text" name="username" placeholder="username">
            </div>

            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" name="password" placeholder="password">
            </div>

            <input type="submit" value="login">
        </form>

        
    </div>

</body>

<style>

form {
position: relative;
z-index: 1;
background: #FFFFFF;
max-width: 400px;
margin: 0 auto 100px;
padding: 45px;
margin-top: 80px;
text-align: center;
border-radius: 15px;
box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}

form input {
outline: 0;
background:  #d1d1d1;
width: 100%;
border: 0;
border-radius: 7px;
margin: 0 0 15px;
padding: 15px;
box-sizing: border-box;
font-size: 14px;
}

form input[type="submit"] {
    background: #216e91;
    width: 100%;
    border: none;
    padding: 15px;
    color: #ffffff;
    border-radius: 7px;
    font-size: 16px;
    cursor: pointer;
    text-transform: uppercase;
    transition: background 0.3s ease;
}

form input[type="submit"]:hover, form input[type="submit"]:focus {
    background: #19536e;
}

form .submit:hover,.form .submit:active,form .submit:focus {
background: #19536e;
}
</style>
</html>
