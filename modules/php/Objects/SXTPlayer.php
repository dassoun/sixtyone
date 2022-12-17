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
 * modules/php/Objects/SXTPlayer.php
 *
 */

namespace PhobyJuan\SixtyOne\Objects;

class SXTPlayer implements \JsonSerializable
{
    private int $player_id;
    private ?int $die_1;
    private ?int $die_2;
    private ?int $die_3;
    private ?int $chosen_location;
    private ?int $chosen_area_cross;
    private ?int $chosen_location_cross;
    private $score_leave = [
        null, null, null, null, null,
        null, null, null, null, null,
        null, null, null, null, null,
        null, null, null, null, null,
    ];
    private $score_area = [
        null, null, null, null, null, null,
    ];
    // private int $score_area_1 = 0;
    // private int $score_area_2 = 0;
    // private int $score_area_3 = 0;
    // private int $score_area_4 = 0;
    // private int $score_area_5 = 0;
    // private int $score_area_6 = 0;
    private int $area_1_1;
    private int $area_1_2;
    private int $area_1_3;
    private int $area_1_4;
    private int $area_2_1;
    private int $area_2_2;
    private int $area_2_3;
    private int $area_2_4;
    private int $area_2_5;
    // private ?int $area_3_1_1;
    // private ?int $area_3_1_2;
    // private ?int $area_3_2_1;
    // private ?int $area_3_2_2;
    // private ?int $area_3_2_3;
    private int $area_3_1;
    private int $area_3_2;
    private int $area_3_3;
    private int $area_3_4;
    private int $area_3_5;
    private int $area_4_1;
    private int $area_4_2;
    private int $area_4_3;
    private int $area_4_4;
    private int $area_4_5;
    private int $area_4_6;
    private int $area_5_1;
    private int $area_5_2;
    private int $area_5_3;
    private int $area_5_4;
    private int $area_5_5;
    private int $area_5_6;
    private int $area_6_1;
    private int $area_6_2;
    private int $area_6_3;
    private int $area_6_4;
    private int $area_6_5;

    private $area_1 = [-1, -1, -1, -1];
    private $area_2 = [-1, -1, -1, -1, -1];
    private $area_3 = [-1, -1, -1, -1, -1];
    private $area_4 = [-1, -1, -1, -1, -1, -1];
    private $area_5 = [-1, -1, -1, -1, -1];
    private $area_6 = [-1, -1, -1, -1, -1, -1];

    private $bonus = [null, null, null, null, null, null];

    /**
     * Get the value of player_id
     */ 
    public function getPlayer_id()
    {
        return $this->player_id;
    }

    /**
     * Set the value of player_id
     */ 
    public function setPlayer_id($player_id)
    {
        $this->player_id = $player_id;

        return $this;
    }

    /**
     * Get the value of die_1
     */ 
    public function getDie_1()
    {
        return $this->die_1;
    }

    /**
     * Set the value of die_1
     *
     * @return  self
     */ 
    public function setDie_1($die_1)
    {
        $this->die_1 = $die_1;

        return $this;
    }

    /**
     * Get the value of die_2
     */ 
    public function getDie_2()
    {
        return $this->die_2;
    }

    /**
     * Set the value of die_2
     *
     * @return  self
     */ 
    public function setDie_2($die_2)
    {
        $this->die_2 = $die_2;

        return $this;
    }

    /**
     * Get the value of die_3
     */ 
    public function getDie_3()
    {
        return $this->die_3;
    }

    /**
     * Set the value of die_3
     *
     * @return  self
     */ 
    public function setDie_3($die_3)
    {
        $this->die_3 = $die_3;

        return $this;
    }

    /**
     * Get the value of chosen_location
     */ 
    public function getChosen_location()
    {
        return $this->chosen_location;
    }

    /**
     * Set the value of chosen_location
     *
     * @return  self
     */ 
    public function setChosen_location($chosen_location)
    {
        $this->chosen_location = $chosen_location;

        return $this;
    }

