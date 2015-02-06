<?php


function dunkdog_additional_user_contacts( $contactmethods ) {
  // Add Facebook
  if ( !isset( $contactmethods['facebook'] ) )
    $contactmethods['facebook'] = 'Facebook';

// Add Twitter
  if ( !isset( $contactmethods['twitter'] ) )
    $contactmethods['twitter'] = 'Twitter';

// Add Skype
  if ( !isset( $contactmethods['skype'] ) )
    $contactmethods['skype'] = 'Skype';

  // Remove Yahoo IM
  // if ( isset( $contactmethods['yim'] ) )
  //   unset( $contactmethods['yim'] );

  return $contactmethods;
}


add_filter( 'user_contactmethods', 'dunkdog_additional_user_contacts', 10, 1 );

?>