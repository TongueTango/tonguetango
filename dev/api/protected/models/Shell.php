<?php 
/**
 * Utility class to run shell commands.
 * 
 * Abstract - do not try to instantiate, use statis methods
 * 
 * @author james
 */
abstract class Shell
{
	/**
	 * Container for active processes.
	 * @var array
	 */
	private static $_processes = array();

	/**
	 * Reference constants for pipes used.
	 */
	const PIPE_STDIN	= 0;
	const PIPE_STDOUT	= 1;
	const PIPE_STDERR	= 2;

	/**
	 * Execute a command and return the raw
	 * output from STDOUT and STDERR.
	 * 
	 * @param string $command
	 * @param string|null $pid
	 * @param bool $ignore_error
	 * @return string|bool
	 */
	public static function run_command($command, $pid=null, $ignore_error=false)
	{
		// Generate unique process id if not provided
		if( is_null($pid) ) {
			$pid = uniqid("PROCESS-", true);
		}
		// Output container
		$output	= '';
		// Result container
		$result	= true;
		// Will contain STDIN, STDOUT and STDERR references
		$pipes	= array();
		// Initialize external process
		$descriptors	= self::_get_descriptors();
		self::$_processes[$pid]	= proc_open($command, $descriptors, $pipes);
		if( !is_resource(self::$_processes[$pid]) ) {
			return false;
		}
		// Close STDIN
		fclose( $pipes[self::PIPE_STDIN] );
		// Toggle blocking status for STDOUT and STDERR
		stream_set_blocking( $pipes[self::PIPE_STDOUT], false );
		stream_set_blocking( $pipes[self::PIPE_STDERR], false );
		// Questionable while loop container
		while( true ) {
			$read	= array();
			if( !feof( $pipes[self::PIPE_STDOUT] ) ) {
				$read[self::PIPE_STDOUT]	= $pipes[self::PIPE_STDOUT];
			}
			if( !feof( $pipes[self::PIPE_STDERR] ) ) {
				$read[self::PIPE_STDERR]	= $pipes[self::PIPE_STDERR];
			}
			if( !$read ) {
				// Pipes both failed
				break;
			}
			$write	= null;
			$except	= null;
			$ready	= stream_select( $read, $write, $except, 2);
			if( !$ready ) {
				// Command failed
				break;
			}
			foreach( $read as $index => $pipe ) {
				if( $pipe === $pipes[self::PIPE_STDERR] ) {
					$result	= false;
				}
				$output	.= fread( $pipe, 1024);
			}
		}
		fclose( $pipes[1] );
		fclose( $pipes[2] );
		// Terminate the process and destroy local reference
		proc_close( self::$_processes[$pid] );
		unset( self::$_processes[$pid] );
		if( $result || $ignore_error ) {
			return $output;
		}
		Yii::log('Error encountered: '.$output, 'info', 'system.web.CController');
		return $result;
	}

	/**
	 * Returns an array of default descriptors for
	 * use with proc_open function.
	 * @return array
	 */
	private static function _get_descriptors()
	{
		return array(
			self::PIPE_STDIN	=> array("pipe", "r"),
			self::PIPE_STDOUT	=> array("pipe", "w"),
			self::PIPE_STDERR	=> array("pipe", "w"),
		);
	}
}