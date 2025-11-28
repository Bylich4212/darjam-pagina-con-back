
<?php
// app/controllers/PerfumeController.php

class PerfumeController
{
    // HOME (texto de Bienvenido a Darjam)
    public function home()
    {
        require __DIR__ . '/../views/home.php';
    }

    // CATÁLOGO DE PERFUMES
    public function index()
    {
        // Solo los tipo "perfume"
        $perfumes = Perfume::allPerfumes();
        require __DIR__ . '/../views/perfumes/index.php';
    }

    // CATÁLOGO DE DECANTS
    public function decants()
    {
        // Solo los tipo "decant"
        $perfumes = Perfume::allDecants();
        // Podés reutilizar la misma vista de perfumes
        require __DIR__ . '/../views/perfumes/index.php';
        // o, si tenés otra, algo como:
        // require __DIR__ . '/../views/decants/index.php';
    }
}
