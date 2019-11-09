<?php
/**
 * Binary Search Tree
 * 
 * @author Rifqi Khoeruman Azam <pravodev@gmail.com>
 */

class Node
{
    public $left, $right, $data = null;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get position for $value given 
     */
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

    public static function isBinarySearchTree($node, $min = PHP_INT_MIN, $max = PHP_INT_MAX): bool
    {
        if($node !== null && !is_a($node, Node::class)){
            throw new \Exception('$node must be an instance of Node class');
        }
        
        if($node === null){
            return true;
        }

        if($node->data < $min || $node->data > $max){
            return false;
        }

        return self::isBinarySearchTree($node->left, $min, $node->data-1) && self::isBinarySearchTree($node->right, $node->data+1, $max);
    }
}

$root = new Node(30);
$root->insertMany([5,12,6,3,4,19,100,24,50,2,102]);
print_r($root->find(100));
print_r("\n\n\n");

$second_root = new Node(20);
$second_root->left = new Node(11);
$second_root->right = new Node(21);
$second_root->left->left = new Node(22);

if(Node::isBinarySearchTree($second_root)){
    print_r('** $second_root is binary search tree **');
}else{
    print_r('!! $second_root is not binary search tree !!');
}