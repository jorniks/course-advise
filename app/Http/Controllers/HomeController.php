<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recommendation;


class HomeController extends Controller {
  
  public function index() {
    return view('home');
  }


  public function getRecommendation() {
    return view('courses', ['coursesArray' => $this->coursesArray]);
  }


  public function submitCourses(Request $request) {
    $sortedArray = $request->all();
    ksort($sortedArray);
    $counter = 1;
    $token = '';
    
    foreach($sortedArray as $arrayKey => $arrayItem) {
      $courseSection = strtolower(explode('_', $arrayKey)[0]);

      if($courseSection === $courseSection && ($arrayKey !== '_token')) {
        $this->courseDetails[$courseSection]['unitScore'] += $this->gradesArray[$arrayItem];
      }
    }

    foreach ($this->courseDetails as $key => $value) {
      if($key !== 'gen') {
        $this->courseDetails[$key]['roundedScore'] += (int)round($this->courseDetails[$key]['unitScore'] + $this->courseDetails['gen']['unitScore']);

        $this->courseDetails[$key]['unitScore'] += $this->courseDetails['gen']['unitScore'];
      }
    }

    $flippedScores = array_flip(array_column($this->courseDetails, 'roundedScore', 'courseKey'));
    $highestScoreCourse = $flippedScores[max(array_keys($flippedScores))];


    array_walk($this->courseDetails[$highestScoreCourse], function($value, $key) use ($highestScoreCourse, $counter) {
      if(is_array($value)) {
        $courseCode = $this->courseDetails[$highestScoreCourse][$key]['code'];

        $this->courseDetails[$highestScoreCourse][$key]['unitScore'] = $this->courseDetails[$courseCode]['unitScore'];
      }
    });

    
    if(!$request->session()->exists('token') || ($request->session()->get('token') !== $request->input('_token'))) {
      $saveRecommendation = new Recommendation();
      $saveRecommendation->mainCourse = $this->courseDetails[$highestScoreCourse]['course'];
      $saveRecommendation->mainCourseScore = $this->courseDetails[$highestScoreCourse]['unitScore'];
      $saveRecommendation->suggestion1 = $this->courseDetails[$highestScoreCourse]['courseSuggestion1']['course'];
      $saveRecommendation->suggestion1Score = $this->courseDetails[$highestScoreCourse]['courseSuggestion1']['unitScore'];
      $saveRecommendation->suggestion2 = $this->courseDetails[$highestScoreCourse]['courseSuggestion2']['course'];
      $saveRecommendation->suggestion2Score = $this->courseDetails[$highestScoreCourse]['courseSuggestion2']['unitScore'];
      $saveRecommendation->save();

      $uniqueID = 'GSLTR'. date('Y', time()) . $saveRecommendation->id;
      session(['personID' => $uniqueID]);

      $saveRecommendation->uniqueID = $uniqueID;
      $saveRecommendation->save();
    }

    session(['token' => $request->input('_token')]);


    return view('advice', ['uniqueID' => $request->session()->get('personID'), 'gradeScoreValues' => $this->courseDetails[$highestScoreCourse]]);
  }


  public $courseDetails = [
    'bio' => [
      'courseKey' => 'bio',
      'roundedScore' => 0,
      'unitScore' => 0,
      'course' => 'Biology',
      'suggestion1' => 'BIOLOGY',
      'suggestion2' => 'MICROBIOLOGY',

      'courseSuggestion1' => [ 'code' => 'chem', 'unitScore' => 0, 'course' => 'Chemistry' ],
      'courseSuggestion2' => [ 'code' => 'phy', 'unitScore' => 0, 'course' => 'Physics' ],
    ],
    
    'phy' => [
      'courseKey' => 'phy',
      'roundedScore' => 0,
      'unitScore' => 0,
      'course' => 'Physics',
      'suggestion1' => 'PHYSICS',
      'suggestion2' => 'ELECTRONICS',

      'courseSuggestion1' => [ 'code' => 'bio', 'unitScore' => 0, 'course' => 'Biology' ],
      'courseSuggestion2' => [ 'code' => 'chem', 'unitScore' => 0, 'course' => 'Chemistry' ],
    ],
    
    'chem' => [
      'courseKey' => 'chem',
      'roundedScore' => 0,
      'unitScore' => 0,
      'course' => 'Chemistry',
      'suggestion1' => 'CHEMISTRY',
      'suggestion2' => 'BIOCHEMISTRY',

      'courseSuggestion1' => [ 'code' => 'bio', 'unitScore' => 0, 'course' => 'Biology' ],
      'courseSuggestion2' => [ 'code' => 'phy', 'unitScore' => 0, 'course' => 'Physics' ],
    ],
    
    'gen' => [
      'unitScore' => 0
    ],
  ];



