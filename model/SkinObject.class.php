<?php
require_once(__DIR__ . '/DAO.class.php');
require_once(__DIR__ . '/Student.class.php');
class SkinObject {
    private int $skinId;
    private string $name;
    private int $price;
    private string $location;
    private string $parts;

    /**
     * @param int $skinId
     * @param string $name
     * @param int $price
     * @param string $location
     * @param string $parts
     */
    public function __construct(int $skinId, string $name, int $price, string $location, int $parts) {
        $this->skinId = $skinId;
        $this->name = $name;
        $this->price = $price;
        $this->location = $location;
        $this->parts = SkinObject::getSkinPartByNumber($parts);
    }

    /**
     * @return int
     */
    public function getSkinId(): int {
        return $this->skinId;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getPrice(): int {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getLocation(): string {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getParts(): string {
        return $this->parts;
    }

    public function getFrenchSkinPart(): string {
        switch ($this->getParts()) {
            case "hat":
                return "Chapeau";
            case "hair":
                return "Cheveux";
            case "teeshirt":
                return "Tee-Shirt";
            case "pants":
                return "Pantalon";
            case "shoes":
                return "Chaussures";
            default:
                return "none";
        }
    }
    private static function getSkinPartByNumber(int $number): string {
        switch ($number) {
            case 1:
                return "hat";
            case 2:
                return "hair";
            case 3:
                return "teeshirt";
            case 4:
                return "pants";
            case 5:
                return "shoes";
            default:
                return "none";
        }
    }
    public static function getAllSkinObjects() : array {
        $dao = DAO::get();
        $query = "SELECT * FROM skinobject ORDER BY parts";
        $table = $dao->query($query);
        $skins = [];
        foreach ($table as $skin) {
            $newSkin = new SkinObject($skin["skinid"], $skin["name"], $skin["price"], $skin["location"], $skin["parts"]);
            $skins[] = $newSkin;
        }
        return $skins;
    }

    public static function getCurrentSkinOfPlayer(int $playerId) : array {
        $dao = DAO::get();
        $query = "SELECT hat, hair, teeshirt, pants, shoes FROM currentskin WHERE playerid=?";
        $table = $dao->query($query, [$playerId]);
        $currentSkin = [];
        if(!count($table)) {
            $dao->exec("INSERT INTO currentskin VALUES ($playerId, null, null, null, null, null, '000000')");
            $currentSkin = [null, null, null, null, null];
        } else {
            $row = $table[0];
            for($i=0; $i < 5; $i++) {
                if($row[$i] != null) {
                    $query = "SELECT * FROM skinobject WHERE skinid=?";
                    $table = $dao->query($query, [$row[$i]]);
                    $rowSkinObject = $table[0];
                    $newSkin = new SkinObject($rowSkinObject["skinid"], $rowSkinObject["name"], $rowSkinObject["price"], $rowSkinObject["location"], $rowSkinObject["parts"]);
                    $currentSkin[] = $newSkin;
                } else {
                    $currentSkin[] = null;
                }
            }
        }
        return $currentSkin;
    }

    public function isPossessedBy(int $playerId) : bool {
        $dao = DAO::get();
        $query = "SELECT * FROM playerskin WHERE playerid=? AND skinid=?";
        $table = $dao->query($query, [$playerId, $this->getSkinId()]);
        return count($table)!=0;
    }

    public static function getAllPossessedSkin(int $playerId) : array {
        $possessedSkin = [];
        $dao = DAO::get();
        $query = "SELECT so.* FROM skinobject so JOIN playerskin ps ON so.skinid = ps.skinid WHERE ps.playerid = ?";
        $table = $dao->query($query, [$playerId]);
        foreach($table as $skin) {
            $newSkin = new SkinObject($skin["skinid"], $skin["name"], $skin["price"], $skin["location"], $skin["parts"]);
            $possessedSkin[] = $newSkin;
        }
        return $possessedSkin;
    }
    public static function getAllunpossessedSkin(int $playerId) : array {
        $possessedSkin = [];
        $dao = DAO::get();
        $query = "SELECT so.* FROM skinobject so LEFT JOIN playerskin ps ON so.skinid = ps.skinid AND ps.playerid = ? WHERE ps.playerid IS NULL";
        $table = $dao->query($query, [$playerId]);
        foreach($table as $skin) {
            $newSkin = new SkinObject($skin["skinid"], $skin["name"], $skin["price"], $skin["location"], $skin["parts"]);
            $possessedSkin[] = $newSkin;
        }
        return $possessedSkin;
    }
    public static function getSkin(int $skinId) : SkinObject {
        $dao = DAO::get();
        $query = "SELECT * FROM skinobject WHERE skinid=?";
        $table = $dao->query($query, [$skinId]);
        $skin = $table[0];
        $newSkin = new SkinObject($skin["skinid"], $skin["name"], $skin["price"], $skin["location"], $skin["parts"]);
        return $newSkin;
    }

    public function isEquiped(int $playerId) : bool {
        $dao = DAO::get();
        $query = "SELECT {$this->getParts()} FROM currentskin WHERE playerid={$playerId}";
        $table = $dao->query($query);
        return $table[0][$this->getParts()]!=null;
    }
    public function toggleSkin(int $playerId) : void {
        $dao = DAO::get();
        if($this->isEquiped($playerId)) {
            $query = "UPDATE currentskin SET {$this->getParts()}=null WHERE playerid={$playerId}";
        } else {
            $query = "UPDATE currentskin SET {$this->getParts()}={$this->getSkinId()} WHERE playerid={$playerId}";
        }
        $dao->exec($query);
    }
    public function previewSkin(array &$currentSkin) {
        $index = -1;
        switch ($this->getParts()) {
            case "hat":
                $index = 0;
                break;
            case "hair":
                $index = 1;
                break;
            case "teeshirt":
                $index = 2;
                break;
            case "pants":
                $index = 3;
                break;
            case "shoes":
                $index = 4;
        }
        if($index != -1) {
            $currentSkin[$index] = $this;
        }
        return $currentSkin;
    }
    public function isBuyBy(Student $student) {
        $dao = DAO::get();
        $query = "INSERT INTO playerskin VALUES (?,?)";
        $data = [$student->getId(), $this->getSkinId()];
        $dao->exec($query, $data);
        $query = "UPDATE person SET currency=? WHERE id=?";
        $data = [$student->getCurrency()-$this->getPrice(), $student->getId()];
        $dao->exec($query, $data);
    }

}
// Supprimer tous les currentskin: delete from currentskin ;
// Attribuer un currentskin à toutes les persons : insert into currentskin select id, null, null, null, null, null, 000000 from person;
?>