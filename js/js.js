//when the dom is ready
window.addEvent('domready', function() {
    new vlaCalendar("page-calendary",  { 
        startMonday: true, 
        filePath: "js/vlacal/inc/akce/"
    });
    
    //store titles and text
    $$('a.tipz').each(function(element,index) {
        var content = element.get('title').split('::');
        element.store('tip:title', content[0]);
        element.store('tip:text', content[1]);
    });
    
    //create the tooltips
    var tipz = new Tips('.tipz',{
        className: 'tipz',
        hideDelay: 50,
        showDelay: 50
    });
});


function showMenu (n,on) {
	objSetStyle('menuitem'+n,'background',(on) ? '#336699':'#99ccff');
	objSetStyle('menuitem'+n,'color',(on) ? 'white':'black');
	objDisplay('submenu'+n,on);
	}

var actMenu = 1;
function openMenu (n) {
	if (n==actMenu) {
		objDisplay('sm'+n,false);
		actMenu = 0;
		}
	else {
		if (actMenu) objDisplay('sm'+actMenu,false);
		objDisplay('sm'+n,true);
		actMenu = n;
		}
	}
function openText(name) {
	var on = objGet(name).style.display=='block';
	objDisplay(name,!on);
	}



//function smajlik(text) {
//if (document.form.body.createTextRange && document.form.body.caretPos) {
//var caretPos = document.form.body.caretPos;

//caretPos.text = caretPos.body.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
//}
//else document.form.body.value += text;
//document.form.body.focus(caretPos)
//} 

// IE only - wraps selected text with lft and rgt
  function WrapIE(lft, rgt) {
    strSelection = document.selection.createRange().text;
    if (strSelection!="") {
      document.selection.createRange().text = lft + strSelection + rgt;
    }
  }

// Moz only - wraps selected text with lft and rgt
  function wrapMoz(txtarea, lft, rgt) {
    var selLength = txtarea.textLength;
    var selStart = txtarea.selectionStart;
    var selEnd = txtarea.selectionEnd;
    if (selEnd==1 || selEnd==2) selEnd=selLength;
    var s1 = (txtarea.value).substring(0,selStart);
    var s2 = (txtarea.value).substring(selStart, selEnd)
    var s3 = (txtarea.value).substring(selEnd, selLength);
    txtarea.value = s1 + lft + s2 + rgt + s3;
  }
  
// Chooses technique based on browser
  function wrapTag(txtarea, lft, rgt) {
    lft = unescape(lft);
    rgt = unescape(rgt);
    if (document.all) {
      WrapIE(lft, rgt);
    }
    else if (document.getElementById) {
      wrapMoz(txtarea, lft, rgt);
    }
  }  
  
// IE only - Insert text at caret position or at start of selected text
  function insertIE (txtarea, text) {
    if (txtarea.createTextRange && txtarea.caretPos) { 
      var caretPos = txtarea.caretPos; 
      caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text+caretPos.text + ' ' : text+caretPos.text;
    } else {
      txtarea.value = txtarea.value + text; 
    }
    return;
  } 

// Moz only - Insert text at caret position or at start of selected text
  function insertMoz(txtarea , lft) {
    var rgt="";
    wrapTag(txtarea, lft, rgt);
    return;
  }

// Switch function based on browser - Insert text at caret position or at start of selected text
  function insertTag(txtarea , lft) {
    if (document.all) {
      insertIE(txtarea, lft);
    }
    else if (document.getElementById) {
      insertMoz(txtarea, lft);
    }
  }

// IE only - stores the current cursor position on any textarea activity
function storeCaret (txtarea) { 
    if (txtarea.createTextRange) { 
      txtarea.caretPos = document.selection.createRange().duplicate();
    } 
  }

function Smile(what)
{
	//document.shoutform.text.value = document.gb.area.value + ' ' + what + ' ';
	//document.gb.area.focus();
	insertTag (document.formular.zprava,what);
	document.formular.zprava.focus();
}

function __formIsSending(){
	alert('Huš!...jednou by to snad stačilo ne?!');
	return false;
}

function __formDisMultipleClick(formObj){
	for (var i=0; i<formObj.length; i++ ){
        if (formObj.elements[i].type == 'submit' || formObj.elements[i].type == 'image'){
			formObj.elements[i].onclick = __formIsSending;
		}
	}
}
