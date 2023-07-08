<?php

namespace App\Core;

class Database
{
    private $connection;
    private $fetchMode;
    private $className;
    private $orderByColumn;
    private $orderByDirection;
    private $perPage;
    private $whereConditions;
    private $whereParams;
    private $selectedColumns;
    private $table;
    private $joinClauses;

    public function __construct()
    {
        $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";

        try {
            $this->connection = new \PDO($dsn, DB_USER, DB_PASS);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        } catch (\PDOException $e) {
            throw new \Exception("Failed to connect to the database: " . $e->getMessage(), $e->getCode());
        }

        // Set default fetch mode to associative array
        $this->fetchMode = \PDO::FETCH_ASSOC;
        $this->className = null;
        $this->orderByColumn = null;
        $this->orderByDirection = 'ASC';
        $this->perPage = null;
        $this->whereConditions = '';
        $this->whereParams = [];
        $this->joinClauses = [];
        $this->table = '';
    }

    /**
     * Disconnect from the database
     */
    public function disconnect()
    {
        $this->connection = null;
    }

    /**
     * Set the order by column and direction
     *
     * @param string $column
     * @param string $direction
     * @return $this
     */
    public function orderBy($column, $direction = 'ASC')
    {
        $this->orderByColumn = $column;
        $this->orderByDirection = strtoupper($direction) === 'DESC' ? 'DESC' : 'ASC';
        return $this;
    }

    /**
     * Enable pagination with a specified number of items per page
     *
     * @param int $perPage
     * @return $this
     */
    public function paginate($perPage)
    {
        $this->perPage = max(1, intval($perPage));
        return $this;
    }

    /**
     * Select the table for the query
     *
     * @param string $table
     * @return $this
     * @throws \Exception if the table does not exist
     */
    public function table($table)
    {
        $query = "SHOW TABLES LIKE '$table';";
        $statement = $this->prepareAndExecuteQuery($query);

        if ($statement->rowCount() === 0) {
            throw new \Exception("Table $table does not exist.");
        } else {
            $this->table = $table;
            return $this;
        }
    }

    /**
     * Set the fetch mode for the query results
     *
     * @param mixed $fetchMode
     * @param string|null $className
     * @return $this
     */
    public function setFetchMode($fetchMode, $className = null)
    {
        $this->fetchMode = $fetchMode;
        $this->className = $className;
        return $this;
    }

