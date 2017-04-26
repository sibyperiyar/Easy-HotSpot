//Simple redirect function
function redirect_(url) {
    window.location = url;
}

//Determine if a value is present in an array
function is_value_in_array(value, arry) {
    for (var i=0; i<arry.length; i++) {
        if (arry[i] == value){
            return true;
        }
    }
    return false;
}

//Backbone of the modal
//Creates the basic layout and elements of the modal
//This is called by other wrapper function with necessary arguments
function BaseModal (title, message, type, redirect_url,
                    close_on_click, close_on_key, close_keys,
                    buttons) {

    //Actual close function
    var cModalClose = function () {
        cmodal.style.display = "none";
        //Redirect only if URL provided
        if (redirect_url != null) {
            redirect_(redirect_url);
        }
        //Implies the cancel/close button was pressed
        return 0;
    }
   
    //Close event trigger from other click events
    var cModalCloseTrigger = function (event) {
        if (close_on_click == true) {
            if ((event.target == cmodal) || (event.target == cclose)) {
                cModalClose();
            }
        }
    }
   
    //Capture keypress and check for exit keys (close_keys)
    var cModalKeypress = function (event) {
        if (close_on_key == true) {
            //Close only if the pressed key was being expected 
            if (is_value_in_array(event.keyCode,close_keys)) {
                cModalClose();
            }
        }
    }
    
    //Create base modal container div
    var cmodal = document.createElement("div");
    cmodal.className = "custom-modal";
    cmodal.onclick = cModalCloseTrigger;
    //Register keypress event callback
    window.onkeyup = cModalKeypress;
    
    //Add content div
    var ccontent = document.createElement("div");
    ccontent.className = "cmodal-content " + type;
    cmodal.appendChild(ccontent);
    
    //Add header div
    var cheader = document.createElement("div");
    cheader.className = "cmodal-header";
    ccontent.appendChild(cheader);
    
    //Add title-text and close-button;
    //Title text
    var ctitle = document.createElement("span");
    ctitle.className = "cmodal-title";
    ctitle.innerHTML = title;
    //Close button
    var cclose = document.createElement("button");
    cclose.className = "cmodal-close";
    cclose.innerHTML = "x";
    cclose.onclick = cModalClose;
    cheader.appendChild(ctitle);
    cheader.appendChild(cclose);
    
    //Add modal-body div
    var cbody = document.createElement("div");
    cbody.className = "cmodal-body";
    ccontent.appendChild(cbody);
    
    //Add message element to the modal body
    var cmessage = document.createElement("span");
    cmessage.className = "cmodal-message";
    cmessage.innerHTML = message;
    cbody.appendChild(cmessage);
    
    //Add icon after message
    var cicon = document.createElement("img");
    cicon.className = "cmodal-icon"
    cicon.src = "images/"+type+".png";
    cmessage.appendChild(cicon);
    
    //If this a dialog with buttons, the list "buttons" with
    //the buttons to be added to the modal will be provided
    if (buttons != []) {
        //Create footer 
        var cfooter = document.createElement("div");
        cfooter.className = "cmodal-footer";
        //Populate footer with buttons from the list
        //Set properties of buttons
        for (var i=0; i<buttons.length; i++) {
            var buttn = document.createElement("button");
            buttn.appendChild(document.createTextNode(buttons[i].text));
            buttn.id = i.toString();
            // Default close button
            if (buttons[i].action == "cmodalClose") {
                buttn.onclick = cModalClose;
                buttn.className = "cmodal-button";
                //Style button with default style if not provided
                if ("style" in buttons[i]) {
                    buttn.className = "cmodal-button " + buttons[i].style;
                }
			// JS function
			} else if ((buttons[i].action != "") && (typeof(buttons[i].action) == "function")) {
				buttn.className = "cmodal-button cmodal-ok";
                //The id of this button is its index in "buttons" list
                buttn.onclick = buttons[i].action;
                //Style button with default style if not provided
                if ("style" in buttons[i]) {
                    buttn.className = "cmodal-button " + buttons[i].style;
                }
            // Some URL
            } else if ((buttons[i].action != "") && (typeof(buttons[i].action) != "function")) {
                buttn.className = "cmodal-button cmodal-ok";
                //The id of this button is its index in "buttons" list
                buttn.onclick = function () {
                                redirect_(buttons[this.id].action);
                }
                //Style button with default style if not provided
                if ("style" in buttons[i]) {
                    buttn.className = "cmodal-button " + buttons[i].style;
                }
            // No action was specified. Just return the index of the button pressed
            } else {
                buttn.className = "cmodal-button cmodal-generic";
                buttn.onclick = function () {
                                return this.id;
                }
                //Style button with default style if not provided
                if ("style" in buttons[i]) {
                    buttn.className = "cmodal-button " + buttons[i].style;
                }
            }
            // Append button to the footer
            cfooter.appendChild(buttn);            
        }
        // Add footer to modal content. Happens only if buttons provided
        ccontent.appendChild(cfooter);
    }

    //Enable display of modal
    cmodal.style.display = "block";
    //Append cModal to the document
    document.body.appendChild(cmodal);
    ccontent.focus();
}

//Base modal function call skeleton for reference
//Update this if you change the argument list of BaseModal function
//BaseModal(title, message, type, redirect_url, close_on_click, close_on_key, close_keys, buttons)


//Usual modal dialog
function cmodal (title, message, type, redirect_url=null) {
    return BaseModal(title, message, type, redirect_url, close_on_click=true,
                        close_on_key=true, close_keys=[13,27], buttons=[]);
}

//Modal dialog with buttons
function cmodalOkCancel (title, message, type, buttons=[]) {
    return BaseModal(title, message, type, redirect_url=null, close_on_click=false,
                        close_on_key=true, close_keys=[27,], buttons=buttons);
}