( function ( $ ) {
    var symboldata = [],
         symbollength = null,
         isconnected = null;

    $.widget( "wcssp.SymbolSelector", {

        options: {
            show: false
                , selecteditem: null
                , positionOn: null
                , positionAt: "left bottom" // For custom positioning
                , positionMy: "left top" //
                , width: 0
                , activation: "click"
                , afterclose: null
                , specifiedarray: []
                , quotes:ko.observableArray([])


        }

        , _create: function () {
            this._buildlayout();
        }

        , _subscribe: function () {
            var self = this;
            if (!self.options.quotes().length) {
                var subs = self.options.quotes.subscribe(function (value) { 
                    symboldata = value;
                    symbollength = value.length;
                    self._updateitems();
                });
            } else {
                symboldata = self.options.quotes();
                symbollength = self.options.quotes().length;
                self._updateitems();
            }
        }
        , _buildlist: function () {
            var symbols = "";
            for ( var i = 0; i < symbollength; i++ ) {
                symbols += '<div class="wc-ssp-content-dropdown-item control-clickable">  <span class="wc-ssp-content-dropdown-item-span">' + symboldata[i].LongName() + '</span>  </div>';
            }
            return symbols;
        }
        , _buildspecifiedlist: function () {
            var length = this.options.specifiedarray.length
              , symbols = ""
            ;
            for ( var i = 0; i < length; i++ ) {
                symbols += '<div class="wc-ssp-content-dropdown-item control-clickable">  <span class="wc-ssp-content-dropdown-item-span">' + this.options.specifiedarray[i].LongName + '</span>  </div>';
            }
            return symbols;
        }
        , _updateitems: function () {
            var self = this,
                items = "";
            self.count = 1;
            for ( var i = 0; i < symbollength; i++ ) {
                items += '<div class="wc-ssp-content-dropdown-item control-clickable">  <span class="wc-ssp-content-dropdown-item-span">' + symboldata[i].LongName() + '</span>  </div>';
            }
            self.quotescontainer.empty();
            self.quotescontainer.html( items );
            if ( self.container$[0].style.display == "none" ) {
                self.container$[0].style.display = "";
                self.quotescontainer.wcScrollBar( {
                    Orientation: 'y',
                    RailSteps: 15
                } );
                self.container$[0].style.display = "none";
            } else {
                self.quotescontainer.wcScrollBar( {
                    Orientation: 'y',
                    RailSteps: 15
                } );
            }
            self.quotescontainer.wcScrollBar("Refresh");

        }
        , _buildlayout: function () {
            var self = this,
                _docs = WC.Document,
                _width = self.options.width > 279 ? self.options.width : 280,
                container_id = "ptweb-ssp" + this.uuid,
                textbox_id = "ssp-textbox" + this.uuid,
                quotescontainer_id = "ssp-content" + this.uuid,
                quotescontainer = "",
                container = "",
                specifiedarraylength = self.options.specifiedarray.length
            ;

            //Elements
            self.container$ = $( '<div class="wt-ssp-container" id="' + container_id + '"/>' );
            self.textbox$ = $( '<input type="text" class="wt-ssp-header-textbox" autofocus="autofocus" id="' + textbox_id + '" /> ' );
            self.quotescontainer = $( '<div class="wt-ssp-content" id="' + quotescontainer_id + '"/>' );

            //Setup
            self.container$.append( self.textbox$ ).append( $( ' <hr class="ssp-hr" />' ) ).append( self.quotescontainer ).width( _width ).appendTo( 'body' );
            if ( specifiedarraylength ) {
                self.quotescontainer.html( self._buildspecifiedlist() );
                self.quotescontainer.wcScrollBar( {
                    Orientation: 'y',
                    RailSteps: 15
                } );
            }
            else {
                if ( symbollength ) {
                    self.quotescontainer.html( self._buildlist() );
                    self.quotescontainer.wcScrollBar( {
                        Orientation: 'y',
                        RailSteps: 15
                    } );
                }
                else {
                    self.quotescontainer.append( $( '<div class="wt-ssp-loading"> Please Wait <br/> Loading...</div>' ) );
                    self._subscribe();
                }
            }


            self.container$.position();
            self.container$.position( {
                at: self.options.positionAt //"right bottom"
                , my: self.options.positionMy //"right top"
                , of: self.options.positionOn != null ? self.options.positionOn : self.element
            } );

            if ( self.options.activation == "rightclick" ) {
                self.element.on( {
                    contextmenu: function ( e ) {

                        var iscallback;
                        if ( self.options.callback ) {
                            iscallback = self.options.callback();
                        };

                        if ( iscallback === false ) return;
                        if ( self.container$[0].style.display == "none" ) {
                            var _item = self.textbox$[0].nextElementSibling.nextElementSibling.firstElementChild.children
                            , lenght = specifiedarraylength ? specifiedarraylength : symbollength
                            ;
                            for ( var i = 0; i < lenght; i++ ) {
                                _item[i].style.display = "";
                            }
                            var _item = null;
                        }
                        if ( symbollength || specifiedarraylength ) { self.quotescontainer.wcScrollBar( "Refresh" ); }
                        self.container$.show();
                        self.textbox$.val( "" );
                        self.textbox$.focus();
                        self.container$.position( {
                            my: "left+3 top+3",
                            of: e,
                            collision: "fit"
                        } )
                    }
                } );
                _docs.on( {
                    mousedown: function ( e ) {
                        if ( self.container$.is( e.target ) || self.container$.has( e.target ).length ) {       //click on the plugin container
                            if ( e.target.className == "wc-ssp-content-dropdown-item" || e.target.className == "wc-ssp-content-dropdown-item-span" || e.target.className == "wc-ssp-content-dropdown-item control-clickable" ) {
                                if ( $.isFunction( self.options.selecteditem ) ) {
                                    var elemText = e.target.innerText,
                                        getsymbol = elemText.substr( 0, elemText.indexOf( ' ' ) ),
                                        symbol = getsymbol ? getsymbol : elemText;
                                    self.options.selecteditem( { item: elemText, symbol: symbol } );
                                    self.container$.hide();
                                    elemText = null;

                                    if ( $.isFunction( self.options.afterclose ) ) self.options.afterclose();
                                }
                            }
                        } else {
                            if ( self.container$[0].style.display == "block" || self.container$[0].style.display == "" ) {
                                self.container$.hide();
                                if ( $.isFunction( self.options.afterclose ) ) self.options.afterclose();
                            }
                        }
                    }
                } );
            }
            else {                     //click activation
                _docs.on( {
                    mousedown: function ( e ) {
                        if ( self.element.is( e.target ) || self.element.has( e.target ).length ) {   //click on the element plugin user
                            e.preventDefault();
                            self.container$.toggle();
                            if ( self.container$[0].style.display == "block" || self.container$[0].style.display == "" ) {

                                self.textbox$.val( "" );
                                self.textbox$.focus();
                                var _item = self.container$.find(".wc-ssp-content-dropdown-item-span") 
                                , lenght = specifiedarraylength ? specifiedarraylength : symbollength
                                ;
                                for ( var i = 0; i < lenght; i++ ) {
                                    _item[i].style.display = "";
                                }

                                self.container$.position( {
                                    at: self.options.positionAt //"right bottom"
                                    , my: self.options.positionMy //"right top"
                                    , of: self.options.positionOn != null ? self.options.positionOn : self.element
                                } );
                                var _item = null;
                                self.container$[0].style.display = "block"
                                if ( symbollength || specifiedarraylength ) { self.quotescontainer.wcScrollBar( "Refresh" ); }

                            }
                        }
                        else {
                            if ( self.container$.is( e.target ) || self.container$.has( e.target ).length ) {       //click on the plugin container
                                if ( e.target.className == "wc-ssp-content-dropdown-item" || e.target.className == "wc-ssp-content-dropdown-item-span" || e.target.className == "wc-ssp-content-dropdown-item control-clickable" ) {
                                    if ( $.isFunction( self.options.selecteditem ) ) {
                                        var elemText = e.target.innerText,
                                       getsymbol = elemText.substr( 0, elemText.indexOf( ' ' ) ),
                                       symbol = getsymbol ? getsymbol : elemText;
                                        self.options.selecteditem( { item: elemText, symbol: symbol } );
                                        self.container$.hide();
                                        if ( $.isFunction( self.options.afterclose ) ) self.options.afterclose();
                                    }
                                }
                            } else {
                                if ( self.container$[0].style.display == "block" || self.container$[0].style.display == "" ) {
                                    self.container$.hide();
                                    if ( $.isFunction( self.options.afterclose ) ) self.options.afterclose();
                                }
                            }
                        }
                    },
                } );

            }

            self.show( self.options.show );


            function txtKeyUp() {
                if ( !symbollength ) return;
                
                var _item = self.container$.find(".wc-ssp-content-dropdown-item");
                var childlength = _item.length;
                for ( var i = 0; i < childlength; i++ ) {

                    if ( symboldata[i].LongName().toLocaleLowerCase().indexOf( this.value.toLocaleLowerCase() ) > -1 ) {
                        _item[i].style.display = "";
                    }
                    else {
                        _item[i].style.display = "none";
                    }
                }
                self.quotescontainer.wcScrollBar( "Refresh" );

            }

            function txtKeyUpspicified() {
                var childlength = self.textbox$[0].nextElementSibling.nextElementSibling.firstElementChild.childElementCount;
                var _item = self.textbox$[0].nextElementSibling.nextElementSibling.firstElementChild.children;
                for ( var i = 0; i < childlength; i++ ) {

                    if ( self.options.specifiedarray[i].LongName.toLocaleLowerCase().indexOf( this.value.toLocaleLowerCase() ) > -1 ) {
                        _item[i].style.display = "";
                    }
                    else {
                        _item[i].style.display = "none";
                    }
                }
                self.quotescontainer.wcScrollBar( "Refresh" );
            }

            self.textbox$.on( {
                keyup: self.options.specifiedarray.length ? txtKeyUpspicified : txtKeyUp
            } );

            self.show( self.options.show );

            WC.OnLayout.push( sspResize );
            function sspResize() {
                self.container$.position( {
                    at: self.options.positionAt 
            , my: self.options.positionMy 
            , of: self.options.positionOn != null ? self.options.positionOn : self.element
                } );
            }

            _docs = null;
            _width = null;
            textbox_id = null;
            quotescontainer = null;
            container = null;
            _content = null;

        }
        , show: function ( isShow ) {
            var self = this;
            if ( isShow || isShow == undefined ) {

                self.container$[0].style.display = "";
                self.textbox$.focus();
                self.container$.position( {
                    at: self.options.positionAt//"right bottom"
                    , my: self.options.positionMy//"right top"
                    , of: self.options.positionOn != null ? self.options.positionOn : self.element
                } );
            }
            else {
                self.container$[0].style.display = "none";
            }

            isShow = null;
            self = null;

        }

    } );
} )( jQuery )













