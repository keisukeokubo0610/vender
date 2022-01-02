$('.user-search-form .search-icon').on('click', function() {
    $('.user-table tbody').empty(); //もともとある要素を空にする
    $('.search-null').remove(); //検索結果が0のときのテキストを消す

    let userName = $('#search_name').val(); //検索ワードを取得

    if (!userName) {
        return false;
    } //ガード節で検索ワードが空の時、ここで処理を止めて何もビューに出さない

    $.ajax({
        type: 'GET',
        url: '/user/index/' + userName, //後述するweb.phpのURLと同じ形にする
        data: {
            'search_name': userName, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
        },
        dataType: 'json', //json形式で受け取る

        beforeSend: function() {
                $('.loading').removeClass('display-none');
            } //通信中の処理をここで記載。今回はぐるぐるさせるためにcssでスタイルを消す。
    }).done(function(data) {}).done(function(data) { //ajaxが成功したときの処理
        $('.loading').addClass('display-none'); //通信中のぐるぐるを消す
        let html = '';
        $.each(data, function(index, value) { //dataの中身からvalueを取り出す
            　　　　 //ここの記述はリファクタ可能
            let id = value.id;
            let name = value.name;
            let avatar = value.avatar;
            let itemsCount = value.items_count;　　　　 // １ユーザー情報のビューテンプレートを作成
            html = `
                                    <tr class="user-list">
                                        <td class="col-xs-2"><img src="${avatar}" class="rounded-circle user-avatar"></td>
                                        <td class="col-xs-3">${name}</td>
                                        <td class="col-xs-2">${itemsCount}</td>
                                        <td class="col-xs-5"><a class="btn btn-info" href="/user/${id}">詳細</a></td>
                                    </tr>
                                        `
        })
        $('.user-table tbody').append(html); //できあがったテンプレートをビューに追加
        　　　 // 検索結果がなかったときの処理
        if (data.length === 0) {
            $('.user-index-wrapper').after('<p class="text-center mt-5 search-null">ユーザーが見つかりません</p>');
        }

    }).fail(function() {　　　 //ajax通信がエラーのときの処理
        console.log('どんまい！');
    })
});