// Webtip.cz - DHTML knihovna
// verze 0.5

function objGet(x) {
	if (typeof x != 'string') return x;
	else if (Boolean(document.getElementById)) return document.getElementById(x);
	else if (Boolean(document.all)) return eval('document.all.'+x);
	else return null;
}


function objSetStyle (obj,prop,val) {
	var o = objGet(obj);
	if (o && o.style) {
		eval ('o.style.'+prop+'="'+val+'"');
		return true;
		}
	else return false;
	}

function objShow (obj,on) {
	return objSetStyle(obj,'visibility',(on) ? 'visible':'hidden');
	}
function objDisplay (obj,on,type) {
	if (on && !type) type = 'block';
	return objSetStyle(obj,'display',(on) ? type:'none');
	}
