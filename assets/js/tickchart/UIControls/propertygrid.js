(function ($) {

    //var plgoption;
    var plugindictionary = {};
    //var containerdictionary = {};
    var containerid = [];
    var int_counter = 0;
    var spinnerarray = [];
    var _id = "";

    $.widget("ptwebpg.PropertyGrid", {

        options: {
            KeyObject: "",
            SetObject: {},
            MetaObject: {},
            Default: null,
            ObjectChanged: function () { }
        }

        , _create: function () {

            plugindictionary[this._getpluginkey()] = {};

        }

       , _init: function () {

           _id = this._getpluginkey();

       }

        //Add new object on the property grid then plot it.
       , AddProperty: function (objprop) {
           if (objprop === undefined) return;

           if (!objprop.hasOwnProperty("SetObject") || !objprop.hasOwnProperty("MetaObject") || !objprop.hasOwnProperty("KeyObject")) return;

           if ($.isEmptyObject(objprop.SetObject) || $.isEmptyObject(objprop.MetaObject) || $.isEmptyObject(objprop.KeyObject)) return;

           if ($.inArray(_id + "-" + objprop.KeyObject, containerid) > -1) return;


           this._build(objprop);

       }

        //build the property grid:
       , _build: function (objopt) {


           var objkey = objopt.KeyObject,
            getcotainer, scrollcontainer;

           //if (plugindictionary[pkey].hasOwnProperty(okey).hasOwnProperty("isdisplayed")) return;


           plugindictionary[_id][objkey] = {};
           plugindictionary[_id][objkey]["Options"] = objopt;
           plugindictionary[_id][objkey]["Grouped"] = this._groupedoption(objopt);
           plugindictionary[_id][objkey]["Default"] = this._setDefaultObject(objopt.SetObject);


           getcotainer = this._plotitems(objkey);
           this.cid = this._maincontainerid(objkey);
           containerid.push(this.cid);
           scrollcontainer = $('<div id="' + this.cid + '"/>').append(getcotainer).addClass("wt-container wt-shadow");
           this.element.append(scrollcontainer);
           //this._displaycontainer(containerid);




           for (var i = 0; i < spinnerarray.length; i++) {
               $(spinnerarray[i].Spinner).WCSpinner({
                   DefaultValue: spinnerarray[i].DefaultValue,
                   MaxValue: spinnerarray[i].MaxValue,
                   MinValue: spinnerarray[i].MinValue,
                   Stop: spinnerarray[i].Callback,
                   IsShowSpinButtons: false,
                   IsAlignLeft: true,
                   BorderColor: "#C8C8C8",
                   IsValidateOnEnter: true
               });
           }
           this._scrollcontainer(this.cid);


           return this;
       }

        //This classify the options to determined the group for each property on object
       , _groupedoption: function (options) {

           var groupings = {};
           var opts = options;
           for (var propname in opts.SetObject) {

               var groupname = ((opts.SetObject[propname] != null && opts.MetaObject[propname].group) || "Other").replace(/\s+/g, '');

               if (!groupings[groupname]) {
                   groupings[groupname] = {};
                   groupings[groupname][propname] = opts.MetaObject[propname];

               }
               else {
                   groupings[groupname][propname] = opts.MetaObject[propname];
               }
               groupings[groupname][propname]["setvalue"] = opts.SetObject[propname];
           }

           //plugindictionary[this._getpluginkey()][opts.KeyObject] = groupings;

           return groupings;
       }

        //Plotting the item based on object
        , _plotitems: function (objkey) {

            var groupitems = plugindictionary[_id][objkey]["Grouped"];
            var options = plugindictionary[_id][objkey]["Options"];

            var container = $('<div/>');// this._getmaincontainer();

            for (var groupname in groupitems) {
                container = this._addgroupcontainer(groupitems[groupname], container, options);
            }

            return container;
        }

        //return the container of the plugin.
        //, _getmaincontainer: function () {

        //    var container = $( '<div/>' );
        //    //.addClass("wt-container wt-shadow").css({
        //    //    "height": this.element.height() - 4,
        //    //    "width": this.element.width() - 4,
        //    //    "padding": "1px",
        //    //    "border": "1.5px solid #C2C4CB",
        //    //});
        //    return container;
        //}

        //get and set container id
        , _maincontainerid: function (objkey) {
            return this._getpluginkey() + "-" + objkey;
        }

        //get and return the plugin string key based on id selector
       , _getpluginkey: function () {
           var str = this.element.attr('id').replace(/[^a-zA-Z]+/g, '') + this.uuid;
           return str;
       }

        //check if object key is exist in plugin dictionary
        , _objectkeychecker: function () {
            if (plugindictionary[this._getpluginkey()][plgoption.KeyObject]) return true;
            return false;
        }

         , _addgroupcontainer: function (groupitem, container, plgoption) {//Adding new group

             var self = this;
             var rowgroup = $('<div/>').addClass("wt-pg-group-div");
             var grouptext = $('<span/>').appendTo(rowgroup).addClass("wt-pg-group-div-span textTrimmable");


             for (var pname in groupitem) {
                 var name = groupitem[pname].group || "Other";
                 var transname = self._textvalidation(name);
                 grouptext.attr('title', transname).text(transname);
                 break;
             }

             var getitems = this._createrowitem(groupitem, plgoption);
             var grouparrow = $('<span/>');
             grouparrow.addClass("wt-pg-group-div-arrow-up control-clickable ui-icon  ui-icon-carat-1-s");
             grouparrow.appendTo(rowgroup); //ui-icon  ui-icon-carat-1-s

             grouparrow.on('click', function () {
                 getitems.toggle();
                 $(this).toggleClass("wt-pg-group-div-arrow-down wt-pg-group-div-arrow-up");
                 if ($("#" + self.cid).hasClass("wt-scrollableContainer-parent")) $("#" + self.cid).wcScrollBar("Refresh");
             });

             grouptext.dblclick(function (e) {
                 getitems.toggle();
                 grouparrow.toggleClass("wt-pg-group-div-arrow-down wt-pg-group-div-arrow-up");
                 if ($("#" + self.cid).hasClass("wt-scrollableContainer-parent")) $("#" + self.cid).wcScrollBar("Refresh");
             });

             rowgroup.append(getitems);

             return container.append(rowgroup);
         }

        , _rowid: function (keyobject, propertyname) {
            return keyobject + "-" + propertyname + "-" + this.uuid;
        }

       , _createrowitem: function (items, plgoption) {

           var _table = $('<table/>').addClass("wt-pg-table");


           for (var pname in items) {

               var _row = $('<tr id=' + this._rowid(plgoption.KeyObject, pname) + '/>').appendTo(_table);

               var itemname = $('<td/>').addClass("wt-pg-table-tr-td");
               itemname.css({ "padding-left": "20px", "width": "40%" });

               var transname = this._textvalidation(items[pname].name);
               var itemnamediv = $('<div/>');
               itemnamediv.text(transname);
               itemnamediv.addClass("wt-pg-table-tr-td-div");
               itemname.attr('title', transname);
               itemname.tooltip({
                   position: {
                       my: "center bottom",
                       at: "center top-2",
                       collision: "fit"
                   }, tooltipClass: "wt-dd-tooltip",
                   open: function (event, ui) {
                       ui.tooltip.css("max-width", "100% !important");
                   }
               });

               itemnamediv.appendTo(itemname);
               itemname.appendTo(_row);

               var columnitem = this._createitemcolumn(items[pname], pname, plgoption.KeyObject);

               columnitem.appendTo(_row);

               if (items[pname].hasOwnProperty("visible") && items[pname]["visible"] == false) {
                   _row.hide();
               }
           }

           return _table;
       }

       , _createitemcolumn: function (itemsettings, propername, objkey) {
           var plgoption = plugindictionary[_id][objkey]["Options"];
           var plgdefault = plugindictionary[_id][objkey]["Default"];
           var objis = itemsettings;

           var td = $('<td/>').addClass("wt-pg-table-tr-td");
           switch (objis.type) {// this will return column for item type. 

               //Color
               case "color":
                   var colorcontainer = $('<div class="wt-pg-table-tr-td-colorcontainer control-clickable"/>').appendTo(td);
                   var spancolor = $('<div class="wt-pg-table-tr-td-color"/>').appendTo(colorcontainer).css("background-color", objis.setvalue);
                   var arrow = $('<span class="wt-dd-grid-arrow"/>').appendTo(colorcontainer);
                   int_counter++;
                   var cpid = "col-pick-" + int_counter;

                   var colorinput = colorcontainer.wcColorPicker({
                       change: function (color) {
                           spancolor.css("background-color", color);
                           plgoption.SetObject[propername] = color;
                           return plgoption.ObjectChanged(plgoption.SetObject, propername);
                       }

                   });
                   plgdefault[propername].InstanceElement = colorinput;

                   $(td.contents()[2]).css({
                       "position": "absolute",
                       "margin-top": "-22px",
                       "z-index": "-1"
                   });

                   break;

                   //number
               case "number":
                   //var colorcontainer = $('<div class="wt-pg-table-tr-td-colorcontainer"/>').appendTo(td);
                   int_counter++;
                   var cpid = "num-" + int_counter;
                   var input = $('<input/>').appendTo(td);
                   var id = "#" + cpid;


                   spinnerarray.push({
                       Spinner: input,
                       Callback: function (val) {
                           if ($.isFunction(plgoption.ObjectChanged)) {
                               plgoption.SetObject[propername] = val;
                               return plgoption.ObjectChanged(plgoption.SetObject, propername);
                           }
                       },
                       DefaultValue: objis.setvalue,
                       MaxValue: itemsettings.options.max,
                       MinValue: itemsettings.options.min
                   });
                   plgdefault[propername].InstanceElement = input;
                   break;

                   //option
               case "option":

                   var dropdown = $('<div/>').css({ "width": "100%", "height": "19px" }).DropDown({
                       controltype: "on-grid",
                       items: objis.options,
                       setvalue: this._textvalidation(objis.setvalue),
                       selecteditem: function (value) {
                           if ($.isFunction(plgoption.ObjectChanged)) {
                               plgoption.SetObject[propername] = value;
                               return plgoption.ObjectChanged(plgoption.SetObject, propername);
                           }
                       }
                   }).appendTo(td);

                   plgdefault[propername].InstanceElement = dropdown;
                   break;

               case "text":
                   var input = $('<input type="text" class="wt-pg-table-tr-td-input textTrimmable" >');
                   var setval = objis.setvalue;
                   var isEnable;
                   var maxlength = itemsettings.options["maxlength"] ? itemsettings.options["maxlength"] : 225;
                   input.val(setval).appendTo(td).on({
                       keyup: function () {
                           if (setval == input.val()) return;
                           setval = input.val();
                           isEnable = input[0].scrollWidth > input[0].offsetWidth ? true : false;
                           input.tooltip({ disabled: !isEnable, content: setval });
                           if ($.isFunction(plgoption.ObjectChanged)) {
                               plgoption.SetObject[propername] = setval;
                               return plgoption.ObjectChanged(plgoption.SetObject, propername);
                           }
                       }
                   }).attr({ "title": setval, "maxlength": maxlength }).tooltip({
                       position: {
                           my: "center bottom",
                           at: "center top-2",
                           collision: "fit"
                       }, tooltipClass: "wt-dd-tooltip",
                       open: function (event, ui) {
                           ui.tooltip.css("max-width", "100% !important");
                       },
                       content: setval
                   });
                   plgdefault[propername].InstanceElement = input;
                   break;
               case "collection":
                   var parent = $('<div class="wt-pg-collection-container"><span>(Collection)</span><div/>').appendTo(td)
                   , label = $('<span class="wt-pg-collection-container-button">...</span>').appendTo(parent).on("click", function (e) {


                       //if ( $.isFunction( plgoption.ObjectChanged ) ) {
                       //    return plgoption.ObjectChanged( plgoption.SetObject[propername], propername );
                       //}
                       //WT.DoubleCollectionEditor.WTDCEditor("Show", {
                       //    collection: plgoption.SetObject[propername],
                       //    onOK: function (d) {
                       //        if ($.isFunction(plgoption.ObjectChanged)) {
                       //            return plgoption.ObjectChanged(plgoption.SetObject[propername], propername);
                       //        }
                       //    }
                       //});
                   });
                   break;

           }



           return td;
       }

        //Determine w/c container is displayed
        , _displaycontainer: function () {
            var mcid = this.cid;
            var that = this;
            $.each(containerid, function (index, value) {
                if (value == mcid) {
                    plugindictionary[that._getpluginkey()][plgoption.KeyObject]["isVisible"] = true;
                    $("#" + value).show();
                }
                else {
                    $("#" + value).hide();
                    //plugindictionary[that._getpluginkey()][plgoption.KeyObject]["isVisible"] = false;
                }
            });
        }

       , _setOption: function (key, value) {
           this._super(key, value);
       }

       , _scrollcontainer: function (cid) {
           var that = this;
           if ($("#" + cid).outerHeight() > this.element.height()) {
               $("#" + cid).wcScrollBar({
                   railAlwaysVisible: false
               });
               $("#" + cid).wcScrollBar("Refresh");
           }
       }

       , _setDefaultObject: function (setobj) {
           var obj = {};
           for (prop in setobj) {
               obj[prop] = setobj[prop];
           }
           return obj;
       }

        , SetProperty: function (object) {

            var getobject = plugindictionary[this._getpluginkey()][object.KeyObject];

            if (object === "undefined" || !getobject) return null;

            var that = this;
            $.each(getobject["Options"], function (key, value) {
                that._setOption(key, value)
            });

            plgoption = this.options;

            this._displaycontainer();
        }

        //Remove object depending on keyobject
        , RemoveProperty: function (object) {
            if (plugindictionary[this._getpluginkey()][object.KeyObject]) {
                var pluginid = this._getpluginkey() + "-" + object.KeyObject;

                $("#" + pluginid).remove();
                containerid.splice($.inArray(pluginid, containerid), 1);
                delete plugindictionary[this._getpluginkey()][object.KeyObject];
            }
            return;
        }

        //Hide property
        , HideProperty: function (object) {
            if (plugindictionary[this._getpluginkey()][object.KeyObject]) {
                var pluginid = this._getpluginkey() + "-" + object.KeyObject;

                if ($.inArray(pluginid, containerid) > -1)
                    $("#" + pluginid).hide();

            }
        }

        , SetVisibility: function (object) {
            if (object == "undefined") return null;
            if (object.hasOwnProperty("KeyObject") && object.hasOwnProperty("PropertyName") && object.hasOwnProperty("Visible")) {
                var rowid = this._rowid(object.KeyObject, object.PropertyName);
                if (object.Visible) { $("#" + rowid).show(); }
                else { $("#" + rowid).hide(); }
            }
        }

        , Refresh: function (options) {
            if (options == undefined) return;
            var containerid = this._maincontainerid(options.KeyObject);

            var container = $("#" + containerid);
            if (container.length) {
                container.css({ "max-height": "none" });
                container.outerHeight(this.element.height());
                container.css({ "max-height": $("#" + containerid).outerHeight() });
                if (container.hasClass("wt-scrollableContainer-parent")) {
                    container.wcScrollBar("Refresh");
                } else {
                    container.wcScrollBar({
                        railAlwaysVisible: false
                    });
                    container.wcScrollBar("Refresh");
                }
            }
        }

        , RestoreDefault: function (keyobject, DefaulTObject) {
            if (keyobject == undefined) return;
            var setobject = plugindictionary[this._getpluginkey()][keyobject];

            for (prop in DefaulTObject) {
                setobject.Options.SetObject[prop] = DefaulTObject[prop];
            }
            this.element.empty();

            this._build(plugindictionary[this._getpluginkey()][keyobject].Options);

            if ($.isFunction(setobject.Options.ObjectChanged)) {
                setobject.Options.ObjectChanged(setobject.Options.SetObject);
            }



        }

        , _textvalidation: function (strname) {
            var trim = strname.toString().replace(/[^a-zA-Z0-9]/g, '_');
            var getTrans = WC.ChartWords[trim];

            if (!getTrans) {
                console.log(trim);
                return strname;
            }
            else {
                return getTrans;
            }

        }
    });

}(jQuery));
