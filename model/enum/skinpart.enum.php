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
            return SkinPart::Chapeau->value;
        case 2:
            return SkinPart::Cheveux->value;
        case 3:
            return SkinPart::TeeShirt->value;
        case 4:
            return SkinPart::Pantalon->value;
        case 5:
            return SkinPart::Chaussures->value;
        default:
            return "Partie inconnue";
    }
}



?>
