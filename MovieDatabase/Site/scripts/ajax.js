// Elokuvan poisto
$("#deleteMovie").click(function(){
	$.ajax({
		type: "POST",
		url: "deleteMovie.php",
		data: { movieId: $(this).attr("data-movieid") }
	}).done(function( msg ) {
		alert("Elokuva on poistettu tietokannasta!");
		window.location.href="index.php";
	});
});
// Henkil√∂n poisto
$("#deletePerson").click(function(){
	$.ajax({
		type: "POST",
		url: "deletePerson.php",
		data: { personId: $(this).attr("data-personid") }
	}).done(function( msg ) {
		alert("Henkilˆ on poistettu tietokannasta!");
		window.location.href="index.php";
	});
});
// Kommentin l√§hett√§minen ja render√∂inti
$(".saveReview").click(function(){
	var userReview = document.getElementById("review").value;
	var e = document.getElementById("stars");
	var userStars = e.options[e.selectedIndex].value;
	var mi = $(this).attr("data-movieid");
	var ue = $(this).attr("data-username");
	if(userReview.length==0){
		alert("Unohdit kirjoittaa arvostelusi!");
		return;
	}
	sendReview({ review: userReview, stars: userStars, movieid: mi, name: ue });
});
function sendReview(data){
	$.ajax({
			type: "POST",
			url: "saveReview.php",
			data: data,
	}).done(function( msg ) {
		renderReviews(data["movieid"]);
	});
}
function renderReviews(movieid){
	$.ajax({
			type: "POST",
			url: "getReviews.php",
			data: {movieId: movieid},
	}).done(function( msg ) {
		var reviews = JSON.parse(msg);
		var el = $(".reviewList");
		var content = "";
		for(var i=0; i<reviews.length; i++){
			var deleteButton="";
			if(reviews[i]["adminStatus"]==true){
				deleteButton="<input type='button' class='deleteReview yellow' style='margin-left: 0px; margin-top: 15px;' data-movieid='"+reviews[i]["movieid"]+"' data-username='"+reviews[i]["username"]+"' value='Poista'>";
			}
			if(i==0){
				content+="<li class='newReview' style='display: none'><a href='userShowCase.php?username="+reviews[i]["username"]+"'><h3>"+reviews[i]["username"]+"</h3></a>"+reviews[i]["review"]+"<div style='overflow: hidden;'><div style='float: left;'><div class='review' style='width:"+(17*parseInt(reviews[i]["stars"]))+"'></div><span style='color: rgb(120,120,120);'>"+reviews[i]["timestamp"]+"</span></div></div>"+deleteButton+"</li>";
			}else{
				content+="<li><a href='userShowCase.php?username="+reviews[i]["username"]+"'><h3>"+reviews[i]["username"]+"</h3></a>"+reviews[i]["review"]+"<div style='overflow: hidden;'><div style='float: left;'><div class='review' style='width:"+(17*parseInt(reviews[i]["stars"]))+"'></div><span style='color: rgb(120,120,120);'>"+reviews[i]["timestamp"]+"</span></div></div>"+deleteButton+"</li>";
			}
		}
		el.html(content);
		$(".deleteReview").bind("click",function(){
			deleteReview(this);
		});
		var aTag = $("a[name='reviewsTop']");
		$('html,body').animate({scrollTop: aTag.offset().top},'slow',function(){$(".newReview").show("blind");});
		$(".reviewForm").html("<h3>Olet jo arvostellut t‰m‰n elokuvan!</h3>");
	});
}
// Hallintaty√∂kalun toimintoja
// Elokuvan lis√§√§minen
var genreList = "";
var directorList = "";
var writerList = "";
var roleList = "";
$("#addGenre").click(function(){
	var e = document.getElementById("genreOptions");
	var val = e.options[e.selectedIndex].value;
	var str = e.options[e.selectedIndex].text;
	genreList+=val+";";
	document.getElementById("genreList").innerHTML+="<li>"+str+"</li>";
});
$("#clearGenre").click(function(){
	genreList="";
	document.getElementById("genreList").innerHTML="";
});
$("#addDirector").click(function(){
	var e = document.getElementById("directorOptions");
	var val = e.options[e.selectedIndex].value;
	var str = e.options[e.selectedIndex].text;
	directorList+=val+";";
	document.getElementById("directorList").innerHTML+="<li><a href='#'>"+str+"</a></li>";
});
$("#clearDirector").click(function(){
	directorList="";
	document.getElementById("directorList").innerHTML="";
});
$("#addWriter").click(function(){
	var e = document.getElementById("writerOptions");
	var val = e.options[e.selectedIndex].value;
	var str = e.options[e.selectedIndex].text;
	writerList+=val+";";
	document.getElementById("writerList").innerHTML+="<li><a href='#'>"+str+"</a></li>";
});
$("#clearWriter").click(function(){
	writerList="";
	document.getElementById("writerList").innerHTML="";
});
$("#addRole").click(function(){
	var e = document.getElementById("roleOptions");
	var val = e.options[e.selectedIndex].value;
	var str = e.options[e.selectedIndex].text;
	roleList+=val+":"+document.getElementById("role").value+";";
	document.getElementById("roleList").innerHTML+="<li><a href='#'>"+str+"</a> roolissa <i>" + document.getElementById("role").value + "</i></li>";
});
$("#clearRole").click(function(){
	roleList="";
	document.getElementById("roleList").innerHTML="";
});
$("#addMovie").click(function(){
	if(emptyFields([$("#movieName"),$("#movieDuration"),$("#moviePremiereYear"),$("#moviePremiereDay"),$("#moviePremiereMonth"),$("#movieDescription")])){
		alert("Tarkista, ettet j‰tt‰nyt tyhji‰ kentti‰!");
		return;
	}
	$.ajax({
		type: "POST",
		url: "saveMovie.php",
		data: { directors: directorList, writers: writerList, roles: roleList, genres: genreList, name: document.getElementById("movieName").value, duration: document.getElementById("movieDuration").value, premiereDate: (document.getElementById("moviePremiereYear").value+"-"+document.getElementById("moviePremiereMonth").value+"-"+document.getElementById("moviePremiereDay").value), description: document.getElementById("movieDescription").value }
	}).done(function( msg ) {
		alert("Elokuva on lis‰tty tietokantaan!");
		document.location.reload(true);
	});
});
// Henkil√∂n lis√§√§minen
$("#addPerson").click(function(){
	if(emptyFields([$("#personName"),$("#personBirthYear"),$("#personBirthMonth"),$("#personBirthDay")])){
		alert("Tarkista, ettet j‰tt‰nyt tyhji‰ kentti‰!");
		return;
	}
	$.ajax({
		type: "POST",
		url: "savePerson.php",
		data: { name: document.getElementById("personName").value, birthDate: (document.getElementById("personBirthYear").value+"-"+document.getElementById("personBirthMonth").value+"-"+document.getElementById("personBirthDay").value), birthPlace: document.getElementById("personBirthPlace").value }
	}).done(function( msg ) {
		alert("Henkilˆ on lis‰tty tietokantaan!");
		document.location.reload(true);
	});
});
// Genren lis√§√§minen
$("#addNewGenre").click(function(){
	if(emptyFields([$("#genreName")])){
		alert("Tarkista, ettet j‰tt‰nyt tyhji‰ kentti‰!");
		return;
	}
	$.ajax({
		type: "POST",
		url: "saveGenre.php",
		data: { name: document.getElementById("genreName").value }
	}).done(function( msg ) {
		alert("Genre on lis‰tty tietokantaan!");
		document.location.reload(true);
	});
});
// Kommentin poistaminen
function deleteReview(element){
	$(element).parent("li").hide("blind",function(){
		var movieid=$(element).attr("data-movieid");
		var username=$(element).attr("data-username");
		$.ajax({
			type: "POST",
			url: "deleteReview.php",
			data: { movieid: movieid, username: username }
		}).done(function( msg ) {
			$.ajax({
				type: "POST",
				url: "getReviews.php",
				data: {movieId: movieid},
			}).done(function( msg ) {
				var reviews = JSON.parse(msg);
				var el = $(".reviewList");
				var content = "";
				for(var i=0; i<reviews.length; i++){
					var deleteButton="";
					if(reviews[i]["adminStatus"]==true){
						deleteButton="<input type='button' class='deleteReview yellow' style='margin-left: 0px; margin-top: 15px;' data-movieid='"+reviews[i]["movieid"]+"' data-username='"+reviews[i]["username"]+"' value='Poista'>";
					}
					content+="<li><a href='userShowCase.php?username="+reviews[i]["username"]+"'><h3>"+reviews[i]["username"]+"</h3></a>"+reviews[i]["review"]+"<div style='overflow: hidden;'><div style='float: left;'><div class='review' style='width:"+(17*parseInt(reviews[i]["stars"]))+"'></div><span style='color: rgb(120,120,120);'>"+reviews[i]["timestamp"]+"</span></div></div>"+deleteButton+"</li>";
				}
				el.html(content);
			});
		});
		$(".deleteReview").bind("click",function(){
			deleteReview(this);
		});
	});
}
$(".deleteReview").click(function(){
	deleteReview(this);
});