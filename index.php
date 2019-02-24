<?php
        $dev = isset($_GET["dev"]) ? strtotime("now") : false;
        $task = isset($_GET["task"]) ? $_GET["task"] : '';
    ?><!DOCTYPE html>
    <html>
        <head>
            <title>Page Title</title>
            <link href="css/style.css?<?php echo $dev; ?>" rel="stylesheet" />
        </head>
        <body>
            <div id="target"></div>
            <script src="js/wes.mantooth.js?<?php echo $dev; ?>"></script>
            <?php
                loadsscripts("js/");
                function loadsscripts($dir) {
                    global $dev;
                    // load files
                    $files = scandir($dir);
                    foreach($files as $file) {
                        if($file == "wes.mantooth.js" || (strpos($file,".js") === false)) {continue;}
                        echo '<script src="'.$dir.$file.'?'.$dev.'&v=1.1.1"></script>'."\n";
                    }   
                }
            ?>
            <script>
                $(document).ready(function(){
                        let task = '<?php echo $task; ?>';
                        switch(task) {
                                case 'newimage':
                                        break;
                                case 'showimages':
                                        break;
                                case 'train':
                                        break;
                                case 'showimagesbyclass':
                                        break;
                                default:
                                        // graph results
                        }
                });
            </script>
        </body>
    </html>