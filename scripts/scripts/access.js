var added = false;

$(function() {
   
   // Register event listener for the alt key
   
   
   if(localStorage.getItem("dyslexic") == 'true') {
		document.body.classList.add("trigger");
	}
	

   
   hotkeys('f8,f9', function (event, handler){
      switch (handler.key) {
        case 'f8': toggleKeyCodes();
         break;
        case 'f9': changeFont();
         break;
       default: alert(event);
     }
   });
    
});



function toggleKeyCodes() {
   
   var currentKey = 'a';
   
   if(!added) {
      $(".access").each(function() {
         var template = Handlebars.compile($("#keyCodeTemplate").html());
			var appendString = template({id: currentKey.replace('+', '-'), name : currentKey});
         $(this).append(appendString);
         
         registerHandlerForPress(currentKey);
         
         currentKey = getNextKey(currentKey);
      });
      added = true;
   }
   else {
      added = false;
      $('.keyCode').each(function() {
         hotkeys.unbind(currentKey);
         currentKey = getNextKey(currentKey);
         this.remove();
      });
   }
}

function registerHandlerForPress(currentKey) {
   hotkeys(currentKey , function(event, handler) {
      switch(handler.key) {
         case currentKey:
            // console.log("Howdy : cntrl + " + currentKey);
            $('#cntrl' + currentKey.replace('+', '-')).click();
            $('#cntrl' + currentKey.replace('+', '-')).parent().click();
            break;
      }
   });
}


function getNextKey(currentKey) {
   // if(currentKey.slice(-1) == 'z') {
   //    currentKey = 'A';
   // }
   // else if(currentKey.length == 1){
      
   // }
   
   if(currentKey == 'z') {
      currentKey = 'shift+a';
   }
   else if(currentKey.length == 1){
      currentKey = String.fromCharCode(currentKey.charCodeAt(0) + 1);
   }
   else {
      console.log(currentKey.substr(0, currentKey.length - 1));
      console.log(String.fromCharCode(currentKey.charAt(currentKey.length - 1).charCodeAt(0) + 1));
      currentKey = currentKey.substr(0, currentKey.length - 1) + String.fromCharCode(currentKey.charAt(currentKey.length - 1).charCodeAt(0) + 1);
   }
   
   
   
   return currentKey;
}


function setAccess(id) {
   $(id).focus();
   $(id)[0].reset();
   console.log("run");
}

function changeFont(){
	var currentState = localStorage.getItem("dyslexic");

	if(currentState != 'true' && currentState != 'false') {
		currentState = 'true';
		localStorage.setItem("dyslexic", currentState);
	}
	else {
      if(currentState == 'true') {
         currentState = 'false';
      }
      else {
         currentState = 'true'
      }

		localStorage.setItem("dyslexic", currentState);
	}
	var x = document.getElementsByTagName("HTML")[0];
	document.body.classList.toggle("trigger");
	
};

