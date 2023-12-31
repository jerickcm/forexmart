(function ($) {
    // custom css expression for a case-insensitive contains()
    jQuery.expr[':'].Contains = function(a,i,m){
        return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
    };


    function listFilter(header, list) { // header is any element, list is an unordered list
        var form = $("<form>").attr({"class":"filterform","action":"#"}),
            input = $("<input>").attr({"id":"searchfield","class":"form-control round-0 filterinput","type":"text", "placeholder":"Search..."});
        $(form).append(input).appendTo(header);
        $(input)
            .change( function () {
                var filter = $(this).val();
                if(filter) {
                    $(list).find("a:not(:Contains(" + filter + "))").parent().slideUp();
                    $(list).find("a:Contains(" + filter + ")").parent().slideDown();
                } else {
                    $(list).find("li").slideDown();
                }
                return false;
            })
            .keyup( function () {
                // fire the above change event after every letter
                $(this).change();
            })
            .focus( function () {
                $(this).change();
            });
    }


    //ondomready
    $(function () {
        listFilter($("#header"), $(".list"));
    });
}(jQuery));