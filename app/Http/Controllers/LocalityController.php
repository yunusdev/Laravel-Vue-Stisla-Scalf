<?php

namespace App\Http\Controllers;

use App\Contracts\LocalityContract;
use Illuminate\Http\Request;

class LocalityController extends Controller
{
    //
    private $stateRepository;

    public function __construct(LocalityContract $stateRepository)
    {

        $this->stateRepository = $stateRepository;

    }


    public function getCountries(){

        return $this->stateRepository->getCountries();

    }

    public function getNigeriaStates(){

        return $this->stateRepository->getNigerianStates();

    }

    public function getNigeriaStatesLGA($stateId){

        return $this->stateRepository->getStatesLGA($stateId);

    }
}
