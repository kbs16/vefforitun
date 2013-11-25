<?php
/**
 * Here we have a bit of fun and create three different caching implementations.
 * - NoCache which could be a debugging cache mechanism, always returning false
 *   or always returning some debug json for development
 * - ApcCache that uses PHPs APC caching mechanism
 * - FilesystemCache that caches to a file and checks its modified time
 *
 * Including this file will also do some factory-ish thing, it returns a caching
 * implementation according to some global state.
 */

/**
 * The interface those who use our caching know, real simple, you can set a value
 * for a key or get a value from a key.
 */
interface ICache
{
	public function get($key);
	public function set($key, $value);
}

/**
 * Our no cache implentation always returns the same json 
 */
class NoCache implements ICache
{
	private $logger;

	public function __construct(ILog $logger)
	{
		$this->logger = $logger;
	}

	public function set($key, $value)
	{
		$this->logger->Log("Not setting {$key} to {$value}");
	}

	// always returns the same file
	public function get($key)
	{
		$this->logger->Log("Getting debug data for {$key}");
		return file_get_contents('cinema.debug.json');
	}
}

/**
 * Implements our caching against the APC API:
 * http://php.net/manual/en/book.apc.php
 */
class ApcCache implements ICache
{
	private $timeout;
	private $logger;

	/** 
	 * We need to know how long we cache stuff and a logger
	 */
	public function __construct($timeout, ILog $logger)
	{
		$this->timeout = $timeout;
		$this->logger = $logger;
	}

	public function set($key, $value)
	{
		$this->logger->Log("Setting data for {$key} to {$value}");
		apc_add($key, $value, $this->timeout);
	}

	public function get($key)
	{
		$this->logger->Log("Getting data for {$key}");
		return apc_fetch($key);
	}
}

class FilesystemCache implements ICache
{
	private $location;
	private $timeout;
	private $logger;

	/**
	 * Location is the folder we write our cached files to with a trailing slash
	 * Timeout is how long we consider cached data valid
	 * Logger is our logger which we use to log. Log.
	 */
	public function __construct($location, $timeout, ILog $logger)
	{
		$this->timeout = $timeout;
		$this->logger = $logger;
	}

	public function set($key, $value)
	{
		$filename = $this->path($key);

		$this->logger->Log("Setting data for {$key} (filename {$filename}) to {$value}");

		file_put_contents($filename, $value);
	}

	public function get($key)
	{
		$filename = $this->path($key);

		$this->logger->Log("Getting data for {$key} (filename {$filename})");

		// does the file exist and is it still valid, i.e. it's not less then $timeout since we wrote it
		if (file_exists($filename) && filemtime($filename) + $this->timeout > time())
		{
			$remaining = time() - filemtime($filename) + $this->timeout;
			$this->logger->Log("Cache for {$key} is fresh for {$remaining} sec");

			return file_get_contents($filename);
		}

		return false;
	}

	// this is the exact location of the cache e.g. /path/to/cache/filename.cache
	private function path($key)
	{
		return $this->location.$key.".cache";
	}
}

// If we're in debug mode, return the nocache cacher
if (DEBUG)
{
	return new NoCache($logger);
}
else
{
	// we prefer the APC cache
	if (function_exists('apc_add'))
	{
		return new ApcCache(CACHE_TIME, $logger);
	}
	// but will settle for the FS cacher
	else
	{
		return new FilesystemCache(CACHE_FS, CACHE_TIME, $logger);
	}
}