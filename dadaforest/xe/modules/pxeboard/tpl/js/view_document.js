(function($) {
    function submit_rating() {
        document_srl = $('input[name=document_srl]').val();
        rating = $('.readerRating :radio.star:checked').val();

        $.ajax({
            type : "POST"
            , contentType: "application/json; charset=utf-8"
            , url : "./"
            , data : { 
                        module : "pxeboard"
                        , act : "dispPxeboardReaderRating"
                        , document_srl : document_srl
                        , rating : rating
                     }
            , dataType : "json"
            , success : function (data) {
                if (data.error) {
                    alert(data.message);
                    return;
                }
                $('#readerRatingAverage input').rating('readOnly', false);
                $('#readerRatingAverage input').rating('select', data.reader_rating_average-1);
                $('#readerRatingAverage input').rating('readOnly', true);
                $('#readerRatingCount').text(data.reader_rating_count);
            }
            , error : function (xhttp, textStatus, errorThrown) { 
                alert(errorThrown + " " + textStatus); 
            }
        });
    }

    jQuery(function($) {
        $('.registrantRating :radio.star').rating({split:2, required:true, readOnly:true});
        $('#readerRatingAverage :radio.star').rating({split:2, required:true, readOnly:true});
        $('.readerRating :radio.star').rating({
            split:2
            , required:true
            , callback:submit_rating
        });

        $('#btnDoRating').toggle(
            function() {
                $('.readerRating').css('display', 'block');
            }
            , function() {
                $('.readerRating').css('display', 'none');
            }
        );
    });
}) (jQuery);
