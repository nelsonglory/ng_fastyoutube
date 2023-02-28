'use strict';
var ngfastyoutube = {
	activateAllVideos: function(checkitem) {
		this.setCookie('activate_youtube_videos', (checkitem.checked ? 1 : 0) , 1);
	},
	setCookie: function(cname, cvalue, exdays) {
		const d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		let expires = "expires="+ d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/;" + "SameSite=Strict";
	},
	getCookie: function(cname) {
		let name = cname + "=";
		let decodedCookie = decodeURIComponent(document.cookie);
		let ca = decodedCookie.split(';');
		for(let i = 0; i <ca.length; i++) {
 			let c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
    		}
    		if (c.indexOf(name) == 0) {
      			return c.substring(name.length, c.length);
    		}
  		}
  		return "";
	},
	replacePlaceholderWithVideo: function(vidEle) {
		let agreement = document.getElementById('agreement_' + vidEle.id);
		if (agreement) {
			// remove agreement
			vidEle.removeChild(agreement);
		}
		// remove play button	
		vidEle.removeChild(vidEle.firstChild);
				
		// Create an iframe with autoplay set to true
    	let video = document.createElement("div");
    	video.setAttribute("class", "responsive-video");
    	let iframe = document.createElement("iframe");
    	let iframe_url = "https://www.youtube-nocookie.com/embed/" + vidEle.id + "?autoplay=1&autohide=1";
    	if (vidEle.getAttribute("data-params")) iframe_url+='&'+vidEle.getAttribute("data-params");
    	iframe.setAttribute("src",iframe_url);
    	iframe.setAttribute("frameborder",'0');
    	iframe.setAttribute("allowfullscreen",'1');

    	video.appendChild(iframe);
  		// replace figure with video
    	vidEle.replaceChild(video, vidEle.firstChild);
	},
}
function showYoutubePreviews(f){/in/.test(document.readyState)?setTimeout('showYoutubePreviews('+f+')',9):f()}

showYoutubePreviews(function(){
    if (!document.getElementsByClassName) {
        // IE8 support
        var getElementsyClassName = function(node, classname) {
            let a = [];
            let re = new RegExp('(^| )'+classname+'( |$)');
            let els = node.getElementsByTagName("*");
            for(let i=0,j=els.length; i<j; i++)
                if(re.test(els[i].className))a.push(els[i]);
            return a;
        }
        var videos = getElementsByClassName(document.body,"fastyoutube");
    } else {
        var videos = document.getElementsByClassName("fastyoutube");
    }

    let nb_videos = videos.length;
    for (let i=0; i<nb_videos; i++) {
        // get width or use max possible
        let width = videos[i].offsetWidth;
    	
        // create new tags & assemble
        let figure = document.createElement("figure");
        let picture = document.createElement("picture");
        let img = document.createElement("img");
        let play = document.createElement("div");

    	// define preview images
        let preview = [
            {120 : 'default.jpg'},
            {320 : 'mqdefault.jpg'},
            {480 : 'hqdefault.jpg'},
            {640 : 'sddefault.jpg'},
            {1280 : 'maxresdefault.jpg'}
        ];
        
        // assemble source
        // url to prev image
        let imglnk = 'https://i.ytimg.com/vi/' + videos[i].id;
        let maxPVwidth = Number(videos[i].getAttribute("max-pv-width"));
        let pvurl;
         
        // reverse array for correct ordering
        preview.reverse().forEach(function(item, index, array) {
            let res;
            for (res in item) {
                // check max width setting
                if (res <= maxPVwidth) {
                    // set max prev image (old browser support)
                    if (res == maxPVwidth) {
                        pvurl = imglnk + '/' + item[res];
                    }
                    let source = document.createElement("source");
                    source.setAttribute("srcset", imglnk + '/' + item[res]);
                    source.setAttribute("media", '(min-width: ' + res + 'px)');
                    picture.appendChild(source);
                }
            }
        });
        
        // old browser support
        // assemble img
        img.setAttribute("src", pvurl);
        // append img
        picture.appendChild(img);
        
        // Overlay the Play icon to make it look like a video player
        play.setAttribute("class","play");
        
        // assemble figure
        // set class according to given video format 
        if (videos[i].getAttribute("format") && videos[i].getAttribute("format") == '16:9') {
            figure.setAttribute("class","sixteen-nine-img");
        } else {
            figure.setAttribute("class","four-three-img");
        }
        figure.appendChild(picture);
        
        // merge
        videos[i].appendChild(play);
        videos[i].appendChild(figure);
		
		// copy element
		let vidEle = videos[i];
		// agreement needed ?
		let agreement = document.getElementById('agreement_' + vidEle.id);
		if (agreement) {
			vidEle.addEventListener('click', function toggleAgreement() {
				if (ngfastyoutube.getCookie('activate_youtube_videos') != 1) {		
					agreement.style.display = 'block'; 
				} else {
					ngfastyoutube.replacePlaceholderWithVideo(vidEle);
				}
				this.removeEventListener('click', toggleAgreement, true);
			}, true);
			 // agree button
			let agreeBtn = document.getElementById('agree_' + vidEle.id);
			agreeBtn.addEventListener('click', function() {
				ngfastyoutube.replacePlaceholderWithVideo(vidEle);
			});
			// disagree button
			let disagreeBtn = document.getElementById('disagree_' + vidEle.id);
			disagreeBtn.addEventListener('click', function() {
				agreement.style.display = 'none';
				vidEle.addEventListener('click', function() {
					agreement.style.display = 'block'; 
				}, true);				
			}, true);		
		} else {
			vidEle.addEventListener('click', function() {
				ngfastyoutube.replacePlaceholderWithVideo(vidEle);
			});
		}	
    }
});