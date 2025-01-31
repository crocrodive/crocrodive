<?php

namespace App\Http\Controllers;

use App\Enum\Roles;
use App\Models\Course;
use App\Models\Site;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Response;

class FormationController extends Controller
{
    public function index(Request $request): View
    {
        $course_value = Course::getAllCoursesData();
        $sites = Site::getAllSitesData();
        return view('formation', ["all_course_value" => $course_value, "sites_list" => $sites]);
    }

    public function show($id)
    {
        $course = Course::getCourseData($id);
        $resp = [];
        $students = [];
        $trainers = [];
        foreach($course as $c){
            if($c['role_id'] == Roles::ATTENDEE->value){
                array_push($students, $c);
            }else if($c['role_id'] == Roles::INSTRUCTOR->value){
                array_push($trainers, $c);
            }elseif($c['role_id'] == Roles::COURSE_MANAGER->value){
                $resp['manager'] = $c;
                array_push($trainers, $c);
            }
        }
        return view('open-course', ["resp" => $resp, "students" => $students, "trainers" => $trainers]);
    }

    public function store(Request $request){
        Course::createCourse($request->all());
        return response()->json(['success' => 'Data is successfully added']);
    }

    public function getLocations(Request $request)
    {
        $sites = Site::getAllSitesData();
        return response()->json($sites);
    }

    public function getLevels(Request $request)
    {
        $levels = Level::getLevelsData();
        return response()->json($levels);
    }

    public function getInstructorData(Request $request)
    {
        $trainers = User::getInstructorData();
        return response()->json($trainers);
    }

    public function getParticipantData(Request $request)
    {
        $participants = User::getParticipantData($request->all());
        return response()->json($participants);
    }
}
