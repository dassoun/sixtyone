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
    public function getById(
        int $id
    ): ?SXTPlayer
    {
        $sql = "SELECT 
                    player_id, 
                    die_1, die_2, die_3, location_chosen,
                    score_area_1, score_area_2, score_area_3, score_area_4, score_area_5, score_area_6, 
                    area_1_1, area_1_2, area_1_3, area_1_4, 
                    area_2_1, area_2_2, area_2_3, area_2_4, area_2_5, 
                    area_3_1_1, area_3_1_2, area_3_2_1, area_3_2_2, area_3_2_3, 
                    area_4_1, area_4_2, area_4_3, area_4_4, area_4_5, area_4_6, 
                    area_5_1, area_5_2, area_5_3, area_5_4, area_5_5, area_5_6, 
                    area_6_1, area_6_2, area_6_3, area_6_4, area_6_5
                FROM player
                WHERE player_id = '$id'";

        $res = self::getObjectFromDB( $sql );

        $player = null;

        if ($res) {
            $player = (new SXTPlayer())->setPlayer_id($res['player_id'])
                ->setDie_1($res['die_1'])
                ->setDie_2($res['die_2'])
                ->setDie_3($res['die_3'])
                ->setLocation_chosen($res['location_chosen'])
                ->setScore_area_1($res['score_area_1'])
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
        $player_id = $player->getPlayer_id();
        $die_1 = $player->getDie_1();
        $die_2 = $player->getDie_2();
        $die_3 = $player->getDie_3();
        $location_chosen = $player->getLocation_chosen();
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
                    die_1 = ".(!empty($die_1) ? "'$die_1'" : "NULL").", 
                    die_2 = ".(!empty($die_2) ? "'$die_2'" : "NULL").", 
                    die_3 = ".(!empty($die_3) ? "'$die_3'" : "NULL").",
                    location_chosen = ".(!empty($location_chosen) ? "'$location_chosen'" : "NULL").",
                    score_area_1 = ".(!empty($score_area_1) ? "'$score_area_1'" : "NULL").",
                    score_area_2 = ".(!empty($score_area_2) ? "'$score_area_2'" : "NULL").",
                    score_area_3 = ".(!empty($score_area_3) ? "'$score_area_3'" : "NULL").",
                    score_area_4 = ".(!empty($score_area_4) ? "'$score_area_4'" : "NULL").",
                    score_area_5 = ".(!empty($score_area_5) ? "'$score_area_5'" : "NULL").",
                    score_area_6 = ".(!empty($score_area_6) ? "'$score_area_6'" : "NULL").",
                    area_1_1 = ".(!empty($area_1_1) ? "'$area_1_1'" : "NULL").",
                    area_1_2 = ".(!empty($area_1_2) ? "'$area_1_2'" : "NULL").",
                    area_1_3 = ".(!empty($area_1_3) ? "'$area_1_3'" : "NULL").",
                    area_1_4 = ".(!empty($area_1_4) ? "'$area_1_4'" : "NULL").",
                    area_2_1 = ".(!empty($area_2_1) ? "'$area_2_1'" : "NULL").",
                    area_2_2 = ".(!empty($area_2_2) ? "'$area_2_2'" : "NULL").",
                    area_2_3 = ".(!empty($area_2_3) ? "'$area_2_3'" : "NULL").",
                    area_2_4 = ".(!empty($area_2_4) ? "'$area_2_4'" : "NULL").",
                    area_2_5 = ".(!empty($area_2_5) ? "'$area_2_5'" : "NULL").",
                    area_3_1_1 = ".(!empty($area_3_1_1) ? "'$area_3_1_1'" : "NULL").",
                    area_3_1_2 = ".(!empty($area_3_1_2) ? "'$area_3_1_2'" : "NULL").",
                    area_3_2_1 = ".(!empty($area_3_2_1) ? "'$area_3_2_1'" : "NULL").",
                    area_3_2_2 = ".(!empty($area_3_2_2) ? "'$area_3_2_2'" : "NULL").",
                    area_3_2_3 = ".(!empty($area_3_2_3) ? "'$area_3_2_3'" : "NULL").",
                    area_4_1 = ".(!empty($area_4_1) ? "'$area_4_1'" : "NULL").",
                    area_4_2 = ".(!empty($area_4_2) ? "'$area_4_2'" : "NULL").",
                    area_4_3 = ".(!empty($area_4_3) ? "'$area_4_3'" : "NULL").",
                    area_4_4 = ".(!empty($area_4_4) ? "'$area_4_4'" : "NULL").",
                    area_4_5 = ".(!empty($area_4_5) ? "'$area_4_5'" : "NULL").",
                    area_4_6 = ".(!empty($area_4_6) ? "'$area_4_6'" : "NULL").",
                    area_5_1 = ".(!empty($area_5_1) ? "'$area_5_1'" : "NULL").",
                    area_5_2 = ".(!empty($area_5_2) ? "'$area_5_2'" : "NULL").",
                    area_5_3 = ".(!empty($area_5_3) ? "'$area_5_3'" : "NULL").",
                    area_5_4 = ".(!empty($area_5_4) ? "'$area_5_4'" : "NULL").",
                    area_5_5 = ".(!empty($area_5_5) ? "'$area_5_5'" : "NULL").",
                    area_5_6 = ".(!empty($area_5_6) ? "'$area_5_6'" : "NULL").",
                    area_6_1 = ".(!empty($area_6_1) ? "'$area_6_1'" : "NULL").",
                    area_6_2 = ".(!empty($area_6_2) ? "'$area_6_2'" : "NULL").",
                    area_6_3 = ".(!empty($area_6_3) ? "'$area_6_3'" : "NULL").",
                    area_6_4 = ".(!empty($area_6_4) ? "'$area_6_4'" : "NULL").",
                    area_6_5 = ".(!empty($area_6_5) ? "'$area_6_5'" : "NULL")."
                WHERE 
                    player_id = $player_id";

        self::DbQuery( $sql );
    }
}