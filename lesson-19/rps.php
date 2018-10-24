<?php
/**
 * Rock-Paper-Scissors
 */
define('SHAPES',  ['R', 'P', 'S']);

function getUserShape()
{
    // 1. $_REQUEST ($_GET, $_POST)
    $shape = $_REQUEST['shape'] ?? 'Z';
    
    if (!in_array($shape, SHAPES)) {
        die('Enter correct data; <a href="index.php">Replay</a>');
    }
   
    return $shape;

    // 2. file_get_contents
    // $shape = trim(file_get_contents(__DIR__ . '/user-shape'));
    
    // return $shape;

    // 3. readline
    // $shape = readline(implode(', ', SHAPES) . ':');
  
    // if (!in_array($shape, SHAPES)) {
    //     getUserShape();
    // }
    
    // return $shape;
}

function getCompShape()
{
    return SHAPES[array_rand(SHAPES)];
}

function playRockPaperScissors($firstShape, $secondShape)
{
    if (!in_array($firstShape, SHAPES)) {
        if (!in_array($secondShape, SHAPES)) {
            return 'draw';
        }

        return 'comp';
    }

    if (!in_array($secondShape, SHAPES)) {
        return 'user';
    }

    $firstIndex = array_search($firstShape, SHAPES);
    $secondIndex = array_search($secondShape, SHAPES);
    $result = $firstIndex - $secondIndex;

    if ($result === -2 || $result === 1) {
        saveScore('user');
        return 'user';
    } else if ($result === -1 || $result === 2) {
        saveScore('comp');
        return 'comp';
    } else {
        saveScore('draw');
        return 'draw';
    }
}

function saveScore($name) {
    $data = trim(@file_get_contents(__DIR__ . '//score'));

    if (!$data) {
        switch ($name) {
            case 'user':
                $score[] = 'user: 1;';
                $score[] = 'comp: 0;';
                $score[] = 'draw: 0;';
                file_put_contents( __DIR__ . '//score', implode(PHP_EOL, $score));
                break;
            case 'comp':
                $score[] = 'user: 0;';
                $score[] = 'comp: 1;';
                $score[] = 'draw: 0;';
                file_put_contents( __DIR__ . '//score', implode(PHP_EOL, $score));
                break;
            case 'draw':
                $score[] = 'user: 0;';
                $score[] = 'comp: 0;';
                $score[] = 'draw: 1;';
                file_put_contents( __DIR__ . '//score', implode(PHP_EOL, $score));
                break;
        }

        return true;
    }

    $data = explode(PHP_EOL, $data);

    foreach ($data as $row) {
        $row = explode(':', $row);

        if (trim($row[0]) === $name) {
            $row[1] = intval($row[1]) + 1 . ';';
        }
        
        $score[] = $row[0] . ': ' . trim($row[1]);
    }

    file_put_contents( __DIR__ . '//score', implode(PHP_EOL, $score));

    return true;
}

$firstShape = getUserShape();
$secondShape = getCompShape();

echo 'First: user - ' . "[$firstShape]" . "<br>";
echo 'Second: comp - ' . "[$secondShape]" . "<br>";
echo 'Win: ' . playRockPaperScissors($firstShape, $secondShape) . "<br>";
echo '<a href="score.php">Score</a><br>';
echo '<a href="index.php">Replay</a><br>';