    /**
     * Get the value of chosen_area_cross
     */ 
    public function getChosen_area_cross()
    {
        return $this->chosen_area_cross;
    }

    /**
     * Set the value of chosen_area_cross
     *
     * @return  self
     */ 
    public function setChosen_area_cross($chosen_area_cross)
    {
        $this->chosen_area_cross = $chosen_area_cross;

        return $this;
    }

    /**
     * Get the value of chosen_location_cross
     */ 
    public function getChosen_location_cross()
    {
        return $this->chosen_location_cross;
    }

    /**
     * Set the value of chosen_location_cross
     *
     * @return  self
     */ 
    public function setChosen_location_cross($chosen_location_cross)
    {
        $this->chosen_location_cross = $chosen_location_cross;

        return $this;
    }

    /**
     * Get the value of score_leave
     */ 
    public function getScore_leave()
    {
        return $this->score_leave;
    }

    /**
     * Set the value of score_leave
     *
     * @return  self
     */ 
    public function setScore_leave($score_leave)
    {
        $this->score_leave = $score_leave;

        return $this;
    }

    /**
     * Get the value of score_area
     */ 
    public function getScore_area()
    {
        return $this->score_area;
    }

    /**
     * Set the value of score_area
     *
     * @return  self
     */ 
    public function setScore_area($score_area)
    {
        $this->score_area = $score_area;

        return $this;
    }

    /**
     * Get the value of score_area_1
     */ 
    public function getScore_area_1()
    {
        return $this->score_area_1;
    }

    /**
     * Set the value of score_area_1
     *
     * @return  self
     */ 
    public function setScore_area_1($score_area_1)
    {
        $this->score_area_1 = $score_area_1;
        
        return $this;
    }

    /**
     * Get the value of score_area_2
     */ 
    public function getScore_area_2()
    {
        return $this->score_area_2;
    }

    /**
     * Set the value of score_area_2
     *
     * @return  self
     */ 
    public function setScore_area_2($score_area_2)
    {
        $this->score_area_2 = $score_area_2;

        return $this;
    }

    /**
     * Get the value of score_area_3
     */ 
    public function getScore_area_3()
    {
        return $this->score_area_3;
    }

    /**
     * Set the value of score_area_3
     *
     * @return  self
     */ 
    public function setScore_area_3($score_area_3)
    {
        $this->score_area_3 = $score_area_3;

        return $this;
    }

    /**
     * Get the value of score_area_4
     */ 
    public function getScore_area_4()
    {
        return $this->score_area_4;
    }

    /**
     * Set the value of score_area_4
     *
     * @return  self
     */ 
    public function setScore_area_4($score_area_4)
    {
        $this->score_area_4 = $score_area_4;

        return $this;
    }

    /**
     * Get the value of score_area_5
     */ 
    public function getScore_area_5()
    {
        return $this->score_area_5;
    }

    /**
     * Set the value of score_area_5
     *
     * @return  self
     */ 
    public function setScore_area_5($score_area_5)
    {
        $this->score_area_5 = $score_area_5;

        return $this;
    }

    /**
     * Get the value of score_area_6
     */ 
    public function getScore_area_6()
    {
        return $this->score_area_6;
    }

    /**
     * Set the value of score_area_6
     *
     * @return  self
     */ 
    public function setScore_area_6($score_area_6)
    {
        $this->score_area_6 = $score_area_6;

        return $this;
    }

    /**
     * Get the value of area_1_1
     */ 
    public function getArea_1_1()
    {
        return $this->area_1_1;
    }

    /**
     * Set the value of area_1_1
     *
     * @return  self
     */ 
    public function setArea_1_1($area_1_1)
    {
        $this->area_1_1 = $area_1_1;
        $this->area_1[0] = $area_1_1;

        return $this;
    }

    /**
     * Get the value of area_1_2
     */ 
    public function getArea_1_2()
    {
        return $this->area_1_2;
    }

