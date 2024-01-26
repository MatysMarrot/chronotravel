<?php
require_once(__DIR__ . '/DAO.class.php');
require_once(__DIR__ . '/Student.class.php');
require_once(__DIR__ . '/enum/Skinpart.enum.php');

class SkinObject {
    private int $skinId; //L'identifiant du skin en db
    private string $name; //Son nom
    private int $price; //Son prix
    private string $location; //Chemin vers l'image
    private Skinpart $parts; //Partie du skin

    /**
     * @param int $skinId
     * @param string $name
     * @param int $price
     * @param string $location
     * @param Skinpart $parts
     */
    public function __construct(int $skinId, string $name, int $price, string $location, string $parts) {
        $this->skinId = $skinId;
        $this->name = $name;
        $this->price = $price;
        $this->location = $location;
        $this->parts = Skinpart::tryFrom($parts);
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
    public function getParts(): Skinpart {
        return $this->parts;
    }

    /**
     * @return string
     * Obtenir le nom associé à l'Enum de la partie du Skin
     */
    public function getFrenchSkinPart(): string {
        return $this->parts->name;
    }

    /**
     * @return array
     * Obtenir tous les SkinObjects en DB
     */
    public static function getAllSkinObjects() : array {
        $dao = DAO::get();
        $query = "SELECT skinid, skinobject.name as name, price, location, skinpart.name as partname 
          FROM skinobject 
          JOIN skinpart ON skinobject.parts = skinpart.skinpartid 
          WHERE skinobject.part != 0 
          ORDER BY parts";
        $table = $dao->query($query);
        $skins = [];
        foreach ($table as $skin) {
            $newSkin = new SkinObject($skin["skinid"], $skin["name"], $skin["price"], $skin["location"], $skin["partname"]);
            $skins[] = $newSkin;
        }
        return $skins;
    }

    /**
     * @return array
     * Obtenir les couleurs de peau
     */
    public static function getColorSkin() : array {
        $dao = DAO::get();

        $query = "SELECT so.skinid, so.name as name, price, location, sp.name as partname FROM skinobject so JOIN skinpart sp ON so.parts=sp.skinpartid WHERE so.parts=0";
        $table = $dao->query($query);
        $skins = [];
        foreach ($table as $skin) {
            $newSkin = new SkinObject($skin["skinid"], $skin["name"], $skin["price"], $skin["location"], $skin["partname"]);
            $skins[] = $newSkin;
        }
        return $skins;
    }

    /**
     * @param int $playerId L'ID du joueur
     * @return array
     * Obtenir le skin porté par un joueur
     */
    public static function getCurrentSkinOfPlayer(int $playerId) : array {
        $dao = DAO::get();
        $query = "SELECT hat, hair, teeshirt, pants, shoes, skincolor FROM currentskin WHERE playerid=?";
        $table = $dao->query($query, [$playerId]);
        $currentSkin = [];
        if(!count($table)) {
            $dao->exec("INSERT INTO currentskin VALUES ($playerId, null, null, null, null, null,25)");
            $currentSkin = [null, null, null, null, null ,25];
        } else {
            $row = $table[0];
            for($i=0; $i < 6; $i++) {
                if($row[$i] != null) {
                    $query = "SELECT skinid, skinobject.name as name, price, location, skinpart.name as partname FROM skinobject JOIN skinpart ON skinobject.parts=skinpart.skinpartid WHERE skinid=?";
                    $table = $dao->query($query, [$row[$i]]);
                    $rowSkinObject = $table[0];
                    $newSkin = new SkinObject($rowSkinObject["skinid"], $rowSkinObject["name"], $rowSkinObject["price"], $rowSkinObject["location"], $rowSkinObject["partname"]);
                    $currentSkin[] = $newSkin;
                } else {
                    $currentSkin[] = null;
                }
            }
        }
        return $currentSkin;
    }

    /**
     * @param int $playerId l'ID du joueur
     * @return bool
     * Checker si le cosmétique est porté par un joueur
     */
    public function isPossessedBy(int $playerId) : bool {
        $dao = DAO::get();
        $query = "SELECT * FROM playerskin WHERE playerid=? AND skinid=?";
        $table = $dao->query($query, [$playerId, $this->getSkinId()]);
        return count($table)!=0;
    }

    /**
     * @param int $playerId l'ID du joueur
     * @return array
     * Obtenir tous les cosmétiques possédés par un joueur
     */
    public static function getAllPossessedSkin(int $playerId) : array {
        $possessedSkin = [];
        $dao = DAO::get();
        $query = "SELECT so.skinid, so.name as name, price, location, sp.name as partname FROM skinobject so JOIN playerskin ps ON so.skinid = ps.skinid JOIN skinpart sp ON so.parts=sp.skinpartid WHERE ps.playerid = ? AND so.parts!=0";
        $table = $dao->query($query, [$playerId]);
        foreach($table as $skin) {
            $newSkin = new SkinObject($skin["skinid"], $skin["name"], $skin["price"], $skin["location"], $skin["partname"]);
            $possessedSkin[] = $newSkin;
        }
        return $possessedSkin;
    }

    /**
     * @param int $playerId
     * @return array
     * Obtenir tous les cosmétiques non-possédés par un joueur
     */
    public static function getAllunpossessedSkin(int $playerId) : array {
        $possessedSkin = [];
        $dao = DAO::get();
        $query = "SELECT so.skinid, so.name as name, price, location, sp.name as partname FROM skinobject so JOIN skinpart sp ON so.parts=sp.skinpartid LEFT JOIN playerskin ps ON so.skinid = ps.skinid AND ps.playerid = ? WHERE ps.playerid IS NULL AND so.parts!=0";
        $table = $dao->query($query, [$playerId]);
        foreach($table as $skin) {
            $newSkin = new SkinObject($skin["skinid"], $skin["name"], $skin["price"], $skin["location"], $skin["partname"]);
            $possessedSkin[] = $newSkin;
        }
        return $possessedSkin;
    }

    /**
     * @param int $skinId
     * @return SkinObject
     * Obtenir un cosmétique à partir de son ID en DB
     */
    public static function getSkin(int $skinId) : SkinObject {
        $dao = DAO::get();
        $query = "SELECT so.skinid, so.name as name, price, location, sp.name as partname FROM skinobject so JOIN skinpart sp ON so.parts=sp.skinpartid WHERE skinid=?";
        $table = $dao->query($query, [$skinId]);
        $skin = $table[0];
        $newSkin = new SkinObject($skin["skinid"], $skin["name"], $skin["price"], $skin["location"], $skin["partname"]);
        return $newSkin;
    }

    /**
     * @param int $playerId l'ID du joueur
     * @return bool
     * Savoir si un joueur équipe le cosmétique actuellement
     */
    public function isEquiped(int $playerId) : bool {
        $dao = DAO::get();
        $query = "SELECT {$this->getParts()->value} FROM currentskin WHERE playerid={$playerId}";
        $table = $dao->query($query);
        return $table[0][$this->getParts()->value]!=null;
    }

    /**
     * @param int $playerId l'ID du joueur
     * @return void
     * Activer le cosmétique sur un joueur
     */
    public function toggleSkin(int $playerId) : void {
        $dao = DAO::get();
        if($this->isEquiped($playerId)) {
            $query = "UPDATE currentskin SET {$this->getParts()->value}=null WHERE playerid={$playerId}";
        } else {
            $query = "UPDATE currentskin SET {$this->getParts()->value}={$this->getSkinId()} WHERE playerid={$playerId}";
        }
        $dao->exec($query);
    }

    /**
     * @param int $playerId l'ID du joueur
     * @return void
     * Changer la couleur de peau d'un joueur
     */

    public function toggleSkinColor(int $playerId) : void {
        $dao = DAO::get();
        $query = "UPDATE currentskin SET {$this->getParts()->value}={$this->getSkinId()} WHERE playerid={$playerId}";
        $dao->exec($query);
    }

    /**
     * @param array $currentSkin Le skin
     * @return array
     * Obtenir un aperçu d'un skin
     */
    public function previewSkin(array &$currentSkin) {
        $index = Skinpart::getPosition($this->getParts());
        if($index != -1) {
            $currentSkin[$index] = $this;
        }
        return $currentSkin;
    }

    /**
     * @param Student $student
     * @return void
     * Consulter si un Student a acheté le cosmétique
     * @see Student
     */
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