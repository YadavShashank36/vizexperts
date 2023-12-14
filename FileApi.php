<?php
namespace OCA\SampleApp\API;

use OCP\AppFramework\Http;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\ApiController;

class FileApi extends ApiController {

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     */
    public function browseFile($fileName) {
        $user = $this->getUser();
        if (!$user) {
            return new DataResponse(['message' => 'User not authenticated'], Http::STATUS_UNAUTHORIZED);
        }
    
      
        $fileUrl = '/remote.php/dav/files/' . $user . '/' . $fileName;
    
     
        $curl = curl_init($fileUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: text/plain']);
    
    
        $fileContents = curl_exec($curl);
    
       
        if ($fileContents === false) {
            $error = curl_error($curl);
            return new DataResponse(['message' => 'Error fetching file: ' . $error], Http::STATUS_INTERNAL_SERVER_ERROR);
        }
    
        // Close cURL session
        curl_close($curl);
    
        return new DataResponse(['file_contents' => $fileContents], Http::STATUS_OK);
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     */
    public function uploadFile($fileName) {
        $user = $this->getUser();
        if (!$user) {
            return new DataResponse(['message' => 'User not authenticated'], Http::STATUS_UNAUTHORIZED);
        }
    
        // Get raw request body which contains the file contents
        $fileContents = file_get_contents('php://input');
    
        // Construct the WebDAV URL for the file
        $fileUrl = '/remote.php/dav/files/' . $user . '/' . $fileName;
    
        // Initialize cURL session to perform a PUT request
        $curl = curl_init($fileUrl);
        curl_setopt($curl, CURLOPT_PUT, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/octet-stream']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $fileContents);
    
        // Execute the PUT request
        $response = curl_exec($curl);
    
        // Check for errors and handle the response
        if ($response === false) {
            $error = curl_error($curl);
            return new DataResponse(['message' => 'Error uploading file: ' . $error], Http::STATUS_INTERNAL_SERVER_ERROR);
        }
    
        // Close cURL session
        curl_close($curl);
    
        return new DataResponse(['message' => 'File uploaded successfully'], Http::STATUS_CREATED);
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     */
    public function downloadFile($fileName) {
        $user = $this->getUser();
        if (!$user) {
            return new DataResponse(['message' => 'User not authenticated'], Http::STATUS_UNAUTHORIZED);
        }
    
        // Construct the WebDAV URL for the file
        $fileUrl = '/remote.php/dav/files/' . $user . '/' . $fileName;
    
        // Redirect the client to the file URL to trigger the download
        return new DataResponse(['file_url' => $fileUrl], Http::STATUS_FOUND, ['Location' => $fileUrl]);
    }
}