    /**
     * Set the value of area_1_2
     *
     * @return  self
     */ 
    public function setArea_1_2($area_1_2)
    {
        $this->area_1_2 = $area_1_2;
        $this->area_1[1] = $area_1_2;

        return $this;
    }

    /**
     * Get the value of area_1_3
     */ 
    public function getArea_1_3()
    {
        return $this->area_1_3;
    }

    /**
     * Set the value of area_1_3
     *
     * @return  self
     */ 
    public function setArea_1_3($area_1_3)
    {
        $this->area_1_3 = $area_1_3;
        $this->area_1[2] = $area_1_3;

        return $this;
    }

    /**
     * Get the value of area_1_4
     */ 
    public function getArea_1_4()
    {
        return $this->area_1_4;
    }

    /**
     * Set the value of area_1_4
     *
     * @return  self
     */ 
    public function setArea_1_4($area_1_4)
    {
        $this->area_1_4 = $area_1_4;
        $this->area_1[3] = $area_1_4;

        return $this;
    }

    /**
     * Get the value of area_2_1
     */ 
    public function getArea_2_1()
    {
        return $this->area_2_1;
    }

    /**
     * Set the value of area_2_1
     *
     * @return  self
     */ 
    public function setArea_2_1($area_2_1)
    {
        $this->area_2_1 = $area_2_1;
        $this->area_2[0] = $area_2_1;

        return $this;
    }

    /**
     * Get the value of area_2_2
     */ 
    public function getArea_2_2()
    {
        return $this->area_2_2;
    }

    /**
     * Set the value of area_2_2
     *
     * @return  self
     */ 
    public function setArea_2_2($area_2_2)
    {
        $this->area_2_2 = $area_2_2;
        $this->area_2[1] = $area_2_2;

        return $this;
    }

    /**
     * Get the value of area_2_3
     */ 
    public function getArea_2_3()
    {
        return $this->area_2_3;
    }

    /**
     * Set the value of area_2_3
     *
     * @return  self
     */ 
    public function setArea_2_3($area_2_3)
    {
        $this->area_2_3 = $area_2_3;
        $this->area_2[2] = $area_2_3;

        return $this;
    }

    /**
     * Get the value of area_2_4
     */ 
    public function getArea_2_4()
    {
        return $this->area_2_4;
    }

    /**
     * Set the value of area_2_4
     *
     * @return  self
     */ 
    public function setArea_2_4($area_2_4)
    {
        $this->area_2_4 = $area_2_4;
        $this->area_2[3] = $area_2_4;

        return $this;
    }

    /**
     * Get the value of area_2_5
     */ 
    public function getArea_2_5()
    {
        return $this->area_2_5;
    }

    /**
     * Set the value of area_2_5
     *
     * @return  self
     */ 
    public function setArea_2_5($area_2_5)
    {
        $this->area_2_5 = $area_2_5;
        $this->area_2[4] = $area_2_5;

        return $this;
    }

    // /**
    //  * Get the value of area_3_1_1
    //  */ 
    // public function getArea_3_1_1()
    // {
    //     return $this->area_3_1_1;
    // }

    // /**
    //  * Set the value of area_3_1_1
    //  *
    //  * @return  self
    //  */ 
    // public function setArea_3_1_1($area_3_1_1)
    // {
    //     $this->area_3_1_1 = $area_3_1_1;
    //     $this->area_3[0][0] = $area_3_1_1;

    //     return $this;
    // }

    // /**
    //  * Get the value of area_3_1_2
    //  */ 
    // public function getArea_3_1_2()
    // {
    //     return $this->area_3_1_2;
    // }

    // /**
    //  * Set the value of area_3_1_2
    //  *
    //  * @return  self
    //  */ 
    // public function setArea_3_1_2($area_3_1_2)
    // {
    //     $this->area_3_1_2 = $area_3_1_2;
    //     $this->area_3[0][1] = $area_3_1_2;

    //     return $this;
    // }

