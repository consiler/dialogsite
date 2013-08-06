--------------------------------
About CPTs
--------------------------------
CPT refers to "Custom Post Type".

Definition: Custom Post Type

Custom Post Types are post templates. CPTs are not full page templates, but templates for repeating elements on the page.

To look at our entire nav structure as of the intial dev of the website go to lib/cpt.php and there will be a php array containing the full structure.


-----------------------------------------------------------------
Why the functions.php looks the way it does, and how to edit it
-----------------------------------------------------------------
The functions.php file has been split up into many sub php files that reside in the /lib folder. 

This is to make editing and organization of the functions.php file easier. 

If you want to include your own php file or library, save it to the /lib directory, and then add its name 
to the $libfiles array. Please keep in mind that order does matter, consider what resources/utilites your 
code needs to run and make sure they have loaded before your code include. 