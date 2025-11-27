<?php
// app/controllers/PerfumeController.php

class PerfumeController {
    public function index() {
        require __DIR__ . '/../views/home.php';
    }

    public function perfumes() {
        $perfumes = Perfume::allPerfumes();
        require __DIR__ . '/../views/perfumes/index.php';
    }

    public function decants() {
        $decants = Perfume::allDecants();
        require __DIR__ . '/../views/decants/index.php';
    }
}
