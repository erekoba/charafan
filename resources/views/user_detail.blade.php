@extends('layouts.app')
@section('content')

    <div id="header">
        @component('components.menu')
        @endcomponent
        <div class=navbar_bottom>
            <form action="{{url('/user_update/'.$user_detail->id)}}" method="post">{{ csrf_field() }}
            <button type="submit" class=header_btm id="profchange">プロフィール変更</button>
            </form>
        </div>
    </div>
    <div class=main>
    <div class="content">
        <div class=user_top>
            <img id=bg_img src="/storage/user_picture/{{$user_detail->u_back_img}}" width=100%></img>
            <img id=ft_img src="/storage/user_picture/{{$user_detail->u_img}}"></img>
            <div id=prof>
                <div class=prof_name></div>
                <div class=prof_comment></div>
                <div class=prof_job>---</div>
            </div>
        </div>
        <div class=contents>
            @if(count($mycharas)>0)
            
            <div class=hedaing><a>♡マイキャラリスト</a></div>
                <div class=box>
                    @foreach($mycharas as $mychara)
                    @if ($loop->iteration < 6)
                    <div id=box1>
                        <div class=inbox>
                            <img src="/storage/chara_img/{{$mychara->chara_picture}}" height=72px>{{$mychara->chara_name}}
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class=bottom>
                    <form action="" method="get">{{ csrf_field() }}
                    <div class=bottom><a href="{{url('/mychara/'.$user_detail->id)}}">もっとみる</a></div>
                    </form>
                </div>
                <hr width=95% size="1" color=#C9C9C9>
            </div>
            
            @else
            <div class=hedaing><a>♡マイキャラリスト</a></div>
                <div class=empty_box>
                    
                        <div class=ajust><a>現在マイキャラは登録されておりません</a></div>
                        <div class=ajust>
                            <form action="{{url('/mychara_select')}}" method="get">{{ csrf_field() }}
                            <button type="submit" class=header_btm id="profchange">マイキャラ追加</button>
                            </form>
                        </div>
                    
                </div>
                <hr width=95% size="1" color=#C9C9C9>
            </div>
            @endif
        <div class=hedaing><a>♡タイムライン</a></div>
            <div class=timeline_top>
                @foreach($activitylogs as $activitylog)
                @if ($loop->remaining < 4)
                <div class=timeline_box>
                    <div id=icon>
                        <img src="/storage/user_picture/{{$activitylog->u_img}}" height=72px>
                    </div>
                    @if($activitylog->label_id>0)
                    <div id=timeline_contents>
                        <div id=timeline_detail>
                            {{$activitylog->l_kana}}さんが{{$activitylog->chara_name}}を「{{$activitylog->label_name}}」に設定しました
                        </div>
                        <div id=good_share>
                            <svg data-v-d5cff4e8="" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 18 18" aria-labelledby="comment" role="presentation"><title id="comment" lang="en">comment icon</title> <g fill="gray"><path data-v-d5cff4e8="" d="M11,11 L13.1428571,11 C13.6162441,11 14,10.6418278 14,10.2 L14,3.8 C14,3.3581722 13.6162441,3 13.1428571,3 L2.85714286,3 C2.38375593,3 2,3.3581722 2,3.8 L2,10.2 C2,10.6418278 2.38375593,11 2.85714286,11 L9,11 L11,13 L11,11 Z M13,13 L13,14.8649584 C13,15.4172431 12.5522847,15.8649584 12,15.8649584 C11.7660635,15.8649584 11.5395306,15.7829422 11.3598156,15.6331797 L8.2,13 L2.66666667,13 C1.19390733,13 -8.8817842e-16,11.8487322 -8.8817842e-16,10.4285714 L-9.86864911e-17,3.57142857 C-9.86864911e-17,2.15126779 1.19390733,1 2.66666667,1 L13.3333333,1 C14.8060927,1 16,2.15126779 16,3.57142857 L16,10.4285714 C16,11.8487322 14.8060927,13 13.3333333,13 L13,13 Z"></path></g></svg>
                            <svg data-v-d5cff4e8="" 
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 18 18" aria-labelledby="fLike" role="presentation">
                                <title id="fLike" lang="en">fLike icon</title>
                                <g fill="gray">
                                    <path data-v-d5cff4e8="" d="M1,6.81818182 C1,4.70945823 2.70945823,3 4.81818182,3 C6.14625411,3 7.31595902,3.6780514 8,4.70685765 C8.68404098,3.6780514 9.85374589,3 11.1818182,3 C13.2905418,3 15,4.70945823 15,6.81818182 C15,7.95857014 14.5000522,8.98218938 13.7073778,9.68181818 C13.6504452,9.73158302 13.6089306,9.76629574 13.5666814,9.80012921 L8.64144526,13.9182198 C8.27015693,14.2286616 7.72984276,14.2286616 7.35855443,13.9182198 L2.43331142,9.80012346 C2.39106708,9.76629373 2.34955719,9.73158494 2.30880946,9.69602483 C1.49994785,8.98218938 1,7.95857014 1,6.81818182 Z"></path>
                                </g>
                            </svg>
                            <div id=share><img class=sns_icon src="/storage/material/Twitter_Social_Icon_Circle_Color.png"></img></div>
                            <div id=share><img class=sns_icon src="/storage/material/f_logo_RGB-Blue_1024.png"></img></div>
                        </div>
                    </div>
                    @elseif($activitylog->comment_id>0)
                    <div id=timeline_contents>
                        <div id=timeline_detail>
                            {{$activitylog->l_kana}}さんが{{$activitylog->chara_name}}のタイムラインにコメントしました「{{$activitylog->comment_id}}」
                        </div>
                        <div id=good_share>
                            <svg data-v-d5cff4e8="" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 18 18" aria-labelledby="comment" role="presentation"><title id="comment" lang="en">comment icon</title> <g fill="gray"><path data-v-d5cff4e8="" d="M11,11 L13.1428571,11 C13.6162441,11 14,10.6418278 14,10.2 L14,3.8 C14,3.3581722 13.6162441,3 13.1428571,3 L2.85714286,3 C2.38375593,3 2,3.3581722 2,3.8 L2,10.2 C2,10.6418278 2.38375593,11 2.85714286,11 L9,11 L11,13 L11,11 Z M13,13 L13,14.8649584 C13,15.4172431 12.5522847,15.8649584 12,15.8649584 C11.7660635,15.8649584 11.5395306,15.7829422 11.3598156,15.6331797 L8.2,13 L2.66666667,13 C1.19390733,13 -8.8817842e-16,11.8487322 -8.8817842e-16,10.4285714 L-9.86864911e-17,3.57142857 C-9.86864911e-17,2.15126779 1.19390733,1 2.66666667,1 L13.3333333,1 C14.8060927,1 16,2.15126779 16,3.57142857 L16,10.4285714 C16,11.8487322 14.8060927,13 13.3333333,13 L13,13 Z"></path></g></svg>
                            <svg data-v-d5cff4e8="" 
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 18 18" aria-labelledby="fLike" role="presentation">
                                <title id="fLike" lang="en">fLike icon</title>
                                <g fill="gray">
                                    <path data-v-d5cff4e8="" d="M1,6.81818182 C1,4.70945823 2.70945823,3 4.81818182,3 C6.14625411,3 7.31595902,3.6780514 8,4.70685765 C8.68404098,3.6780514 9.85374589,3 11.1818182,3 C13.2905418,3 15,4.70945823 15,6.81818182 C15,7.95857014 14.5000522,8.98218938 13.7073778,9.68181818 C13.6504452,9.73158302 13.6089306,9.76629574 13.5666814,9.80012921 L8.64144526,13.9182198 C8.27015693,14.2286616 7.72984276,14.2286616 7.35855443,13.9182198 L2.43331142,9.80012346 C2.39106708,9.76629373 2.34955719,9.73158494 2.30880946,9.69602483 C1.49994785,8.98218938 1,7.95857014 1,6.81818182 Z"></path>
                                </g>
                            </svg>
                            <div id=share><img class=sns_icon src="/storage/material/Twitter_Social_Icon_Circle_Color.png"></img></div>
                            <div id=share><img class=sns_icon src="/storage/material/f_logo_RGB-Blue_1024.png"></img></div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif
                @endforeach
                <div class=bottom><a href="{{url('/timeline_chara/user/'.$user_detail->id)}}">もっとみる</a></div>
                <hr width=95% size="1" color=#C9C9C9>
            </div>
            
        <div class=contents>
            <div class=hedaing><a>♡マイプロジェクト</a></div>
            <ul class=box>
                <li id=box1></li>
                <li id=box1></li>
                <li id=box1></li>
            </ul>
            <div class=bottom><a>もっとみる</a></div>
            <hr width=95% size="1" color=#C9C9C9>
        </div>
        <div class=contents>
            <div class=hedaing><a>♡マイピクチュア</a></div>
            <ul class=box>
                <li id=box1></li>
                <li id=box1></li>
                <li id=box1></li>
            </ul>
            <div class=bottom><a>もっとみる</a></div>
            <hr width=95% size="1" color=#C9C9C9>
        </div>
    </div>
    </div>
<style>
    .empty_box{
        height:100px;
        display:flex;
        flex-direction:column;
        justify-content:center;
    }
    .ajust{
        text-align:center;
        margin:6px;
    }
</style>
    
    
@endsection