    // /**
    //  * Get the value of area_3_2_1
    //  */ 
    // public function getArea_3_2_1()
    // {
    //     return $this->area_3_2_1;
    // }

    // /**
    //  * Set the value of area_3_2_1
    //  *
    //  * @return  self
    //  */ 
    // public function setArea_3_2_1($area_3_2_1)
    // {
    //     $this->area_3_2_1 = $area_3_2_1;
    //     $this->area_3[1][0] = $area_3_2_1;

    //     return $this;
    // }

    // /**
    //  * Get the value of area_3_2_2
    //  */ 
    // public function getArea_3_2_2()
    // {
    //     return $this->area_3_2_2;
    // }

    // /**
    //  * Set the value of area_3_2_2
    //  *
    //  * @return  self
    //  */ 
    // public function setArea_3_2_2($area_3_2_2)
    // {
    //     $this->area_3_2_2 = $area_3_2_2;
    //     $this->area_3[1][1] = $area_3_2_2;

    //     return $this;
    // }

    // /**
    //  * Get the value of area_3_2_3
    //  */ 
    // public function getArea_3_2_3()
    // {
    //     return $this->area_3_2_3;
    // }

    // /**
    //  * Set the value of area_3_2_3
    //  *
    //  * @return  self
    //  */ 
    // public function setArea_3_2_3($area_3_2_3)
    // {
    //     $this->area_3_2_3 = $area_3_2_3;
    //     $this->area_3[1][2] = $area_3_2_3;

    //     return $this;
    // }

    /**
     * Get the value of area_4_1
     */ 
    public function getArea_4_1()
    {
        return $this->area_4_1;
    }

    /**
     * Set the value of area_4_1
     *
     * @return  self
     */ 
    public function setArea_4_1($area_4_1)
    {
        $this->area_4_1 = $area_4_1;
        $this->area_4[0] = $area_4_1;

        return $this;
    }

    /**
     * Get the value of area_4_2
     */ 
    public function getArea_4_2()
    {
        return $this->area_4_2;
    }

    /**
     * Set the value of area_4_2
     *
     * @return  self
     */ 
    public function setArea_4_2($area_4_2)
    {
        $this->area_4_2 = $area_4_2;
        $this->area_4[1] = $area_4_2;

        return $this;
    }

    /**
     * Get the value of area_4_3
     */ 
    public function getArea_4_3()
    {
        return $this->area_4_3;
    }

    /**
     * Set the value of area_4_3
     *
     * @return  self
     */ 
    public function setArea_4_3($area_4_3)
    {
        $this->area_4_3 = $area_4_3;
        $this->area_4[2] = $area_4_3;

        return $this;
    }

    /**
     * Get the value of area_4_4
     */ 
    public function getArea_4_4()
    {
        return $this->area_4_4;
    }

    /**
     * Set the value of area_4_4
     *
     * @return  self
     */ 
    public function setArea_4_4($area_4_4)
    {
        $this->area_4_4 = $area_4_4;
        $this->area_4[3] = $area_4_4;

        return $this;
    }

    /**
     * Get the value of area_4_5
     */ 
    public function getArea_4_5()
    {
        return $this->area_4_5;
    }

    /**
     * Set the value of area_4_5
     *
     * @return  self
     */ 
    public function setArea_4_5($area_4_5)
    {
        $this->area_4_5 = $area_4_5;
        $this->area_4[4] = $area_4_5;

        return $this;
    }

    /**
     * Get the value of area_4_6
     */ 
    public function getArea_4_6()
    {
        return $this->area_4_6;
    }

    /**
     * Set the value of area_4_6
     *
     * @return  self
     */ 
    public function setArea_4_6($area_4_6)
    {
        $this->area_4_6 = $area_4_6;
        $this->area_4[5] = $area_4_6;

        return $this;
    }

    /**
     * Get the value of area_5_1
     */ 
    public function getArea_5_1()
    {
        return $this->area_5_1;
    }

