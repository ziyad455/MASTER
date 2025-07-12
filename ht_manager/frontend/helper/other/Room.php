<?php
require "../../../backend/database/conectdb.php";


class Room {
    // private $number, $type, $size, $price, $description, $photo;
    private string $roomNumber;
    private string $roomType;
    private string $roomSize;
    private float $roomPrice;
    private string $roomDescription;
    private string $roomPhoto;

    public function __construct($number, $type, $size, $price, $description, $photo) {
        $this->roomNumber = $number;
        $this->roomType = $type;
        $this->roomSize = $size;
        $this->roomPrice = $price;
        $this->roomDescription = $description;
        $this->roomPhoto = $photo;
    }

   public function save($db) {
    // require_once "../../../backend/database/conectdb.php";
    $sql = "INSERT INTO chambres (numero, type, superficie, prix, description, image)
        VALUES (?, ?, ?, ?, ?, ?)";
    return $db->insert($sql, [
        $this->roomNumber,
        $this->roomType,
        $this->roomSize,
        $this->roomPrice,
        $this->roomDescription,
        $this->roomPhoto
          ]);
      }

    // public function countRooms($db) {
    //   $sql = "SELECT COUNT(*) AS total FROM chambres";
    //   $result = $db->selectOne($sql);
    //   $totalRooms = $result['total'];
    //   return $totalRooms;
    // }

        public function getRoomNumber(): string {
        return $this->roomNumber;
    }

    public function getRoomType(): string {
        return $this->roomType;
    }

    public function getRoomSize(): string {
        return $this->roomSize;
    }

    public function getRoomPrice(): float {
        return $this->roomPrice;
    }

    public function getRoomDescription(): string {
        return $this->roomDescription;
    }

    public function getRoomPhoto(): string {
        return $this->roomPhoto;
    }


    public function toArray(): array {
        return [
            'room_number' => $this->roomNumber,
            'room_type' => $this->roomType,
            'room_size' => $this->roomSize,
            'room_price' => $this->roomPrice,
            'room_description' => $this->roomDescription,
            'room_photo' => $this->roomPhoto
        ];
    }
}

