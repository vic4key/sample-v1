function sleep(ms)
{
	var time = new Date().getTime();
	while(new Date().getTime() < time + ms) {}
}

function incl_style(file)
{
	var obj = document.createElement("link");
	obj.type = "text/css";
	obj.rel  = "stylesheet";
	obj.href = file;
	document.head.append(obj);
}

function incl_script(file)
{
	var obj  = document.createElement("script");
	obj.type = "text/javascript";
	obj.src  = file;
	document.body.append(obj);
}