<?php
        $config = parse_ini_file('../config.ini');
        mysql_connect($config['endpoint'],$config['username'],$config['password']);
        mysql_select_db($config['dbname']);

        $email = $_REQUEST['email'];
        $passkey = $_REQUEST['passkey'];

        $query = "select email,passkey from user where email = '".$email."'";
        $DoesEmailExist = mysql_query($query);

        if(mysql_num_rows($DoesEmailExist) == 0){
                echo 4;
                mysql_close();
                return;
        }
        else{
                $row = mysql_fetch_row($DoesEmailExist);
                $hash_passkey = $row[1];

                if(password_verify($passkey,$hash_passkey)){
                        echo 0;
                }
                else {
                        echo 3;
                }

                mysql_close();
                return;
        }
        mysql_close();
?>