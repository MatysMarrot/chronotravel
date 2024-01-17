<?php

enum SkinPart: string {
    case Chapeau = "Chapeau";
    case Cheveux = "Cheveux";
    case TeeShirt = "Tee-shirt";
    case Pantalon = "Pantalon";
    case Chaussures = "Chaussures";
}

function getSkinPartByNumber(int $number): string {
    switch ($number) {
        case 1:
            return SkinPart::Chapeau;
        case 2:
            return SkinPart::Cheveux;
        case 3:
            return SkinPart::TeeShirt;
        case 4:
            return SkinPart::Pantalon;
        case 5:
            return SkinPart::Chaussures;
        default:
            return "Partie inconnue";
    }
}

?>
