@extends('layouts.app')
@section('content')

    <div id="header">
        @component('components.menu')
        @endcomponent
        <div class=navbar_bottom>
            <form action="{{url('/chara_entry')}}" method="GET">{{ csrf_field() }}
            <button type="submit" class=header_btm id="mychara_set">コメントを入力</button>
            </form>
        </div>
    </div>
    <div class="main">
    <div class="content">
        <div class=checkbox>
            @if($chara)
            <div style='padding:12px 0px 12px 0px'>♡選択中のキャラ</div>
            <div style='padding:12px 0px 12px 0px'>
            <button type="" class=checkbox_btm>{{$chara->chara_name}}</button></div>
            @endif
        </div>
        <div class=contents>
            <div class=hedaing><a>♡タイムライン</a></div>
            <div class=timeline_top>
                @foreach($activitylogs as $activitylog)
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
                            <div id=share><a href="https://twitter.com/share?url=http://c04016a722574522b3bee7cb18eb419e.vfs.cloud9.us-east-2.amazonaws.com/chara_top/1" data-lang="ja"><img class=sns_icon src="/storage/material/Twitter_Social_Icon_Circle_Color.png"></img></a></div>
                            <div id=share class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://c04016a722574522b3bee7cb18eb419e.vfs.cloud9.us-east-2.amazonaws.com/chara_top/1" class=""><img class=sns_icon src="/storage/material/f_logo_RGB-Blue_1024.png"></img></a></div>
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
                            <div id=share><a href="https://twitter.com/share?ref_src=twsrc%5Etfw"
        data-text="<!-- ここにTweetしたときにデフォルトでいれておきたい文字列を入れる -->" data-url="<!-- ここにTweetしたときに入れたいURLを入れる -->"
        data-lang="ja"><img class=sns_icon src="/storage/material/Twitter_Social_Icon_Circle_Color.png"></img></a></div>
                            <div id=share class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://c04016a722574522b3bee7cb18eb419e.vfs.cloud9.us-east-2.amazonaws.com/chara_top/1" class=""><img class=sns_icon src="/storage/material/f_logo_RGB-Blue_1024.png"></img></a></div>
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            
    </div>
    </div>
<style type="text/css">
body{
  color:#717171;   
}
a{
    width:100%;
}
    .chara_top>div{
        text-align:center;
        color:#717171;
    }
    .chara_population{
        display:flex;
        flex-direction:row;
        justify-content:center;
    }
    .chara_population>div{
        margin:6px 6px 6px 6px;
    }
    .chara_population>label{
        margin:6px 0 6px 0;
    }
    .timeline_box{
        display:flex;
        background: #FFFFF8 0% 0% no-repeat padding-box;
        width: 100%;
        height: 100px;
        color:#717171;
        font-size:12px;
        margin:12px 0 12px 0;
    }
    #icon{
        display:flex;
        justify-content:center;
        align-items:center;
        margin:0px 12px 0px 36px;
    }
    #icon>img{
        object-fit: cover;
        object-position:-20px 0px;
        box-shadow: 0px 3px 6px #00000029;
        border-radius: 50%;
        height:72px;
        width:72px;
    }
    #timeline_contents{
        width:63%;
    }
    #timeline_detail{
       display:flex;
        justify-content:flex-start;
        align-items:center;
        text-align:left;
        height:60px;
        padding:0 12px 0 12px;
    }
    #good_share{
        display:flex;
        flex-direction:row;
        justify-content:space-around;
        align-items:center;
        padding:0 0px 0 64px;
    }
    .sns_icon{
        width:24px;
        height:24px;
    }
    .checkbox{
        display:flex;
        flex-direction:column;
        padding:12px 0 12px 12px;
        
    }
    .checkbox_btm {
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border: 1px solid #4A95E9;
        border-radius: 30px;
        padding: 4px 12px 4px 12px;
        color: #4A95E9;
        opacity: 1;
    }
</style>

<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v4.0"></script>
@endsection