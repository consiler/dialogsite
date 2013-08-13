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
  'content-templates-taxonomy',
  'acf-mod',
  'cpt-renderer'
  );
$libdir = "lib/";
//Must be loaded in order.
foreach($libfiles as $file) require_once(locate_template($libdir.$file.'.php'));



class FooterWalker extends Walker_Nav_Menu {
  //eliminates line breaks between lis in the footer.
  //allows us to get around whitespace put between inline-blocks
  function end_el( &$output, $item, $depth = 0, $args = array() ) {
    $output .= "</li>";
  }
}
class HeaderWalker extends Walker_Nav_Menu {
  
}