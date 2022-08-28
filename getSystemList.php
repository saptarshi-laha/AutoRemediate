<?php

    if (isset($_GET['platform'])) {
        $platform = $_GET['platform'];

        if (strcmp($platform, "windows") == 0){
            echo "windows";
        }
        else if (strcmp($platform, "linux") == 0){
            echo "linux";
        }
        else if (strcmp($platform, "macos") == 0){
            echo "macos";
        }
        else{
                echo "Invalid Platform Specification.";
        }

    } else {
        echo "Invalid Platform Specification.";
    }