    /**
     * Create a new record in the database
     *
     * @param array $data
     * @return int
     */
    public function create($data)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $this->prepareAndExecuteQuery($query, $data);
        return $this->connection->lastInsertId();
    }

    /**
     * Update records in the database based on conditions
     *
     * @param array $data
     * @return int
     */
    public function update($data)
    {
        $setClause = [];

        foreach ($data as $column => $value) {
            $setClause[] = "$column = :$column";
        }

        $setParams = $data;

        $query = "UPDATE {$this->table} SET " . implode(" , ", $setClause) . " WHERE {$this->whereConditions}";

        $params = array_merge($this->whereParams, $setParams);

        $statement = $this->prepareAndExecuteQuery($query, $params);

        return $statement->rowCount();
    }


    /**
     * Retrieve records from the database
     *
     * @param array $columns
     * @return $this
     */
    public function select($columns = [])
    {
        $this->selectedColumns = array_merge($this->selectedColumns ?? [], $columns);
        return $this;
    }

    /**
     * Delete records from the database based on conditions
     *
     * @return int
     */
    public function delete()
    {
        $query = "DELETE FROM {$this->table}";
        $statement = $this->prepareAndExecuteQuery($query, $this->whereParams);
        return $statement->rowCount();
    }

    /**
     * Find a record in the database by ID
     *
     * @param int $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->where('id', '=', $id)->get(true);
    }

    /**
     * Find the first record matching the conditions
     * @return mixed
     */
    public function first()
    {
        $this->orderBy('id', 'asc');
        return $this->get(true);
    }

    /**
     * Find the last record matching the conditions
     * @return mixed
     */
    public function last()
    {
        $this->orderBy('id', 'desc');
        return $this->get(true);
    }

    /**
     * Add a WHERE clause to the query
     *
     * @param string $column
     * @param string $operation
     * @param mixed $value
     * @return $this
     */
    public function where($column, $operation, $value)
    {
        $this->whereConditions .= $this->whereConditions ? " AND $column $operation :$column" : "$column $operation :$column";
        $this->whereParams[$column] = $value;
        return $this;
    }

    /**
     * Add an OR WHERE clause to the query
     *
     * @param string $column
     * @param string $operation
     * @param mixed $value
     * @return $this
     */
    public function orWhere($column, $operation, $value)
    {
        $this->whereConditions .= $this->whereConditions ? " OR $column $operation :$column" : "$column $operation :$column";
        $this->whereParams[$column] = $value;
        return $this;
    }
    /**
     * Perform a search in the specified column for the given keyword
     *
     * @param string $column 
     * @param string $keyword
     * @return $this
     */
    public function search($column, $keyword)
    {
        $this->where($column, 'LIKE', '%' . $keyword . '%');
        return $this;
    }


    /**
     * Prepare and execute a database query
     *
     * @param string $query
     * @param array $params
     * @return \PDOStatement
     */
    private function prepareAndExecuteQuery($query, $params = [])
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        if ($this->fetchMode !== null) {
            if ($this->className !== null) {
                $statement->setFetchMode($this->fetchMode, $this->className);
            } else {
                $statement->setFetchMode($this->fetchMode);
            }
        }

        return $statement;
    }

    /**
     * Retrieve records from the database
     *
     * @param bool $single
     * @return mixed|array
     */
    public function get($single = false)
    {
        $query = $this->buildQuery([
            'columns' => $this->selectedColumns ?? '*',
            'whereConditions' => $this->whereConditions,
            'orderByColumn' => $this->orderByColumn,
            'orderByDirection' => $this->orderByDirection,
            'joinClauses' => $this->joinClauses,
        ]);
        
        $statement = $this->prepareAndExecuteQuery($query, $this->whereParams);

        if ($single) {
            return $statement->fetch();
        }

        $results = $statement->fetchAll();

        if ($this->perPage !== null) {
            $currentPage = $_GET['page'] ?? 1;
            $startIndex = ($currentPage - 1) * $this->perPage;
            $paginatedResults = array_slice($results, $startIndex, $this->perPage);
            $lastPage = ceil(count($results) / $this->perPage);

            $paginationData = [
                'total' => count($results),
                'per_page' => $this->perPage,
                'current_page' => $currentPage,
                'last_page' => $lastPage,
                'next_page_url' => $currentPage < $lastPage ? "?page=" . ($currentPage + 1) : null,
                'prev_page_url' => $currentPage > 1 ? "?page=" . ($currentPage - 1) : null,
            ];

            return ['data' => $paginatedResults, 'pagination' => $paginationData];
        }

        return $results;
    }
    /**
     * Build the SELECT query
     *
     * @param array $params
     * @return string
     */
    private function buildQuery($params)
    {
        $columns = isset($params['columns']) ? $params['columns'] : '*';
        $whereConditions = isset($params['whereConditions']) ? $params['whereConditions'] : '';
        $orderByColumn = isset($params['orderByColumn']) ? $params['orderByColumn'] : null;
        $orderByDirection = isset($params['orderByDirection']) ? $params['orderByDirection'] : 'ASC';
        $limit = isset($params['limit']) ? $params['limit'] : null;
        $joinClauses = isset($params['joinClauses']) ? $params['joinClauses'] : [];


        if (is_array($columns)) {
            $columns = implode(", ", $columns);
        }

        $query = "SELECT {$columns} FROM {$this->table}";

        if (!empty($joinClauses)) {
            $query .= ' ' . implode(' ', $joinClauses);
        }

        if (!empty($whereConditions)) {
            $query .= " WHERE " . $whereConditions;
        }

        if ($orderByColumn !== null) {
            $query .= " ORDER BY {$orderByColumn} {$orderByDirection}";
        }

        if ($limit !== null) {
            $query .= " LIMIT " . intval($limit);
        }

        return $query;
    }

    /**
     * Retrieve a specified number of records from the database
     *
     * @param int $count
     * @return mixed|array
     */
    public function take($count)
    {
        $query = $this->buildQuery([
            'columns' => $this->selectedColumns ?? '*',
            'whereConditions' => $this->whereConditions,
            'orderByColumn' => $this->orderByColumn,
            'orderByDirection' => $this->orderByDirection,
            'joinClauses' => $this->joinClauses,
            'limit' => $count,
        ]);
        $statement = $this->prepareAndExecuteQuery($query, $this->whereParams);
        return $statement->fetchAll();
    }


    public function join($table, $column1, $operator, $column2)
    {

        $joinClause = "JOIN $table ON $column1 $operator $column2";
        $this->joinClauses[] = $joinClause;
        return $this;
    }
}
