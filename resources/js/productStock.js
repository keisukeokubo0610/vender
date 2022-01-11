/* Ajax通信開始 */
$(function() {
    $('#getStock').on('click', function() {

        $('#product_table').empty(); //もともとある要素を空にする

        console.log('ストック検索作動！');

        var searchStock = $('#search_stock').val();

        console.log(searchStock);

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: 'GET',
            url: searchStock, //後述するweb.phpのURLと同じ形にする
            data: {
                'search_stock': searchStock //ここはサーバーに贈りたい情報。今回はバリューを送りたい。
            },
            dataType: 'json', //json形式で受け取る

        })

        .done(function(data) { //ajaxが成功したときの処理
            console.log('ajax成功！');
            $.each(data, function(index, value) { //dataの中身からvalueを取り出す

                    // オブジェクトや値を JSON 文字列に変換
                    var data_stringify = JSON.stringify(data);
                    var data_json = JSON.parse(data_stringify);
                    console.log(value);
                    console.log(data_json);


                    var i = 0;
                    for (i = 0; i < value.length; i++) {　　　 // １ユーザー情報のビューテンプレートを作成

                        addhtml = `
            
            <tr>
                <th>id： ${value[i].id}</th>
                <th>商品画像：<img src="/storage/${value[i].img_path}" alt="商品画像"></th>
                <th>商品名：${value[i].product_name}</th>
                <th>価格：${value[i].price}</th>
                <th>在庫数：${value[i].stock}</th>
                <th>メーカー名：${value[i].company_name}</th>
                <th><a href="/product/${value[i].id}" class="btn btn-primary">詳細</a></th>

                <form class="form-inline btn" action="{{ route('productDelete', ${value[i].id}) }}"
                    method="POST">
                    @csrf

                <th><button value="{{ csrf_token() }}" id="deleteTarget" data-product-id="${value[i].id}" class="btn btn-danger">削除</button></th>

                </form>
                <br>
            </tr>
            `;
                        $('#product_table').append(addhtml); //できあがったテンプレートをビューに追加
                    }
                }) //できあがったテンプレートをビューに追加
                　　　 // 検索結果がなかったときの処理
            if (data.length === 0) {
                $('.products-index-wrapper').after('<p class="text-center mt-5 search-null">商品が見つかりません</p>');
            }

        }).fail(function() {　　　 //ajax通信がエラーのときの処理
            console.log('検索できませんでした！');
        })

    })
});