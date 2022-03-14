<?php 
class Album 
{

private PDO $db;
private string $table = '`album`';
private int $id;
private string $title;
private string $releaseDate;
private string $shortDesc;
private string $longDesc;
private string $coverLink;
private string $search;




public function __construct()
{
    try {
        $this->db = new PDO('mysql:host=localhost;port=3307;dbname=projet_titre_pro;charset=utf8mb4', 'root');
    } catch (Exception $error) {
        die($error->getMessage());
    }
}
// Récupère tous les albums
public function getAlbumsForDisplay(): array{
    $query = 'SELECT ' . $this->table . '.`id`, `title`, `cover_link` AS `cover`, `artist`'
    . ' FROM ' . $this->table;
    $queryStatement = $this->db->query($query); 
    return $queryStatement->fetchAll(PDO::FETCH_OBJ);
}

// Récupère les noms des artistes crédités principalements dans l'album
    /* public function getBandNames(): array{
    $query = 'SELECT band.name AS bandName'
    . ' FROM ' . $this->table
    . ' JOIN `credited_band` ON `album`.`id` = `credited_band`.`id_album` '
    . ' JOIN `band` ON `credited_band`.`id_band` = `band`.`id`';
    $queryStatement = $this->db->query($query); 
    return $queryStatement->fetchAll(PDO::FETCH_OBJ);
} */


//Récupère les infos d'un album
public function getAlbum(): object{
    $query = 'SELECT ' . $this->table . '.`id`, `title`, `cover_link` AS `cover`, `artist`, `long_desc` AS `desc`, DATE_FORMAT(`releaseDate`, \'%d/%m/%Y\') AS `releaseDate`'
    .', `label`'
    . ' FROM ' . $this->table
    . ' WHERE `album`.`id` = :albumId';
    $queryStatement = $this->db->prepare($query); 
    $queryStatement->bindValue(':albumId', $this->id, PDO::PARAM_INT);
    $queryStatement->execute();
    return $queryStatement->fetch(PDO::FETCH_OBJ);
}

//Récupère les pistes d'un album
public function getAlbumTracks(): array{
    $query = 'SELECT `album_track`.`title` AS `trackTitle`, `duration`, `track_order` AS `trackOrder`'
    . ' FROM ' . $this->table
    . ' JOIN `album_track` ON `album`.`id` = `album_track`.`id_album` '
    . ' WHERE `album`.`id` = :albumId';
    $queryStatement = $this->db->prepare($query); 
    $queryStatement->bindValue(':albumId', $this->id, PDO::PARAM_INT);
    $queryStatement->execute();
    return $queryStatement->fetchAll(PDO::FETCH_OBJ);
}

//Récupère les musiciens crédités dans l'album
public function getCreditedMusicians(): array{
    $query = 'SELECT `musician`.`name` AS `musicianName`, `credited_musician`.`instrument` AS `instrument`'
    . ' FROM ' . $this->table
    . ' JOIN `credited_musician` ON `album`.`id` = `credited_musician`.`id_album`'
    . ' JOIN `musician` ON `credited_musician`.`id_musician` = `musician`.`id`'
    . ' WHERE `album`.`id` = :albumId';
    $queryStatement = $this->db->prepare($query); 
    $queryStatement->bindValue(':albumId', $this->id, PDO::PARAM_INT);
    $queryStatement->execute();
    return $queryStatement->fetchAll(PDO::FETCH_OBJ);
}

//Récupère les infos d'un album
public function getSearchedAlbums(): array{
    $query = 'SELECT ' . $this->table . '.`id`, `title`, `cover_link` AS `cover`, `artist`'
    . ' FROM ' . $this->table
    . ' WHERE `title` LIKE :title';
    $queryStatement = $this->db->prepare($query); 
    $queryStatement->bindValue(':title', '%'. $this->search . '%', PDO::PARAM_STR);
    $queryStatement->execute(); 
    return $queryStatement->fetchAll(PDO::FETCH_OBJ);
}




public function setId($id){
    $this->id = $id;
}
public function setSearch($search){
    $this->search = $search;
}
public function setTracks($tracks){
    $this->tracks = $tracks;
}




}