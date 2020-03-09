<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/jquery-3.4.1.min.js"></script>
</head>
<body>
<div class="header">
    <h2>User Login Page </h2>
</div>

<form method="post" action="/login_post">
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
        <input id="username" type="text" name="username" required>
    </div>
    <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="login_user">Login</button>
    </div>
    <p>
        Not yet registered? <a href="register.php">Register</a>
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