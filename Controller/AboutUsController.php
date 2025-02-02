<?php
require_once __DIR__ . '/../Repository/AboutUsRepository.php';

class AboutUsController {
    private $aboutUsRepo;

    public function __construct() {
        $this->aboutUsRepo = new AboutUsRepository();
    }

    public function showAboutUs() {
        return $this->aboutUsRepo->getAboutUs();
    }
}
?>
