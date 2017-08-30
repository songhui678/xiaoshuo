function setTab(name,cursel,n){
	for(i=1;i<=n;i++){
		var menu=document.getElementById(name+i);
		var con=document.getElementById("con_"+name+"_"+i);
		menu.className=i==cursel?"h3on":"";
		con.style.display=i==cursel?"block":"none";
	}
}
//function setTop(name,cursel,n){
//	for(i=1;i<=n;i++){
//		var menu=document.getElementById(name+i);
//		var con=document.getElementById("con_"+name+"_"+i);
//		menu.className=i==cursel?"h3on":"";
//		con.style.display=i==cursel?"block":"none";
//		var cob=document.getElementById("cob_"+name+"_"+i);
//		menu.className=i==cursel?"h3on":"";
//		cob.style.display=i==cursel?"none":"block";
//	}
//}
function tr(id){
	if(id=='1'){
		document.getElementById('tr_1').style.display="none";
		document.getElementById('tr_2').style.display="block";
		document.getElementById('tr_c').style.display="block";
		}
	if(id=='2'){
		document.getElementById('tr_1').style.display="block";
		document.getElementById('tr_2').style.display="none";
		document.getElementById('tr_c').style.display="none";
		}
}
function lazyload() {
    var imgcount = 0;
    $(".index_middle_c img[_src]:visible,.index_34_left_c img[_src]:visible,.index_tv img[_src]:visible").each(function() {
        var st = $(window).scrollTop(),
        ch = $(window).height();
        var ot = $(this).offset().top,
        oh = parseInt(this.getAttribute("height"), 10);
        if (ot < st + ch && ot + oh > st) {
            this.src = this.getAttribute("_src");
            this.removeAttribute("_src")
        }
        imgcount++
    });
    if (!imgcount) clearInterval(si_lazyload);
    isscroll = 0
}
function endlazy() {
    si_lazyload = setInterval(lazyload, 1000)
}