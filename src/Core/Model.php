<?php

namespace App\Core;

use PDO;

abstract class Model
{
    protected string $table;
    protected array $fillable = [];
    protected array $hidden = [];
    protected array $attributes = [];
    protected $primaryKey = null;
    protected Database $db;

    public function __construct()
    {
        $this->db = new Database();
        $this->db->table($this->table);
        $this->setFetchMode(PDO::FETCH_CLASS, get_class($this));
    }


    // Find a record by ID and populate the model attributes
    public function find($id)
    {
        return $this->db->findById($id);
    }

    // Create a new record
    public function create(array $data)
    {
        $fillableData = $this->filterFillableData($data);

        if (empty($fillableData)) {
            throw new \Exception("No fillable attributes provided for creating a record.");
        }

        $id = $this->db->create($fillableData);
        return $this->find($id);
    }

    // Update records based on conditions
    public function update(array $data)
    {
        $fillableData = $this->filterFillableData($data);

        if (empty($fillableData)) {
            throw new \Exception("No fillable attributes provided for updating the record(s).");
        }

        $affectedRows = $this->db->update($fillableData);
        return $affectedRows;
    }

    // Filter the data array to include only fillable attributes
    private function filterFillableData(array $data): array
    {
        $fillableData = [];
        foreach ($data as $attribute => $value) {
            if (in_array($attribute, $this->fillable)) {
                $fillableData[$attribute] = $value;
            }
        }
        return $fillableData;
    }


    // Delete records based on conditions
    public function delete()
    {
        $affectedRows = $this->db->delete();
        return $affectedRows;
    }

    // Retrieve all records from the table
    public function all()
    {
        return $this->db->get();
    }

    // Add an order by clause to the query
    public function orderBy($column, $direction = 'ASC')
    {
        $this->db->orderBy($column, $direction);
        return $this;
    }

    // Set pagination for the query
    public function paginate($perPage)
    {
        $this->db->paginate($perPage);
        return $this;
    }

    // Retrieve records from the table
    public function get()
    {
        return $this->db->get();
    }

    // Select specific columns from the table
    public function select($columns = [])
    {
        return $this->db->select($columns);
    }

    // Add a where clause to the query
    public function where($column, $operation, $value)
    {
        $this->db->where($column, $operation, $value);
        return $this;
    }

    // Add a where clause to the query
    public function orWhere($column, $operation, $value)
    {
        $this->db->where($column, $operation, $value);
        return $this;
    }

    // Add a where clause to the query
    public function search($column, $value)
    {
        $this->db->search($column, $value);
        return $this;
    }

    public function first()
    {
        return $this->db->first();
    }

    public function last()
    {
        return $this->db->last();
    }

    // Set the fetch mode for the query
    public function setFetchMode($fetchMode, $className = null)
    {
        $this->db->setFetchMode($fetchMode, $className);
        return $this;
    }

    public function join($table,$column1,$operation,$column2)
    {
        $this->db->join($table,$column1,$operation,$column2);
        return $this;   
    }
    
    public function __get($name)
    {
    }
}
