$(function () {
    $('#selectType').on('change', function () {
        var selection = $(this).val();
        switch (selection) {
            case "T":
                $(".idUpload").show()
                break;
            default:
                $(".idUpload").hide()
        }
    });
});