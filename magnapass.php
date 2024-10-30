<?php

/*
Plugin Name: MagnaPass
Description: Add the MagnaPass widget to your WordPress website
Version: 1.0
Author: MagnaPass
License: GPL2
*/

function magnapass_shortcode( $atts , $content = null )
{
    $atts = shortcode_atts(
        array(
            'host'      => '',
            'version'   => '',
            'partner'   => '',
            'container' => '',
            'debug'     => ''
        ),
        $atts,
        'magnapass'
    );

    $magnapass_host = $atts['host'];

    if ( empty( $magnapass_host ) )
    {
        $magnapass_host = 'https://www.magnapass.co.uk';
    }
 
    $magnapass_version = $atts['version'];
 
    if ( empty( $magnapass_version ) )
    {
        $magnapass_version = '20180701';
    }
 
    $magnapass_partner = $atts['partner'];
 
    if ( empty( $magnapass_partner ) )
    {
        $magnapass_partner = 'Please Enter your Partner ID';
    }
 
    $magnapass_container = $atts['container'];
 
    if ( empty( $magnapass_container ) )
    {
        $magnapass_container = '#magna';
    }
 
    $magnapass_debug = $atts['debug'];
 
    if ( empty( $magnapass_debug ) )
    {
        $magnapass_debug = 'false';
    }

    if ( empty( $atts['partner'] ) )
    {
        $output = '<p>Please Enter your Partner ID</p>'; 
    }
    else
    {
        if ( strpos( $magnapass_container, '#' ) !== false )
        {
            $magnapass_div = str_replace( "#", "", $magnapass_container );
            $output = "<div id='".$magnapass_div."'></div>";
        }
        elseif ( strpos( $magnapass_container, '.' ) !== false )
        {
            $magnapass_div = str_replace( ".", "", $magnapass_container );
            $output = "<div class='".$magnapass_div."'></div>";
        }
  
        $output .= "
<script>
(function(m,w,i,d,g,e,t) { 
m.magnaArgs={partner:g,container:e,host:i,debug:t};
var sc=w.createElement('script');sc.type='text/javascript';
sc.async=true;sc.setAttribute('crossorigin','anonymous');
sc.src=m.magnaArgs.host+'/widget/'+d+'.js'+'?p='+Math.random();
w.getElementsByTagName('head')[0].appendChild(sc);
})
(window,document, '$magnapass_host', $magnapass_version, '$magnapass_partner', '$magnapass_container', $magnapass_debug );
</script>";
    }
 
    return $output;
}

add_shortcode( 'magnapass', 'magnapass_shortcode' );
