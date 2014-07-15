temppass="";

$("#submit").click( function() {
	temppass="";
	
	$( "#password" ).prev().css( "background-color", "" );
	$( "#userid" ).prev().css( "background-color", "" );
	$("#errmsg").empty();
	$("#errmsg").html("<br>");
	formhash($("#login"),password);
	$.post( $("#login").attr("action"),
	$("#login :input").serializeArray(),
	function(info) {
		if(info=="Success")
			location.reload();
		else if(userid.value=="")
			$( "#userid" ).prev().css( "background-color", "#d9534f" );
		else if(temppass=="")
			$( "#password" ).prev().css( "background-color", "#d9534f" );
		else{
			
			$("#errmsg").html(info);
		}
	});
	
	$("#login").submit( function() {
		return false;	
	});
	
	$("#userid").on("focus",function(){
		$( "#userid" ).prev().css( "background-color", "" );
    })
	$("#password").on("focus",function(){
		$( "#password" ).prev().css( "background-color", "" );
    })
});
function formhash(form, password) {
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.append(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
	temppass=password.value;
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
	
}
 
function regformhash(form, uid, email, password, conf) {
     // Check each field has a value
    if (uid.value == ''         || 
          email.value == ''     || 
          password.value == ''  || 
          conf.value == '') {
 
        alert('You must provide all the requested details. Please try again');
        return false;
    }
 
    // Check the userid
 
    re = /^\w+$/; 
    if(!re.test(form.userid.value)) { 
        alert("userid must contain only letters, numbers and underscores. Please try again"); 
        form.userid.focus();
        return false; 
    }
 
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 6) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        form.password.focus();
        return false;
    }
 
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
        return false;
    }
 
    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.password.focus();
        return false;
    }
 
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
    conf.value = "";
 
    // Finally submit the form. 
    form.submit();
    return true;
}