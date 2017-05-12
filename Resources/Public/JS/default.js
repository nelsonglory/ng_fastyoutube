'use strict';
function r(f){/in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
r(function(){
    if (!document.getElementsByClassName) {
        // IE8 support
        var getElementsByClassName = function(node, classname) {
            var a = [];
            var re = new RegExp('(^| )'+classname+'( |$)');
            var els = node.getElementsByTagName("*");
            for(var i=0,j=els.length; i<j; i++)
                if(re.test(els[i].className))a.push(els[i]);
            return a;
        }
        var videos = getElementsByClassName(document.body,"fastyoutube");
    } else {
        var videos = document.getElementsByClassName("fastyoutube");
    }

    var nb_videos = videos.length;
    for (var i=0; i<nb_videos; i++) {
    	// choose resulution based preview image size
    	var re = /^(\d+)px$/;
    	var width = Number(re.exec(videos[i].style.width)[1]);

    	switch (true) {
    		case ( width <= 120): var prevpic = 'default.jpg';
    		break;
    		
    		case ( width <= 320): var prevpic = 'mqdefault.jpg';
    		break;
    		
    		case ( width <= 480): var prevpic = 'hqdefault.jpg';
    		break;
    		
    		case ( width > 480): var prevpic = 'sddefault.jpg';
    		break;
    	}
    	
        // Based on the YouTube ID, we can easily find the thumbnail image
        videos[i].style.backgroundImage = 'url(https://i.ytimg.com/vi/' + videos[i].id + '/' + prevpic + ')';
        // scale preview image
        videos[i].style.backgroundSize =  videos[i].style.width + ' ' + videos[i].style.height;
        // Overlay the Play icon to make it look like a video player
        var play = document.createElement("div");
        play.setAttribute("class","play");
        videos[i].appendChild(play);

        videos[i].onclick = function() {
            // Create an iFrame with autoplay set to true
            var iframe = document.createElement("iframe");
            var iframe_url = "https://www.youtube.com/embed/" + this.id + "?autoplay=1&autohide=1";
            if (this.getAttribute("data-params")) iframe_url+='&'+this.getAttribute("data-params");
            iframe.setAttribute("src",iframe_url);
            iframe.setAttribute("frameborder",'0');
            iframe.setAttribute("allowfullscreen",'1');

            // The height and width of the iFrame should be the same as parent
            iframe.style.width  = this.style.width;
            iframe.style.height = this.style.height;

            // Replace the YouTube thumbnail with YouTube Player
            this.parentNode.replaceChild(iframe, this);
        }
    }
});