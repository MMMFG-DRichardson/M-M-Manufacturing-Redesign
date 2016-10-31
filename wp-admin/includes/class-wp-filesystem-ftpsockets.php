<?php
/**
 * WordPress FTP Sockets Filesystem.
 *
 * @package WordPress
 * @subpackage Filesystem
 */

/**
 * WordPress Filesystem Class for implementing FTP Sockets.
 *
 * @since 2.5.0
 * @package WordPress
 * @subpackage Filesystem
 * @uses WP_Filesystem_Base Extends class
 */
class WP_Filesystem_ftpsockets extends WP_Filesystem_Base {
	/**
<<<<<<< HEAD
	 * @access public
=======
>>>>>>> origin/master
	 * @var ftp
	 */
	public $ftp;

<<<<<<< HEAD
	/**
	 * @access public
	 *
	 * @param array $opt
	 */
	public function __construct( $opt  = '' ) {
=======
	public function __construct($opt = '') {
>>>>>>> origin/master
		$this->method = 'ftpsockets';
		$this->errors = new WP_Error();

		// Check if possible to use ftp functions.
		if ( ! @include_once( ABSPATH . 'wp-admin/includes/class-ftp.php' ) ) {
			return;
		}
		$this->ftp = new ftp();

		if ( empty($opt['port']) )
			$this->options['port'] = 21;
		else
<<<<<<< HEAD
			$this->options['port'] = (int) $opt['port'];
=======
			$this->options['port'] = $opt['port'];
>>>>>>> origin/master

		if ( empty($opt['hostname']) )
			$this->errors->add('empty_hostname', __('FTP hostname is required'));
		else
			$this->options['hostname'] = $opt['hostname'];

		// Check if the options provided are OK.
		if ( empty ($opt['username']) )
			$this->errors->add('empty_username', __('FTP username is required'));
		else
			$this->options['username'] = $opt['username'];

		if ( empty ($opt['password']) )
			$this->errors->add('empty_password', __('FTP password is required'));
		else
			$this->options['password'] = $opt['password'];
	}

<<<<<<< HEAD
	/**
	 * @access public
	 *
	 * @return bool
	 */
=======
>>>>>>> origin/master
	public function connect() {
		if ( ! $this->ftp )
			return false;

		$this->ftp->setTimeout(FS_CONNECT_TIMEOUT);

<<<<<<< HEAD
		if ( ! $this->ftp->SetServer( $this->options['hostname'], $this->options['port'] ) ) {
			$this->errors->add( 'connect',
				/* translators: %s: hostname:port */
				sprintf( __( 'Failed to connect to FTP Server %s' ),
					$this->options['hostname'] . ':' . $this->options['port']
				)
			);
=======
		if ( ! $this->ftp->SetServer($this->options['hostname'], $this->options['port']) ) {
			$this->errors->add('connect', sprintf(__('Failed to connect to FTP Server %1$s:%2$s'), $this->options['hostname'], $this->options['port']));
>>>>>>> origin/master
			return false;
		}

		if ( ! $this->ftp->connect() ) {
<<<<<<< HEAD
			$this->errors->add( 'connect',
				/* translators: %s: hostname:port */
				sprintf( __( 'Failed to connect to FTP Server %s' ),
					$this->options['hostname'] . ':' . $this->options['port']
				)
			);
			return false;
		}

		if ( ! $this->ftp->login( $this->options['username'], $this->options['password'] ) ) {
			$this->errors->add( 'auth',
				/* translators: %s: username */
				sprintf( __( 'Username/Password incorrect for %s' ),
					$this->options['username']
				)
			);
=======
			$this->errors->add('connect', sprintf(__('Failed to connect to FTP Server %1$s:%2$s'), $this->options['hostname'], $this->options['port']));
			return false;
		}

		if ( ! $this->ftp->login($this->options['username'], $this->options['password']) ) {
			$this->errors->add('auth', sprintf(__('Username/Password incorrect for %s'), $this->options['username']));
>>>>>>> origin/master
			return false;
		}

		$this->ftp->SetType( FTP_BINARY );
		$this->ftp->Passive( true );
		$this->ftp->setTimeout( FS_TIMEOUT );
		return true;
	}

	/**
<<<<<<< HEAD
	 * Retrieves the file contents.
	 *
	 * @since 2.5.0
	 * @access public
	 *
	 * @param string $file Filename.
	 * @return string|false File contents on success, false if no temp file could be opened,
	 *                      or if the file doesn't exist.
=======
	 * @param string $file
	 * @return false|string
>>>>>>> origin/master
	 */
	public function get_contents( $file ) {
		if ( ! $this->exists($file) )
			return false;

		$temp = wp_tempnam( $file );

<<<<<<< HEAD
		if ( ! $temphandle = fopen( $temp, 'w+' ) ) {
			unlink( $temp );
			return false;
		}
=======
		if ( ! $temphandle = fopen($temp, 'w+') )
			return false;
>>>>>>> origin/master

		mbstring_binary_safe_encoding();

		if ( ! $this->ftp->fget($temphandle, $file) ) {
			fclose($temphandle);
			unlink($temp);

			reset_mbstring_encoding();

			return ''; // Blank document, File does exist, It's just blank.
		}

		reset_mbstring_encoding();

		fseek( $temphandle, 0 ); // Skip back to the start of the file being written to
		$contents = '';

		while ( ! feof($temphandle) )
			$contents .= fread($temphandle, 8192);

		fclose($temphandle);
		unlink($temp);
		return $contents;
	}
<<<<<<< HEAD

	/**
	 * @access public
	 *
=======
	/**
>>>>>>> origin/master
	 * @param string $file
	 * @return array
	 */
	public function get_contents_array($file) {
		return explode("\n", $this->get_contents($file) );
	}

	/**
<<<<<<< HEAD
	 * @access public
	 *
=======
>>>>>>> origin/master
	 * @param string $file
	 * @param string $contents
	 * @param int|bool $mode
	 * @return bool
	 */
	public function put_contents($file, $contents, $mode = false ) {
		$temp = wp_tempnam( $file );
		if ( ! $temphandle = @fopen($temp, 'w+') ) {
			unlink($temp);
			return false;
		}

		// The FTP class uses string functions internally during file download/upload
		mbstring_binary_safe_encoding();

		$bytes_written = fwrite( $temphandle, $contents );
		if ( false === $bytes_written || $bytes_written != strlen( $contents ) ) {
			fclose( $temphandle );
			unlink( $temp );

			reset_mbstring_encoding();

			return false;
		}

		fseek( $temphandle, 0 ); // Skip back to the start of the file being written to

		$ret = $this->ftp->fput($file, $temphandle);

		reset_mbstring_encoding();

		fclose($temphandle);
		unlink($temp);

		$this->chmod($file, $mode);

		return $ret;
	}

<<<<<<< HEAD
	/**
	 * @access public
	 *
	 * @return string
	 */
=======
>>>>>>> origin/master
	public function cwd() {
		$cwd = $this->ftp->pwd();
		if ( $cwd )
			$cwd = trailingslashit($cwd);
		return $cwd;
	}

<<<<<<< HEAD
	/**
	 * @access public
	 *
	 * @param string $file
	 * @return bool
	 */
=======
>>>>>>> origin/master
	public function chdir($file) {
		return $this->ftp->chdir($file);
	}

	/**
<<<<<<< HEAD
	 * @access public
	 *
=======
>>>>>>> origin/master
	 * @param string $file
	 * @param int|bool $mode
	 * @param bool $recursive
	 * @return bool
	 */
	public function chmod($file, $mode = false, $recursive = false ) {
		if ( ! $mode ) {
			if ( $this->is_file($file) )
				$mode = FS_CHMOD_FILE;
			elseif ( $this->is_dir($file) )
				$mode = FS_CHMOD_DIR;
			else
				return false;
		}

		// chmod any sub-objects if recursive.
		if ( $recursive && $this->is_dir($file) ) {
			$filelist = $this->dirlist($file);
			foreach ( (array)$filelist as $filename => $filemeta )
				$this->chmod($file . '/' . $filename, $mode, $recursive);
		}

		// chmod the file or directory
		return $this->ftp->chmod($file, $mode);
	}

	/**
<<<<<<< HEAD
	 * @access public
	 *
=======
>>>>>>> origin/master
	 * @param string $file
	 * @return string
	 */
	public function owner($file) {
		$dir = $this->dirlist($file);
		return $dir[$file]['owner'];
	}
<<<<<<< HEAD

	/**
	 * @access public
	 *
=======
	/**
>>>>>>> origin/master
	 * @param string $file
	 * @return string
	 */
	public function getchmod($file) {
		$dir = $this->dirlist($file);
		return $dir[$file]['permsn'];
	}
<<<<<<< HEAD

	/**
	 * @access public
	 *
=======
	/**
>>>>>>> origin/master
	 * @param string $file
	 * @return string
	 */
	public function group($file) {
		$dir = $this->dirlist($file);
		return $dir[$file]['group'];
	}
<<<<<<< HEAD

	/**
	 * @access public
	 *
	 * @param string   $source
	 * @param string   $destination
	 * @param bool     $overwrite
=======
	/**
	 * @param string $source
	 * @param string $destination
	 * @param bool $overwrite
>>>>>>> origin/master
	 * @param int|bool $mode
	 * @return bool
	 */
	public function copy($source, $destination, $overwrite = false, $mode = false) {
		if ( ! $overwrite && $this->exists($destination) )
			return false;

		$content = $this->get_contents($source);
		if ( false === $content )
			return false;

		return $this->put_contents($destination, $content, $mode);
	}
<<<<<<< HEAD

	/**
	 * @access public
	 *
	 * @param string $source
	 * @param string $destination
	 * @param bool   $overwrite
=======
	/**
	 * @param string $source
	 * @param string $destination
	 * @param bool $overwrite
>>>>>>> origin/master
	 * @return bool
	 */
	public function move($source, $destination, $overwrite = false ) {
		return $this->ftp->rename($source, $destination);
	}
<<<<<<< HEAD

	/**
	 * @access public
	 *
	 * @param string $file
	 * @param bool   $recursive
=======
	/**
	 * @param string $file
	 * @param bool $recursive
>>>>>>> origin/master
	 * @param string $type
	 * @return bool
	 */
	public function delete($file, $recursive = false, $type = false) {
		if ( empty($file) )
			return false;
		if ( 'f' == $type || $this->is_file($file) )
			return $this->ftp->delete($file);
		if ( !$recursive )
			return $this->ftp->rmdir($file);

		return $this->ftp->mdel($file);
	}

	/**
<<<<<<< HEAD
	 * @access public
	 *
=======
>>>>>>> origin/master
	 * @param string $file
	 * @return bool
	 */
	public function exists( $file ) {
		$list = $this->ftp->nlist( $file );

		if ( empty( $list ) && $this->is_dir( $file ) ) {
			return true; // File is an empty directory.
		}

		return !empty( $list ); //empty list = no file, so invert.
		// Return $this->ftp->is_exists($file); has issues with ABOR+426 responses on the ncFTPd server.
	}

	/**
<<<<<<< HEAD
	 * @access public
	 *
=======
>>>>>>> origin/master
	 * @param string $file
	 * @return bool
	 */
	public function is_file($file) {
		if ( $this->is_dir($file) )
			return false;
		if ( $this->exists($file) )
			return true;
		return false;
	}

	/**
<<<<<<< HEAD
	 * @access public
	 *
=======
>>>>>>> origin/master
	 * @param string $path
	 * @return bool
	 */
	public function is_dir($path) {
		$cwd = $this->cwd();
		if ( $this->chdir($path) ) {
			$this->chdir($cwd);
			return true;
		}
		return false;
	}

	/**
<<<<<<< HEAD
	 * @access public
	 *
=======
>>>>>>> origin/master
	 * @param string $file
	 * @return bool
	 */
	public function is_readable($file) {
		return true;
	}

	/**
<<<<<<< HEAD
	 * @access public
	 *
=======
>>>>>>> origin/master
	 * @param string $file
	 * @return bool
	 */
	public function is_writable($file) {
		return true;
	}

	/**
<<<<<<< HEAD
	 * @access public
	 *
=======
>>>>>>> origin/master
	 * @param string $file
	 * @return bool
	 */
	public function atime($file) {
		return false;
	}

	/**
<<<<<<< HEAD
	 * @access public
	 *
=======
>>>>>>> origin/master
	 * @param string $file
	 * @return int
	 */
	public function mtime($file) {
		return $this->ftp->mdtm($file);
	}

	/**
	 * @param string $file
	 * @return int
	 */
	public function size($file) {
		return $this->ftp->filesize($file);
	}
<<<<<<< HEAD

	/**
	 * @access public
	 *
=======
	/**
>>>>>>> origin/master
	 * @param string $file
	 * @param int $time
	 * @param int $atime
	 * @return bool
	 */
	public function touch($file, $time = 0, $atime = 0 ) {
		return false;
	}

	/**
<<<<<<< HEAD
	 * @access public
	 *
	 * @param string $path
	 * @param mixed  $chmod
	 * @param mixed  $chown
	 * @param mixed  $chgrp
=======
	 * @param string $path
	 * @param mixed $chmod
	 * @param mixed $chown
	 * @param mixed $chgrp
>>>>>>> origin/master
	 * @return bool
	 */
	public function mkdir($path, $chmod = false, $chown = false, $chgrp = false ) {
		$path = untrailingslashit($path);
		if ( empty($path) )
			return false;

		if ( ! $this->ftp->mkdir($path) )
			return false;
		if ( ! $chmod )
			$chmod = FS_CHMOD_DIR;
		$this->chmod($path, $chmod);
		return true;
	}

	/**
<<<<<<< HEAD
	 * @access public
	 *
	 * @param string $path
=======
	 * @param sting $path
>>>>>>> origin/master
	 * @param bool $recursive
	 */
	public function rmdir($path, $recursive = false ) {
		$this->delete($path, $recursive);
	}

	/**
<<<<<<< HEAD
	 * @access public
	 *
	 * @param string $path
	 * @param bool   $include_hidden
	 * @param bool   $recursive
=======
	 * @param string $path
	 * @param bool $include_hidden
	 * @param bool $recursive
>>>>>>> origin/master
	 * @return bool|array
	 */
	public function dirlist($path = '.', $include_hidden = true, $recursive = false ) {
		if ( $this->is_file($path) ) {
			$limit_file = basename($path);
			$path = dirname($path) . '/';
		} else {
			$limit_file = false;
		}

		mbstring_binary_safe_encoding();

		$list = $this->ftp->dirlist($path);
		if ( empty( $list ) && ! $this->exists( $path ) ) {

			reset_mbstring_encoding();

			return false;
		}

		$ret = array();
		foreach ( $list as $struc ) {

			if ( '.' == $struc['name'] || '..' == $struc['name'] )
				continue;

			if ( ! $include_hidden && '.' == $struc['name'][0] )
				continue;

			if ( $limit_file && $struc['name'] != $limit_file )
				continue;

			if ( 'd' == $struc['type'] ) {
				if ( $recursive )
					$struc['files'] = $this->dirlist($path . '/' . $struc['name'], $include_hidden, $recursive);
				else
					$struc['files'] = array();
			}

			// Replace symlinks formatted as "source -> target" with just the source name
			if ( $struc['islink'] )
				$struc['name'] = preg_replace( '/(\s*->\s*.*)$/', '', $struc['name'] );

<<<<<<< HEAD
			// Add the Octal representation of the file permissions
			$struc['permsn'] = $this->getnumchmodfromh( $struc['perms'] );

=======
>>>>>>> origin/master
			$ret[ $struc['name'] ] = $struc;
		}

		reset_mbstring_encoding();

		return $ret;
	}

<<<<<<< HEAD
	/**
	 * @access public
	 */
=======
>>>>>>> origin/master
	public function __destruct() {
		$this->ftp->quit();
	}
}
