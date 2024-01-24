<?php

enum Era : string{

    case ANTIQUITY = "ANTIQUITE";
    case MIDDLE_AGES = "MOYENAGE";
    case MODERN_AGES = "MODERNE";
    case CONTEMPORARY_TIMES = "CONTEMP";
}

class EnumUtils{
    public static array $ENUM_ORDER = [
        1 => Era::ANTIQUITY,
        2 => Era::MIDDLE_AGES,
        3 => Era::MODERN_AGES,
        4 => Era::CONTEMPORARY_TIMES,
    ];
}

?>