@extends('layouts.app')
@section('content')

   <div id="header">
        @component('components.menu')
        @endcomponent
        <div class=navbar_bottom>
            <form action={{url('/mychara_add')}} method="POST">{{ csrf_field() }}
            <button id=modal type="button" class="header_btm" data-toggle="modal" data-target="#modal2">
            キャラを探す</button>
            </form>
        </div>
    </div>
    <div class="main">
    <div class="content">
        
            <div class=hedaing><a>♡登録キャラ一覧</a></div>
            @foreach($charas as $chara)
            
                <div class=contents>
                    <div class=chara_top>
                        <div class=chara_head>{{$chara->chara_name.'('.$chara->chara_castingtitle.')'}}</div>
                        <div class=chara_main>
                            <img id=chara_img src="/storage/chara_img/{{$chara->chara_picture}}"></img>
                            <div class=chara_prof>
                                <div class=chara_prof_comment></div>
                                <div style="text-align:start;"></div>
                            </div>
                        </div>
                        <div id="chara_detail"><a href="{{url('/chara_top/'.$chara->chara_id)}}">キャラトップへ</a>
                        
                            <button id=modal type="button" class="label_btn_" data-toggle="modal" data-target="#modal1" value='{{$chara->chara_id}}'>
                              マイキャラに追加
                            </button>
                            </div>
                    </div>
                    
                </div>
            
            @endforeach
            <form method="get" action="{{url('mychara_add/'.$user_detail->id)}}" enctype="multipart/form-data">{{ csrf_field() }}
                    <div class="modal fade" id="modal1" tabindex="-1"
                          role="dialog" aria-labelledby="label1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h6 class="modal-title" id="label1">ラベルを選択してください</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body" id='mychara'>
                              <!--<input id='chara_id_selected' name='chara_id' value=1>-->
                              <div id=label_btns>
                                @foreach($labels as $label)
                                <input type="radio" name=label_id id='label_{{$label->label_id}}' value='{{$label->label_id}}'>
                                <label for='label_{{$label->label_id}}' class="label_btn">{{$label->label_name}}</label>
                                @endforeach
                              </div>
                            <div class=label_gen>
                                <a>新しくラベルを作る</a>
                                <input class=gen_label_textbox type="text" name="newlabel" style='width:40%'/>
                            </div>
                          </div>
                          <div class="modal-footer">
                            
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
                            <button type="submit" class="btn btn-primary">登録</button>
                          </div>
                        </div>
                        
                      </div>
                    </div>
            </form>
            <form method="get" action="{{url('/mychara_search')}}" enctype="multipart/form-data">{{ csrf_field() }}
            <div class="modal fade" id="modal2" tabindex="-1"
                          role="dialog" aria-labelledby="label1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h6 class="modal-title" id="label1">ラベルで探す</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" id='mychara'>
                      <!--<input id='chara_id_selected' name='chara_id' value=1>-->
                      <div id=label_btns>
                        @foreach($labels as $label)
                        <input type="radio" name=label_id id='label_s_{{$label->label_id}}' value='{{$label->label_id}}'>
                        <label for='label_s_{{$label->label_id}}' class="label_btn">{{$label->label_name}}</label>
                        @endforeach
                      </div>
                    
                  </div>
                  <div class="modal-header">
                    <h6 class="modal-title" id="label1">キャラ名で探す</h6>
                  </div>
                  <div class="modal-body" id='mychara'>
                      <!--<input id='chara_id_selected' name='chara_id' value=1>-->
                      <div class=label_gen>
                        <input class=gen_label_textbox type="text" name="chara_name"/>
                    　</div>
                  </div>
                  <div class="modal-header">
                    <h6 class="modal-title" id="label1">作品名で探す</h6>
                  </div>
                  <div class="modal-body" id='mychara'>
                      <div class=label_gen>
                        <input class=gen_label_textbox type="text" name="title"/>
                    　</div>
                  </div>

                  
                  <div class="modal-footer">
                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
                    <button type="submit" class="btn btn-primary">検索</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
    </div>
    </div>
<style>
    a{
        color:#717171;
    }
    a:hover{
        color:#4A95E9;
    }
  
    .label_gen{
        padding:12px 0 0px 0;
    }
    .gen_label_textbox{
        border-bottom: 1px solid #dee2e6;
        border-radius: .3rem;
    }
    input[type=radio] {
        display: none; 
    }
    input[type="radio"]:checked + label{
        background: #FFFFFF 0% 0% no-repeat padding-box;
        color: #4A95E9;
    }
</style>
@endsection
