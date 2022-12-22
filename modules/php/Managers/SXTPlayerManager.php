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
                    player_id, player_score,
                    score_leave_1, score_leave_2, score_leave_3, score_leave_4, score_leave_5, 
                    score_leave_6, score_leave_7, score_leave_8, score_leave_9, score_leave_10,
                    score_leave_11, score_leave_12, score_leave_13, score_leave_14, score_leave_15,
                    score_leave_16, score_leave_17, score_leave_18, score_leave_19, score_leave_20,
                    die_1, die_2, die_3, chosen_location, chosen_area_cross, chosen_location_cross, gained_bonus,
                    score_area_1, score_area_2, score_area_3, score_area_4, score_area_5, score_area_6, 
                    area_1_1, area_1_2, area_1_3, area_1_4, 
                    area_2_1, area_2_2, area_2_3, area_2_4, area_2_5, 
                    area_3_1, area_3_2, area_3_3, area_3_4, area_3_5, 
                    area_4_1, area_4_2, area_4_3, area_4_4, area_4_5, area_4_6, 
                    area_5_1, area_5_2, area_5_3, area_5_4, area_5_5, area_5_6, 
                    area_6_1, area_6_2, area_6_3, area_6_4, area_6_5,
                    bonus_1, bonus_2, bonus_3, bonus_4, bonus_5, bonus_6
                FROM player
                WHERE player_id = '$id'";

        $res = self::getObjectFromDB( $sql );

        $player = null;

        if ($res) {
            $player = (new SXTPlayer())->setPlayer_id($res['player_id'])
                ->setPlayer_score($res['player_score'])
                ->setScore_leave(array(
                        $res['score_leave_1'], $res['score_leave_2'], $res['score_leave_3'], $res['score_leave_4'], $res['score_leave_5'], 
                        $res['score_leave_6'], $res['score_leave_7'], $res['score_leave_8'], $res['score_leave_9'], $res['score_leave_10'],
                        $res['score_leave_11'], $res['score_leave_12'], $res['score_leave_13'], $res['score_leave_14'], $res['score_leave_15'], 
                        $res['score_leave_16'], $res['score_leave_17'], $res['score_leave_18'], $res['score_leave_19'], $res['score_leave_20'],
                    ))
                ->setDie_1($res['die_1'])
                ->setDie_2($res['die_2'])
                ->setDie_3($res['die_3'])
                ->setChosen_location($res['chosen_location'])
                ->setChosen_area_cross($res['chosen_area_cross'])
                ->setChosen_location_cross($res['chosen_location_cross'])
                ->setGained_bonus($res['gained_bonus'])
                ->setScore_area(array(
                        $res['score_area_1'], $res['score_area_2'], $res['score_area_3'], 
                        $res['score_area_4'], $res['score_area_5'], $res['score_area_6']
                    ))
                ->setArea_1(array(
                    $res['area_1_1'], $res['area_1_2'], $res['area_1_3'], $res['area_1_4']
                    )) 
                ->setArea_2(array(
                    $res['area_2_1'], $res['area_2_2'], $res['area_2_3'], $res['area_2_4'], $res['area_2_5']
                    )) 
                ->setArea_3(array(
                    $res['area_2_1'], $res['area_2_2'], $res['area_2_3'], $res['area_2_4'], $res['area_3_5']
                    )) 
                ->setArea_4(array(
                    $res['area_4_1'], $res['area_4_2'], $res['area_4_3'], $res['area_4_4'], $res['area_4_5'], $res['area_4_6']
                    )) 
                ->setArea_5(array(
                    $res['area_5_1'], $res['area_5_2'], $res['area_5_3'], $res['area_5_4'], $res['area_5_5'], $res['area_5_6']
                    )) 
                ->setArea_6(array(
                    $res['area_6_1'], $res['area_6_2'], $res['area_6_3'], $res['area_6_4'], $res['area_6_5']
                    )) 
                ->setArea_1_1($res['area_1_1'])
                ->setArea_1_2($res['area_1_2'])
                ->setArea_1_3($res['area_1_3'])
                ->setArea_1_4($res['area_1_4'])
                ->setArea_2_1($res['area_2_1'])
                ->setArea_2_2($res['area_2_2'])
                ->setArea_2_3($res['area_2_3'])
                ->setArea_2_4($res['area_2_4'])
                ->setArea_2_5($res['area_2_5'])
                ->setArea_3_1($res['area_3_1'])
                ->setArea_3_2($res['area_3_2'])
                ->setArea_3_3($res['area_3_3'])
                ->setArea_3_4($res['area_3_4'])
                ->setArea_3_5($res['area_3_5'])
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
                ->setArea_6_5($res['area_6_5'])
                ->setBonus(array(
                        $res['bonus_1'], $res['bonus_2'], $res['bonus_3'], $res['bonus_4'], $res['bonus_5'], $res['bonus_6']
                    ));
        }

        return $player;
    }

    public function persist(SXTPlayer $player): void
    {
        $player_id = $player->getPlayer_id();
        $player_score = $player->getPlayer_score();
        $score_leave = $player->getScore_leave();
        $die_1 = $player->getDie_1();
        $die_2 = $player->getDie_2();
        $die_3 = $player->getDie_3();
        $chosen_location = $player->getChosen_location();
        $chosen_area_cross = $player->getChosen_area_cross();
        $chosen_location_cross = $player->getChosen_location_cross();
        $gained_bonus = $player->getGained_bonus();
        $score_area = $player->getScore_area();
        // $score_area_1 = $player->getScore_area_1();
        // $score_area_2 = $player->getScore_area_2(); 
        // $score_area_3 = $player->getScore_area_3(); 
        // $score_area_4 = $player->getScore_area_4(); 
        // $score_area_5 = $player->getScore_area_5(); 
        // $score_area_6 = $player->getScore_area_6(); 
        $area_1_1 = $player->getArea_1_1(); 
        $area_1_2 = $player->getArea_1_2(); 
        $area_1_3 = $player->getArea_1_3(); 
        $area_1_4 = $player->getArea_1_4(); 
        $area_2_1 = $player->getArea_2_1(); 
        $area_2_2 = $player->getArea_2_2(); 
        $area_2_3 = $player->getArea_2_3(); 
        $area_2_4 = $player->getArea_2_4(); 
        $area_2_5 = $player->getArea_2_5(); 
        $area_3_1 = $player->getArea_3_1(); 
        $area_3_2 = $player->getArea_3_2(); 
        $area_3_3 = $player->getArea_3_3(); 
        $area_3_4 = $player->getArea_3_4(); 
        $area_3_5 = $player->getArea_3_5(); 
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
        $bonus = $player->getBonus();

        $sql_score_leave = "";
        foreach($score_leave as $key => $score) {
            $sql_score_leave .= "score_leave_".($key+1)." = ".(!empty($score) ? "'$score'" : "NULL").", ";
        }

        $sql_score_area = "";
        foreach($score_area as $key => $score) {
            $sql_score_area .= "score_area_".($key+1)." = ".(!empty($score) ? "'$score'" : "NULL").", ";
        }

        $sql_bonus = "";
        foreach($bonus as $key => $value) {
            $sql_bonus .= "bonus_".($key+1)." = ".(!empty($value) ? "'$value'" : "NULL").", ";
        }

        $sql = "UPDATE 
                    player 
                SET 
                    player_score = '".$player_score."', ".
                    $sql_score_leave."  
                    die_1 = ".(!empty($die_1) ? "'$die_1'" : "NULL").", 
                    die_2 = ".(!empty($die_2) ? "'$die_2'" : "NULL").", 
                    die_3 = ".(!empty($die_3) ? "'$die_3'" : "NULL").",
                    chosen_location = ".(!empty($chosen_location) ? "'$chosen_location'" : "NULL").",
                    chosen_area_cross = ".(!empty($chosen_area_cross) ? "'$chosen_area_cross'" : "NULL").",
                    chosen_location_cross = ".(!empty($chosen_location_cross) ? "'$chosen_location_cross'" : "NULL").",
                    gained_bonus = ".(!empty($gained_bonus) ? "'$gained_bonus'" : "NULL").", ".
                    $sql_score_area.
                    $sql_bonus."
                    area_1_1 = ".$area_1_1.",
                    area_1_2 = ".$area_1_2.",
                    area_1_3 = ".$area_1_3.",
                    area_1_4 = ".$area_1_4.",
                    area_2_1 = ".$area_2_1.",
                    area_2_2 = ".$area_2_2.",
                    area_2_3 = ".$area_2_3.",
                    area_2_4 = ".$area_2_4.",
                    area_2_5 = ".$area_2_5.",
                    area_3_1 = ".$area_3_1.",
                    area_3_2 = ".$area_3_2.",
                    area_3_3 = ".$area_3_3.",
                    area_3_4 = ".$area_3_4.",
                    area_3_5 = ".$area_3_5.",
                    area_4_1 = ".$area_4_1.",
                    area_4_2 = ".$area_4_2.",
                    area_4_3 = ".$area_4_3.",
                    area_4_4 = ".$area_4_4.",
                    area_4_5 = ".$area_4_5.",
                    area_4_6 = ".$area_4_6.",
                    area_5_1 = ".$area_5_1.",
                    area_5_2 = ".$area_5_2.",
                    area_5_3 = ".$area_5_3.",
                    area_5_4 = ".$area_5_4.",
                    area_5_5 = ".$area_5_5.",
                    area_5_6 = ".$area_5_6.",
                    area_6_1 = ".$area_6_1.",
                    area_6_2 = ".$area_6_2.",
                    area_6_3 = ".$area_6_3.",
                    area_6_4 = ".$area_6_4.",
                    area_6_5 = ".$area_6_5."
                WHERE 
                    player_id = $player_id";

        self::DbQuery( $sql );
    }
}