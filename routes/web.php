<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Activitylog;
use App\Label;
use App\Chara;
use App\Mychara;
use App\user_detail;
use Illuminate\Http\Request;

Route::POST('/chara',function(Request $request){
    //データ登録処理
    $charas = new Chara;
    $charas->chara_name=$request->name;
    $charas->chara_profile=$request->prof;
    $charas->register_id=1;
    $charas->chara_birthday='test';
    
    $upload_chara_img=$request->chara_img;
    $filePath = $upload_chara_img->store('public/chara_img');
    $charas->chara_picture =str_replace('public/chara_img/', '', $filePath);
    
    $charas->chara_castingtitle=$request->title;
    $charas->chara_parent='test';
    $charas->chara_gender=$request->gender;
    $charas->save();
    
    return redirect('/chara_entry');
});

Route::post('/chara_update',function(chara $chara,Request $request){
    //キャラデータ更新処理
    
    $chara = Chara::where('chara_id',$request->id)
                   ->first();
    $chara->chara_name=$request->name;
    $chara->chara_profile=$request->prof;
    $chara->register_id=1;
    $chara->chara_birthday='test';
    
    if($request->chara_img){
    $upload_chara_img=$request->chara_img;
    $filePath = $upload_chara_img->store('public/chara_img');
    $chara->chara_picture =str_replace('public/chara_img/', '', $filePath);
    }
    $chara->chara_castingtitle=$request->title;
    $chara->chara_parent='test';
    $chara->chara_gender=$request->gender;
    $chara->save();

    return redirect('/chara_top/'.$chara->chara_id);
});  

Route::GET('/chara_update/{chara}',function(Chara $chara){
    return view('chara_update',['chara'=>$chara]);
});

Route::get('/chara_entry',function(){
    return view('chara_entry');
});

Route::post('/chara_top',function(){
    
});

Route::get('/chara_top/{chara}',function(Chara $chara){
    $labels=
    Mychara::where('chara_id',$chara->chara_id)
                ->join('labels','labels.label_id','=','mycharas.label_id')
                ->distinct()->select('mycharas.chara_id','labels.label_id','labels.label_name')
                ->get();
                
    $sums=
    Mychara::select(\DB::raw('count(concat(mycharas.chara_id,mycharas.label_id)) count'),
                          \DB::raw('concat(mycharas.chara_id,mycharas.label_id) result'),
                          \DB::raw('max(mycharas.chara_id) sum_chara_id'),
                          \DB::raw('max(mycharas.label_id) sum_label_id'),
                          \DB::raw('max(labels.label_name) sum_label_name'))
                ->groupBy('result')
                ->having('sum_chara_id','=',$chara->chara_id)
                ->join('labels','labels.label_id','=','mycharas.label_id')
                // ->toSql();
                ->get();
                
    $total=Mychara::select(\DB::raw('count(chara_id) total'))
                ->groupBy('chara_id')
                ->having('chara_id','=',$chara->chara_id)
                ->first();
                
    $activitylogs=Activitylog::where('activitylogs.chara_id',$chara->chara_id)
                ->join('user_details','user_details.id','=','activitylogs.user_id')
                ->leftJoin('labels','labels.label_id','=','activitylogs.label_id')
                ->get();
                
    return view('chara_top',['chara'=>$chara,'total'=>$total,'sums'=>$sums,'activitylogs'=>$activitylogs]);
});

Route::get('/user_detail', function () {
    $mycharas=user_detail::where('user_details.email',Auth::user()->email)
                ->join('mycharas','mycharas.user_id','=','user_details.id')
                ->join('charas','charas.chara_id','=','mycharas.chara_id')
                ->get();
    $user_detail=user_detail::where('user_details.email',Auth::user()->email)
                ->first();
                
    $mychara=user_detail::where('user_details.email',Auth::user()->email)
                ->join('mycharas','mycharas.user_id','=','user_details.id')
                ->select('chara_id')
                ->get();
    
    $activitylogs=Activitylog::whereIn('activitylogs.chara_id',$mychara)
                ->join('user_details','user_details.id','=','activitylogs.user_id')
                ->leftJoin('labels','labels.label_id','=','activitylogs.label_id')
                ->join('charas','charas.chara_id','=','activitylogs.chara_id')
                ->get();        
    
    
    return view('user_detail',['mycharas'=>$mycharas,'user_detail'=>$user_detail,'activitylogs'=>$activitylogs]);
    
    // return view('user_detail');
});