    /**
     * Set the value of area_5_1
     *
     * @return  self
     */ 
    public function setArea_5_1($area_5_1)
    {
        $this->area_5_1 = $area_5_1;
        $this->area_5[0] = $area_5_1;

        return $this;
    }

    /**
     * Get the value of area_5_2
     */ 
    public function getArea_5_2()
    {
        return $this->area_5_2;
    }

    /**
     * Set the value of area_5_2
     *
     * @return  self
     */ 
    public function setArea_5_2($area_5_2)
    {
        $this->area_5_2 = $area_5_2;
        $this->area_5[1] = $area_5_2;

        return $this;
    }

    /**
     * Get the value of area_5_3
     */ 
    public function getArea_5_3()
    {
        return $this->area_5_3;
    }

    /**
     * Set the value of area_5_3
     *
     * @return  self
     */ 
    public function setArea_5_3($area_5_3)
    {
        $this->area_5_3 = $area_5_3;
        $this->area_5[2] = $area_5_3;

        return $this;
    }

    /**
     * Get the value of area_5_4
     */ 
    public function getArea_5_4()
    {
        return $this->area_5_4;
    }

    /**
     * Set the value of area_5_4
     *
     * @return  self
     */ 
    public function setArea_5_4($area_5_4)
    {
        $this->area_5_4 = $area_5_4;
        $this->area_5[3] = $area_5_4;

        return $this;
    }

    /**
     * Get the value of area_5_5
     */ 
    public function getArea_5_5()
    {
        return $this->area_5_5;
    }

    /**
     * Set the value of area_5_5
     *
     * @return  self
     */ 
    public function setArea_5_5($area_5_5)
    {
        $this->area_5_5 = $area_5_5;
        $this->area_5[4] = $area_5_5;

        return $this;
    }

    /**
     * Get the value of area_5_6
     */ 
    public function getArea_5_6()
    {
        return $this->area_5_6;
    }

    /**
     * Set the value of area_5_6
     *
     * @return  self
     */ 
    public function setArea_5_6($area_5_6)
    {
        $this->area_5_6 = $area_5_6;
        $this->area_5[5] = $area_5_6;

        return $this;
    }

    /**
     * Get the value of area_6_1
     */ 
    public function getArea_6_1()
    {
        return $this->area_6_1;
    }

    /**
     * Set the value of area_6_1
     *
     * @return  self
     */ 
    public function setArea_6_1($area_6_1)
    {
        $this->area_6_1 = $area_6_1;
        $this->area_6[0] = $area_6_1;

        return $this;
    }

    /**
     * Get the value of area_6_2
     */ 
    public function getArea_6_2()
    {
        return $this->area_6_2;
    }

    /**
     * Set the value of area_6_2
     *
     * @return  self
     */ 
    public function setArea_6_2($area_6_2)
    {
        $this->area_6_2 = $area_6_2;
        $this->area_6[1] = $area_6_2;

        return $this;
    }

    /**
     * Get the value of area_6_3
     */ 
    public function getArea_6_3()
    {
        return $this->area_6_3;
    }

    /**
     * Set the value of area_6_3
     *
     * @return  self
     */ 
    public function setArea_6_3($area_6_3)
    {
        $this->area_6_3 = $area_6_3;
        $this->area_6[2] = $area_6_3;

        return $this;
    }

    /**
     * Get the value of area_6_4
     */ 
    public function getArea_6_4()
    {
        return $this->area_6_4;
    }

    /**
     * Set the value of area_6_4
     *
     * @return  self
     */ 
    public function setArea_6_4($area_6_4)
    {
        $this->area_6_4 = $area_6_4;
        $this->area_6[3] = $area_6_4;

        return $this;
    }

    /**
     * Get the value of area_6_5
     */ 
    public function getArea_6_5()
    {
        return $this->area_6_5;
    }

    /**
     * Set the value of area_6_5
     *
     * @return  self
     */ 
    public function setArea_6_5($area_6_5)
    {
        $this->area_6_5 = $area_6_5;
        $this->area_6[4] = $area_6_5;

        return $this;
    }

