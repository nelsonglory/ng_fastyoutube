'use strict';
function ng_fastyoutube(f){/in/.test(document.readyState)?setTimeout('ng_fastyoutube('+f+')',9):f()}
ng_fastyoutube(function(){
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
        // get width or use max possible
        var width = videos[i].offsetWidth;
    	
        // create new tags & assemble
        var figure = document.createElement("figure");
        var picture = document.createElement("picture");
        var img = document.createElement("img");
        var play = document.createElement("div");

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
        var imglnk = 'https://i.ytimg.com/vi/' + videos[i].id;
        var maxPVwidth = Number(videos[i].getAttribute("max-pv-width"));
        var pvurl;
         
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
                    var source = document.createElement("source");
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
        
        videos[i].onclick = function() {
            // Create an iframe with autoplay set to true
            var video = document.createElement("div");
            video.setAttribute("class", "responsive-video");
            var iframe = document.createElement("iframe");
            var iframe_url = "https://www.youtube-nocookie.com/embed/" + this.id + "?autoplay=1&autohide=1";
            if (this.getAttribute("data-params")) iframe_url+='&'+this.getAttribute("data-params");
            iframe.setAttribute("src",iframe_url);
            iframe.setAttribute("frameborder",'0');
            iframe.setAttribute("allowfullscreen",'1');

            video.appendChild(iframe);
            // Replace the YouTube thumbnail with YouTube Player
            this.parentNode.replaceChild(video, this);
        }
    }
});
