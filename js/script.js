/**
* @file
*/

(function ($, Drupal) {

    //Drupal.AjaxCommands.prototype.hello = function (ajax, response, status) {
    //  console.log(response.message);
    //}
    $("#acm").on("click", "td", function() {
        alert($( this ).text());
    });
    $('.up').on('click',function(){
        debugger;
        var this_table=$(this).closest('table');
        var rows = this_table.find('tbody').find('tr').get();
        var col = $(this).attr('alt');
        if(col.split(' ')[1] != undefined ) col = col.split(' ')[1];

        rows.sort(function(a, b) {

            var A = $(a).find('.data_sort_'+col).text().toUpperCase();
            var B = $(b).find('.data_sort_'+col).text().toUpperCase();

            //if(new Date(A.trim()) <= new Date(B.trim()))
            if(col=='id'){
                if(A-B<0) {
                    return -1;
                }

                if(A-B>0) {
                    return 1;
                }
            }
            else{
                if(A.trim()<B.trim()) {
                    return -1;
                }
                if(A.trim()>B.trim()) {
                    return 1;
                }

            }
            return 0;

        });

        $.each(rows, function(index, row) {
            this_table.children('tbody').append(row);
        });      
        //       alert('up');
        return false;
    });
    $('.down').on('click',function(){
        debugger;
        var this_table=$(this).closest('table');
        var rows = this_table.find('tbody').find('tr').get();

        var col = $(this).attr('alt');
        if(col.split(' ')[1] != undefined ) col = col.split(' ')[1];

        rows.sort(function(a, b) {

            var A = $(a).find('.data_sort_'+col).text().toUpperCase();
            var B = $(b).find('.data_sort_'+col).text().toUpperCase();

            if(col=='id'){          
                if(A-B>0) {
                    return -1;
                }

                if(A-B<0) {
                    return 1;
                }
            }
            else{
                if(A.trim()>B.trim()) {
                    return -1;
                }

                if(A.trim()<B.trim()) {
                    return 1;
                }
            }
            return 0;

        });

        $.each(rows, function(index, row) {
            this_table.children('tbody').append(row);
        });      
        //       alert('up');
        return false;
    });   
})(jQuery, Drupal);
