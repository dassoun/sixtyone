<?php
/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * PaxPamirEditionTwo implementation : © Julien Coignet <breddabasse@hotmail.com>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * modules/php/Managers/SXTPlayerManager.php
 *
 */

namespace PhobyJuan\SixtyOne\Managers;

use PhobyJuan\SixtyOne\Objects\SXTPlayer;

class SXTPlayerManager extends \APP_DbObject
{
    public function getPlayerById(
        int $id
    ): ?SXTPlayer
    {
        $sql = "SELECT 
                    score_area_1, score_area_2, score_area_3, score_area_4, score_area_5, score_area_6, 
                    area_1_1, area_1_2, area_1_3, area_1_4, area_2_1, area_2_2, area_2_3, area_2_4, 
                    area_2_5, area_3_1_1, area_3_1_2, area_3_2_1, area_3_2_2, area_3_2_3, area_4_1, 
                    area_4_2, area_4_3, area_4_4, area_4_5, area_4_6, area_5_1, area_5_2, area_5_3, 
                    area_5_4, area_5_5, area_5_6, area_6_1, area_6_2, area_6_3, area_6_4, area_6_5
                FROM player
                WHERE player_id = '$id'";

        $res = self::getObjectFromDB( $sql );

        $player = null;

        if ($res) {
            $player = (new SXTPlayer())->setScore_area_1($res['score_area_1'])
                ->setScore_area_2($res['score_area_2'])
                ->setScore_area_3($res['score_area_3'])
                ->setScore_area_4($res['score_area_4'])
                ->setScore_area_5($res['score_area_5'])
                ->setScore_area_6($res['score_area_6'])
                ->setArea_1_1($res['area_1_1'])
                ->setArea_1_2($res['area_1_2'])
                ->setArea_1_3($res['area_1_3'])
                ->setArea_1_4($res['area_1_4'])
                ->setArea_2_1($res['area_2_1'])
                ->setArea_2_2($res['area_2_2'])
                ->setArea_2_3($res['area_2_3'])
                ->setArea_2_4($res['area_2_4'])
                ->setArea_2_5($res['area_2_5'])
                ->setArea_3_1_1($res['area_3_1_1'])
                ->setArea_3_1_2($res['area_3_1_2'])
                ->setArea_3_2_1($res['area_3_2_1'])
                ->setArea_3_2_2($res['area_3_2_2'])
                ->setArea_3_2_3($res['area_3_2_3'])
                ->setArea_4_1($res['area_4_1'])
                ->setArea_4_2($res['area_4_2'])
                ->setArea_4_3($res['area_4_3'])
                ->setArea_4_4($res['area_4_4'])
                ->setArea_4_5($res['area_4_5'])
                ->setArea_4_6($res['area_4_6'])
                ->setArea_5_1($res['area_5_1'])
                ->setArea_5_2($res['area_5_2'])
                ->setArea_5_3($res['area_5_3'])
                ->setArea_5_4($res['area_5_4'])
                ->setArea_5_5($res['area_5_5'])
                ->setArea_5_6($res['area_5_6'])
                ->setArea_6_1($res['area_6_1'])
                ->setArea_6_2($res['area_6_2'])
                ->setArea_6_3($res['area_6_3'])
                ->setArea_6_4($res['area_6_4'])
                ->setArea_6_5($res['area_6_5']);
        }

        return $player;
    }

    public function persist(SXTPlayer $player): void
    {
        $score_area_1 = $player->getScore_area_1();
        $score_area_2 = $player->getScore_area_2(); 
        $score_area_3 = $player->getScore_area_3(); 
        $score_area_4 = $player->getScore_area_4(); 
        $score_area_5 = $player->getScore_area_5(); 
        $score_area_6 = $player->getScore_area_6(); 
        $area_1_1 = $player->getArea_1_1(); 
        $area_1_2 = $player->getArea_1_2(); 
        $area_1_3 = $player->getArea_1_3(); 
        $area_1_4 = $player->getArea_1_4(); 
        $area_2_1 = $player->getArea_2_1(); 
        $area_2_2 = $player->getArea_2_2(); 
        $area_2_3 = $player->getArea_2_3(); 
        $area_2_4 = $player->getArea_2_4(); 
        $area_2_5 = $player->getArea_2_5(); 
        $area_3_1_1 = $player->getArea_3_1_1(); 
        $area_3_1_2 = $player->getArea_3_1_2(); 
        $area_3_2_1 = $player->getArea_3_2_1(); 
        $area_3_2_2 = $player->getArea_3_2_2(); 
        $area_3_2_3 = $player->getArea_3_2_3(); 
        $area_4_1 = $player->getArea_4_1(); 
        $area_4_2 = $player->getArea_4_2(); 
        $area_4_3 = $player->getArea_4_3(); 
        $area_4_4 = $player->getArea_4_4(); 
        $area_4_5 = $player->getArea_4_5(); 
        $area_4_6 = $player->getArea_4_6(); 
        $area_5_1 = $player->getArea_5_1(); 
        $area_5_2 = $player->getArea_5_2(); 
        $area_5_3 = $player->getArea_5_3(); 
        $area_5_4 = $player->getArea_5_4(); 
        $area_5_5 = $player->getArea_5_5(); 
        $area_5_6 = $player->getArea_5_6(); 
        $area_6_1 = $player->getArea_6_1(); 
        $area_6_2 = $player->getArea_6_2(); 
        $area_6_3 = $player->getArea_6_3(); 
        $area_6_4 = $player->getArea_6_4(); 
        $area_6_5 = $player->getArea_6_5();

        $sql = "UPDATE 
                    player 
                SET 
                    score_area_1 = '$score_area_1', 
                    score_area_2 = '$score_area_2', 
                    score_area_3 = '$score_area_3', 
                    score_area_4 = '$score_area_4', 
                    score_area_5 = '$score_area_5', 
                    score_area_6 = '$score_area_6', 
                    area_1_1 = '$area_1_1', 
                    area_1_2 = '$area_1_2', 
                    area_1_3 = '$area_1_3', 
                    area_1_4 = '$area_1_4', 
                    area_2_1 = '$area_2_1', 
                    area_2_2 = '$area_2_2', 
                    area_2_3 = '$area_2_3', 
                    area_2_4 = '$area_2_4', 
                    area_2_5 = '$area_2_5', 
                    area_3_1_1 = '$area_3_1_1', 
                    area_3_1_2 = '$area_3_1_2', 
                    area_3_2_1 = '$area_3_2_1', 
                    area_3_2_2 = '$area_3_2_2', 
                    area_3_2_3 = '$area_3_2_3', 
                    area_4_1 = '$area_4_1', 
                    area_4_2 = '$area_4_2', 
                    area_4_3 = '$area_4_3', 
                    area_4_4 = '$area_4_4', 
                    area_4_5 = '$area_4_5', 
                    area_4_6 = '$area_4_6', 
                    area_5_1 = '$area_5_1', 
                    area_5_2 = '$area_5_2', 
                    area_5_3 = '$area_5_3', 
                    area_5_4 = '$area_5_4', 
                    area_5_5 = '$area_5_5', 
                    area_5_6 = '$area_5_6', 
                    area_6_1 = '$area_6_1', 
                    area_6_2 = '$area_6_2', 
                    area_6_3 = '$area_6_3', 
                    area_6_4 = '$area_6_4', 
                    area_6_5 = '$area_6_5'
                WHERE 
                    player_id = '$player_id'";

        self::DbQuery( $sql );
    }
}