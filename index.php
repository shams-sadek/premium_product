<?php

$arr = [
        [
            'id' => 1,
            'user_id' => 50,
            'post_premium' => 1
        ],
        [
            'id' => 2,
            'user_id' => 60,
            'post_premium' => 0
        ],
        [
            'id' => 3,
            'user_id' => 70,
            'post_premium' => 0
        ],
        [
            'id' => 4,
            'user_id' => 88,
            'post_premium' => 1
        ],
        [
            'id' => 5,
            'user_id' => 99,
            'post_premium' => 0
        ],
        [
            'id' => 6,
            'user_id' => 55,
            'post_premium' => 0
        ],
        [
            'id' => 7,
            'user_id' => 199,
            'post_premium' => 1
        ],

];


class PremiumProduct {

    protected $arr = null;

    protected $result = null;

    protected $premium = null;
    protected $nonPremium = null;

    protected $merge = null;

    public function __construct($arr)
    {
        $this->arr = $arr;

        $this->setPremium();

        $this->setNonPremium();

        $this->setMerge();

        $this->setResult();

    }

    public function setPremium()
    {
        $this->premium = array_filter($this->arr, function($a){
            return ( $a['post_premium'] == 1 );
        });
    }

    public function setNonPremium()
    {
        $this->nonPremium = array_filter($this->arr, function($a){
            return ( $a['post_premium'] == 0 );
        });
    }

    public function setMerge()
    {
        $this->merge = array_map(function($a, $b){
            return [$a, $b];
        }, $this->premium, $this->nonPremium);

    }

    public function setResult()
    {
        $this->result = array_reduce($this->merge, function($carry, $item){

             foreach($item as $product){
                 if( ! empty($product) ) {
                     $carry[] = $product;
                 }
             }

             return $carry;

        });
    }

    public function get()
    {
        return $this->result;
    }

}

$obj = new PremiumProduct($arr);

echo '<pre>';
print_r($obj->get());
echo '</pre>';
