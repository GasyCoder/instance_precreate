<?php

function deleteDirectory($dir) {
    $directory_to_delete = $dir;
    
    // Vérifie si le dossier existe
    if (!is_dir($directory_to_delete)) {
        dd("Le dossier n'existe pas : $directory_to_delete");
        return false;
    }
    
    // Ouvre le dossier
    $items = scandir($directory_to_delete);
    foreach ($items as $item) {
        // Ignore les dossiers spéciaux . et ..
        if ($item == '.' || $item == '..') {
            continue;
        }

        // Chemin complet de l'élément
        $path = $directory_to_delete . DIRECTORY_SEPARATOR . $item; // Ajoute le nom de l'élément ici
        
        // Si c'est un dossier, appel récursif
        if (is_dir($path)) {
            deleteDirectory($path); // Passe juste le nom de l'élément
        } else {
            // Supprime le fichier
            unlink($path);
        }
    }

    // Supprime le dossier vide
    rmdir($directory_to_delete);

    return true;
}
