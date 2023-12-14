<?php
namespace OCA\SampleApp\Service;

use OCP\Files\FileInfo;
use OCP\Files\IRootFolder;

class FileService {

    private $rootFolder;

    public function __construct(IRootFolder $rootFolder) {
        $this->rootFolder = $rootFolder;
    }

    
}
