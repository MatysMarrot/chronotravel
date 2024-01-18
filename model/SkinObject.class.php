<?php
require_once(__DIR__ . '/DAO.class.php');
require_once(__DIR__.'/enum/skinpart.enum.php');
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
        $this->parts = getSkinPartByNumber($parts);
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


}

?>