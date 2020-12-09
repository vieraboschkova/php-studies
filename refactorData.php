<?php

// Given an array with minimally 10 items where the first column is a product id, 
// the second the date of creation, the third the date of being sold and the fourth
// the date of being deleted, transform this into an array for google charts using the structure:
// month, amount of created items, amount of sold items, amount of deleted items
// if there wasn't any item sold or deleted for that month, mark it as 0


    $productsData = [
        [   "id"=> 1,
            "dateOfCreation"=> "2020-12-1",
            "dateOfSale"=> "2020-12-2",
            "dateOfDeletion"=> "2020-12-3"
        ],
        [   "id"=> 2,
            "dateOfCreation"=> "2020-2-1",
            "dateOfSale"=> "2020-2-2",
            "dateOfDeletion"=> "2020-2-3"
        ],
        [   "id"=> 3,
            "dateOfCreation"=> "2020-1-10",
            "dateOfSale"=> "2020-8-20",
            "dateOfDeletion"=> "2020-9-23"
        ],
        [   "id"=> 4,
            "dateOfCreation"=> "2020-10-1",
            "dateOfSale"=> "2020-10-2",
            "dateOfDeletion"=> "2020-10-3"
        ],
        [   "id"=> 5,
            "dateOfCreation"=> "2020-11-10",
            "dateOfSale"=> "2020-11-20",
            "dateOfDeletion"=> "2020-12-3"
        ],
        [   "id"=> 2,
            "dateOfCreation"=> "2020-2-1",
            "dateOfSale"=> "2020-2-2",
            "dateOfDeletion"=> "2020-2-3"
        ],
        [   "id"=> 3,
            "dateOfCreation"=> "2020-1-10",
            "dateOfSale"=> "2020-9-20",
            "dateOfDeletion"=> "2020-9-23"
        ],
        [   "id"=> 4,
            "dateOfCreation"=> "2020-10-1",
            "dateOfSale"=> "2020-10-2",
            "dateOfDeletion"=> "2020-11-3"
        ],
        [   "id"=> 5,
            "dateOfCreation"=> "2020-10-10",
            "dateOfSale"=> "2020-11-20",
            "dateOfDeletion"=> "2020-12-3"
        ],
    ];

    $now=time();

    $t=date('Y-m',$now);
    // $t=date('Y-m', strtotime($productsData[1]['dateOfCreation']));

    function convertDate($someStringDate) {
        $date = date('Y-n',strtotime($someStringDate));
        return $date;
    }

    function getLastSixMonths($currentTime) {        
        $currentMonth = date('n', strtotime($currentTime));
        $currentYear = date('Y', strtotime($currentTime));
        $arrayOfDates=[];
        for ($i = 0; $i < 6; $i++) {
            $monthToPush = ($currentMonth - $i + 12)%12;
            $yearToPush = $currentYear;
            if (($currentMonth - $i) < 1) {
                $yearToPush -= 1;
            }
            if ($monthToPush === 0) {
                $monthToPush = 12;
            }
            array_push($arrayOfDates, $yearToPush.'-'.$monthToPush);
        }
        return $arrayOfDates;
    }

    $lastSixMonths = getLastSixMonths($t);

    function checksIfDateInGivenPeriodOfTime($someStringDate, $stringDateToCompareTo) {
        $yearMonthToCheck = date('Y-m',strtotime($someStringDate));
        $yearMonthToCompare = date('Y-m', strtotime($stringDateToCompareTo));

        $result=($yearMonthToCheck === $yearMonthToCompare);
        return $result;
    }

    $monthsDataArray = array_map(function ($item) {
        return array("date" => $item, "itemsCreated" => 0, "itemsSold" => 0, "itemsDeleted" => 0);
    }, $lastSixMonths);

    foreach($productsData as $item) {
        foreach($item as $key=>$value) {
            switch ($key) {
                case 'dateOfCreation':
                    if (in_array(convertDate($value), $lastSixMonths)) {
                        $date = convertDate($value);
                        $monthsIndex= array_search($date, $lastSixMonths);
                        $monthsDataArray[$monthsIndex]["itemsCreated"]++;
                    }                    
                    break;
                case 'dateOfSale':
                    if (in_array(convertDate($value), $lastSixMonths)) {
                        $date = convertDate($value);
                        $monthsIndex= array_search($date, $lastSixMonths);
                        $monthsDataArray[$monthsIndex]["itemsSold"]++;
                    }
                    break;
                case 'dateOfDeletion':
                    if (in_array(convertDate($value), $lastSixMonths)) {
                        $date = convertDate($value);
                        $monthsIndex= array_search($date, $lastSixMonths);
                        $monthsDataArray[$monthsIndex]["itemsDeleted"]++;
                    }
                    break;
            }
        }
    }
    
    var_dump(array_reverse($monthsDataArray));

?>
