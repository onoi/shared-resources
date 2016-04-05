/**
 * Simple storage engine with time eviction
 *
 * @license GNU GPL v2+
 * @since 0.1
 *
 * @author mwjames
 */

/*global jQuery */
/*jslint white: true */

( function( $ ) {

	'use strict';

	/**
	 * @since  1.0
	 * @constructor
	 *
	 * @param namespace {string}
	 */
	var FORAGE = function ( namespace ) {

		this.exception = function StorageException( message ) {
			this.message = message;
			this.name = "StorageException";
		}

		if ( namespace === undefined || namespace.indexOf( ':' ) < 0 ) {
			throw new this.exception( "Invalid storage name of '" + namespace + "' ." );
		};

		var array = namespace.split( ':' );

		localforage.config( {
		    name: array.shift(),
		    storeName: array.join( ':' )
		} );

		this.namespace = namespace;
		this.hasForage = typeof( localforage ) !== "undefined";
	};

	/**
	 * @since  1.0
	 *
	 * @param key {string}
	 * @param value {string}
	 * @param ttl {integer}
	 *
	 * @return boolean
	 */
	FORAGE.prototype.set = function( key, value, ttl ) {

		if( !this.hasForage ) {
			return false;
		}

		var now = new Date(),
		item = {
			ttl   : ( ttl * 1000 ) || 0, // in seconds
			time  : now.getTime(),
			value : value
		};

		localforage.setItem( key, item , function( err, value ) {} );
	};

	/**
	 * @since  1.0
	 *
	 * @param key {string}
	 * @param callback {Object}
	 *
	 * @return null|mixed
	 */
	FORAGE.prototype.get = function( key, callback ) {

		if ( typeof callback !== "function" ) {
			throw new this.exception( "Expected a function as callback." );
		};

		if( !this.hasForage ) {
			return callback( null );
		}

		localforage.getItem( key, function( err, value ) {

			var item = value,
				now = new Date();

			if ( item === null ) {
				return callback( null );
			};

			if ( item.ttl && item.ttl + item.time < now.getTime() ) {
				localforage.removeItem( key );
				return callback( null );
			}

			callback( item.value );
		} );

		return null;
	};

	/**
	 * @since  1.0
	 * @constructor
	 *
	 * @param namespace {string}
	 * @param engine {string}
	 *
	 * @return {this}
	 */
	var blobstore = function ( namespace, engine ) {

		this.VERSION = 1;

		this.namespace = namespace;
		this.engine = engine;

		if ( this.engine === '' || this.engine === undefined ) {
			this.engine = new FORAGE( namespace );
		}

		return this;
	};

	/**
	 * @since  1.0
	 *
	 * @param key {string}
	 * @param value {string}
	 * @param ttl {integer}
	 */
	blobstore.prototype.set = function( key, value, ttl ) {
		this.engine.set( key, value, ttl );
	};

	/**
	 * @since  1.0
	 *
	 * @param key {string}
	 * @param callback {Object}
	 *
	 * @return null|mixed
	 */
	blobstore.prototype.get = function( key, callback ) {
		return this.engine.get( key, callback );
	};

	window.onoi = window.onoi || {};
	window.onoi.blobstore = blobstore;

}( jQuery ) );
