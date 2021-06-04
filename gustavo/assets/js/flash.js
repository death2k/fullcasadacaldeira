function flash(arquivo, id, width, height)
{
	//var li = document.getElementById(id);
	swf = "<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' width='"+width+"' height='"+height+"' id=''>";
	swf+= "<param name='allowScriptAccess' value='sameDomain' />";
	swf+= "<param name='movie' value='"+arquivo+"' />";
	swf+= "<param name='quality' value='high' />";
	swf+= "<param name='wmode' value='transparent' />";
	swf+= "<param name='scale' value='noscale' />";
	swf+= "<embed src='"+arquivo+"' quality='high' wmode='transparent' width='"+width+"' height='"+height+"'name='menu_topo' allowScriptAccess='sameDomain' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' />";
	swf+= "</object>";
	//li.innerHTML = swf;
	document.write(swf);
};