
$(document).ready(function(e) {

	
	var COOKIE_NAME = 'PHPSESSID'; 
	$.cookie(COOKIE_NAME, null,{path:'/',domain:getHost()});


	function getHost(){

		var host=window.location.host;
		var hostArr=new Array();
		hostArr=host.split(".");
		if(hostArr.length>2){
			return newHost=hostArr[1]+'.'+hostArr[2];
		}else{
			return host;
		}

	}
})





