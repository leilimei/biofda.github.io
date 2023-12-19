<?php
define( 'DISABLE_JETPACK_WAF', false );
if ( defined( 'DISABLE_JETPACK_WAF' ) && DISABLE_JETPACK_WAF ) return;
define( 'JETPACK_WAF_MODE', 'silent' );
define( 'JETPACK_WAF_SHARE_DATA', false );
define( 'JETPACK_WAF_DIR', '/www/wwwroot/biofda/wp-content/jetpack-waf' );
define( 'JETPACK_WAF_WPCONFIG', '/www/wwwroot/biofda/wp-content/../wp-config.php' );
require_once '/www/wwwroot/biofda/wp-content/plugins/jetpack/vendor/autoload.php';
Automattic\Jetpack\Waf\Waf_Runner::initialize();
