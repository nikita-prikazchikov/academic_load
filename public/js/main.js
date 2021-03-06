var generic = {};
generic.getYearId = function () {
    return $("#yearId").val();
};
generic.getSemester = function () {
    return $("#semester").val();
};
generic.getContainer = function () {
    return $("#container");
};
generic.loadInContainer = function (url) {
    generic.getContainer().html("").load(url);
};

var header = {};
header.init = function () {
    $(".btn-show-dialog-period-change").click(period.dialog.show);
};

var utils = {};
utils.buildURL = function (controller, action, parameters) {
    var strEnd = '';
    if (parameters !== undefined) {
        var iteration = 0;
        for (var key in parameters) {
            if (iteration++) {
                strEnd += "&";
            }
            strEnd += key + "=" + parameters[key];
        }
    }
    var loc = document.location;
    var url = loc.protocol + '//' + loc.host + '/' + controller + ( action != undefined && action.length > 0 ? '/' + action : '');
    return url + "?" + strEnd;
};
utils.array2json = function (arr) {
    var parts = [];
    var is_list = (Object.prototype.toString.apply(arr) === '[object Array]');
    var is_obj = (Object.prototype.toString.apply(arr) === '[object Object]');

    for (var key in arr) {
        var value = arr[key];
        if (value !== null && typeof value == "object") { //Custom handling for arrays
            if (is_list) parts.push(array2json(value));
            /* :RECURSION: */
            if (is_obj) parts.push('"' + key + '"' + ":" + array2json(value));
            else parts[key] = array2json(value);
            /* :RECURSION: */
        } else {
            var str = "";
            if (!is_list) str = '"' + key + '":';

            //Custom handling for multiple data types
            if (typeof value == "number") str += value; //Numbers
            else if (value === false) str += 'false'; //The booleans
            else if (value === true) str += 'true';
            else if (value === null) str += "null";
            else str += '"' + encodeURIComponent(value) + '"'; //All other things

            parts.push(str);
        }
    }
    var json = parts.join(",");

    if (is_list) return '[' + json + ']';//Return numerical JSON
    return '{' + json + '}';//Return associative JSON
}
utils.trim = function (str) {
    return str.replace(/^\s+|\s+$/g, "");
}
utils.clone = function (obj) {
    // Handle the 3 simple types, and null or undefined
    if (null == obj || "object" != typeof obj) return obj;

    // Handle Date
    if (obj instanceof Date) {
        var copy = new Date();
        copy.setTime(obj.getTime());
        return copy;
    }

    // Handle Array
    if (obj instanceof Array) {
        var copy = [];
        for (var i = 0, len = obj.length; i < len; ++i) {
            copy[i] = clone(obj[i]);
        }
        return copy;
    }

    // Handle Object
    if (obj instanceof Object) {
        var copy = {};
        for (var attr in obj) {
            if (obj.hasOwnProperty(attr)) copy[attr] = clone(obj[attr]);
        }
        return copy;
    }

    throw new Error("Unable to copy obj! Its type isn't supported.");
}
utils.displayError = function (text, title) {
    title = title || "Error";
    $("#dialog-message")
        .html(text)
        .dialog({
            modal:true,
            title:title,
            height:"auto",
            width:400,
            buttons:{
                Ok:function () {
                    $(this).dialog("close");
                }
            }
        });
};
utils.displayConfirm = function (text, title, callback) {
    title = title || "Error";
    $("#dialog-message")
        .html(text)
        .dialog({
            modal:true,
            title:title,
            dialogClass:"alert",
            height:"auto",
            width:400,
            buttons:{
                Yes:function () {
                    if (callback) {
                        callback();
                    }
                    $(this).dialog("close");
                },
                No:function () {
                    $(this).dialog("close");
                }
            }
        });
}

var dialog = {};
dialog.display = function (loadUrl) {
    $("#modal").html('<div class="modal-body"><div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div></div>').load(loadUrl).modal();
};
dialog.disableSubmit = function () {
    $("#modal").find(".modal-footer .btn").attr("disabled", "disabled");
};
dialog.enableSubmit = function () {
    $("#modal").find(".modal-footer .btn").removeAttr("disabled");
};
dialog.close = function () {
    $("#modal").modal('hide');
};
{
}
dialog.get = function () {
    return $("#modal");
};

var period = {};
period.dialog = {};
period.dialog.init = function () {
    dialog.get().find(".btn-period-submit").click(period.dialog.submit);
};
period.dialog.show = function () {
    dialog.display(utils.buildURL("index", "perioddialog"));
};
period.dialog.submit = function () {
    var semester = period.dialog.getSemester();
    var parameters = {};
    parameters.id_year = period.dialog.getYearId();
    if (semester) {
        parameters.semester = semester;
    }
    location.href = utils.buildURL("index", "index", parameters);
};
period.dialog.getYearId = function () {
    return dialog.get().find("select[name='year']").val();
};
period.dialog.getSemester = function () {
    return dialog.get().find("select[name='semester']").val();
};

var pages = {
    discipline:{dialog:{}, list:{}, view:{}},
    group:{dialog:{}},
    rate:{list:{}, view:{}},
    speciality:{dialog:{}, list:{}, view:{}},
    user:{dialog:{}, list:{}, view:{}},
    year:{list:{}}
};

