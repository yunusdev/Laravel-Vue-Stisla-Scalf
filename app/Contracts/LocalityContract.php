<?php

namespace App\Contracts;

interface LocalityContract
{
    public function getCountries();

    public function getNigerianStates();

    public function getNigeriaStatesLGA($stateId);

}
