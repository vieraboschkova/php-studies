<?php
$total = 10;
    //array of pages
    //get current page
    // if page first -> show first 3, ..., last
    // if page second -> sshow first 4, ... last
    // if page third -> show first 5, ..., last
    // if page fourth -> show first 6, ... last
    //if page fifth -> show first 7,... last

    function generatePageNumbers($pagesMax, $currentPage){
        $pagesArray = [];
        echo 'CURRENT: '.$currentPage.'<br>';
        echo 'MAX: '.$pagesMax.'<br>';
        for ($i =0; $i < $pagesMax; $i++){
            array_push($pagesArray, $i+1);
        }
        // echo '<pre>';
        // print_r($pagesArray);
        
        //IF NUMBER OF PAGES TOO SHORT
        if ($pagexMax<=0) { return $pagesArray; }

        $firstPage = $pagesArray[0];
        $lastPage = end($pagesArray);
        $beginningArray = array($firstPage, '...');
        $endingArray = array('...', $lastPage);

        $pagesLayout = [];

        if ($currentPage <= $firstPage + 4 ) {
            // echo 'first 5 numbers: ';
            $beginning = array_slice($pagesArray,0, $currentPage + 2);
            $pagesLayout = array_merge($beginning, $endingArray);
        } else if ($currentPage >= $lastPage - 4) {
            // echo 'last 5 numbers: ';
            $ending = array_slice($pagesArray, $currentPage -3);
            $pagesLayout = array_merge($beginningArray, $ending);
        } else {
            $middle = array($currentPage-2, $currentPage - 1, $currentPage, $currentPage +1, $currentPage + 2);
            $pagesLayout = array_merge($beginningArray, $middle, $endingArray);
        }

        echo '<pre>';
        print_r($pagesLayout);
        return $pagesLayout;

    }
    
    //TEST:
    generatePageNumbers(100,1);
    generatePageNumbers(100,99);
    generatePageNumbers(100,100);

?>