pages.discipline.dialog.init = function () {
    $(".btn-discipline-submit").click(pages.discipline.dialog.submit);
};
pages.discipline.dialog.show = function (disciplineId) {
    dialog.display(utils.buildURL("discipline", "dialog", {id_discipline:disciplineId}));
};
pages.discipline.dialog.submit = function () {
    $.post(utils.buildURL("discipline", "edit"),
        {
            id_discipline:$("#edit-discipline-id").val(),
            name:$("#edit-discipline-name").val()
        },
        function (data) {
            if (data.success) {
                dialog.close();
                pages.discipline.list.load();
            }
            else {
                $("#modal_alert").html(data.message).show();
            }
        },
        'json'
    );
};
pages.discipline.list.init = function () {
    $(".btn-discipline-add").click(function () {
        pages.discipline.dialog.show(0)
    });
    $(".btn-discipline-edit").click(function () {
        pages.discipline.dialog.show($(this).data("id"))
    });
};
pages.discipline.list.load = function () {
    $(".discipline-list-container").load(utils.buildURL("discipline", "list"));
};
pages.discipline.view.init = function () {};

pages.group.dialog.init = function () {
    $(".btn-group-submit").click(pages.group.dialog.submit);
};
pages.group.dialog.show = function (groupId, specialityId) {
    dialog.display(utils.buildURL("group", "dialog", {id_group:groupId, id_speciality:specialityId}));
};
pages.group.dialog.submit = function () {
    $.post(utils.buildURL("group", "edit"),
        {
            id_group:$("#edit-group-id").val(),
            id_speciality:$("#edit-speciality-id").val(),
            name:$("#edit-group-name").val()
        },
        function (data) {
            if (data.success) {
                dialog.close();
                pages.speciality.list.load();
            }
            else {
                $("#modal_alert").html(data.message).show();
            }
        },
        'json'
    );
};

pages.rate.submit = function (rateId, value) {
    $("#view_alert").hide();
    $.post(utils.buildURL("rate", "edit"),
        {
            id_rate:rateId,
            value:value
        },
        function (data) {
            if (!data.success) {
                $("#view_alert").html(data.message).show();
            }
        },
        'json'
    );
};
pages.rate.list.init = function () {
    $(".btn-user-rate-change").change(function () {
        pages.rate.submit( $(this).data("id"), $(this).val())
    });
};
pages.rate.list.load = function ( yearId ) {
    location.href = utils.buildURL("rate", "index", {id_year:yearId});
};
pages.rate.view.init = function () {
    $(".btn-user-rate-back").click( function(){
        pages.year.load( $(this).data("yearId"))
    } )
};

pages.speciality.dialog.init = function () {
    $(".btn-speciality-submit").click(pages.speciality.dialog.submit);
};
pages.speciality.dialog.show = function (specialityId) {
    dialog.display(utils.buildURL("speciality", "dialog", {id_speciality:specialityId}));
};
pages.speciality.dialog.submit = function () {
    $.post(utils.buildURL("speciality", "edit"),
        {
            id_speciality:$("#edit-speciality-id").val(),
            name:$("#edit-speciality-name").val(),
            type:$("#edit-speciality-type").val()
        },
        function (data) {
            if (data.success) {
                dialog.close();
                pages.speciality.list.load();
            }
            else {
                $("#modal_alert").html(data.message).show();
            }
        },
        'json'
    );
};
pages.speciality.list.init = function () {
    $(".btn-group-add").click(function () {
        pages.group.dialog.show(0, $(this).data("specialityId"))
    });
    $(".btn-group-edit").click(function () {
        pages.group.dialog.show($(this).data("id"), $(this).data("specialityId"))
    });
    $(".btn-speciality-add").click(function () {
        pages.speciality.dialog.show(0)
    });
    $(".btn-speciality-edit").click(function () {
        pages.speciality.dialog.show($(this).data("id"))
    });
};
pages.speciality.list.load = function () {
    $(".speciality-list-container").load(utils.buildURL("speciality", "list"));
};
pages.speciality.view.init = function () {};

pages.user.dialog.init = function () {
    $(".btn-user-submit").click(pages.user.dialog.submit);
};
pages.user.dialog.show = function (userId) {
    dialog.display(utils.buildURL("user", "dialog", {id_user:userId}));
};
pages.user.dialog.submit = function () {
    $.post(utils.buildURL("user", "edit"),
        {
            id_user:$("#edit-user-id").val(),
            name:$("#edit-user-name").val()
        },
        function (data) {
            if (data.success) {
                dialog.close();
                pages.user.list.load();
            }
            else {
                $("#modal_alert").html(data.message).show();
            }
        },
        'json'
    );
};
pages.user.list.init = function () {
    $(".btn-user-add").click(function () {
        pages.user.dialog.show(0)
    });
    $(".btn-user-edit").click(function () {
        pages.user.dialog.show($(this).data("id"))
    });
};
pages.user.list.load = function () {
    $(".user-list-container").load(utils.buildURL("user", "list"));
};
pages.user.view.init = function () {};

pages.year.init = function () {

};
pages.year.load = function (yearId) {
    location.href = utils.buildURL("year", "index", {id_year:yearId})
};
pages.year.list.init = function () {
    $(".btn-year-rate-edit").click(function(){
        pages.rate.list.load( $(this).data("id"))
    })
};