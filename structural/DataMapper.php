<?php

namespace structural;

class DataMapper
{
    private string $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function make($args): DataMapper
    {
        return new self($args["name"]);
    }

}

class WorkerMapper
{
    private WorkerStorageAdapter $workerStorageAdapter;

    /**
     * @param WorkerStorageAdapter $workerStorageAdapter
     */
    public function __construct(WorkerStorageAdapter $workerStorageAdapter)
    {
        $this->workerStorageAdapter = $workerStorageAdapter;
    }

    public function findById($id): DataMapper|string
    {
        $res = $this->workerStorageAdapter->find($id);
        if ($res === null) {
            return "Worker with this id doesn't exists";
        }
        return $this->make($res);
    }

    private function make($args): DataMapper
    {
        return DataMapper::make($args);
    }

}

class WorkerStorageAdapter
{
    private array $data = [];

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function find($id)
    {
        if (isset($this->data[$id])){
            return $this->data[$id];
        }
        return null;
    }
}

$data = [
    1=>[
        "name" => "Boris"
    ]
];
$workerStorageAdapter = new WorkerStorageAdapter($data);

$workerMapper = new WorkerMapper($workerStorageAdapter);

var_dump($workerMapper->findById(2));
var_dump($workerMapper->findById(1));