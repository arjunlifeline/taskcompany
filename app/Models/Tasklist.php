<?php

namespace App\Models;
use App\Models\Citizen;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Tasklist extends Model
{

    public $table = 'student';
    protected $fillable = [
        'name',
        'status',
        'created_at',
		'updated_at',
    ];

    public function updateData($id,$columns){
        return DB::table('tasklist')->where('id',$id)->update($columns);
    }
	
    public function addData($postdata){
         DB::table('tasklist')->insert($postdata);
        return DB::getPdo()->lastInsertId();
    }
	public function getEditDetails($id){
         $data=DB::table('tasklist')->where('id','=',$id)->update(['status' => 1]);
        return $data;
    }
	public function datadelete($id){
        DB::table('tasklist')->where('id',$id)->delete();
        return;
    }
}
