// Tyhjien kenttien check
function emptyFields(elArray){
	var emptyFields=false;
	for(var i=0; i<elArray.length; i++){
		elArray[i].removeClass("input-error");
		if(elArray[i].val()==""){
			emptyFields=true;
			elArray[i].addClass("input-error");
		}
	}
	return emptyFields;
}
// Navigaatio
$("nav li ul").hide().removeClass("fallback");
	$("nav li").hover(function () {
		$("ul", this).stop().slideDown(100);
	},
	function () {
		$("ul", this).stop().slideUp(100);
	}
	);
// XSS esto
	function XSSDanger(string){
		var forbiddenTags= new Array(/(<script)/i,/(<img)/i,/(<iframe)/i,/(>)/i,/(<)/i);
		for(var i=0; i<forbiddenTags.length; i++){
			if(string.match(forbiddenTags[i])){
				alert("Kentist‰ lˆytyi tageja, jotka eiv√§t ole syˆtteiss‰ sallittuja!");
			return true;
			}
		}
		var forbiddenChars=new Array(String.fromCharCode(39),String.fromCharCode(34));
		for(var i=0; i<forbiddenChars.length; i++){
			if(string.indexOf(forbiddenChars[i])!=-1){
				alert("Kentist‰ lˆytyi kielletty merkki ("+forbiddenChars[i]+"-merkki)");
			return true;
			}
		}
		return false;
	}
// Rekister√∂inti check
$(document).ready(function(){
	$("#register").submit(function(event){
		if($("#usernameRegister").val().length<3 || $("#usernameRegister").val().length>15){
			event.preventDefault();
			alert("K‰ytt‰j‰nimen t‰ytyy olla v‰hint‰‰n kolme ja enint‰‰n viisitoista merkki pitk‰!");
		}
		if($("#passwordRegister").val()!=$("#passwordRegisterAgain").val()){
			event.preventDefault();
			alert("Tarkista, ett‰ antamasi salasana on molemmissa kentiss‰ sama!");
		}
		if($("#passwordRegister").val().length<5){
			event.preventDefault();
			alert("Salasanasi t‰ytyy olla v‰hint‰‰n viisi merkki‰ pitk‰!");
		}
		if($("#registerUsername").val()==""){
			event.preventDefault();
			alert("K‰ytt‰j‰tunnus ei saa olla tyhj‰!");
		}
	});
});