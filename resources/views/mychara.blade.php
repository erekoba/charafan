@extends('layouts.app')
@section('content')

   <div id="header">
        @component('components.menu')
        @endcomponent
        <div class=navbar_bottom>
            <form action="{{url('/mychara_select')}}" method="get">{{ csrf_field() }}
            <button type="submit" class=header_btm id="profchange">マイキャラ追加</button>
            </form>
        </div>
    </div>
    <div class="main">
    <div class="content">
        <div class=contents>
            <div class=hedaing><a>♡マイキャラリスト</a></div>
            @foreach($user_details as $user_detail)
            <form method="POST" action="{{url('mychara_update/'.$user_detail->id)}}" enctype="multipart/form-data">{{ csrf_field() }}
                <div class=contents>
                    <div class=chara_top>
                        <div class=chara_head>{{$user_detail->chara_name.'('.$user_detail->chara_castingtitle.')'}}</div>
                        <div class=chara_main>
                            <img id=chara_img src="/storage/chara_img/{{$user_detail->chara_picture}}"></img>
                            <div class=chara_prof>
                                <div class=chara_prof_comment></div>
                                <div style="text-align:start;"></div>
                            </div>
                        </div>
                        <div class=chara_population>
                        <button type="" class=label_btn id="profchange">{{$user_detail->label_name}}</button>
                        </div>
                        <div id="chara_detail"><a href="{{url('/chara_top/'.$user_detail->chara_id)}}">>>キャラトップへ</a></div>
                    </div>
                    <div>
                </div>
            </form>
            @endforeach
        </div>
    </div>
    </div>
<style>
    a{
        color:#717171;
    }
    a:hover{
        color:#4A95E9;
    }
  
</style>
@endsection
