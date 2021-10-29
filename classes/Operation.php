<?php

class Operation{

    private $operation;
    private $a;
    private $b;

    private $denominatorEqual;

    public function __construct($operation , $a , $b){
        $this->operation = $operation;
        $this->a = $a;
        $this->b = $b; 
        
        $this->denominatorsEqual = Fraction::checkDenominator($a->getQ() , $b->getQ());
        
    }

    public function sum(){
        if($this->denominatorsEqual){
            $result = new Fraction(null, 
                                    $this->a->getP() + $this->b->getP() ,  
                                    $this->a->getQ());
        }else{
            $denominator = $this->a->getQ() * $this->b->getQ();
            $numerator = (( $denominator / $this->a->getQ() ) * $this->a->getP()) +
                            (( $denominator / $this->b->getQ() ) * $this->b->getP());
           $result = new Fraction(null , $numerator , $denominator);
        }
        
        return $result;
    }

    public function test(){
        return [ $this->a->getP() , $this->a->getQ() ];
    }
}