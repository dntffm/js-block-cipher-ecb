<?php
namespace App;
class MYCrypt{

    public function stringToBinary($string)
    {
        $characters = str_split($string);
    
        $binary = [];
        foreach ($characters as $character) {
            /* $data = unpack('H*', $character);
            $binary[] = base_convert($data[1], 16, 2); */
            $dec = ord($character);
            $bin = decbin($dec);
            if(strlen($bin) < 8){
                $temp = "";
                for ($i=0; $i < 8 - strlen($bin); $i++) { 
                    $temp .= '0';
                }

                $temp .= $bin;
                $bin = $temp;
            }

            $binary[] = $bin;
        }
    
        return implode('', $binary);    
    }
 

    public static function encrypt($plaintext,$key){
        $binaries = (new self)->stringToBinary($plaintext);
        $splitedData = str_split($binaries,4);
        
        $xorData = [];
        foreach($splitedData as $data){

            $temp = decbin(bindec($data) ^ bindec($key));
            if(strlen($temp) < 4){
                $tmp = "";
                for ($i=0; $i < 4 - strlen($temp); $i++) { 
                    $tmp .= "0";
                }
                $tmp .= $temp;
                $temp = $tmp;

            }
            $xorData[] = $temp;
            
        }
        
        $newposData = [];
        foreach($xorData as $data){
            $temp = "";
            $data = str_split($data);
            $temp .= $data[1];
            $temp .= $data[2];
            $temp .= $data[3];
            $temp .= $data[0];
            $newposData[] = $temp;
        }
        
        $cipher = "";
        foreach($newposData as $data){
            //$cipher .= chr(bindec( $data)+50);
            $cipher .= $data;
        }
        return $cipher;
    }

    public static function decrypt($ciphertext,$key){
        $ciphertext = str_split($ciphertext,4);
        $realPos =[];
        foreach ($ciphertext as $dt) {
            $data = str_split($dt);
            //$data = decbin(ord($dt)-50);
           
            $temp = "";
            $temp .= $data[3];
            $temp .= $data[0];
            $temp .= $data[1];
            $temp .= $data[2];
            $realPos[] = $temp;
        }

        $xorData = "";
        foreach($realPos as $data){

            $temp = decbin(bindec($data) ^ bindec($key));
            if(strlen($temp) < 4){
                $tmp = "";
                for ($i=0; $i < 4 - strlen($temp); $i++) { 
                    $tmp .= "0";
                }
                $tmp .= $temp;
                $temp = $tmp;

            }
            $xorData .= $temp;
            
        }
        $notSplited = str_split( $xorData,8);
        $plaintext = "";
        foreach ($notSplited as $data) {
            $plaintext .= chr(bindec($data));
        }

        return $plaintext;
    }
}

/* $crypt = new Crypt();

$encrypted = $crypt->encrypt('dentacakepSDASD','1000');

var_dump($crypt->decrypt($encrypted,'1000')); */

?>