// Route::get('/user_detail/{user_detail}', function (user_detail $user_detail, Request $request) {
//     $mycharas=user_detail::where('user_details.id',$user_detail->id)
//                 ->join('mycharas','mycharas.user_id','=','user_details.id')
//                 ->join('charas','charas.chara_id','=','mycharas.chara_id')
//                 ->get();
    
//     return view('user_detail',['mycharas'=>$mycharas,'user_detail'=>$user_detail]);
    
// });

Route::get('/mychara/{user_detail}', function (user_detail $user_detail, Request $request) {
    $user_details=user_detail::where('user_details.id',$user_detail->id)
                ->join('mycharas','mycharas.user_id','=','user_details.id')
                ->join('labels','labels.label_id','=','mycharas.label_id')
                ->join('charas','charas.chara_id','=','mycharas.chara_id')
                ->get();
    $u_id=Auth::user()->id;
                
    return view('mychara',['user_details'=>$user_details,'u_id'=>$u_id]);
    // return view('user_detail');
});
Route::POST('/mychara_update/{mychara}', function (Mychara $mychara, Request $request) {
    $mychara->chara_id=$request->chara_id;
    $mychara->label_id=$request->label_id;
    $mychara->save();
    
    return view('user_detail');
});
Route::get('/mychara_select', function () {
   $user_detail=user_detail::where('user_details.email',Auth::user()->email)->first();
   $mycharas=Mychara::where('user_id',$user_detail->id)
            ->select('chara_id')
            ->get();
   $charas=Chara::whereNotIn('chara_id',$mycharas)
            ->get();
   $labels=Label::get();
                
    return view('mychara_select',['user_detail'=>$user_detail,'charas'=>$charas,'labels'=>$labels]);
    // return view('user_detail');
});

Route::get('/mychara_add/{user_detail}',function(user_detail $user_detail, Request $request){
    if($request->newlabel){
        $label=new Label;
        $label->label_name=$request->newlabel;
        $label->save();
        
        $mychara = new Mychara;
        $mychara->chara_id=$request->chara_id;
        $mychara->user_id=$user_detail->id;
        $mychara->label_id=$label->label_id;
        $mychara->save();
        
        $activitylog = new Activitylog;
        $activitylog->user_id=$user_detail->id;
        $activitylog->chara_id=$request->chara_id;
        
            if($label->label_id>0){
            $activitylog->log_detail=1;
            $activitylog->label_id=$request->label_id;
            }else{
            $activitylog->log_detail=3;
            $activitylog->comment_id=1;   
            }
            
        $activitylog->like=1;
        $activitylog->show_hide_flg=1;
        $activitylog->save();
    }else{
    $mychara = new Mychara;
    $mychara->chara_id=$request->chara_id;
    $mychara->user_id=$user_detail->id;
    $mychara->label_id=$request->label_id;
    $mychara->save(); 
    
    $activitylog = new Activitylog;
    $activitylog->user_id=$user_detail->id;
    $activitylog->chara_id=$request->chara_id;
    
        if($request->label_id>0){
        $activitylog->log_detail=1;
        $activitylog->label_id=$request->label_id;
        }else{
        $activitylog->log_detail=3;
        $activitylog->comment_id=1;   
        }
    
    $activitylog->like=1;
    $activitylog->show_hide_flg=1;
    $activitylog->save();
    }
    
    return redirect('/mychara_select');
});

