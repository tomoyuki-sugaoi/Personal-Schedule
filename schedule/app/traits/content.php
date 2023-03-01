<?php
namespace App\Traits\Content;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRegiRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\AmSchedule;
use App\Models\PmSchedule;
use App\Models\Deadline;

trait Content {
  public function getContent(Request $request) {

  }
}