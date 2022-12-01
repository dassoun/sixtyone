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

class PXPPlayer implements \JsonSerializable
{
    private ?int $score_area_1;
    private ?int $score_area_2;
    private ?int $score_area_3;
    private ?int $score_area_4;
    private ?int $score_area_5;
    private ?int $score_area_6;
    private ?int $area_1_1;
    private ?int $area_1_2;
    private ?int $area_1_3;
    private ?int $area_1_4;
    private ?int $area_2_1;
    private ?int $area_2_2;
    private ?int $area_2_3;
    private ?int $area_2_4;
    private ?int $area_2_5;
    private ?int $area_3_1_1;
    private ?int $area_3_1_2;
    private ?int $area_3_2_1;
    private ?int $area_3_2_2;
    private ?int $area_3_2_3;
    private ?int $area_4_1;
    private ?int $area_4_2;
    private ?int $area_4_3;
    private ?int $area_4_4;
    private ?int $area_4_5;
    private ?int $area_4_6;
    private ?int $area_5_1;
    private ?int $area_5_2;
    private ?int $area_5_3;
    private ?int $area_5_4;
    private ?int $area_5_5;
    private ?int $area_5_6;
    private ?int $area_6_1;
    private ?int $area_6_2;
    private ?int $area_6_3;
    private ?int $area_6_4;
    private ?int $area_6_5;



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

        return $this;
    }

    /**
     * Get the value of area_3_1_1
     */ 
    public function getArea_3_1_1()
    {
        return $this->area_3_1_1;
    }

    /**
     * Set the value of area_3_1_1
     *
     * @return  self
     */ 
    public function setArea_3_1_1($area_3_1_1)
    {
        $this->area_3_1_1 = $area_3_1_1;

        return $this;
    }

    /**
     * Get the value of area_3_1_2
     */ 
    public function getArea_3_1_2()
    {
        return $this->area_3_1_2;
    }

    /**
     * Set the value of area_3_1_2
     *
     * @return  self
     */ 
    public function setArea_3_1_2($area_3_1_2)
    {
        $this->area_3_1_2 = $area_3_1_2;

        return $this;
    }

    /**
     * Get the value of area_3_2_1
     */ 
    public function getArea_3_2_1()
    {
        return $this->area_3_2_1;
    }

    /**
     * Set the value of area_3_2_1
     *
     * @return  self
     */ 
    public function setArea_3_2_1($area_3_2_1)
    {
        $this->area_3_2_1 = $area_3_2_1;

        return $this;
    }

    /**
     * Get the value of area_3_2_2
     */ 
    public function getArea_3_2_2()
    {
        return $this->area_3_2_2;
    }

    /**
     * Set the value of area_3_2_2
     *
     * @return  self
     */ 
    public function setArea_3_2_2($area_3_2_2)
    {
        $this->area_3_2_2 = $area_3_2_2;

        return $this;
    }

    /**
     * Get the value of area_3_2_3
     */ 
    public function getArea_3_2_3()
    {
        return $this->area_3_2_3;
    }

    /**
     * Set the value of area_3_2_3
     *
     * @return  self
     */ 
    public function setArea_3_2_3($area_3_2_3)
    {
        $this->area_3_2_3 = $area_3_2_3;

        return $this;
    }

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

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
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
            "area_3_1_1" => $this->getArea_3_1_1(),
            "area_3_1_2" => $this->getArea_3_1_2(),
            "area_3_2_1" => $this->getArea_3_2_1(),
            "area_3_2_2" => $this->getArea_3_2_2(),
            "area_3_2_3" => $this->getArea_3_2_3(),
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
        ];
    }
}