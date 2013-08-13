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
$libfiles = array(
  'settings',
  'dialog-setup',
  'scripts-styles',
  'widgets',
  'paging-nav',
  'entry-meta-date',
  'attached-image',
  'get-link-url',
  'body-class',
  'content-width',
  'wrapper',
  'cpt-content-admin-menu',
  'fieldset-taxonomy',
  'content-templates-taxonomy',
  'acf-mod',
  'cpt-renderer',
  'nav-walkers'
  );
$libdir = "lib/";
//Must be loaded in order.
foreach($libfiles as $file) require_once(locate_template($libdir.$file.'.php'));