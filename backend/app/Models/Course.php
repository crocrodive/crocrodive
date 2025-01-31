<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\UserCourse;
use Illuminate\Support\Facades\DB;

/**
 * A diving course for the current year ("formation" in french).
 *
 * A diving course has a manager, and a team of instructors.
 *
 * Each course focus on a specific level of certification.
 *
 * Each year, the technical director of the club defines the courses
 * that will be organized.
 *
 * @property string $id Identifier for the course (UUIDv4)
 * @property \Date $start_date Date of the beginning of the course
 */
class Course extends CustomPrefixedModel
{
    use HasUuids, HasFactory;

    protected $table = 'croc_courses';
    protected string $prefix = 'cour_';
    protected $primaryKey = 'cour_id';

    protected $fillable = [
        'cour_start_date',
        'manager_user_id',
        'leve_id',
        'site_id',
    ];

    public function manager() {
        return $this->belongsTo(User::class, 'manager_user_id', 'user_id');
    }

    public function level() {
        return $this->belongsTo(Level::class, 'leve_id', 'leve_id');
    }

    public function site() {
        return $this->belongsTo(Site::class, 'site_id', 'site_id');
    }

    public static function getAllCoursesData()
    {
        return Course::join('croc_sites', 'croc_courses.site_id', '=', 'croc_sites.site_id')
            ->join('croc_levels', 'croc_courses.leve_id', '=', 'croc_levels.leve_id')
            ->join('users', 'croc_courses.manager_user_id', '=', 'users.user_id')
            ->get(['croc_courses.cour_start_date', 'user_firstname', 'user_lastname', 'leve_name', 'site_name', 'cour_id']);
    }

    public static function getCourseData($id){
        return Course::join('croc_users_courses', 'croc_courses.cour_id', '=', 'croc_users_courses.cour_id')
            ->join('users', 'croc_users_courses.user_id', '=', 'users.user_id')
            ->join('croc_sites', 'croc_courses.site_id', '=', 'croc_sites.site_id')
            ->join('croc_levels', 'croc_courses.leve_id', '=', 'croc_levels.leve_id')
            ->where('croc_courses.cour_id', $id)
            ->get(['croc_levels.leve_name', 'croc_sites.site_name', 'users.role_id', 'users.user_firstname', 'users.user_lastname']);
    }

    public function sessions() {
        return $this->hasMany(Session::class, 'cour_id', 'cour_id');
    }

    public static function createCourse($data){
        try{
            $course = self::create([
                'cour_start_date' => now(),
                'leve_id' => $data['level_id'],
                'site_id' => $data['location_id'],
                'manager_user_id' => $data['responsable'],
            ]);
        }catch(\Exception $e){
            var_dump("error", $e);
        }
        $id = $course['cour_id'];

        foreach($data['trainers'] as $trainer){
            try{
                DB::table('croc_users_courses')->insert([
                    'cour_id' => $id,
                    'user_id' => $trainer['user_id'],
                ]);
            }catch(\Exception $e){
                dump("error", $e->getMessage());
            }
        }

        foreach($data['participants'] as $part){
            try{
                DB::table('croc_users_courses')->insert([
                    'cour_id' => $id,
                    'user_id' => $part['user_id'],
                ]);
            }catch(\Exception $e){
                dump("error", $e->getMessage());
            }
        }
        
        User::where('user_id', $data['responsable'])->update(['role_id' => "Responsable de formation"]);
    }
}
