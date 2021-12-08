<?php 
namespace Plugins;

use Aws\S3\S3Client;

/**
 * 
 */
class Minio {

	private static $s3 = null;

	/**
	* 
	* @void 
	*/
	private static function setup($bucket) {
		if (is_null(self::$s3)) {
			self::$s3 = new S3Client([
				'version' => config('MINIO_VERSION', 'storage'),
				'region'  => config('MINIO_REGION', 'storage'),
				'endpoint' => config('MINIO_ENDPOINT', 'storage'),
				'use_path_style_endpoint' => true,
				'credentials' => [
					'key'    => config('MINIO_KEY', 'storage'),
					'secret' => config('MINIO_SECRET', 'storage'),
				],
			]);
		}

		$result = self::$s3->listBuckets();
		$buckets = $result['Buckets'];
		$buckets = array_column($buckets, 'Name');

		if (!in_array($bucket, $buckets)) {
			try {
				// Create a bucket
				$result = self::$s3->createBucket([
					'Bucket' => $bucket,
				]);
			} catch (\Throwable $e) {
				return $e->getMessage();
			}
		}
	}

	/**
	* 
	* @return 
	*/
	public static function multiplePut($bucket, $files) {
		self::setup($bucket);

		$objectNames = array();
		$fileCount = count($files['name']);

		for ($i=0; $i < $fileCount; $i++) { 
			$filename = strtolower($files['name'][$i]);
			$pathToFile = $files['tmp_name'][$i];
			
			$objectName = self::upload($bucket, $pathToFile, $filename);
			array_push($objectNames, $objectName);
		}

		return $objectNames;
	}

	/**
	* 
	* @return 
	*/
	public static function put($bucket, $file) {
		self::setup($bucket);

		$filename = strtolower($file['name']);
		$pathToFile = $file['tmp_name'];

		$objectName = self::upload($bucket, $pathToFile, $filename);
		return $objectName;
	}

	/**
	* 
	* @return 
	*/
	public static function putObj($bucket, $pathToFile) {
		self::setup($bucket);

		$filename = strtolower(pathinfo($pathToFile, PATHINFO_BASENAME));

		$objectName = self::upload($bucket, $pathToFile, $filename);
		return $objectName;
	}

	/**
	* 
	* @return 
	*/
	public static function presignedUrl($bucket, $objectName, $expire='+10 minutes') {
		self::setup($bucket);

		// Get a command object from the client
		$command = self::$s3->getCommand('GetObject', [
			'Bucket' => $bucket,
			'Key'    => $objectName
		]);

		// Create a pre-signed URL for a request with duration of 10 miniutes
		$presignedRequest = self::$s3->createPresignedRequest($command, $expire);

		// Get the actual presigned-url
		$presignedUrl = (string) $presignedRequest->getUri();
		
		return $presignedUrl;
	}

	/**
	* 
	* @return 
	*/
	public static function get($bucket, $objectName) {
		self::setup($bucket);

		$url = self::$s3->getObjectUrl($bucket, $objectName);
		return $url;
	}

	/**
	* 
	* @return 
	*/
	private static function upload($bucket, $pathToFile, $fileName, $ACL='public-read') {
		try {
			// append to folder
			$folder = date('Y-m').'/';

			// avoid replicate name
			$i = 1;
			$extention = pathinfo($fileName, PATHINFO_EXTENSION);
			$rawName = $folder.pathinfo($fileName, PATHINFO_FILENAME);
			$fileName = $folder.$fileName;
			while (self::$s3->doesObjectExist($bucket, $fileName)) {
				$fileName = $rawName . ((string) $i) . '.' . $extention;
				$i ++;
			}

			// put file
			self::$s3->putObject([
				'Bucket' 	=> $bucket,
				'Key' 		=> $fileName,
				'Body' 		=> fopen($pathToFile, 'r'),
				'ACL' 		=> $ACL,
			]);

			return $fileName;
		} catch (\Aws\S3\Exception\S3Exception $e) {
			echo $e->getMessage();
			return false;
		}

	}
}