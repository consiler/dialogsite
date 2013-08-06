<?php
/*
* 
*               .-://:-`       `:+oso+-`       `-://:-.                
*             -+ooooooo+:`   `+hdddddddh/    `/+ooooooo+.              
*            .ooooooooooo/   oddddddddddd/   +ooooooooooo.             
*            /oooooooooooo`  ddddddddddddy  `oooooooooooo:             
*            -ooooooooooo/   sddddddddddd+   +ooooooooooo.             
*             -+ooooooo+/`   `oddddddddh+`   `/oooooooo+-              
*              `.:///:-`       ./osyso:.       `-:///:.`               
*                                                                                                                                            
*                                                                      
*                     
* `+/:::::::/-`     :/                 -+                              
* `o:       `-+:    ``                 :o                              
* `o:         .o-   -:    `-::::::.    :o     `-:::::-`     `.:::::.`:.
* `o:          ++   /+   `+/`   `-+.   :o    :+-`  ``:+.   `//.`  `-/o-
* `o:          /o   /+   `.`  ```.o-   :o   .o.       :o`  /+       -o-
* `o:          +/   /+    .::::---o-   :o   :o        .o-  o:       .o-
* `o:         :o.   /+   /+.`    `o-   :o   -o.       -o`  /+       :o-
* `o:```````-//.    /+   /+`   `.:o:`  :o    :+.`   `-+-   `//.```.:/o-
* `//:::::::-.      ::   `:/::::-`-/-  -/     .::::::-`      .-:::-..o.
*                                                         ./`      :+` 
*                                                          -/:----//.  
*                                                            `....`   
*/
$libfiles = array('settings', 'dialog-setup', 'scripts-styles', 'widgets', 'paging-nav', 'entry-meta-date',
 'attached-image', 'get-link-url', 'body-class', 'content-width', 'template-wrapper', 'cpt');
$libdir = "lib/";
foreach($libfiles as $file) require_once(locate_template($libdir.$file.'.php'));