$(function() {

    $(document).on('click', '#deleteTarget', function() {

        var deleteConfirm = confirm('削除してよろしいでしょうか？');

        if (deleteConfirm == true) {
            var clickEle = $(this);
            // 削除ボタンにユーザーIDをカスタムデータとして埋め込んでます。
            var productID = clickEle.attr('data-product-id');
            console.log(productID);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                url: '/delete/' + productID,
                type: 'POST',
                data: {
                    'id': productID,
                    '_method': 'DELETE'
                } // DELETE リクエストだよ！と教えてあげる。
            })


            .done(function() {
                alert('成功！');
                // 通信が成功した場合、クリックした要素の親要素の <tr> を削除
                clickEle.parents('tr').remove();
            })

            .fail(function() {
                alert('エラー');
            });

        } else {
            (function(e) {
                e.preventDefault()
            });
        };
    });



});