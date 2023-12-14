<?php
namespace OCA\SampleApp\Controller;

use OCP\AppFramework\Controller;
use OCP\IRequest;
use OCA\SampleApp\Service\FileService;

class FileController extends Controller {

    private $fileService;

    public function __construct($AppName, IRequest $request, FileService $fileService) {
        parent::__construct($AppName, $request);
        $this->fileService = $fileService;
    }

   
}
