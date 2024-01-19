<?php
enum Skinpart : string
{
    case Chapeau = "hat";
    case Cheveux = "hair";
    case TeeShirt = "teeshirt";
    case Pantalon = "pants";
    case Chaussures = "shoes";

    public static function getPosition(self $value): int {
        switch ($value) {
            case self::Chapeau: return 0;
            case self::Cheveux: return 1;
            case self::TeeShirt: return 2;
            case self::Pantalon: return 3;
            case self::Chaussures: return 4;
        }
        return -1;
    }
}

?>

