<?php
        $dev = isset($_GET["dev"]) ? strtotime("now") : false;
        $task = isset($_GET["task"]) ? $_GET["task"] : '';
    ?><!DOCTYPE html>
    <html>
        <head>
            <title>Page Title</title>
            <link href="css/style.css?<?php echo $dev; ?>" rel="stylesheet" />
            <style id="dynamicstyle"></style>
        </head>
        <body>
            <div id="controls">
                <select id="psize">
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6" selected="selected">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
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
                                    runIt(setFirst);
                                        break;
                                case 'showimages':
                                        break;
                                case 'train':
                                    runIt(setTrain);
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