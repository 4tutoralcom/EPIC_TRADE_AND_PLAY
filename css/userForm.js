temppass="";

$( document ).ready( function(){

	$('.button-checkbox').each(function(){
		var $widget = $(this),
			$button = $widget.find('button'),
			$checkbox = $widget.find('input:checkbox'),
			color = $button.data('color'),
			settings = {
					on: {
						icon: 'glyphicon glyphicon-check'
					},
					off: {
						icon: 'glyphicon glyphicon-unchecked'
					}
			};
		$button.on('click', function () {
			$checkbox.prop('checked', !$checkbox.is(':checked'));
			$checkbox.val(($checkbox.val()==="0")?1:0)
			updateDisplay();
		});

		$checkbox.on('change', function () {
			updateDisplay();
		});

		function updateDisplay() {
			var isChecked = $checkbox.is(':checked');
			// Set the button's state
			$button.data('state', (isChecked) ? "on" : "off");

			// Set the button's icon
			$button.find('.state-icon')
				.removeClass()
				.addClass('state-icon ' + settings[$button.data('state')].icon);

			// Update the button's color
			if (isChecked) {
				$button
					.removeClass('btn-default')
					.addClass('btn-' + color + ' active');
			}
			else
			{
				$button
					.removeClass('btn-' + color + ' active')
					.addClass('btn-default');
			}
		}
		function init() {
			updateDisplay();
			// Inject the icon if applicable
			if ($button.find('.state-icon').length == 0) {
				$button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
			}
		}
		init();
	});
	$("#FormForgot #submit").click( function() {
	
	});
	$("#registerForm #submit").click( function() {
		$( "#registerForm #password" ).prev().css( "background-color", "" );
		$( "#registerForm #userid" ).prev().css( "background-color", "" );
		regHash=regformhash(registerForm,
					registerForm.username,
					registerForm.first_name,
					registerForm.last_name,
					registerForm.email,
					registerForm.password,
					registerForm.confirmpwd,
					registerForm.t_and_c
					);
		$("#registerForm #errmsg").html((regHash.error) ?   regHash.error:"<br>");
		if(!regHash.error){
			$.post( $("#registerForm").attr("action"),
			$("#registerForm :input").serializeArray(),
			function(info) {
				if(info=="Success")
					location.reload();
				else if(userid.value=="")
					$( "#signinForm #userid" ).prev().css( "background-color", "#d9534f" );
				else if(temppass=="")
					$( "#signinForm #password" ).prev().css( "background-color", "#d9534f" );
				else{

					$("#signinForm #errmsg").html(info);
				}
			});
		}

	});

	$("#signinForm #submit").click( function() {
		temppass="";
		$( "#signinForm #password" ).prev().css( "background-color", "" );
		$( "#signinForm #userid" ).prev().css( "background-color", "" );
		$("#signinForm #errmsg").empty();
		$("#signinForm #errmsg").html("<br>");
		formhash($("#signinForm"),signinForm.password);
		$.post( $("#signinForm").attr("action"),
		$("#signinForm :input").serializeArray(),
		function(info) {
			if(info=="Success")
				$("#signinForm #errmsg").html("An Confirmation Email has been sent to "+registerForm.email+ "Click on the link in the email to confirm your account. it will be invalid in 72 hours.");
			else{
				$("#signinForm #errmsg").html(info);
			}
		});
	});

	$("#signinForm input").on("focus",function(){
		$( "#"+this.id).prev().css( "background-color", "" );
	});

	$("form").submit( function() {
		return false;	
	});

	$('#registerForm #username').on('input',function(e){
		if( this.value.length>6 ) {
			$.post( "/includes/findUsername.php",
			{ username:this.value },
			function(info) {
				if(info=="No Username Found")
					$( "#registerForm #username" ).prev().css( "background-color", "#4fd953 " );
				else if(info=="Username Found")
					$( "#registerForm #username" ).prev().css( "background-color", "#d9534f" );	
			});
		}else{
			$( "#registerForm #username" ).prev().css( "background-color", "" );
		}
    });

	$('#registerForm #email').on('input',function(e){
		if( validateEmail(this.value) ) {
			$.post( "/includes/findEmail.php",
			{ email:this.value },
			function(info) {
				if(info=="No Email Found")
					$( "#registerForm #email" ).prev().css( "background-color", "#4fd953 " );
				else if(info=="Email Found")
					$( "#registerForm #email" ).prev().css( "background-color", "#d9534f" );	
			});
		}else{
			$( "#registerForm #email" ).prev().css( "background-color", "" );
		}
    });	
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
 
function regformhash(form, uid, first_name, last_name, email, password, conf,accept) {
	var data = {
		error:false,
	};
		 // Check each field has a value
		if (uid.value === ''		   || 
				first_name.value === ''|| 
				last_name.value === '' || 
				email.value === ''     || 
				password.value === ''  || 
				conf.value === '') {
	 
			data.error=('You must provide all the requested details. Please try again');
			$($('#registerForm input').filter(function() { return this.value == ""; })[0]).focus();
		}else{
	 
				// Check the userid
			 
				re = /^\w+$/; 
				if(!re.test(uid.value)) { 
					data.error=("userid must contain only letters, numbers and underscores. Please try again"); 
					uid.focus(); 
				}else{
			 
				// Check that the password is sufficiently long (min 6 chars)
				// The check is duplicated below, but this is included to give more
				// specific guidance to the user
				if (password.value.length < 6) {
					data.error=('Passwords must be at least 6 characters long.  Please try again');
					password.focus();
				}else{
			 
				// At least one number, one lowercase and one uppercase letter 
				// At least six characters 
			 
					var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
					if (!re.test(password.value)) {
						data.error=('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
					}else{
				 
						// Check password and confirmation are the same
						if (password.value != conf.value) {
							data.error=('Your password and confirmation do not match. Please try again');
							password.focus();
						}else{
							if(accept.value!="1"){
								data.error=('You must agree to the Terms and Conditions.');
							}else{
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
							}
						}
					}
				}
			}
		}
	// Finally submit the form. 
		return data;
}

function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 