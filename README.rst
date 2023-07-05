YouTube Video Plugin (ng_fastyoutube)
=====================================

**TYPO3 Plugin that displays YouTube-videos faster by loading the video-player on demand while displaying a cacheable preview picture.**

System requirements
-------------------

- TYPO3 10.4 LTS, TYPO3 11.5 LTS

Features
--------

- Responsive
- Configurable video aspect ratio (16:9, 4:3)
- Single video or playlist
- Several on/off switches (show related videos, fullscreen, YouTube logo, video controls)
- DSGVO compliant two-click solution presenting YouTube`s privacy statement 

Installation
------------

-  Use composer with composer require phfr/ng_fastyoutube
-  _or_ install the extension through the Extension Manager

Usage
-----

Insert a regular Plug-In-Element on a page. Switch to "Plugin"-Tab and choose YouTubeVideo [ng_fastyoutube_pi] 
from "Selected Plugin"-list.

Configuration
-------------
Configuration can be done via the plugin-tab or TSconfig

**TSconfig-Example:**
::
    plugin.tx_ngfastyoutube {
        settings {
            # disables DSGVO compliant two-click solution
    	    display_privacy_statement = 1
         }
    }
    

**List of available properties:**

+---------------------------+---------------------------------------------+----------------------------------------+------------------+
| Property                  | Description                                 | Possible values                        | Default          |
+===========================+=============================================+========================================+==================+
| disable_branding          | disables 'YouTube'-player branding          | 0,1                                    | 0                |
+---------------------------+---------------------------------------------+----------------------------------------+------------------+
| disable_fullscreen        | disables players fullscreen switch          | 0,1                                    | 0                |
+---------------------------+---------------------------------------------+----------------------------------------+------------------+
| disable_privacy_statement | disables DSGVO compliant two-click solution | 0,1                                    | 0                |
+---------------------------+---------------------------------------------+----------------------------------------+------------------+
| hide_controls             | hides players control elements              | 0,1                                    | 0                |
+---------------------------+---------------------------------------------+----------------------------------------+------------------+
| max-pv-width              | width of the preview image (px)             | 120, 320, 480, 640, 1280               | 480              |
+---------------------------+---------------------------------------------+----------------------------------------+------------------+
| no_related_videos         | don't show related videos                   | 0,1                                    | 0                |
+---------------------------+---------------------------------------------+----------------------------------------+------------------+
| playlistID                | ID of a youtube playlist                    |                                        | none             |
+---------------------------+---------------------------------------------+----------------------------------------+------------------+
| video_format              | format of the preview picture               | 4:3,16:9                               | 16:9             |
+---------------------------+---------------------------------------------+----------------------------------------+------------------+
| video_quality             | video quality                               | small,medium,large,hd720,hd1080,hires  | none = automatic |
+---------------------------+---------------------------------------------+----------------------------------------+------------------+
| vidID                     | ID of a youtube video                       |                                        | none             |
+---------------------------+---------------------------------------------+----------------------------------------+------------------+

Sources
-------

-  `GitHub`_
-  `Packagist`_
-  `TER`_

.. _GitHub: https://github.com/nelsonglory/ng_fastyoutube
.. _Packagist: https://packagist.org/packages/phfr/ng_fastyoutube
.. _TER: https://extensions.typo3.org/extension/ng_fastyoutube/