    /**
     * Get the value of area_1
     */ 
    public function getArea_1()
    {
        return $this->area_1;
    }

    /**
     * Set the value of area_1
     *
     * @return  self
     */ 
    public function setArea_1($area_1)
    {
        $this->area_1 = $area_1;

        return $this;
    }

    /**
     * Get the value of area_2
     */ 
    public function getArea_2()
    {
        return $this->area_2;
    }

    /**
     * Set the value of area_2
     *
     * @return  self
     */ 
    public function setArea_2($area_2)
    {
        $this->area_2 = $area_2;

        return $this;
    }

    /**
     * Get the value of area_3
     */ 
    public function getArea_3()
    {
        return $this->area_3;
    }

    /**
     * Set the value of area_3
     *
     * @return  self
     */ 
    public function setArea_3($area_3)
    {
        $this->area_3 = $area_3;

        return $this;
    }

    /**
     * Get the value of area_4
     */ 
    public function getArea_4()
    {
        return $this->area_4;
    }

    /**
     * Set the value of area_4
     *
     * @return  self
     */ 
    public function setArea_4($area_4)
    {
        $this->area_4 = $area_4;

        return $this;
    }

    /**
     * Get the value of area_5
     */ 
    public function getArea_5()
    {
        return $this->area_5;
    }

    /**
     * Set the value of area_5
     *
     * @return  self
     */ 
    public function setArea_5($area_5)
    {
        $this->area_5 = $area_5;

        return $this;
    }

    /**
     * Get the value of area_6
     */ 
    public function getArea_6()
    {
        return $this->area_6;
    }

