<?php

/* 
*
* This is the functions file for the garden-cal plugin
*
*/ 

error_reporting(E_ALL ^ E_NOTICE);

global $this_year;
$this_year = date('Y');

global $next_year;
$next_year = date($this_year + 1);

global $today;
$today = new DateTime();

// Season start dates are constant
global $spring;
global $summer;
global $fall;
global $winter;
$spring = new DateTime('March 20');
$winter = new DateTime('June 20');
$fall = new DateTime('September 22');
$winter = new DateTime('December 21');

// Define last frost date of each zone as 
// Global variables  
$zone1_LF = date('m-d', strtotime('June 15'));
$zone2_LF = date('m-d', strtotime('May 15'));
$zone3_LF = date('m-d', strtotime('May 15'));
$zone4_LF = date('m-d', strtotime('May 15'));
$zone5_LF = date('m-d', strtotime('April 15'));
$zone6_LF = date('m-d', strtotime('April 15'));
$zone7_LF = date('m-d', strtotime('April 15'));
$zone8_LF = date('m-d', strtotime('March 15'));
$zone9_LF = date('m-d', strtotime('February 15'));
$zone10_LF = date('m-d', strtotime('January 15'));
// $zone11_LF = "No Frost in Zone 11!";


function the_season() {

  switch(true) {
      case $GLOBALS['today'] >= $GLOBALS['spring'] && $GLOBALS['today'] < $GLOBALS['summer']:
          $season = 'Spring';
          return $season;
          break;

      case $GLOBALS['today'] >= $GLOBALS['summer'] && $GLOBALS['today'] < $GLOBALS['fall']:
          $season = 'Summer';
          return $season;
          break;

      case $GLOBALS['today'] >= $GLOBALS['fall'] && $GLOBALS['today'] < $GLOBALS['winter']:
          $season = 'Fall';
          return $season;
          break;

      default:
          $season = 'Winter';
          return $season;
  }
}


// Depending on what time of year it is, that will determine
// If the user is concerned about the last frost of the current year
// Or planning a garden for the next year
function frost_year() {

  global $this_year;
  global $next_year;

  if ($GLOBALS['today'] < $GLOBALS['fall']) {
    //echo "this year";
    return $this_year;
  }
  else {
    //echo "next year";
    return $next_year;
  }
}


// Function to return the last frost date per zone
// Will be used to calculate planting dates per zone
function zone_last_frost($zone) {

  global $zone1_LF;
  global $zone2_LF;
  global $zone3_LF;
  global $zone4_LF;
  global $zone5_LF;
  global $zone6_LF;
  global $zone7_LF;
  global $zone8_LF;
  global $zone9_LF;
  global $zone10_LF;
  global $zone11_LF;

  // Pull last frost date constants based on user input
  switch(true) {
    case ($_POST["zone"] == '1'):
      $last_frost = $zone1_LF;
      break;

    case ($_POST["zone"] == '2'):
      $last_frost = $zone2_LF;
      break;

    case ($_POST["zone"] == '3'):
      $last_frost = $zone3_LF;
      break;

    case ($_POST["zone"] == '4'):
      $last_frost =  $zone4_LF;
      break;

    case ($_POST["zone"] == '5'):
      $last_frost =  $zone5_LF;
      break;

    case ($_POST["zone"] == '6'):
      $last_frost =  $zone6_LF;
      break;

    case ($_POST["zone"] == '7'):
      $last_frost =  $zone7_LF;
      break;

    case ($_POST["zone"] == '8'):
      $last_frost =  $zone8_LF;
      break;

    case ($_POST["zone"] == '9'):
      $last_frost =  $zone9_LF;
      break;

    case ($_POST["zone"] == '10'):
      $last_frost =  $zone10_LF;
      break;

    case ($_POST["zone"] == '11'):
      $last_frost =  $zone11_LF;
      break;
  }

  //return $last_frost;
  return date('Y-m-d', strtotime(frost_year()."-".$last_frost));
  
} // End of zone_last_frost function


// This function calculates when to plant seeds based on when the last frost is
// Date should be YYYY-MM-DD
// Both params should be surrounded by ''
// $days_away is the number of days from when the seeds/seedlings should be planted
// $days away will usually be '-42 days' or '-56 days' (6 or 8 weeks) for seeds
function plant_date($date, $days_away) {
  
  $date = date($date); //6 weeks out
  $plant_date = strtotime($days_away, strtotime($date)) ;
  $plant_date = date('F d', $plant_date);
  return $plant_date;

}

// Displays the date as it should appear on the website
// Month and day (i.e. October 06 or May 18)
function display_date($date) {
  
  $date = DateTime::createFromFormat('Y-m-d', $date);
  return $date->format('F d');

}

?>