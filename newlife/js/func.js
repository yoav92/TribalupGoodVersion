$(document).ready(function(){
	var result="";

	$('#password').keyup(function(){

		var password = $(this).val();
		password=$.trim(password);
		var lettre_min = /[a-z]/;
		var lettre_maj = /[A-Z]/;
		var nombre = /[0-9]/;

			if(password.length != 0)
			{
				$('.error').hide();

				//password faible
					if((password.match(lettre_min)) && password.length < 5)
					{
						$('.bar').animate({width:'10%'},200).show();
						$('.bar').css('background-color','red').show();
						$('.bar').text('Faible').show();
						$('.pass').css("border-color","red");
						result="faible";
					}
					else if((password.match(lettre_maj)) && password.length < 5)
					{
						$('.bar').animate({width:'10%'},200).show();
						$('.bar').css('background-color','red').show();
						$('.bar').text('Faible').show();
						$('.pass').css("border-color","red");
						result="faible";
					}
					else if((password.match(nombre)) && password.length < 5)
					{
						$('.bar').animate({width:'10%'},200).show();
						$('.bar').css('background-color','red').show();
						$('.bar').text('Faible').show();
						$('.pass').css("border-color","red");
						result="faible";
					}
				//password moyen
					else if((password.match(lettre_min)) && (password.match(lettre_maj)) && password.length >= 6 && password.length<=8)
					{
						$('.bar').animate({width:'15%'},200).show();
						$('.bar').css('background-color','orange').show();
						$('.bar').text('Moyen').show();
						$('.pass').css("border-color","orange");
						result="moyen";
					}
					else if((password.match(nombre)) && (password.match(lettre_maj)) && password.length >= 6 && password.length<=8)
					{
						$('.bar').animate({width:'15%'},200).show();
						$('.bar').css('background-color','orange').show();
						$('.bar').text('Moyen').show();
						$('.pass').css("border-color","orange");
						result="moyen";
					}
					else if((password.match(lettre_min)) && (password.match(nombre)) && password.length >= 6 && password.length<=8)
					{
						$('.bar').animate({width:'15%'},200).show();
						$('.bar').css('background-color','orange').show();
						$('.bar').text('Moyen').show();
						$('.pass').css("border-color","orange");
						result="moyen";
					}
					else if( password.length >=10)
					{
						$('.bar').animate({width:'15%'},200).show();
						$('.bar').css('background-color','orange').show();
						$('.bar').text('Moyen').show();
						$('.pass').css("border-color","orange");
						result="moyen";
					}else if((password.match(lettre_min)) && (password.match(nombre)) && (password.match(lettre_maj)) && password.length >= 5 && password.length<=7)
					{
						$('.bar').animate({width:'20%'},200).show();
						$('.bar').css('background-color','orange').show();
						$('.bar').text('moyen').show();
						$('.pass').css("border-color","orange");
						result="moyen";
					}
				//password fort
					else if((password.match(lettre_min)) && (password.match(nombre)) && (password.match(lettre_maj)) && password.length > 7)
					{
						$('.bar').animate({width:'20%'},200).show();
						$('.bar').css('background-color','green').show();
						$('.bar').text('Fort').show();
						$('.pass').css("border-color","green");
						result="fort";
					}
					else if(password.length >= 12)
					{
						$('.bar').animate({width:'20%'},200).show();
						$('.bar').css('background-color','green').show();
						$('.bar').text('Fort').show();
						$('.pass').css("border-color","green");
						result="fort";
					}

			}
			else
			{
				$('.bar').hide();
				$('.error').fadeIn().text("Please enter your password");
				$('.pass').css("border-color","#FF0000");
				result="vide";
			}

	});

		$('form').submit(function(){
			if(result=="faible")
			{
				return false;
			}
			else if(result=="moyen" || result=="fort")
			{
				return true;
			}
			else{
				return false;
			}
		});

});