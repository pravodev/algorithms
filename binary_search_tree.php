<?php

class Node
{
    private $left, $right, $data = null;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getPositionOf($value)
    {
        if($value < $this->data){
            return 'left';
        }else if($value > $this->data){
            return 'right';
        }
        return null;
    }
    
    public function insert(int $value)
    {
        $position = $this->getPositionOf($value);
        if($this->data){
            if($position){
                if($this->$position == null){
                    $this->$position = new Node($value);
                }else{
                    $this->$position->insert($value);
                }
            }
        }else{
            $this->data = $data;
        }
        return $this;
    }

    public function insertMany(array $values)
    {
        foreach($values as $value){
            $this->insert($value);
        }
    }
    
    public function find($value)
    {
        $position = $this->getPositionOf($value);
        
        if($position){
            if($this->$position == null){
                return $value . ' not found';
            }
            return $this->$position->find($value);
        }
        return $value . ' found';
    }

    public function showTree()
    {
        if($this->left){
            print_r($this->left->showTree());
        }
        print_r($this->data . ' ');

        if($this->right){
            print_r($this->right->showTree());
        }
        
    }
}

$root = new Node(30);
$root->insertMany([5,12,6,3,4,19,100,24,50,2,102]);
echo ($root->find(100));