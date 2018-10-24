<?php
    $clear = $_REQUEST['clear'] ?? false;
    if ($clear) {
        clearScore();
    }

    function getScore() {
        $data = trim(@file_get_contents(__DIR__ . '//score'));

        if (!$data) {
            echo 'user: 0; <br>';
            echo 'comp: 0; <br>';
            echo 'draw: 0; <br>';
            echo '<a href="index.php">Play</a>';
            return false;
        }
        $data = explode(PHP_EOL, $data);

        foreach ($data as $value) {
            echo $value . '<br>';
        }
        echo '<a href="index.php">Play</a><br>';
        echo '<a href="score.php?clear=true">Clear score</a><br>';

        return true;
    }

    function clearScore() {
        file_put_contents( __DIR__ . '//score', '');
    }

    getScore();