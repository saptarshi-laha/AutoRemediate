<?php

    if (isset($_GET['platform'])) {
        $platform = $_GET['platform'];

        if (strcmp(strtolower($platform), "windows") == 0){
            $filename = "dataw.json";
            if(file_exists($filename)){

                //Get file type and set it as Content Type
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                header('Content-Type: ' . finfo_file($finfo, $filename));
                finfo_close($finfo);

                //Use Content-Disposition: attachment to specify the filename
                header('Content-Disposition: attachment; filename='.basename($filename));

                //No cache
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');

                //Define file size
                header('Content-Length: ' . filesize($filename));

                ob_clean();
                flush();
                readfile($filename);
                exit;
            }
            else {
                echo "File Not Found!";
            }
        }
        else if (strcmp(strtolower($platform), "linux") == 0){
            $filename = "datal.json";
            if(file_exists($filename)){

                //Get file type and set it as Content Type
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                header('Content-Type: ' . finfo_file($finfo, $filename));
                finfo_close($finfo);

                //Use Content-Disposition: attachment to specify the filename
                header('Content-Disposition: attachment; filename='.basename($filename));

                //No cache
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');

                //Define file size
                header('Content-Length: ' . filesize($filename));

                ob_clean();
                flush();
                readfile($filename);
                exit;
            }
            else{
                echo "File Not Found!";
            }
        }
        else if (strcmp(strtolower($platform), "darwin") == 0){
            $filename = "datad.json";
            if(file_exists($filename)){

                //Get file type and set it as Content Type
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                header('Content-Type: ' . finfo_file($finfo, $filename));
                finfo_close($finfo);

                //Use Content-Disposition: attachment to specify the filename
                header('Content-Disposition: attachment; filename='.basename($filename));

                //No cache
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');

                //Define file size
                header('Content-Length: ' . filesize($filename));

                ob_clean();
                flush();
                readfile($filename);
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

