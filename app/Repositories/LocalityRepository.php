<?php

namespace App\Repositories;

use App\Contracts\LocalityContract;
use App\Contracts\SubCategoryContract;
use App\Models\SubCategory;

class LocalityRepository implements LocalityContract
{

    public function getCountries()
    {

        $countries = file_get_contents(resource_path('json/countries.json'));

        return json_decode($countries, true);

    }

    public function getNigerianStates()
    {

        $states = file_get_contents(resource_path('json/states.json'));

        return json_decode($states, true);

    }

    public function getNigeriaStatesLGA($stateId)
    {

        $states = $this->getNigerianStates();
        $newState = null;
        foreach($states as $state) {
            if ($state['id'] == $stateId) {
                $newState = $state;
                break;
            }
        }
        return $newState;
    }


}
