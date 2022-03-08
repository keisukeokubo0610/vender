$(function() {
    // $(window).on('load', function() {
    // $('.getProductsList').on('load', function() {
    $('.sortable').on('click', function(data) {
        //実行処理
        $('#product_table').empty(); //もともとある要素を空にする


        var sort_item = $(this).find('button').val();
        var sort = $(this).find('.sort_type').val();

        console.log(sort_item);
        console.log(sort);

        // var sortUrl = (document.URL);
        // if (document.URL.match(/sort/)) {

        console.log('成功2！');

        $.ajax({
                type: 'GET',
                url: './sort', //後述するweb.phpのURLと同じ形にする
                data: { 'sort_item': sort_item, 'sort': sort },
                dataType: 'json', //json形式で受け取る

                beforeSend: function() {
                        console.log('ソート成功！');

                        // $('.loading').removeClass('display-none');
                    } //通信中の処理をここで記載。今回はぐるぐるさせるためにcssでスタイルを消す。
            })
            .done(function(data) { //ajaxが成功したときの処理
                // console.log("通信に成功しました");
                // $('.loading').addClass('display-none'); //通信中のぐるぐるを消す
                $.each(data, function(index, value) { //dataの中身からvalueを取り出す
                        　　　　 //ここの記述はリファクタ可能

                        // オブジェクトや値を JSON 文字列に変換
                        var data_stringify = JSON.stringify(data);
                        var data_json = JSON.parse(data_stringify);
                        // console.log(data_json);


                        var i = 0;
                        for (i = 0; i < data_json.length; i++) {　　　 // １ユーザー情報のビューテンプレートを作成

                            addhtml = `
                    
                    <tr>

                        <th>id： ${data_json[i].id}</th>
                        <th>商品画像：<img src="./storage/${data_json[i].img_path}" alt="商品画像"></th>
                        <th>商品名：${data_json[i].product_name} </th>
                        <th>価格：${data_json[i].price}</th>
                        <th>在庫数：${data_json[i].stock}</th>
                        <th>メーカー名：${data_json[i].company_name}</th>
                        <th><a href="./product/${data_json[i].id}" class="btn btn-primary">詳細</a></th>

                        <form class="form-inline btn" action="{{ route('productDelete', ${data_json[i].id}) }}"
                            method="POST">
                            @csrf

                        <th><button value="{{ csrf_token() }}" id="deleteTarget" data-product-id="${data_json[i].id}" class="btn btn-danger">削除</button></th>

                        </form>
                        <br>
                    </tr>
                    `;
                            $('#product_table').append(addhtml); //できあがったテンプレートをビューに追加
                        }
                        if (value.length == 0) {
                            alert('商品が見つかりませんでした。');
                        }
                        return false;
                    })　　　 // 検索結果がなかったときの処理

            }).fail(function() {　　　 //ajax通信がエラーのときの処理
                console.log('どんまい！');
            });

        // }
        // }
    })
});