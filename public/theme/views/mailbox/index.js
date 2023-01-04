//Handle starring
$(".mailbox-star").click(function (e) {
    e.preventDefault();

    handleImportant([$(this).parents("tr").attr("data-mailbox-flag-id")]);
});

// handle starring for checked inputs
$(".mailbox-star-all").on("click", function (e) {
    if(!checkboxCheck()) {
        return;
    }

    var checked = new Array();

    $(".check-message:checked").each(function (val) {
        checked.push($(this).parents("tr").attr("data-mailbox-flag-id"));
    });


    handleImportant(checked);
});
// handle trash
$(".mailbox-trash-all").on("click", function (e) {
    if(!checkboxCheck()) {
        return;
    }
    var checked = new Array();
    $(".check-message:checked").each(function (val) {
        checked.push($(this).parents("tr").attr("data-user-folder-id"));
    });
    handleTrash(checked);
});
function handleImportant(data)
{
    Mailbox.toggleImportant(data, function (response) {

        if(response.state == 0) {
            alert(response.msg);
        } else {
            response.updated.map(function(value) {
                if(value.is_important == 1) {
                    //Switch states
                    $("tr[data-mailbox-flag-id='"+value.id+"'] td.mailbox-star").find("a > i").removeClass("fa-star-o").addClass("fa-star");
                } else {
                    //Switch states
                    $("tr[data-mailbox-flag-id='"+value.id+"'] td.mailbox-star").find("a > i").removeClass("fa-star").addClass("fa-star-o");
                }
            });

            alert(response.msg);
        }
    });

}
function handleTrash(data)
{
    Mailbox.trash(data, function (response) {

        if(response.state == 0) {
            alert(response.msg);
        } else {

            alert(response.msg);

            setInterval(function () {
                location.reload();
            }, 3000);
        }
    });
}
