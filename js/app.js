function getShortUrl() {
	//console.log(url.value);
	//console.log(text.value);
	if(url.value)
		$.ajax({
		type: "POST",
		url: "url.php",
		data: "url="+url.value+(text.value ? "&text="+text.value : "" ),
		success: function(msg){
				if(msg)
					shortUrl.innerHTML = window.location.href+msg;
				}
		});
}
