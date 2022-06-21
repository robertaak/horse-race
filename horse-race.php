<?php

$minSpeed = 1;
$maxSpeed = 3;
$distance = 10;
$actionSpeed = 1;

$players = explode(' ', readline("Enter players: "));
$bet = readline('Enter bet: ');
$choice = readline('Enter player to bet on: ');

$track = [];

for ($i = 0; $i < count($players); $i++) {
    $track[$i] = array_fill(0, $distance, '-');
    $track[$i][0] = $players[$i];
}


$iterations = 0;
$winners = [];

while (count($winners) < count($players)) {
    system('clear');

    for ($i = 0; $i < count($players); $i++) {
        $currentPosition = array_search($players[$i], $track[$i]);

        if ($currentPosition === false) continue;

        $step = rand($minSpeed, $maxSpeed);
        $nextPosition = $currentPosition + $step;

        if ($nextPosition > $distance) {
            $nextPosition = $distance;
        }
        if ($nextPosition === $distance && !in_array($players[$i], $winners)) {
            $winners[] = $players[$i];
        }
        if (!in_array($players[$i], $winners)) {
            $track[$i][$nextPosition] = $players[$i];
            $track[$i][$currentPosition] = '-';
        }

        foreach ($track as $line) {
            echo implode('', $line);
            echo PHP_EOL;
        }

        $iterations++;
        sleep($actionSpeed);
    }
    foreach ($winners as $place => $player) {
        echo ($place +1). ". - $player".PHP_EOL;
    }
    if ($choice === $winners[0]) {
        $prize = $bet * count($players);
        echo "You've won $$prize!";
    } else {
        $loss = $bet;
        echo "You've lost $$loss!";
    }
}