function toggle_object(post_id){   
    var obj = xGetElementById(post_id);   
    if(!obj) return;   
  
    if(obj.style.display=="none"){   
        obj.style.display='block';
        
    } else {   
        obj.style.display="none";  
		document.memoinput.title.focus();		
			
    }
	
}


function subject_to_content () {
	document.getElementById('postContent').value=document.getElementById('postTitle').value;
}


function iframe_autoresize(objFrame) {
	var newHeight = objFrame.contentWindow.document.body.scrollHeight;
	objFrame.height = newHeight;
}

