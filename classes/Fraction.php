<?php

class Fraction
{
    private $number;
    private $p;
    private $q;

    public function setNumber($number){
        if (!is_null($number))
            $this->number = $number;         
    }

    public function getP(){
        return $this->p;
    }

    public function getQ(){
        return $this->q;
    }

    public function __construct($number=null ,$p=null , $q=null){
        if(!is_null($number))
            $this->setNumber($number);

        if(!is_null($p) && !is_null($q))
            $this->p = $p;
            $this->q = $q;
        //$this->decimalToFraction();
    }

    public function decimalToFraction(){
        
        $numberParts = explode('.', $this->number);

        if (count($numberParts) !== 2)
            throw new Exception('Input number is not valid.');

        $integer = $numberParts[0];
        $decimal = $numberParts[1];

        $notPeriodic = '';
        $periodic = '';

        for ($i = 0; $i < strlen($decimal); $i++) {
            if (!preg_match('/\b(\d+)\1+\b/', $decimal)) {
                $notPeriodic .= $decimal[0];
                $decimal = substr($decimal, 1);
                continue;
            }

            $periodic = $decimal;
            break;
        }

        if (is_null($periodic))
            throw new Exception('This number doesn\'t have a period.');

        $period = '';

        for ($i = 0; $i < strlen($periodic); $i++) {
            $period .= $periodic[$i];
            $k = $i + 1;
            if ($period[0] === $periodic[$k])
                break;
        }

        if (empty($notPeriodic)) {
            $p = $period;
            $q = str_repeat('9', strlen($period));
        } else {
            $p = intval($notPeriodic . (( $denominator / $this->a->getQ() ) * $this->denominator->a->getP()) . $period) - intval($notPeriodic);
            $q = str_repeat('9', strlen($period)) . str_repeat('0', strlen($notPeriodic));
        }

        $this->p = $p;
        $this->q = $q;
    }

    public function fractionToDecimal(){
        return $this->p / $this->q;    
    }

    public static function checkDenominator($q1 , $q2){
        return $q1 === $q2;        
    }

    public function rationlize(){
        /*$p = $this->p;
        $q = $this->q;

        if($p > $q){
            $a = $p;
            $b = $q;
        }
        
        if(($q % $p) === 0){
            $p 
        }*/

    }

    public function latexFraction(){
        return '\frac{' . $this->p . '}{' . $this->q . '}';
    }
}
