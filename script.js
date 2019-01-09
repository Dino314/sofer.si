$(document).ready(function(){
	
	//checks first if either or both fields are empty, if not then it attempts to log the user in and either displays an error or loads the welcome page
	$("#loginButton").click(function(){
		
		var login = $("#login_ime").val();
		var pass = $("#login_geslo").val();
		
		if (login=="" && pass==""){
			$("#infoFormLog").text("Username and password fields are empty");
		}
		else if(login==""){
			$("#infoFormLog").text("Username field is empty");
		}
		else if(pass==""){
			$("#infoFormLog").text("Password field is empty");
		}
		else{
			var data={
				login_ime:login,
				login_geslo:pass
				};
			
			//sending data via POST method to a php script, returns a response
			$.post("login.php", data, function(response, status){
				//"response" receives - whatever written in echo of above PHP script.
				//alert(response);
				
				if (response=="loginSuccess"){
					//load page instead of "error"
					//$("#infoForm").text("loadPage");
					document.location.href = "welcomePage.html";
				}
				else if(response=="loginError"){
					$("#infoFormLog").text("Wrong username or password");
				}
				else{
					$("#infoFormLog").text("Error in connecting to database: ("+response+"), ("+status+")");
				}
			});
		}
	});
	
	//checks first if either or both fields are empty, if not then it attempts to register the user and either displays an error or successful registration and switches to the login page
	$("#registerButton").click(function(){
		
		var login = $("#register_ime").val();
		var pass = $("#register_geslo").val();
		
		if (login=="" && pass==""){
			$("#infoFormReg").text("Username and password fields are empty");
		}
		else if(login==""){
			$("#infoFormReg").text("Username field is empty");
		}
		else if(pass==""){
			$("#infoFormReg").text("Password field is empty");
		}
		else{

			var data={
				uporabnisko_ime:login,
				geslo:pass
			};
			
			//sending data via POST method to a php script, returns a response
			$.post("register.php", data, function(response, status){

				if(response=="registerSuccess"){
					registerLogin();
					$("#infoFormLog").text("Registration Successful, you may log in now");
				}
				else if(response=="registerError"){
					$("#infoFormReg").text("Registraion failed, username already exists");
				}
				else{
					$("#infoFormReg").text("Error in connecting to database: ("+response+"), ("+status+")");
				}
			});
		}
	});
	
	$("#addButton").click(function(){
		
		var od1 = $("#od").val();
		var do1 = $("#doo").val();
		var cas1 = $("#cas").val();
		var cena1 = $("#cena").val();
		var opis1 = $("#opis").val();
		
		if (od1=="" || do1=="" || cas1=="" || cena1==""){
			$("#addErrorLog").text("Nekatera polja so prazna");
		}else{
			
			
			var data={
				od:od1,
				doo:do1,
				cas:cas1,
				cena:cena1,
				opis:opis1
			};
			
			$.post("dodaj.php", data, function(response, status){
				
				if(response=="addedSuccess"){
					$("#addErrorLog").text("Uspesno dodajanje");
				}
				else if(response=="alreadyExists"){
					$("#addErrorLog").text("Enak prevoz je ze objavljen");
					
				}else{
					$("#addErrorLog").text("Napaka: "+response+", "+status);
				
				}
			});
		}
	});
	
	$("#addCar").click(function(){
		
		var reg_tablica1 = $("#reg_tablica").val();
		var opis_avta1 = $("#opis_avta").val();
		var st_mest1 = $("#st_mest").val();
		var zavarovanje1 = $("#zavarovanje").val();
		
		if (reg_tablica1=="" || opis_avta1=="" || st_mest1=="" || zavarovanje1==""){
			$("#carErrorLog").text("Nekatera polja so prazna");
		}else{
			
			
			var data={
				reg_tablica:reg_tablica1,
				opis_avta:opis_avta1,
				st_mest:st_mest1,
				zavarovanje:zavarovanje1
			};
			
			$.post("dodajAvto.php", data, function(response, status){
				
				if(response=="addedSuccess"){
					$("#carErrorLog").text("Uspesno dodajanje avta");
				}
				else if(response=="alreadyExists"){
					$("#carErrorLog").text("Imate ze prijavljen avto na tem racunu");
					
				}else{
					$("#carErrorLog").text("Napaka: "+response+", "+status);
				
				}
			});
		}
	});
	
	$("#rezerviraj").click(function() {
		
		$.post("rezerviraj.php", "", function(response, status){
				
			if(response=="zasedeno"){
				$("#rezervirajErrorLog").text("Ni vec prostih mest");
			}
			else if(response=="reserveSuccess"){
				//need to add function to update the current number of free seats, for now you need to refresh the page
				$("#rezervirajErrorLog").text("Uspesna rezervacija");
				
			}else{
				$("#rezervirajErrorLog").text("Napaka: "+response+", "+status);
			
			}
		});
	});
	
	$(".clickable").click(function(){
		window.location = $(this).data("href");
	});

});

//function to switch between login and registration form
function registerLogin(){
	
	var register = document.getElementById("registerform");
	var login = document.getElementById("loginform");
	
	if(register.style.display==="none" || register.style.display===""){
		//change between register and login form
		register.style.display="inline";
		login.style.display="none";
		//copy the name and password from login to register form
		document.getElementById("register_ime").value=document.getElementById("login_ime").value;
		document.getElementById("register_geslo").value=document.getElementById("login_geslo").value;
		
	}
	else{
		//change between register and login form
		register.style.display="none";
		login.style.display="inline";
		//copy the name and password from register to login form
		document.getElementById("login_ime").value=document.getElementById("register_ime").value;
		document.getElementById("login_geslo").value=document.getElementById("register_geslo").value;
	}
}