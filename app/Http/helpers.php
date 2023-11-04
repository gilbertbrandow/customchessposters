<?php

namespace App;

function formatPGN(string $pgn): array
{

    $rows = []; 
    $rowsIndex = 0; 

    for($i = 0; $i < strlen($pgn); $i++) 
    {

        if (($pgn[$i] == ' ' &&  preg_match('~[0-9]+~', $pgn[$i + 1])) || !isset($pgn[$i + 1])) {
            $move = substr($pgn, 0, $i + 1);
            $pgn = substr($pgn, $i + 1);
            $i = 0;

             //Check if fits in current row[], can create new row or should return
             if (isset($rows[$rowsIndex])) {
                if (strlen($rows[$rowsIndex]) + strlen($move) < 210) {
                    $rows[$rowsIndex] .= ' ' . $move;

                } else if ($rowsIndex < 5) {
                    $rowsIndex++;
                    $rows[$rowsIndex] = $move;
                } else {
                    $rows[$rowsIndex] .= "...";
                    return $rows;
                }
            } else {
                $rows[$rowsIndex] = $move;
            }

        }
    }

    return $rows;
}

function diagramInfo(string $pgn, string $moveComment, int $diagramPosition): string
{

    if(!$diagramPosition) return '';

    //Loop through the array until finding correct move number and set starting index of that move
    $indexOfMove = strpos($pgn, (round($diagramPosition / 2)) . '.') + strlen(strval(round($diagramPosition / 2))) + 2;

    //Get index of next space
    $spaceIndex = strpos($pgn, ' ', $indexOfMove);

    if($spaceIndex == -1) $spaceIndex = strlen($pgn); 

    //Depending on if half move or not, look until next ' ', or from next ' ' to the one after that
    if ($diagramPosition % 2 != 0) {
        //White move
        return "Position after White's move " . round($diagramPosition / 2) . '. ' . substr($pgn, $indexOfMove, $spaceIndex - $indexOfMove) . ($moveComment ? ', ' . $moveComment : '');
    } else {
        //Black move
        $nextSpaceIndex = (strpos($pgn, ' ', $spaceIndex + 1) > 0) ? strpos($pgn, ' ', $spaceIndex + 1) : strlen($pgn);
        return "Position after Black's move " . round($diagramPosition / 2) . '. ... ' . substr($pgn, $spaceIndex + 1, $nextSpaceIndex - $spaceIndex) . ($moveComment ? ', ' . $moveComment : '');
    } 
}