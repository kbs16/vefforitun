<?php

/**
 * Base for a simple REST client, only supports GET
 */
class RestClient
{
	private $cache;
	private $logger;

	/**
	 * We depend on a cache and a logger and recieve them via Dependency Injection, read more:
	 * http://misko.hevery.com/2008/07/08/how-to-think-about-the-new-operator/
	 */
	public function __construct(ICache $cache, ILog $logger)
	{
		$this->cache = $cache;
		$this->logger = $logger;
	}

	/**
	 * Perform a request to $url using $method and returns the result.
	 * If $json is true, the response will be decoded before being returned
	 */
	public function Request($url, $method = 'GET', $json = false)
	{
		$this->logger->Log("Request for {$url} with method {$method}, JSON? {$json}");
		if ($method !== 'GET')
		{
			throw new RestException("Method ".$method." is not supported");
		}

		$key = $this->makeKey($url);
		//debug vegna staðsetningar á cache skránni
		//$key = getcwd()."/cache/".$key.".cache";

		$this->logger->Log("Key for {$url} is {$key}");

		// do we have a cached response?
		$response = $this->cache->get($key);

		// nope, go ahead and fetch one
		if ($response === false)
		{
			$this->logger->Log("Cache is empty -- requesting data");

			$curl = curl_init($url);

			// cURL will now return the string instead of printing it out
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			// Logging here allows us to track how long the request takes
			$this->logger->Log("Starting cURL request");
			$response = curl_exec($curl);
			$this->logger->Log("Finished cURL request");

			// something went wrong! Log it and throw
			if ($response === false)
			{
			    $info = curl_getinfo($curl);

			    curl_close($curl);

				$this->logger->Log("Unable to call ".$url.". Error from cURL: ".var_export($info, true));
			    throw new RestException("Unable to call ".$url);
			}

			curl_close($curl);

			// cache the response for next time
			$this->cache->set($key, $response);
		}
		else
		{
			$this->logger->Log("Got hit from cache!");
		}

		// are we going to decode the response from json?
		if ($json)
		{
			$response = $this->decodeJson($response);

			if ($response === false)
			{
				$this->logger->Log("Unable to decode JSON from ".$url);
				throw new RestException("Unable to decode JSON from ".$url);
			}
		}

		return $response;
	}

	// shorthand for a GET request
	public function Get($url, $json = false)
	{
		return $this->Request($url, 'GET', $json);
	}

	// create a semi-safe cache key for the url being requested
	private function makeKey($url)
	{
		$key = str_replace("http://", "", $url);
		$key = str_replace(array("/", "?", "&", "#", "="), "-", $key);

		return $key;
	}

	private function decodeJson($data)
	{
		$decoded = json_decode($data, true);

		if ($decoded === 'NULL')
		{
			return false;
		}

		return $decoded;
	}
}

// Create a new exception we can catch explicitly
class RestException extends Exception
{
}