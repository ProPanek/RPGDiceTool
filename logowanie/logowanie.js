function setrejestracja()
{
	document.getElementById("box-logowanie").style.opacity = "0.0";
	setTimeout(function(){
		document.getElementById("box-logowanie").style.zIndex = "-999";
		document.getElementById("box-rejestracja").style.zIndex = "999";

	}, 1100);
	setTimeout(function(){
		document.getElementById("box-rejestracja").style.opacity = "1.0";
	}, 2100);
}	


function setlogowanie()
{
	document.getElementById("box-rejestracja").style.opacity = "0.0";
	setTimeout(function(){
		document.getElementById("box-rejestracja").style.zIndex = "-999";
		document.getElementById("box-logowanie").style.zIndex = "999";

	}, 1100);
	setTimeout(function(){
		document.getElementById("box-logowanie").style.opacity = "1.0";
	}, 2100);
}	

