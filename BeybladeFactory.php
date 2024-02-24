<?php

class BeybladeFactory
{
    /**
     * @var \database\Database $connection Refers to the database connection
     */
    private database\Database $connection;

    /**
     * @var int                $highestId  Refers to the highest ID currently in the table
     */
    private int               $highestId;

    /**
     * @param \database\Database $connection Refers to the database connection
     *
     * Upon instantiation, sets the database connection property
     */
    public function __construct(database\Database $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return void Runs a query to check whether a table exists or not. Creates the table if it doesn't
     */
    private function checkTableExistence(): void
    {
        $query = "CREATE TABLE IF NOT EXISTS beyblade(
        id int AUTO_INCREMENT PRIMARY KEY,
        name varchar(255) NOT NULL,
        special_move varchar(255) NOT NULL,
        type varchar(255) NOT NULL,
        owner varchar(255) NOT NULL,
        UNIQUE(name, special_move, type, owner)
    )";

        $statement = $this->connection->getConnection()->prepare($query);
        $statement->execute();
    }

    /**
     * @param  Beyblade $beyblade Inserts a beyblade into the table
     * @return void
     */
    public function insertBeyblade(Beyblade $beyblade):void
    {
        $beybladeData = [
            "name"         => $beyblade->getName(),
            "special_move" => $beyblade->getSpecialMove(),
            "type"         => $beyblade->getType(),
            "owner"        => $beyblade->getOwner()
        ];

        echo !$this->connection->insert("beyblade", $beybladeData) ?
            "Failed to insert beyblade!" : "Successfully generated and inserted beyblade!";
    }

    /**
     * @return Beyblade Generates a random beyblade
     */
    public function generateBeyblade(): Beyblade
    {
        $this->checkTableExistence();
        $this->refreshHighId();

        $name        = $this->generateBeybladeInfo("Beyblade");
        $specialMove = $this->generateBeybladeInfo("Special Move");
        $type        = $this->generateBeybladeInfo("Beyblade Type");
        $owner       = $this->generateBeybladeInfo("Owner");

        return new Beyblade($name, $specialMove, $type, $owner);
    }

    /**
     * @return void Sets the highestId property to the highest ID currently in the table
     */
    private function refreshHighId(): void
    {
        $stmnt = $this->connection->getConnection()->prepare("SELECT MAX(id) AS highest_id FROM beyblade");
        $result = $stmnt->execute();

        !$result ? die("Issue retrieving highest ID") : $number = $stmnt->fetch(PDO::FETCH_ASSOC);

        if(!$number) {
            die("Issue fetching highest ID");
        }

        $this->highestId = $number["highest_id"] ?? 0;
    }

    /**
     * @return int Retrieves the highest ID currently in the table
     */
    private function getHighestId(): int
    {
        return $this->highestId;
    }

    /**
     * @param  string $detail Refers to the beyblade detail being generated
     * @return string         Generates a random string based on the detail passed in
     */
    private function generateBeybladeInfo(string $detail): string
    {
        $uniqueNum = $this->getHighestId() + 1;

        return "{$detail} {$uniqueNum}";
    }

    /**
     * @return void Removes all records from a table
     */
    public function emptyTable():void
    {
        $this->checkTableExistence();

        echo !$this->connection->truncateTable("beyblade") ?
            "Failed to empty table!" : "Table cleared successfully!";
    }

    /**
     * @param  string $backupName Refers to the backup table name
     * @return void               Backs up the table, storing it's data in a new backup table
     */
    public function backupTable(string $backupName): void
    {
        echo !$this->connection->backup("beyblade", $backupName) ?
            "Attempt to create backup unsuccessful" :
            "Backup created successfully";
    }

    /**
     * @param  string $backupName Refers to the backup table
     * @return void               Merges backup table with existing table
     */
    public function mergeBackup(string $backupName):void
    {
        $this->checkTableExistence();

        echo !$this->connection->mergeTables($backupName, "beyblade") ?
            "Failed to merge!":
            "Successful merge!" ;
    }

    /**
     * @param  string $table Refers to the name of the table
     * @return void          Removes the table
     */
    public function removeTable(string $table):void
    {
        echo !$this->connection->dropTable($table) ? "Failed to drop table!" : "Table dropped successfully!";
    }
}