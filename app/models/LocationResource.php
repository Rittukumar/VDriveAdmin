<?php

/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 04/11/15
 * Time: 8:12 PM
 */
class LocationResource
{
    /**
     * @param $input_array
     * @return mixed
     */
    public function getLocationDetails($location)
    {
        $locationArray = array(
            'city' => '',
            'state' => '',
            'country' => ''
        );

        // Parse the google location details for enquiry city.

        $address_parts = array(
            'street_address' => array("neighborhood"),
            'street_address2' => array("sublocality_level_3", "sublocality"),
            'locality' => array('sublocality_level_1', 'sublocality'),
            'city' => array('locality'),
            'state' => array('administrative_area_level_1'),
            'country' => array('country'),
            'zip' => array('postal_code'),
        );


        if (!empty($location)) {
            if (isset($location['address_components'])) {
                $ac = $location['address_components'];

                foreach ($address_parts as $need => $types) {
                    foreach ($ac as $a) {
                        if (in_array($a['types'][0], $types)) {
                            if ($a['types'][0] == 'administrative_area_level_1') {
                                $locationArray['state'] = $a['long_name'];
                            }
                            if ($a['types'][0] == 'country') {
                                $locationArray['country'] = $a['long_name'];
                            }
                            if ($a['types'][0] == 'locality') {
                                $locationArray['city'] = $a['long_name'];
                            }
                        }
                    }
                }
                return $locationArray;
            }
            return $locationArray;
        }
        return $locationArray;
    }
}