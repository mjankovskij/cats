<?php

class App
{

    public static $uri;

    public static function __constructStatic()
    {
        self::$uri = ltrim(URI[0], '0');
    }

    public static function router()
    {
        self::__constructStatic();
        $data = self::dataProcess();
        if (!isset(self::$uri) || self::$uri === '') {
            return (new Controller\Index)->render($data);
        } elseif (
            isset(self::$uri) &&
            is_numeric(self::$uri) &&
            self::$uri > 0 &&
            self::$uri <= 1000000
        ) {
            return (new Controller\Cat)->render($data);
        } else {
            return (new Controller\Error)->render();
        }
    }

    public static function dataProcess()
    {
        self::__constructStatic();
        // Nuskaito logs, kačių sekai ir statistikai.
        $file = new File('logs.json');
        $fileData = json_decode($file->read(), true) ?? [];

        foreach ($fileData as $key => $item) {
            if ($item['N'] === self::$uri) {
                $data['countN'] = $item['countN'];
                // Cathcinimas, turi praeiti 60s po paskutinio puslapio atnaujinimo, kitaip įrašys prieš tai buvusias kates N
                // puslapyje ir laikas prasidės iš naujo(60s). Galima kurti atskira saugyklą catchinimams, jei reikia, kad būtinai persikrautu po 60s.
                if (strtotime($item['datetime']) + 60 > time()) {
                    $data['cats'] = $item['cats'];
                }
            }
            // Paskutinės katės sąraše paieška.
            if ($key === count($fileData) - 1) {
                $lastCat = $item['cats'][2];
            }
        }

        $data['countAll'] = count($fileData);

        //Jei atidarytas N puslapis.
        if (self::$uri) {
            $data['datetime'] = date('Y-m-d H:i:s');
            $data['N'] = self::$uri;
            // Lankytojų skaičivimas.
            $data['countN'] = ($data['countN'] ?? 0) + 1;
            // Jei pagal laiką nebuvo atrasta tinkamų kačių, generuojam naujas paeiliui nuo paskutinio įrašo.
            if (!isset($data['cats'])) {
                $catObject = new Controller\Cat;
                $lastCatKey = $catObject->getCatKey($lastCat ?? 0);
                $data['cats'] = $catObject->getCats($lastCatKey + 1);
                $data['countAll']++;
            }
            $fileData[] = $data;
            $file->push(json_encode($fileData));
            return ['cats' => $data['cats'], 'countN' => $data['countN'], 'countAll' => $data['countAll'], 'N' => self::$uri];
        }

        // Jei esama index'e.
        return $data['countAll'];
    }
}
