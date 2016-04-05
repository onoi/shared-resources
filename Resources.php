<?php

/**
 * @codeCoverageIgnore
 * @since 0.1
 *
 * @license GNU GPL v2+
 * @author mwjames
 */

if ( defined( 'ONOI_SHARED_RESOURCES_VERSION' ) ) {
	return 1;
}

define( 'ONOI_SHARED_RESOURCES_VERSION', '0.1' );

if ( defined( 'MEDIAWIKI' ) ) {

	$GLOBALS['wgResourceModules']['onoi.md5'] = array(
		'localBasePath' => __DIR__ ,
		'remoteExtPath' => '../vendor/onoi/shared-resources',
		'position' => 'bottom',
		'scripts' => array(
			'res/md5/md5.js'
		),
		'targets' => array(
			'mobile',
			'desktop'
		)
	);

	$GLOBALS['wgResourceModules']['onoi.blockUI'] = array(
		'localBasePath' => __DIR__ ,
		'remoteExtPath' => '../vendor/onoi/shared-resources',
		'position' => 'bottom',
		'scripts' => array(
			'res/jquery.blockUI/jquery.blockUI.js'
		),
		'targets' => array(
			'mobile',
			'desktop'
		)
	);

	$GLOBALS['wgResourceModules']['onoi.rangeslider'] = array(
		'localBasePath' => __DIR__ ,
		'remoteExtPath' => '../vendor/onoi/shared-resources',
		'position' => 'bottom',
		'styles' => array(
			'res/jquery.rangeSlider/ion.rangeSlider.css',
			'res/jquery.rangeSlider/ion.rangeSlider.skinFlat.css'
		),
		'scripts' => array(
			'res/jquery.rangeSlider/ion.rangeSlider.js'
		),
		'targets' => array(
			'mobile',
			'desktop'
		)
	);

	$GLOBALS['wgResourceModules']['onoi.localForage'] = array(
		'localBasePath' => __DIR__ ,
		'remoteExtPath' => '../vendor/onoi/shared-resources',
		'position' => 'bottom',
		'scripts' => array(
			'res/localForage/localforage.min.js'
		),
		'targets' => array(
			'mobile',
			'desktop'
		)
	);

	$GLOBALS['wgResourceModules']['onoi.blobstore'] = array(
		'localBasePath' => __DIR__ ,
		'remoteExtPath' => '../vendor/onoi/shared-resources',
		'position' => 'bottom',
		'scripts' => array(
			'res/onoi.blobstore.js'
		),
		'dependencies'  => array(
			'onoi.localForage',
		),
		'targets' => array(
			'mobile',
			'desktop'
		)
	);

	$GLOBALS['wgResourceModules']['onoi.async'] = array(
		'localBasePath' => __DIR__ ,
		'remoteExtPath' => '../vendor/onoi/shared-resources',
		'position' => 'bottom',
		'scripts' => array(
			'res/jquery.async/jquery.async.js'
		),
		'targets' => array(
			'mobile',
			'desktop'
		)
	);

	$GLOBALS['wgResourceModules']['onoi.jstorage'] = array(
		'localBasePath' => __DIR__ ,
		'remoteExtPath' => '../vendor/onoi/shared-resources',
		'position' => 'bottom',
		'scripts' => array(
			'res/jStorage/jstorage.js'
		),
		'targets' => array(
			'mobile',
			'desktop'
		)
	);
}
