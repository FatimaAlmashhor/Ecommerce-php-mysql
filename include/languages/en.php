<?php
      function lang( $phrasa )
      {
          static $lang = array(
          
              'GATEGORAY'          => 'Category' ,
              'HOME'               => 'Home' ,
			  'ABOUT US'           => 'About Us',
			  'WACHING MACHINES'   => 'Waching machines',
			  'REFREGRATORS'       => 'Refregartors' ,
			  'OVENS'              => 'Ovens' ,
              'TVS'                => 'TVs' ,
			  'EDIT PROFILE'       => 'Edit Profile',
			  'SETTINGS'           => 'Settings',
			  'LOGOUT'             => 'LogOut' ,
			  'ADD NEW MEMBER'     => 'Add new Member',
			  'MEMBERS'            => 'Members',
              'ITEMS'              => 'Items'
           ) ;
          
          return $lang[ $phrasa ];
      }

?>