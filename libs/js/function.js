var libsApiLink = "http://devwherear.com/arms/v2/ARMS/libs/api/";
var rootLink = "http://devwherear.com/arms/v2/ARMS/";



function submitARMarker(imageList)
{
    var imageList = JSON.stringify(imageList)
    console.log(imageList);

    var formRequestData = $("#ARMarkerCreateForm").serializeArray();
    var images = {
        name: "images",
        value: JSON.stringify(imageList)
    };

    var artyoeValue = $("#artype").val();
    var artype = {
        name:"artype",
        value:artyoeValue
    };

    var phoneCountryValueEN = $("#phone_country_code_en").val();
    var phoneCountryCodeEN = {
        name:"phone_country_code_en",
        value:phoneCountryValueEN
    };

    var phoneCountryValueTC = $("#phone_country_code_tc").val();
    var phoneCountryCodeTC = {
        name:"phone_country_code_tc",
        value:phoneCountryValueTC
    };


    var phoneCountryValueSC = $("#phone_country_code_sc").val();
    var phoneCountryCodeSC = {
        name:"phone_country_code_sc",
        value:phoneCountryValueSC
    };

    var whatapssCountryValueEN = $("#whatapps_country_code_en").val();
    var whatappsCountryCodeEN = {
        name:"whatapps_country_code_en",
        value:whatapssCountryValueEN
    };
    var whatapssCountryValueTC = $("#whatapps_country_code_tc").val();
    var whatappsCountryCodeTC = {
        name:"whatapps_country_code_tc",
        value:whatapssCountryValueTC
    };
    var whatapssCountryValueSC = $("#whatapps_country_code_sc").val();
    var whatappsCountryCodeSC = {
        name:"whatapps_country_code_sc",
        value:whatappsCountryCodeSC
    };

    formRequestData.push(images);
    formRequestData.push(artype);
    formRequestData.push(phoneCountryCodeEN);
    formRequestData.push(phoneCountryCodeTC);
    formRequestData.push(phoneCountryCodeSC);
    formRequestData.push(whatappsCountryCodeEN);
    formRequestData.push(whatappsCountryCodeTC);
    formRequestData.push(whatappsCountryCodeSC);

    console.log(formRequestData);

    $.ajax(
        {
            method: "POST",
            url: libsApiLink + "artarget/save/",
            data: formRequestData,
            success: function(data)
            {

                var _data = $.parseJSON(data);
                if(_data["status"] == 1)
                {
                    $.ajax(
                        {
                            method: "POST",
                            url: libsApiLink + "vuforia_api/create/",
                            data:
                                {
                                    image: _data["image_path"],
                                    name: _data["create_name"],
                                    aritemid: _data["aritemid"],
                                },
                            success: function(data)
                            {
                                if(data["result_code"] == "Success")
                                {
                                    $.ajax(
                                        {
                                            method: "POST",
                                            url: libsApiLink + "artarget/update_vuforiaid/",
                                            data:
                                                {
                                                    aritemid: _data["aritemid"],
                                                    vuforiaid: data["target_record"]["target_id"]
                                                },
                                            success: function(data)
                                            {
                                                console.log(data);
                                                window.location = rootLink + "artarget/";
                                            },
                                            error: function(data)
                                            {
                                            },
                                            failure: function(data)
                                            {
                                            }
                                        }
                                    );

                                }
                            },
                            error: function(data)
                            {
                            },
                            failure: function(data)
                            {
                            }
                        }
                    );
                }
            },
            error: function(data)
            {

            },
            failure: function(data)
            {
            }
        }
    );

}