Route::get('/mychara_search',function(Request $request){
    $user_detail=user_detail::where('user_details.email',Auth::user()->email)->first();
    if($request->label_id){
    $results=Mychara::where('label_id',$request->label_id)
           ->select('chara_id')
           ->get();
    }elseif($request->chara_name){
    $results=Chara::where('chara_name',$request->chara_name)
           ->select('chara_id')
           ->get();
    }else{
    $results=Chara::where('chara_castingtitle',$request->title)  
           ->select('chara_id')
           ->get();    
    }
    $charas=Chara::whereIn('chara_id',$results)
           ->get();
    $labels=Label::get();
    return view('mychara_select',['user_detail'=>$user_detail,'charas'=>$charas,'labels'=>$labels]);
});

Route::get('mychara_delete/{chara}',function(chara $chara){
    $user_detail=user_detail::where('email',Auth::user()->email)
            ->first();
    $mychara=Mychara::where('chara_id',$chara->chara_id)
            ->where('user_id',$user_detail->id)
            ->delete();
    return redirect('/chara_top/'.$chara->chara_id);
});

Route::GET('/user_entry', function () {
    // $user_details=user_detail::where('email','ggg')->get();
    // return view('user_entry',['user_details'=>$user_details]);
    return view('user_entry');
});

Route::POST('/user',function(Request $request){
    
    //データ登録処理
    $user_details = new user_detail;
    $user_details->email=Auth::user()->email;
    $user_details->pass='test';
    $user_details->l_kana=$request->name;
    $user_details->l_name='test';
    $user_details->f_kana='test';
    $user_details->f_name='test';
    $user_details->u_profile=$request->prof;
    $user_details->birthday = $request->birthday;
    $user_details->gender ='test';
    
    $upload_ft_img=$request->ft_img;
    $filePath_ft = $upload_ft_img->store('public/user_picture');
    
    $user_details->u_img =str_replace('public/user_picture/', '', $filePath_ft);
    
    $upload_bg_img=$request->bg_img;
    $filePath_bg = $upload_bg_img->store('public/user_picture');
    
    $user_details->u_back_img =str_replace('public/user_picture/', '', $filePath_bg);
    $user_details->save();
    return redirect('/user_detail');
    
});

Route::POST('/user_update',function(Request $request){
    
    //データ更新処理
    $user_detail = user_detail::find($request->id);
    $user_detail->l_kana=$request->name;
    $user_detail->u_profile=$request->prof;
    $user_detail->birthday = $request->birthday;
    
    if($request->bg_img){
    $change_bg_img=$request->bg_img;
    $filePath_bg = $change_bg_img->store('public/user_picture');
    $user_detail->u_back_img =str_replace('public/user_picture/', '', $filePath_bg);
    }
    
    if($request->ft_img){
    $change_ft_img=$request->ft_img;
    $filePath_ft = $change_ft_img->store('public/user_picture');
    $user_detail->u_img =str_replace('public/user_picture/', '', $filePath_ft);
    }
    
    $user_detail->save();
    return redirect('/user_detail');
});    

Route::post('/user_update/{user_detail}',function(user_detail $user_detail){
    return view('user_update',['user_detail'=>$user_detail]);
});

Route::get('/timeline_chara/{chara}',function(Chara $chara){
    $activitylogs=Activitylog::where('activitylogs.chara_id',$chara->chara_id)
                ->join('user_details','user_details.id','=','activitylogs.user_id')
                ->leftJoin('labels','labels.label_id','=','activitylogs.label_id')
                ->get();
    
    return view('timeline_chara',['chara'=>$chara,'activitylogs'=>$activitylogs]);
});

Route::get('/timeline_chara/user/{user_detail}',function(user_detail $user_detail){
    $mychara=Mychara::where('user_id',$user_detail->id)
                ->select('chara_id')
                ->get();
                
    $activitylogs=Activitylog::whereIn('activitylogs.chara_id',$mychara)
                ->join('user_details','user_details.id','=','activitylogs.user_id')
                ->leftJoin('labels','labels.label_id','=','activitylogs.label_id')
                ->join('charas','charas.chara_id','=','activitylogs.chara_id')
                ->get();
    
    $chara='';
    
    return view('timeline_chara',['chara'=>$chara,'activitylogs'=>$activitylogs]);
});

Auth::routes();

Route::get('/home', function(){
    return view('auth/register') ;
});


