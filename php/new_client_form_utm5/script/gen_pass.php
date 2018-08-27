<?php
   $id = md5(uniqid(rand(),true));
   echo substr($id,8,8);