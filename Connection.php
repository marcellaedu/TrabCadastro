<?php
    //Conexão com banco de dados
    class Connection{
        private static $conn = null;

        public static function getConnection(){

            if(self::$conn == null){
                $opcoes = array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                );

                self::$conn = new PDO("mysql:host=localhost;dbname=dbjogador", "root", "bancodedados", $opcoes);
    
                //print_r($connec);
            }

            return self::$conn;
        }
    }
?>