<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Relationship;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class RelationshipController extends Controller
{
    public function index(){
        $query = 'select a.name as user1, b.name as user2, c.tag as tag from relationships inner join users as a on relationships.user1 = a.id inner join users as b on relationships.user2 = b.id inner join tags as c on relationships.tag = c.id';
        return response()->json(DB::select($query));
    }

    public function show($id){
      $query = 'select a.name as user1, b.name as user2, c.tag as tag from relationships inner join users as a on relationships.user1 = a.id inner join users as b on relationships.user2 = b.id inner join tags as c on relationships.tag = c.id where relationships.user1 = ? union select b.name as user1, a.name as user2, c.tag as tag from relationships inner join users as a on relationships.user1 = a.id inner join users as b on relationships.user2 = b.id inner join tags as c on relationships.tag = c.id where relationships.user2 = ?';
      return response()->json(['user'=>User::find($id),'relations'=>DB::select($query,[$id,$id])]);
    }

    public function path($id1, $id2){
        $query = 'call tc_path(?,?)';
        $result = DB::select($query,[$id1,$id2]);
        $start = ['from'=>User::find($id1)->toArray(),'to'=>User::find($id2)->toArray(),'seperation'=>-1];
        if(!!$result){
          $nodes = explode(".",$result[0]->path_string,-1);
          $start = ['from'=>User::find($result[0]->user1)->toArray(),'to'=>User::find($result[0]->user2)->toArray(),'seperation'=>$result[0]->distance-1];
          $path = [];
          foreach ($nodes as $node) {
            array_push($path,User::find($node)->toArray());
          }
          return response()->json(['result'=>'success','summary'=>$start,'path'=>$path]);
      }
      else{
        return response()->json(['result'=>'error','summary'=>$start,'path'=>'']);
      }
    }

    public function add(Request $request){
      $user1 = $request->input('user1');
      $user2 = $request->input('user2');
      $tag = $request->input('tag');

      try{
        if($user1 < $user2){
          Relationship::create(['user1'=>$user1,'user2'=>$user2,'tag'=>$tag]);
          return response()->json(['success'=>true]);
        }
        else if($user1 == $user2){
          return response()->json(['success'=>false]);
        }
        else{
          Relationship::create(['user1'=>$user2,'user2'=>$user1,'tag'=>$tag]);
          return response()->json(['success'=>true]);
        }
      } catch(\Illuminate\Database\QueryException $ex){
        return response()->json(['success'=>false,'error'=>$ex->getMessage()]);
      }
    }

}
