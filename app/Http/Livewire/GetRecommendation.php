<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Recommendation;

class GetRecommendation extends Component {
  public $resultExists = null, $studentCode;

  public function render() {
    $this->resultExists = null;
    
    if(!empty($this->studentCode) && strlen($this->studentCode) >= 10) {
      $result = Recommendation::where('uniqueID', $this->studentCode)->get();

      if(count($result) < 1) {
        $this->resultExists = false;
      } else {
        $this->resultExists = true;
      }
    }
    return view('livewire.get-recommendation');
  }
}
