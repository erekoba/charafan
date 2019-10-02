$(function(){
   $("#bg_input").on('change',function(e){
       // 1枚だけ表示する
        var file = e.target.files[0];
        console.log(file);

        // ファイルのブラウザ上でのURLを取得する
        var blobUrl = window.URL.createObjectURL(file);

        // img要素に表示
        $('#bg_img').attr('src', blobUrl);
   });
   
   $("#ft_input").on('change',function(e){
       // 1枚だけ表示する
        var file = e.target.files[0];

        // ファイルのブラウザ上でのURLを取得する
        var blobUrl = window.URL.createObjectURL(file);

        // img要素に表示
        $('#ft_img').attr('src', blobUrl);
   })
   $('#hidden').hide()
   $("#post").on('click',function(){
        
       $('#hidden').show()
   })
   
   $('.label_btn_').on('click',function(){
     var selected_chara=$(this).val();
     console.log(selected_chara)
     $('#chara_id_selected').remove();
     var add="<input id='chara_id_selected' type=hidden name='chara_id' value="+selected_chara+">"
     $('#mychara').append(add);
     
   })
   
   // $('#chara_id_selected').on('click',function(){
   //   console.log($('#chara_id_selected').val())
   // })
    
});