<?php

    $error="";
    $result="";
    $name="";
    if($_GET)
    {
        $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$_GET['city']."/forecasts/latest");
        
        if($file_headers[0]=='HTTP/1.1 404 Not Found')
        {
            $error='<div class="alert alert-danger" role="alert">city could not be found
                            </div>';
        }
        
        
        else
        {
            $_GET['city']=str_replace(" ","",$_GET['city']);
        $original=file_get_contents("https://www.weather-forecast.com/locations/".$_GET['city']."/forecasts/latest");
         $firstArray=explode('<tr class="b-forecast__table-description b-forecast__hide-for-small days-summaries"><th></th><td colspan="9"><span class="b-forecast__table-description-title"><h2>',$original);
         
         $cityArray=explode('<div class="main-title__issued show-for-medium-up">',$original);
         
         
         
            if(sizeof($firstArray)>1)
            {
                $weather=explode('</span></p>',$firstArray[1]);
                $cityName=explode("forecast issued:",$cityArray[1]);
                $name=$cityName[0];
                if(sizeof($weather)>1)
                    {
                        $result=$weather[0];
                        $result='<div class="alert alert-success" role="alert">
                        '.$name.'<br>'.$result.'
                        </div>';
                    }
                     else
                         {
                             $error="the city could not be found";
                            $error='<div class="alert alert-danger" role="alert">city could not be found
                            </div>';
                         }
                    }
            
             else
                {   
                 $error="the city could not be found";
                    $error='<div class="alert alert-danger" role="alert">
                        city could not be found
                    </div>';
                }
        
        }
    }

?>
<!--add weather.html here-->