    /**
     * Set the value of area_6
     *
     * @return  self
     */ 
    public function setArea_6($area_6)
    {
        $this->area_6 = $area_6;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            "player_id" => $this->getPlayer_id(),
            "die_1" => $this->getDie_1(),
            "die_2" => $this->getDie_2(),
            "die_3" => $this->getDie_3(),
            "chosen_location" => $this->getChosen_location(),
            "chosen_area_cross" => $this->getChosen_area_cross(),
            "chosen_location_cross" => $this->getChosen_location_cross(),
            "score_leave" => $this->getScore_leave(),
            "score_are" => $this->getScore_area(),
            "score_area_1" => $this->getScore_area_1(),
            "score_area_2" => $this->getScore_area_2(),
            "score_area_3" => $this->getScore_area_3(),
            "score_area_4" => $this->getScore_area_4(),
            "score_area_5" => $this->getScore_area_5(),
            "score_area_6" => $this->getScore_area_6(),
            "area_1_1" => $this->getArea_1_1(),
            "area_1_2" => $this->getArea_1_2(),
            "area_1_3" => $this->getArea_1_3(),
            "area_1_4" => $this->getArea_1_4(),
            "area_2_1" => $this->getArea_2_1(),
            "area_2_2" => $this->getArea_2_2(),
            "area_2_3" => $this->getArea_2_3(),
            "area_2_4" => $this->getArea_2_4(),
            "area_2_5" => $this->getArea_2_5(),
            "area_3_1" => $this->getArea_3_1(),
            "area_3_2" => $this->getArea_3_2(),
            "area_3_3" => $this->getArea_3_3(),
            "area_3_4" => $this->getArea_3_4(),
            "area_3_5" => $this->getArea_3_5(),
            "area_4_1" => $this->getArea_4_1(),
            "area_4_2" => $this->getArea_4_2(),
            "area_4_3" => $this->getArea_4_3(),
            "area_4_4" => $this->getArea_4_4(),
            "area_4_5" => $this->getArea_4_5(),
            "area_4_6" => $this->getArea_4_6(),
            "area_5_1" => $this->getArea_5_1(),
            "area_5_2" => $this->getArea_5_2(),
            "area_5_3" => $this->getArea_5_3(),
            "area_5_4" => $this->getArea_5_4(),
            "area_5_5" => $this->getArea_5_5(),
            "area_5_6" => $this->getArea_5_6(),
            "area_6_1" => $this->getArea_6_1(),
            "area_6_2" => $this->getArea_6_2(),
            "area_6_3" => $this->getArea_6_3(),
            "area_6_4" => $this->getArea_6_4(),
            "area_6_5" => $this->getArea_6_5(),
            "area_1" => $this->getArea_1(),
            "area_2" => $this->getArea_2(),
            "area_3" => $this->getArea_3(),
            "area_4" => $this->getArea_4(),
            "area_5" => $this->getArea_5(),
            "area_6" => $this->getArea_6(),
            "bonus" => $this->getBonus(),
        ];
    }

    /**
     * Add a leave score (3rd die)
     */ 
    public function add_leave_score(int $value): SXTPlayer
    {
        $i = 0;
        $found = false;
        while ($i < count($this->score_leave) && !$found) {
            if ($this->score_leave[$i] == null) {
                $this->score_leave[$i] = $value;

                $found = true;
            } else {
                $i++;
            }
        }

        return $this;
    }

    /**
     * Get total leave score (3rd die)
     */ 
    public function get_total_score_leave(): int
    {
        $sum = 0;

        for ($i=0; $i<count($this->score_leave); $i++) {
            if ($this->score_leave[$i] != null) {
                $sum += $this->score_leave[$i];
            }
        }

        return $sum;
    }

    /**
     * Get leave last position
     */ 
    public function get_score_leave_last_position(): int
    {
        $i = 0;
        $found = false;
        while ($i < count($this->score_leave) && !$found) {
            if ($this->score_leave[$i] != null) {
                $i++;
            } else {
                $found = true;
            }
        }

        return $i;
    }

    /**
     * Get the value of area_3_1
     */ 
    public function getArea_3_1()
    {
        return $this->area_3_1;
    }

    /**
     * Set the value of area_3_1
     *
     * @return  self
     */ 
    public function setArea_3_1($area_3_1)
    {
        $this->area_3_1 = $area_3_1;
        $this->area_3[0] = $area_3_1;

        return $this;
    }

    /**
     * Get the value of area_3_2
     */ 
    public function getArea_3_2()
    {
        return $this->area_3_2;
    }

    /**
     * Set the value of area_3_2
     *
     * @return  self
     */ 
    public function setArea_3_2($area_3_2)
    {
        $this->area_3_2 = $area_3_2;
        $this->area_3[1] = $area_3_2;

        return $this;
    }

    /**
     * Get the value of area_3_3
     */ 
    public function getArea_3_3()
    {
        return $this->area_3_3;
    }

    /**
     * Set the value of area_3_3
     *
     * @return  self
     */ 
    public function setArea_3_3($area_3_3)
    {
        $this->area_3_3 = $area_3_3;
        $this->area_3[2] = $area_3_3;

        return $this;
    }

    /**
     * Get the value of area_3_4
     */ 
    public function getArea_3_4()
    {
        return $this->area_3_4;
    }

    /**
     * Set the value of area_3_4
     *
     * @return  self
     */ 
    public function setArea_3_4($area_3_4)
    {
        $this->area_3_4 = $area_3_4;
        $this->area_3[3] = $area_3_4;

        return $this;
    }

    /**
     * Get the value of area_3_5
     */ 
    public function getArea_3_5()
    {
        return $this->area_3_5;
    }

    /**
     * Set the value of area_3_5
     *
     * @return  self
     */ 
    public function setArea_3_5($area_3_5)
    {
        $this->area_3_5 = $area_3_5;
        $this->area_3[4] = $area_3_5;

        return $this;
    }

    /**
     * Get the value of bonus
     */ 
    public function getBonus()
    {
        return $this->bonus;
    }

    /**
     * Set the value of bonus
     *
     * @return  self
     */ 
    public function setBonus($bonus)
    {
        $this->bonus = $bonus;

        return $this;
    }
}