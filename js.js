function buttonPress(element)
{
 	var elements=document.getElementsByClassName('userPrint');
	for(var i=0, length=elements.length; i<length; i++){
		elements[i].style.background= '';
		
	}	
element.style.background = '#787878';
}



function loadService()
{
	var eleUsers=document.getElementsByClassName('userPrint');
	var widthWrap = eleUsers.length * 100 + 50 + "px";
	var eleWrap = document.getElementById('wrap');
	eleWrap.style.width = widthWrap; 
	// end délka users

   $("#chat").css("height", $(this).height()-100-54-122-52-1);
   $("#main").css("height", $(this).height()-100-54-1);
   // délka users
   
}

function loadIndex()
{
	$("#login").css("height", $(this).height()-100-30-30);
   $("#login h2").css("margin-top", $(this).height()/2-169-29-50);
   $("#login p").css("margin-top", $(this).height()/2-88-145);
   $("#registration h2").css("margin-top", $(this).height()/2-171-29-50);
   //$("#login p").css("margin-top", $(this).height()/2-88-145);
}

$(window).resize(function() {
   $("#chat").css("height", $(this).height()-100-54-122-52-1);
   $("#main").css("height", $(this).height()-100-54-1);
   
   $("#login").css("height", $(this).height()-100-30-30);
   $("#login h2").css("margin-top", $(this).height()/2-169-29-50);
   $("#login p").css("margin-top", $(this).height()/2-88-145);
   $("#registration h2").css("margin-top", $(this).height()/2-171-29-50);
});

   