  public $coursesArray = [
    'ND1_1' => [
      ['code'=> 'STB 111', 'sect' => 'BIO', 'title' => 'PLANT AND ANIMAL TAXONOMY',],
      ['code'=> 'STB 112', 'sect' => 'BIO', 'title' => 'MORPH. & PHYSIOLOGY OF LIVING THINGS I',],
      ['code'=> 'STC 111', 'sect' => 'CHEM', 'title' => 'GENERAL PRINCIPLE OF CHEMISTRY',],
      ['code'=> 'STC 112', 'sect' => 'CHEM', 'title' => 'INORGANIC CHEMISTRY I',],
      ['code'=> 'GLT 111', 'sect' => 'GEN', 'title' => 'GENERAL LABORATORY TECHNIQUES I',],
      ['code'=> 'GNS 103', 'sect' => 'GEN', 'title' => 'USE OF LIBRARY',],
      ['code'=> 'GNS 127', 'sect' => 'GEN', 'title' => 'CITIZENSHIP EDUCATION I',],
      ['code'=> 'STC 113', 'sect' => 'GEN', 'title' => 'TECHNICAL ENGLISH',],
      ['code'=> 'STP 111', 'sect' => 'PHY', 'title' => 'MECHANICS',],
      ['code'=> 'STP 112', 'sect' => 'PHY', 'title' => 'HEAT ENERGY',],
      ['code'=> 'STP 113', 'sect' => 'PHY', 'title' => 'ALGEBRA FOR SCIENCE',],
      ['code'=> 'STP 114', 'sect' => 'PHY', 'title' => 'ELECTRONIC LOGIC FOR SCIENCE',],
    ],
    'ND1_2' => [
      ['code'=> 'STB 121', 'sect' => 'BIO', 'title' => 'CELL BIOLOGY',],
      ['code'=> 'STB 122', 'sect' => 'BIO', 'title' => 'MORPH. & PHYSIOLOGY OF LIVING THINGS II',],
      ['code'=> 'STC 121', 'sect' => 'CHEM', 'title' => 'ORGANIC CHEMISTRY',],
      ['code'=> 'STC 122', 'sect' => 'CHEM', 'title' => 'PHYSICAL CHEMISTRY',],
      ['code'=> 'STC 123', 'sect' => 'CHEM', 'title' => 'ANALYTICAL CHEMISTRY',],
      ['code'=> 'COM 127', 'sect' => 'GEN', 'title' => 'COMPUTER PACKAGES',],
      ['code'=> 'EED 126', 'sect' => 'GEN', 'title' => 'INTRODUCTION TO ENTREPRENEURSHIP',],
      ['code'=> 'GLT 121', 'sect' => 'GEN', 'title' => 'GENERAL LABORATORY TECHNIQUE II',],
      ['code'=> 'GNS 128', 'sect' => 'GEN', 'title' => 'CITIZENSHIP EDUCATION II',],
      ['code'=> 'STP 121', 'sect' => 'PHY', 'title' => 'ELECT/ MAGNETISM',],
      ['code'=> 'STP 122', 'sect' => 'PHY', 'title' => 'OPTICS AND WAVES',],
    ],
    'ND2_1' => [
      ['code'=> 'STB 212', 'sect' => 'BIO', 'title' => 'PATHOLOGY',],
      ['code'=> 'STM 211', 'sect' => 'BIO', 'title' => 'MICROBIOLOGY',],
      ['code'=> 'STB 211', 'sect' => 'BIO', 'title' => 'PEST AND PEST CONTROL',],
      ['code'=> 'STC 212', 'sect' => 'CHEM', 'title' => 'INSTRUMENTATION ANALYTICAL CHEMISTRY & QUALITY CONTROL',],
      ['code'=> 'STC 211', 'sect' => 'CHEM', 'title' => 'INORGANIC CHEMISTRY II',],
      ['code'=> 'COM 217', 'sect' => 'GEN', 'title' => 'COMPUTER PACKAGES II',],
      ['code'=> 'GLT 211', 'sect' => 'GEN', 'title' => 'GENERAL LABORATORY TECHNIQUE',],
      ['code'=> 'EED 216', 'sect' => 'GEN', 'title' => 'PRACTICE OF ENTREPRENEURSHIP',],
      ['code'=> 'SWE 200', 'sect' => 'GEN', 'title' => 'SIWES',],
      ['code'=> 'STP 211', 'sect' => 'PHY', 'title' => 'ELECTRONICS',],
      ['code'=> 'STP 213', 'sect' => 'PHY', 'title' => 'CALCULUS FOR SCIENCE',],
      ['code'=> 'STP 212', 'sect' => 'PHY', 'title' => 'THERMODYNAMICS AND ELECT',],
    ],
    'ND2_2' => [
      ['code'=> 'STB 221', 'sect' => 'BIO', 'title' => 'GENETICS',],
      ['code'=> 'STB 222', 'sect' => 'BIO', 'title' => 'ECOLOGY',],
      ['code'=> 'STC 221', 'sect' => 'CHEM', 'title' => 'ORGANIC CHEMISTRY',],
      ['code'=> 'STC 222', 'sect' => 'CHEM', 'title' => 'BIOCHEMISTRY',],
      ['code'=> 'SLT 222', 'sect' => 'GEN', 'title' => 'PROJECT',],
      ['code'=> 'GLT 221', 'sect' => 'GEN', 'title' => 'GENERAL LABORATORY TECHNIQUES',],
      ['code'=> 'STP 221', 'sect' => 'PHY', 'title' => 'MAINT. AND REPAIRS OF SCIENCE ELECT. EQUIP',],
      ['code'=> 'SLT 221', 'sect' => 'GEN', 'title' => 'SEMINAR',],
    ],
  ];


  // public $gradesArray = [
  //   'F' => 0,
  //   'E' => 40,
  //   'D' => 45,
  //   'CD' => 50,
  //   'C' => 55,
  //   'BC' => 60,
  //   'B' => 65,
  //   'AB' => 70,
  //   'A' => 75
  // ];


  public $gradesArray = [
    'F' => 0,
    'E' => 2.0,
    'D' => 2.25,
    'CD' => 2.5,
    'C' => 2.75,
    'BC' => 3.0,
    'B' => 3.25,
    'AB' => 3.5,
    'A' => 4
  ];


}
