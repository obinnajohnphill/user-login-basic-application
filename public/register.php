<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/jquery-3.4.1.min.js"></script>
</head>
<body>
<div class="header">
    <h2>User Registration Page</h2>
</div>

<form method="post" action="/registration_post">
    <?php
    if($_SESSION['password_mismatch'] ){?>
        <?php
        echo '<div class="error">
             '.$_SESSION['password_mismatch'].'
            <div>';}?>
    <ul class="errorMessages"
    style="width: 92%;
    margin: 0px auto;
    padding: 10px;
    color: #a94442;
    border-radius: 5px;
    text-align: left;">
    </ul>

    <div class="input-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div class="input-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="input-group">
        <label for="password_1">Password</label>
        <input type="password" id="password_1" name="password_1" required>
    </div>
    <div class="input-group">
        <label for="password_2">Confirm password</label>
        <input type="password" id="password_2" name="password_2" required>
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Register</button>
    </div>
    <p>
        Already registered? <a href="login.php">Login</a>
    </p>
</form>

<script>
    let createAllErrors = function() {
        let form = $( this ),
            errorList = $( "ul.errorMessages", form );

        let showAllErrorMessages = function() {
            errorList.empty();

            // Find all invalid fields within the form.
           let invalidFields = form.find( ":invalid" ).each( function( index, node ) {

                // Find the field's corresponding label
                let label = $( "label[for=" + node.id + "] "),
                    // Opera incorrectly does not fill the validationMessage property.
                    message = node.validationMessage || 'Invalid value.';

                errorList
                    .show()
                    .append( "<li><span>" + label.html() + "</span> " + message + "</li>" );
            });
        };

        // Support Safari
        form.on( "submit", function( event ) {
            if ( this.checkValidity && !this.checkValidity() ) {
                $( this ).find( ":invalid" ).first().focus();
                event.preventDefault();
            }
        });

        $( "input[type=submit], button:not([type=button])", form )
            .on( "click", showAllErrorMessages);

        $( "input", form ).on( "keypress", function( event ) {
            let type = $( this ).attr( "type" );
            if ( /date|email|month|number|search|tel|text|time|url|week/.test ( type )
                && event.keyCode == 13 ) {
                showAllErrorMessages();
            }
        });
    };

    $( "form" ).each( createAllErrors );
</script>

</body>
</html>