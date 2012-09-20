<?php
/**
 * Utility class to convert audio to compatible format for
 * posting to facebook wall.
 * 
 * Abstract - do not try to instantiate, use statis methods
 * 
 * @author james
 */
abstract class Converter
{
	/**
	 * General definition of FFMPEG command line used.
	 * @var string
	 */
	private static $_ffmpeg_command	= 'ffmpeg -loop_input -shortest -y -i %1$s -i %2$s -r 1 %3$s';

	/**
	 * General definition of FFMPEG audio command line
	 * used for audio only conversion.
	 * @var string
	 */
	private static $_ffmpeg_audio	= 'ffmpeg -vn -i %1$s -acodec %2$s -ar 16000 -ac 1 %3$s';

	/**
	 * Convert a file to AVI format and return the resulting
	 * file path.
	 * 
	 * @param string $file_uri
	 * @return string|bool
	 */
	public static function convert_to_avi($file_uri)
	{
		$placeholder_image	= APPPATH.'../public/assets/images/video_placeholder.png';
		$output_filename	= APPPATH.'cache/'.microtime(true).'.avi';
		$convert_command	= sprintf(
			self::$_ffmpeg_command,
			$placeholder_image,
			$file_uri,
			$output_filename
		);
		Yii::log('Running command: '.$convert_command, 'info', 'system.web.CController');
		$result	= Shell::run_command($convert_command, null, true);
		if( $result ) {
			return $output_filename;
		}
		return $result;
	}

	/**
	 * Convert a file to FLV format and return the resulting
	 * file path.
	 * 
	 * @param string $file_uri
	 * @return string|bool
	 */
	public static function convert_to_flv($file_uri)
	{
		$placeholder_image	= APPPATH.'../public/assets/images/video_placeholder.png';
		$output_filename	= APPPATH.'cache/'.microtime(true).'.flv';
		$convert_command	= sprintf(
			self::$_ffmpeg_command,
			$placeholder_image,
			$file_uri,
			$output_filename
		);
		Yii::log('Running command: '.$convert_command, 'info', 'system.web.CController');
		$result	= Shell::run_command($convert_command, null, true);
		if( $result ) {
			return $output_filename;
		}
		return $result;
	}

	/**
	 * Convert a file to MP4 format and return the resulting
	 * file path.
	 * 
	 * @param string $file_uri
	 * @return string|bool
	 */
	public static function convert_to_mp4($file_uri)
	{
		$placeholder_image	= APPPATH.'../public/assets/images/video_placeholder.png';
		$output_filename	= APPPATH.'cache/'.microtime(true).'.mp4';
		$convert_command	= sprintf(
			self::$_ffmpeg_command,
			$placeholder_image,
			$file_uri,
			$output_filename
		);
		Yii::log('Running command: '.$convert_command, 'info', 'system.web.CController');
		$result	= Shell::run_command($convert_command, null, true);
		if( $result ) {
			return $output_filename;
		}
		return $result;
	}

	/**
	 * Convert a file to MP3 format and return the resulting
	 * file path.
	 *
	 * @param string $file_uri
	 * @return string|bool
	 */
	public static function convert_to_audio_mp3($file_uri)
	{
		$placeholder_image      = APPPATH.'../public/assets/images/video_placeholder.png';
		$output_filename        = APPPATH.'cache/'.microtime(true).'.mp3';
		$convert_command        = sprintf(
			self::$_ffmpeg_audio,
			$file_uri,
			'libmp3lame',
			$output_filename
		);
		Yii::log('Running command: '.$convert_command, 'info', 'system.web.CController');
		$result = Shell::run_command($convert_command, null, true);
		if( $result ) {
			return $output_filename;
		}
		return $result;
	}

	/**
	 * Convert a file to MP3 format and return the resulting
	 * file path.
	 *
	 * @param string $file_uri
	 * @return string|bool
	 */
	public static function convert_to_audio_ogg($file_uri)
	{
		$placeholder_image      = APPPATH.'../public/assets/images/video_placeholder.png';
		$output_filename        = APPPATH.'cache/'.microtime(true).'.ogg';
		$convert_command        = sprintf(
			self::$_ffmpeg_audio,
			$file_uri,
			'vorbis',
			$output_filename
		);
		Yii::log('Running command: '.$convert_command, 'info', 'system.web.CController');
		$result = Shell::run_command($convert_command, null, true);
		if( $result ) {
			return $output_filename;
		}
		return $result;
	}
}