function saveARMarker(imageList)
{
    var imageList = JSON.stringify(imageList)

    var formRequestData = $("#ARMarkerCreateForm").serializeArray();
    var images = {
        name: "images",
        value: JSON.stringify(imageList)
    };

    var artyoeValue = $("#artype").val();
    var artype = {
        name:"artype",
        value:artyoeValue
    };

    var phoneCountryValueEN = $("#phone_country_code_en").val();
    var phoneCountryCodeEN = {
        name:"phone_country_code_en",
        value:phoneCountryValueEN
    };

    var phoneCountryValueTC = $("#phone_country_code_tc").val();
    var phoneCountryCodeTC = {
        name:"phone_country_code_tc",
        value:phoneCountryValueTC
    };


    var phoneCountryValueSC = $("#phone_country_code_sc").val();
    var phoneCountryCodeSC = {
        name:"phone_country_code_sc",
        value:phoneCountryValueSC
    };

    var whatapssCountryValueEN = $("#whatapps_country_code_en").val();
    var whatappsCountryCodeEN = {
        name:"whatapps_country_code_en",
        value:whatapssCountryValueEN
    };
    var whatapssCountryValueTC = $("#whatapps_country_code_tc").val();
    var whatappsCountryCodeTC = {
        name:"whatapps_country_code_tc",
        value:whatapssCountryValueTC
    };
    var whatapssCountryValueSC = $("#whatapps_country_code_sc").val();
    var whatappsCountryCodeSC = {
        name:"whatapps_country_code_sc",
        value:whatappsCountryCodeSC
    };

    formRequestData.push(images);
    formRequestData.push(artype);
    formRequestData.push(phoneCountryCodeEN);
    formRequestData.push(phoneCountryCodeTC);
    formRequestData.push(phoneCountryCodeSC);
    formRequestData.push(whatappsCountryCodeEN);
    formRequestData.push(whatappsCountryCodeTC);
    formRequestData.push(whatappsCountryCodeSC);

    console.log(formRequestData);

    $.ajax(
        {
            method: "POST",
            url: libsApiLink + "artarget/save/",
            data: formRequestData,
            success: function(data)
            {
                var _data = $.parseJSON(data);
                if(_data["status"] == 1)
                {
                    console.log(_data);
                    if(_data["vuforia"] != "")
                    {
                        console.log("Updating Vuforia");
                        $.ajax(
                            {
                                method: "POST",
                                url: libsApiLink + "vuforia_api/update/",
                                data:
                                    {
                                        "vuforiaid": _data["vuforia"],
                                        "aritemid": _data["aritemid"]
                                    },
                                success: function(data)
                                {
                                    console.log("Update vuforia");
                                    console.log(data);
                                }

                            }
                        );
                    }
                    window.location = rootLink + "artarget/";
                }
            },
            error: function(data)
            {

            },
            failure: function(data)
            {
            }
        }
    );
}

function uuidv4() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
        return v.toString(16);
    });
}
function cancelARMarker()
{
    window.location = rootLink + "artarget/";
}

function SaveARInfo()
{
    var arname = $("input[name=ar_name]").val();
    var projectname = $("input[name=project_name]").val();
    var artype = $("#artype").val();
    var arid = $("input[name=uid]").val();

    var ARItems = $(".ARButtonItem");
    var SaveItems =
        {
            "en": new Array(),
            "tc": new Array(),
            "sc": new Array()
        };

    $.each(ARItems, function(k, v){
        var ARItemInfo = GetARInfoInARItem(v, $(v).data("lang"));
        switch ($(v).data("lang"))
        {
            case "en":
            {
                SaveItems["en"].push(ARItemInfo);
            }
            break;
            case "tc":
            {
                SaveItems["tc"].push(ARItemInfo);
            }
            break;
            case "sc":
            {
                SaveItems["sc"].push(ARItemInfo);
            }
            break;
        }
    });

    $.ajax(
        {
            method: "POST",
            url: libsApiLink + "artarget/add/",
            data:
                {
                    uid: arid,
                    ARMarker: markerImage,
                    ARName: arname,
                    Project: projectname,
                    ARType: artype,
                    ARItems: SaveItems
                },
            success: function(data)
            {
                var _data = $.parseJSON(data);
                window.location = rootLink + "artarget/";

            },
            error: function(data)
            {

            },
            failure: function(data)
            {
            }
        }
    );
}

function GetARInfoInARItem(ARItem, lang)
{

    var ARItem =
        {
            "eleID": $(ARItem).attr("id"),
            "buttonType": $(ARItem).find("select").val(),
            "info": $(ARItem).find("#info input").val(),
            "video": $(ARItem).find("#video input").val(),
            "images": GetARItemImage($(ARItem).find("select").val(), $(ARItem).attr("id"), lang),
        };
    return ARItem;
}

function GetARItemImage(buttonType, arid, lang)
{
    var returnImages = new Array();
    $.each(imageList[lang], function(k, v)
    {
        if(v["aruuid"] == arid && v["artype"] == buttonType)
        {
            returnImages.push(v);
        }
    });
    return returnImages;
}