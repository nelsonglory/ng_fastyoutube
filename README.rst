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
```
plugin.tx_ngfastyoutube {
    settings {
    	display_privacy_statement = 1
     }
}
```
This setting disables the DSGVO compliant two-click solution.

***List of available properties:***
| Property | Description | Default |
| -------- | ----------- | ------- |


Sources
-------

-  `GitHub`_
-  `Packagist`_
-  `TER`_

.. _GitHub: https://github.com/nelsonglory/ng_fastyoutube
.. _Packagist: https://packagist.org/packages/phfr/ng_fastyoutube
.. _TER: https://extensions.typo3.org/extension/ng_fastyoutube/
