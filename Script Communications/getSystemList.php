<?php

    if (isset($_GET['platform'])) {
        $platform = $_GET['platform'];

        if (strcmp(strtolower($platform), "windows") == 0){
            $filename = "dataw.json";
            if(file_exists($filename)){
                $fileContent = file_get_contents($filename);
                $fileContent =  "msspName\n".base64_encode($fileContent);
                echo $fileContent;
                exit;
            }
            else {
                echo "File Not Found!";
            }
        }
        else if (strcmp(strtolower($platform), "linux") == 0){
            $filename = "datal.json";
            if(file_exists($filename)){
                $fileContent = file_get_contents($filename);
                $fileContent =  "msspName\n".base64_encode($fileContent);
                echo $fileContent;
                exit;
            }
            else{
                echo "File Not Found!";
            }
        }
        else if (strcmp(strtolower($platform), "darwin") == 0){
            $filename = "datad.json";
            if(file_exists($filename)){
                $fileContent = file_get_contents($filename);
                $fileContent =  "msspName\n".base64_encode($fileContent);
                echo $fileContent;
                exit;
            }
            else{
                echo "File Not Found!";
            }
        }
        else{
                echo "Invalid Platform Specification.";
        }

    } else {
        echo "Invalid Platform Specification.";
    }

