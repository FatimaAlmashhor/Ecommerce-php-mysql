<?php
      function lang( $phrasa )
      {
          static $lang = array(
          
              'GATEGORAY'          => 'ألاصناف' ,
              'HOME'               => 'الرئسية' ,
			  'ABOUT US'           => 'بشأننا',
			  'WACHING MACHINES'   => 'غسالات',
			  'REFREGRATORS'       => 'ثلاجات' ,
			  'OVENS'              =>  'طباخات' ,
			  'TVS'                => 'شاشات تلفاز'
          
          ) ;
          
          return $lang[ $phrasa ];
      }

?>