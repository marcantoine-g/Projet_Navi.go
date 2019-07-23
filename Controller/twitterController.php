<?php

class twitterController{
    
    public function afficheTwitter(){
      $tab=[ "./img/ligne/M1.svg" , "./img/ligne/M2.svg" , "./img/ligne/M3.svg" , "./img/ligne/M4.svg" , "./img/ligne/M5.svg" , "./img/ligne/M6.svg" , "./img/ligne/M7.svg" , "./img/ligne/M8.svg" , "./img/ligne/M9.svg" , "./img/ligne/M10.svg" , "./img/ligne/M11.svg" , "./img/ligne/M12.svg" , "./img/ligne/M13.svg" , "./img/ligne/M14.svg" ];

        $total = 14;

       require('./View/twitter.php'); 
    }
    
    public function afficheTwitter2(){
        
    $num = $_GET['num'];

    $url = array(
        "<a class='twitter-timeline' href='https://twitter.com/Ligne1_RATP?ref_src=twsrc%5Etfw'>Tweets by Ligne1_RATP</a> <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>"
        ,
        "<a class='twitter-timeline' href='https://twitter.com/Ligne2_RATP?ref_src=twsrc%5Etfw'>Tweets by Ligne2_RATP</a> <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>"
        ,
        "<a class='twitter-timeline' href='https://twitter.com/Ligne3_RATP?ref_src=twsrc%5Etfw'>Tweets by Ligne3_RATP</a> <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>"
        ,
        "<a class='twitter-timeline' href='https://twitter.com/Ligne4_RATP?ref_src=twsrc%5Etfw'>Tweets by Ligne4_RATP</a> <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>"
        ,
        "<a class='twitter-timeline' href='https://twitter.com/Ligne5_RATP?ref_src=twsrc%5Etfw'>Tweets by Ligne5_RATP</a> <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>"
        ,
        "<a class='twitter-timeline' href='https://twitter.com/Ligne6_RATP?ref_src=twsrc%5Etfw'>Tweets by Ligne6_RATP</a> <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>"
        ,
        "<a class='twitter-timeline' href='https://twitter.com/Ligne7_RATP?ref_src=twsrc%5Etfw'>Tweets by Ligne7_RATP</a> <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>"
        ,
        "<a class='twitter-timeline' href='https://twitter.com/Ligne8_RATP?ref_src=twsrc%5Etfw'>Tweets by Ligne8_RATP</a> <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>"
        ,
        "<a class='twitter-timeline' href='https://twitter.com/Ligne9_RATP?ref_src=twsrc%5Etfw'>Tweets by Ligne9_RATP</a> <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>"
        ,
        "<a class='twitter-timeline' href='https://twitter.com/Ligne10_RATP?ref_src=twsrc%5Etfw'>Tweets by Ligne10_RATP</a> <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>"
        ,
        "<a class='twitter-timeline' href='https://twitter.com/Ligne11_RATP?ref_src=twsrc%5Etfw'>Tweets by Ligne11_RATP</a> <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>"
        ,
        "<a class='twitter-timeline' href='https://twitter.com/Ligne12_RATP?ref_src=twsrc%5Etfw'>Tweets by Ligne12_RATP</a> <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>"
        ,
        "<a class='twitter-timeline' href='https://twitter.com/Ligne13_RATP?ref_src=twsrc%5Etfw'>Tweets by Ligne13_RATP</a> <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>"
        ,
        "<a class='twitter-timeline' href='https://twitter.com/Ligne14_RATP?ref_src=twsrc%5Etfw'>Tweets by Ligne14_RATP</a> <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>"
    );
       require('./View/twitter2.php'); 
    }
    
    
}