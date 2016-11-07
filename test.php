 <?php


    setlocale(LC_ALL,"es_CL");
    $loc = setlocale(LC_TIME, NULL);
    $dias=3;
    $a=strftime("%A, %d de %B del %Y. %H:%M:%S",mktime(0,0,0,date("m"),date("d")+1,date("Y")))."<br>";
    echo $a;
    
?> 