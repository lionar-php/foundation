<?php

/**
 * Bind an abstract type that becomes a shared instance.
 * 
 * @param  string  $abstract 	The abstract type to register.
 * @param  Closure $concrete 	The concrete definition of the abstract type.
 * @return void
 */
function share ( $abstract, Closure $concrete )
{
	global $application; // defined in bootstrap/core providers/application.php
	$application->share ( $abstract, $concrete );
}

/**
 * Bind an abstract type that must be resolved every single time.
 * 
 * @param  string  $abstract 	The abstract type to register.
 * @param  Closure $concrete 	The concrete definition of the abstract type.
 * @return void
 */
function bind ( $abstract, Closure $concrete )
{
	global $application; // defined in bootstrap/core providers/application.php
	$application->bind ( $abstract, $concrete );
}

/**
 * Resolve an abstract type out of the application
 * 
 * @param  string $abstract 	The abstract type to resolve
 * @return mixed           		The resolved abstract type
 */
function make ( $abstract )
{
	global $application;
	return $application->make ( $abstract );
}

/**
 * Binding a request coupled to an action inside the container
 * 
 * @param  string $request 		A description of a request
 * @param  Closure $action  	An action to perform on the request
 *
 * @example   					when ( 'i want to see the dashboard', then ( apply ( a ( function ( dependency $dependency ) { do something here } ))));
 * @return void          
 */
function when ( $request, Closure $action )
{
	dd ( debug_backtrace ( ) );
	global $application; 	// defined in bootstrap/core providers/application.php
	$application->share ( $request, $action );
}

/**
 * The following functions don't actually do anything.
 * They are purely for readability purposes.
 */

function then ( $action )
{
	return $action;
}

function apply ( $action )
{
	return $action;
}

function a ( $action )
{
	return $action;
}