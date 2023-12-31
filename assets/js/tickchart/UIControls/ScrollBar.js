﻿$(function () {
    
    $.widget("webscroll.wcScrollBar", {
        options: {
            Orientation: 'y',
            Steps: 4,
            RailSteps: 10,
            TimeoutDelay: 50,
            disableScrollOnHover: ["input"],
            railAlwaysVisible: false,
            offsetRight: 0,
            offsetBottom: 1,
            _isScrollable: true,
        },

        _create: function () {
            var self = this;
            var parent;
            var child;
            var childWidthScrollVisible;
            var childHeightScrollVisible;
            var containerHeight;
            var currentHeight;
            var currentScrollableHeight;
            var containerWidth;
            var currentWidth;
            var currentScrollableWidth;
            var id;
            var handle;
            var up;
            var down;
            var rail
            var scrollCont;
            var xHandle;
            var xLeft;
            var xRight;
            var xRail
            var xScrollCont;
            var yRailHeight;
            var yHandleHeight;
            var xRailWidth;
            var xHandleWidth;
            var maxTop;
            var maxRight;
            var RailScrollDelta;
            var isScrollable = true;
            var isMouseDown = false;
            var delta = 0;
            var ph, pw, ch, cw;
            
            InitializeAndSubscribe();
            

            function InitializeAndSubscribe() {
                switch (self.options.Orientation) {
                    case 'x':
                        {
                            SetXVariables();
                            SetHorizontalScrollElements();

                            xHandle.draggable({
                                axis: self.options.Orientation,
                                containment: 'parent',
                                scroll: true,
                                drag: function () {
                                    var position = xHandle.position().left;
                                    child.css({ left: -(position * (child.width() / (xRail.width() - 24)) - 1) });
                                }
                            });

                            xLeft.on('mousedown', function (e) {
                                isMouseDown = true;
                                delta = -1;
                                setXPos();
                                e = null;
                                event = null;
                            });

                            xLeft.on('mouseup', function (e) {
                                isMouseDown = false;
                                delta = 0;
                                e = null;
                                event = null;
                            });

                            xLeft.on('mouseleave', function (e) {
                                isMouseDown = false;
                                delta = 0;
                                e = null;
                                event = null;
                            });

                            xRight.on('mousedown', function (e) {
                                isMouseDown = true;
                                delta = 1;
                                setXPos();
                                e = null;
                                event = null;
                            });

                            xRight.on('mouseup', function (e) {
                                isMouseDown = false;
                                delta = 0;
                                e = null;
                                event = null;
                            });

                            xRight.on('mouseleave', function (e) {
                                isMouseDown = false;
                                delta = 0;
                                e = null;
                                event = null;
                            });

                            xRail.on('mousedown', function (e) {
                                RailScrollDelta = ((xHandle.position().left + xHandle.width()) < e.offsetX) ? 1 : (xHandle.position().left > e.offsetX) ? -1 : 0;
                                if (RailScrollDelta !== 0) {
                                    xRailDragPos(RailScrollDelta);
                                }
                                e = null;
                                event = null;
                            });
                            break;
                        }
                    case 'y':
                        {
                            SetVariables();
                            SetElements();

                            parent.mouseState = 'up';
                            handle.mouseState = 'up';
                            handle.lastMousePosY = null;
                            handle.proposedNewPosY = 0;

                            $(document).on('mousemove', function (e) {
                                if ((parent.mouseState === 'down') && (handle.mouseState === 'down')) {
                                    handle.proposedNewPosY = handle.position().top + e.pageY - handle.lastMousePosY;
                                    
                                        

                                        if (handle.proposedNewPosY < 0) {
                                            handle[0].style.top = '0px';
                                        } else if (handle.proposedNewPosY > (rail.height() - handle.height() - 2)) {
                                            handle[0].style.top = ((rail.height() - handle.height()) - 2) + 'px';
                                        } else {
                                            handle[0].style.top = handle.proposedNewPosY + 'px';
                                        }

                                        handle.lastMousePosY = e.pageY;
                                            var position = handle.position().top;
                                            var computedChildPos = (position * (child.height() / (rail.height() - 2)) - 1);
                                            maxTop = (rail.height() - handle.height()) - 2;
                                            var childMaxTop = child.height() - parent.height();
                                            var childPos = (computedChildPos >= childMaxTop) ? childMaxTop : (position < maxTop) ? computedChildPos : childMaxTop;
                                            child.css({ top: -childPos });
                                            maxTop = null;
                                    
                                }
                                e = null;
                                event = null;
                            });

                            parent.on('mousedown', function () {
                                parent.mouseState = 'down';
                                event = null;
                            });

                            parent.on('mouseup', function () {
                                parent.mouseState = 'up';
                                handle.mouseState = 'up';
                                event = null;
                            });

                            handle.on('mousedown', function (e) {
                                handle.lastMousePosY = e.pageY;
                                handle.mouseState = 'down';
                                parent.mouseState = 'down';
                                e = null;
                                event = null;
                            });


                            $(document).on('mouseup', function () {
                                if (handle.mouseState === 'down') {
                                    handle.mouseState = 'up';
                                }
                                event = null;
                            });
                          
                            parent.mousewheel(function (event) {
                                if (_disableWheelOnElementHover(event)) { return; }
                                if (!self.options._isScrollable) { return; }
                                handleHeight = handle.height();
                                var scrollPosition = scrollPos(handle.position().top, self.options.Steps, event.deltaY);
                                var computedChildPos = (scrollPosition * (child.height() / (rail.height() - 2)) - 1);
                                maxTop = (rail.height() - handle.height()) - 2;
                                var childMaxTop = child.height() - parent.height();
                                var childPos = (computedChildPos > childMaxTop) ? childMaxTop : (scrollPosition < maxTop) ? computedChildPos : childMaxTop;
                                handle.css("top", scrollPosition + "px");
                                child.css({ top: -childPos });
                                scrollPosition = null;
                                handleHeight = null;
                                maxTop = null;
                                event = null;
                            });

                            up.on('mousedown', function (e) {
                                isMouseDown = true;
                                delta = 1;
                                setPos();
                                e = null;
                                event = null;
                            });

                            up.on('mouseup', function (e) {
                                isMouseDown = false;
                                delta = 0;
                                e = null;
                                event = null;
                            });

                            up.on('mouseleave', function (e) {
                                isMouseDown = false;
                                delta = 0;
                                e = null;
                                event = null;
                            });

                            up = null;

                            down.on('mousedown', function (e) {
                                isMouseDown = true;
                                delta = -1;
                                setPos();
                                e = null;
                                event = null;
                            });

                            down.on('mouseup', function (e) {
                                isMouseDown = false;
                                delta = 0;
                                e = null;
                                event = null;
                            });

                            down.on('mouseleave', function (e) {
                                isMouseDown = false;
                                delta = 0;
                                e = null;
                                event = null;
                            });

                            rail.on('mousedown', function (e) {
                                if (handle.mouseState === 'up') {
                                    RailScrollDelta = ((handle.position().top + handle.height()) < e.offsetY) ? -1 : (handle.position().top > e.offsetY) ? 1 : 0;
                                    if (RailScrollDelta !== 0) {
                                        RailDragPos(RailScrollDelta);
                                    }
                                }
                                e = null;
                                event = null;
                            });

                            break;
                        }
                    case 'xy':
                        {
                            setXYVariables();
                            SetXYElements();

                            handle.draggable({
                                axis: 'y',
                                containment: 'parent',
                                scroll: true,
                                drag: function () {
                                    var position = handle.position().top;
                                    child.css({ top: -(position * (child.height() / (rail.height() - 6)) - 1) });
                                }
                            });

                            xHandle.draggable({
                                axis: 'x',
                                containment: 'parent',
                                scroll: true,
                                drag: function () {
                                    var position = xHandle.position().left;
                                    child.css({ left: -(position * (child.width() / (xRail.width() - 34)) - 1) });
                                }
                            });

                            parent.mousewheel(function (e) {
                                if (_disableWheelOnElementHover(event)) { return; }
                                if (!self.options._isScrollable) { return; }
                                handleHeight = handle.height();
                                var scrollPosition = scrollPos(handle.position().top, self.options.Steps, e.deltaY);
                                handle.css("top", scrollPosition + "px");
                                child.css({ top: -(scrollPosition * (child.height() / (rail.height() - 14)) - 1) });
                                scrollPosition = null;
                                handleHeight = null;
                                e = null;
                                event = null;
                            });

                            up.on('mousedown', function (e) {
                                isMouseDown = true;
                                delta = 1;
                                setPos();
                            });

                            up.on('mouseup', function (e) {
                                isMouseDown = false;
                                delta = 0;
                            });

                            up.on('mouseleave', function (e) {
                                isMouseDown = false;
                                delta = 0;
                            });

                            up = null;

                            down.on('mousedown', function (e) {
                                isMouseDown = true;
                                delta = -1;
                                setPos();
                            });

                            down.on('mouseup', function (e) {
                                isMouseDown = false;
                                delta = 0;
                            });

                            down.on('mouseleave', function (e) {
                                isMouseDown = false;
                                delta = 0;
                            });

                            rail.on('mousedown', function (e) {
                                RailScrollDelta = ((handle.position().top + handle.height()) < e.offsetY) ? -1 : (handle.position().top > e.offsetY) ? 1 : 0;
                                if (RailScrollDelta !== 0) {
                                    RailDragPos(RailScrollDelta);
                                }
                            });

                            xLeft.on('mousedown', function (e) {
                                isMouseDown = true;
                                delta = -1;
                                setXPos();
                            });

                            xLeft.on('mouseup', function (e) {
                                isMouseDown = false;
                                delta = 0;
                            });

                            xLeft.on('mouseleave', function (e) {
                                isMouseDown = false;
                                delta = 0;
                            });

                            xRight.on('mousedown', function (e) {
                                isMouseDown = true;
                                delta = 1;
                                setXPos();
                            });

                            xRight.on('mouseup', function (e) {
                                isMouseDown = false;
                                delta = 0;
                            });

                            xRight.on('mouseleave', function (e) {
                                isMouseDown = false;
                                delta = 0;
                            });

                            xRail.on('mousedown', function (e) {
                                RailScrollDelta = ((xHandle.position().left + xHandle.width()) < e.offsetX) ? 1 : (xHandle.position().left > e.offsetX) ? -1 : 0;
                                if (RailScrollDelta !== 0) {
                                    xRailDragPos(RailScrollDelta);
                                }
                            });
                            break;
                        }
                }
                               
            }

            function SetVariables() {
                parent = self.element;
                child = $(parent).children();

                childWidthScrollVisible = child.width() - 10;
                child.width(childWidthScrollVisible);
                childWidthScrollVisible = null;
                containerHeight = parent.height();
                currentHeight = containerHeight;
                currentScrollableHeight = child.height();
                id = self.uuid;
                var len = parent[0].children.length;
                if (len > 1) {
                    var container = $('<div id="scrollableContent-' + id + '"></div>');
                    for (var i = 0; i != len; i++) {
                        $(child[i]).appendTo(container);
                    }
                    parent.append(container);
                    child = $(parent).children();
                }
                else if (len === 1) {
                    if (parent[0].children[0].nodeName !== "DIV") {
                        var container = $('<div id="scrollableContent-' + id + '"></div>');
                        if (parent[0].children[0].nodeName === "TABLE") { $(child[0]).width('100%');}
                        $(child[0]).appendTo(container);
                        parent.append(container);
                        child = $(parent).children();
                    }
                }
                
            }

            function SetXVariables() {
                parent = self.element;
                child = $(parent).children();
                
                containerWidth = parent.width();
                currentWidth = containerWidth;
                currentScrollableWidth = child.width();
                id = self.uuid;

                var len = parent[0].children.length;
                if (len > 1) {
                    var container = $('<div id="scrollableContent-' + id + '" style="width:1600px; height:'+ (parent.height() - 10) +'px; overflow: hidden;"></div>');
                    for (var i = 0; i != len; i++) {
                        $(child[i]).css({width: 1600}).appendTo(container);
                    }
                    parent.append(container);
                    child = $(parent).children();
                }

                childHeightScrollVisible = child.height() - 10;
                child.height(childHeightScrollVisible);
                childHeightScrollVisible = null;
            }

            function setXYVariables() {
                parent = self.element;
                child = $(parent).children();

                containerHeight = parent.height();
                currentHeight = containerHeight;
                currentScrollableHeight = child.height();
                containerWidth = parent.width();
                currentWidth = containerWidth;
                currentScrollableWidth = child.width();
                id = self.uuid;

                var len = parent[0].children.length;
                if (len > 1) {
                    var container = $('<div id="scrollableContent-' + id + '" style="width:1600px; overflow: hidden;"></div>');
                    for (var i = 0; i != len; i++) {
                        $(child[i]).css({ width: 1580 }).appendTo(container);
                    }
                    parent.append(container);
                    child = $(parent).children();
                }

                childWidthScrollVisible = child.width();
                child.width(childWidthScrollVisible);
                childWidthScrollVisible = null;

                childHeightScrollVisible = child.height();
                child.height(childHeightScrollVisible);
                childHeightScrollVisible = null;
            }

            function SetHorizontalScrollElements() {
                if (!parent.hasClass("wt-scrollableContainer-parent")) {
                    parent.addClass("wt-scrollableContainer-parent");
                }

                if (!child.hasClass("wt-scroll-content")) {
                    child.addClass("wt-scroll-content");
                }

                var container = $('<div id="xScrollContainer-' + id + '" style="height: 10px; width: ' + containerWidth + 'px; top: '+ containerHeight +'px"></div>').addClass("wt-scroll-container-x");
                var leftBtn = $('<div id="leftBtn-' + id + '" style="width:10px; height:10px; position:absolute; left:0px;" class="wt-scroll-arrow-left-icon"></div>');
                var rightBtn = $('<div id="rightBtn-' + id + '" style="width:10px; height:10px; position:absolute; right:0px;" class="wt-scroll-arrow-right-icon"></div>');
                railWidth = containerWidth - 20;
                var scrollRail = $('<div id="xRail-' + id + '" style="height:10px; width:' + railWidth + 'px; position:absolute; left:10px;"></div>');
                handleWidth = Math.round(railWidth / (child.width() / (railWidth + 20)));
                var scrollHandle = $('<div id="xScrollHandle-' + id + '" class="wt-scroll-handle-x" style="width: ' + handleWidth + 'px"></div>');

                container.append(leftBtn);
                container.append(scrollRail);
                container.append(rightBtn);
                scrollRail.append(scrollHandle);
                parent.append(container);

                xHandle = $('#xScrollHandle-' + id);
                xLeft = $('#leftBtn-' + id);
                xRight = $('#rightBtn-' + id);
                xRail = $('#xRail-' + id);
                xScrollCont = $('#xScrollContainer-' + id);

                xScrollCont.css({ bottom: self.options.offsetBottom });

                maxRight = xRail.width() - xHandle.width();
                containerWidth = null;
            }

            function SetElements() {
                // Apply Class
                parent.addClass("wt-scrollableContainer-parent");
                child.addClass("wt-scroll-content");
                // Create Elements
                var container = $('<div id="yScrollContainer-'+ id +'" style="height: ' + containerHeight + 'px; width: 10px;"></div>').addClass("wt-scroll-container");
                var upBtn = $('<div id="upBtn-' + id + '" style="width:10px; height:10px; position:absolute; right:0px;" class="wt-scroll-arrow-up-icon"></div>');
                var downBtn = $('<div id="downBtn-' + id + '" style="width:10px; height:10px; position:absolute; right:0px; top:' + (containerHeight - 10) + 'px" class="wt-scroll-arrow-down-icon"></div>');
                yRailHeight = containerHeight - 20;
                var scrollRail = $('<div id="rail-' + id + '" style="height: ' + yRailHeight + 'px; width:10px; position:absolute; right:0px; top:10px;"></div>');
                handleHeight = Math.round(yRailHeight / (child.height() / (yRailHeight + (upBtn.height() * 2))));
                var scrollHandle = $('<div id="scrollHandle-' + id + '" class="wt-scroll-handle" style="height: ' + handleHeight + 'px"></div>');
                // Append Elements
                container.append(upBtn);
                container.append(scrollRail);
                container.append(downBtn);
                scrollRail.append(scrollHandle);
                parent.append(container);
                // Set selectors
                handle = $('#scrollHandle-' + id);
                up = $('#upBtn-' + id);
                down = $('#downBtn-' + id);
                rail = $('#rail-' + id);
                scrollCont = $('#yScrollContainer-' + id);

                scrollCont.css({ right: self.options.offsetRight });
                // Set max top value
                maxTop = (rail.height() - handle.height()) - 2;

                containerHeight = null;
                yRailHeight = null;
            }

            function SetXYElements() {
                parent.addClass("wt-scrollableContainer-parent");
                child.addClass("wt-scroll-content");

                var yContainer = $('<div id="yScrollContainer-' + id + '" style="height: ' + (containerHeight - 10) + 'px; width: 10px;"></div>').addClass("wt-scroll-container");
                var upBtn = $('<div id="upBtn-' + id + '" style="width:10px; height:10px; position:absolute; right:0px;" class="wt-scroll-arrow-up-icon"></div>');
                var downBtn = $('<div id="downBtn-' + id + '" style="width:10px; height:10px; position:absolute; right:0px; top:' + (containerHeight - 20) + 'px" class="wt-scroll-arrow-down-icon"></div>');
                yRailHeight = containerHeight - 20;
                var yScrollRail = $('<div id="rail-' + id + '" style="height: ' + yRailHeight + 'px; width:10px; position:absolute; right:0px; top:10px;"></div>');
                yHandleHeight = Math.round(yRailHeight / (child.height() / (yRailHeight + 20)));
                var yScrollHandle = $('<div id="scrollHandle-' + id + '" class="wt-scroll-handle" style="height: ' + yHandleHeight + 'px"></div>');

                var xContainer = $('<div id="xScrollContainer-' + id + '" style="height: 10px; width: ' + (containerWidth - 10) + 'px; top: ' + (containerHeight - 10) + 'px"></div>').addClass("wt-scroll-container-x");
                var leftBtn = $('<div id="leftBtn-' + id + '" style="width:10px; height:10px; position:absolute; left:0px;" class="wt-scroll-arrow-left-icon"></div>');
                var rightBtn = $('<div id="rightBtn-' + id + '" style="width:10px; height:10px; position:absolute; right:0px;" class="wt-scroll-arrow-right-icon"></div>');
                xRailWidth = containerWidth - 20;
                var xScrollRail = $('<div id="xRail-' + id + '" style="height:10px; width:' + xRailWidth + 'px; position:absolute; left:10px;"></div>');
                xHandleWidth = Math.round(xRailWidth / (child.width() / (xRailWidth + 20)));
                var xScrollHandle = $('<div id="xScrollHandle-' + id + '" class="wt-scroll-handle-x" style="width: ' + xHandleWidth + 'px"></div>');

                yContainer.append(upBtn);
                yContainer.append(yScrollRail);
                yContainer.append(downBtn);
                yScrollRail.append(yScrollHandle);
                parent.append(yContainer);

                xContainer.append(leftBtn);
                xContainer.append(xScrollRail);
                xContainer.append(rightBtn);
                xScrollRail.append(xScrollHandle);
                parent.append(xContainer);

                handle = $('#scrollHandle-' + id);
                up = $('#upBtn-' + id);
                down = $('#downBtn-' + id);
                rail = $('#rail-' + id);
                scrollCont = $('#yScrollContainer-' + id);
                scrollCont.css({ right: self.options.offsetRight });

                xHandle = $('#xScrollHandle-' + id);
                xLeft = $('#leftBtn-' + id);
                xRight = $('#rightBtn-' + id);
                xRail = $('#xRail-' + id);
                xScrollCont = $('#xScrollContainer-' + id);

                maxTop = (rail.height() - handle.height()) - 2;
                maxRight = xRail.width() - xHandle.width();

                containerHeight = null;
                containerWidth = null;
                yRailHeight = null;
                yHandleHeight = null;
            }

            function _disableWheelOnElementHover(target) {
                var targetTag = target.target.tagName.toLowerCase();
            
                return ($.inArray(targetTag, self.options.disableScrollOnHover) > -1);
            }

            function updateVar(a, b, ori) {
                switch (ori) {
                    case 'x':
                        railWidth = a;
                        handleWidth = b;
                        maxRight = xRail.width() - xHandle.width();
                        break;
                    case 'y':
                        handleHeight = b;
                        maxTop = (rail.height() - handle.height()) - 2;
                        break;
                    case 'xy':
                        handleHeight = b;
                        maxTop = (rail.height() - handle.height()) - 2;
                        break;
                }
                
            }

            function UpdateChildXYHeight(cElem) {
                var len = cElem[0].children.length;
                var xyHeight = 0;
                for (var i = 0; i != len; i++) {
                    xyHeight = (cElem[0].children[i].offsetHeight >= xyHeight) ? cElem[0].children[i].offsetHeight : xyHeight;
                }
                if (xyHeight >= parent.height()) {
                    child.height(xyHeight);
                }
            }

            function RailDragPos(delta) {
                var scrollPosition = scrollPos(handle.position().top, self.options.RailSteps, delta);
                handle.css("top", scrollPosition + "px");
                child.css({ top: -(scrollPosition * (child.height() / (rail.height() - 2)) - 1) });
            }

            function xRailDragPos(delta) {
                var scrollPosition = xScrollPos(xHandle.position().left, self.options.RailSteps, delta);
                xHandle.css({ left: scrollPosition });
                child.css({ left: -(scrollPosition * (child.width() / (xRail.width() - 2)) - 1) });
            }

            function setPos() {
                handleHeight = handle.height();
                var scrollPosition = scrollPos(handle.position().top, self.options.Steps, delta);
                var computedChildPos = (scrollPosition * (child.height() / (rail.height() - 2)) - 1);
                var childMaxTop = child.height() - parent.height();
                var childPos = (computedChildPos >= childMaxTop) ? childMaxTop : computedChildPos;
                handle.css("top", scrollPosition + "px");
                child.css({ top: -childPos });
                scrollPosition = null;
                handleHeight = null;
                if (isMouseDown) {
                    setTimeout(setPos, self.options.TimeoutDelay);
                }
            }

            function setXPos() {
                handleWidth = xHandle.width();
                var scrollPosition = xScrollPos(xHandle.position().left, 8, delta);
                xHandle.css({ left: scrollPosition });
                child.css({ left: -(scrollPosition * (child.width() / (xRail.width() - 2)) - 1) });
                scrollPosition = null;
                handleWidth = null;

                if (isMouseDown) {
                    setTimeout(setXPos, self.options.TimeoutDelay);
                }
            }

            function xScrollPos(currentLeft, increment, scrollDirection) {
                var returnValue;
                var _increment = (currentLeft >= maxRight) ? maxRight : increment;
                if (scrollDirection > 0) {
                    if (currentLeft >= maxRight) { returnValue = maxRight; return returnValue; }
                    else {
                        returnValue = ((currentLeft + _increment) >= maxRight) ? maxRight : (currentLeft + _increment);
                        return returnValue;
                    }
                }
                if (scrollDirection < 0) {
                    if (currentLeft <= 0) { return 0; }
                    else {
                        returnValue = ((currentLeft - _increment) <= 0) ? 0 : (currentLeft - _increment);
                        return returnValue;
                    }
                }
            }

            function scrollPos(currentTop, increment, scrollDirection) {
                var returnValue;
                maxTop = (rail.height() - handle.height()) - 2;
                var _increment = (currentTop >= maxTop) ? maxTop : increment;
                if (scrollDirection > 0) {
                    if (currentTop <= 0) { maxTop = null; return 0; }
                    else {
                        returnValue = ((currentTop - increment) <= 0) ? 0 : (currentTop - increment);
                        maxTop = null;
                        return returnValue;
                    }
                }
                if (scrollDirection < 0) {
                    if (currentTop >= ((parent.height() - 20) - handleHeight) - 2) {
                        returnValue = ((currentTop - _increment) <= maxTop) ? maxTop : (currentTop - _increment);
                        maxTop = null;
                        return returnValue;
                    }
                    else {
                        returnValue = ((currentTop + _increment) >= maxTop) ? maxTop : (currentTop + _increment);
                        maxTop = null;
                        return returnValue;
                    }
                }
            }
        }

        , ScrollToID: function (id) {
            this.Refresh();
            var child = $(this.element.children()[0]);
            var handle = $('#scrollHandle-' + this.uuid);
            var rail = $('#rail-' + this.uuid);
            var maxTop = (rail.height() - handle.height()) - 2;
            var top = $(id).position().top + 1;
            var gcd = getGCD(child.height(), (rail.height() - 2));
            var dividend = child.height() / gcd;
            var denominator = (rail.height() - 2) / gcd;
            var x = (denominator / dividend) * top;
            var y = (x >= maxTop) ? maxTop : x;
            handle.css("top", y + "px");
            var childmaxtop = child.height() - this.element.height();
            var childtop = ((y * (child.height() / (rail.height() - 2)) - 1) >= childmaxtop) ? childmaxtop : (y * (child.height() / (rail.height() - 2)) - 1);
            child.css({ top: -(childtop) });
            maxTop = null;
            this.Refresh();
            function getGCD(a, b) {
                var temp;
                while (b > 0) {
                    temp = b;
                    b = a % b;
                    a = temp;
                }
                return Math.round(a);
            }

        }

        , ScrollToElement: function (el) {
            this.Refresh();
            var child = $(this.element.children()[0]);
            var handle = $('#scrollHandle-' + this.uuid);
            var rail = $('#rail-' + this.uuid);
            var maxTop = (rail.height() - handle.height()) - 2;
            var top = el.position().top + 1;
            var gcd = getGCD(child.height(), (rail.height() - 2));
            var dividend = child.height() / gcd;
            var denominator = (rail.height() - 2) / gcd;
            var x = (denominator / dividend) * top;
            var y = (x >= maxTop) ? maxTop : x;
            handle.css("top", y + "px");
            var childmaxtop = child.height() - this.element.height();
            var childtop = ((y * (child.height() / (rail.height() - 2)) - 1) >= childmaxtop) ? childmaxtop : (y * (child.height() / (rail.height() - 2)) - 1);
            child.css({ top: -(childtop) });
            maxTop = null;
            this.Refresh();
            function getGCD(a, b) {
                var temp;
                while (b > 0) {
                    temp = b;
                    b = a % b;
                    a = temp;
                }
                return Math.round(a);
            }
        }

        , Refresh: function () {
            var self = this;
            var parent = $(self.element);
            var child = $(self.element.children()[0]);
            
            switch (self.options.Orientation) {

                case 'x':
                    {
                        xHandle = $('#xScrollHandle-' + self.uuid);
                        xLeft = $('#leftBtn-' + self.uuid);
                        xRight = $('#rightBtn-' + self.uuid);
                        xRail = $('#xRail-' + self.uuid);
                        xScrollCont = $('#xScrollContainer-' + self.uuid);

                        var pw, rw, hw, cw, ph, ml;
                        pw = parent.width();
                        cw = child.width();
                        ph = parent.height();
                        rw = pw - 20;
                        hw = Math.round(rw / (cw / (pw)));
                        xScrollCont.width(pw);
                        xRail.width(rw);
                        xRight.css({ left: (pw - 10) });
                        xHandle.width(hw);

                        if (cw < pw) {
                            xScrollCont.css({ display: 'none' });
                            self.options._isScrollable = false;
                            if (self.options.railAlwaysVisible) {
                                child.height((ph - (10 + self.options.offsetBottom)));
                            } else {
                                child.height(ph);
                            }
                            child.css({ left: 0 });
                        }
                        else if (cw > pw) {
                            xScrollCont.css({ display: 'block' });
                            self.options._isScrollable = true;
                            child.height(ch - 10);
                            $('#scrollableContent-' + id).height((ph - 10));
                        }
                    }
                    break;

                case 'y':
                    {
                        var handle = $('#scrollHandle-' + self.uuid);
                        var rail = $('#rail-' + self.uuid);
                        var up = $('#upBtn-' + self.uuid);
                        var down = $('#downBtn-' + self.uuid);
                        var scrollCont = $('#yScrollContainer-' + self.uuid);

                        var ph, rh, hh, ch, pw, mt, cmt, ct, pos, ccp, cp;

                        ph = parent.height();
                        ch = child.height();
                        pw = parent.width();
                        rh = ph - 20;
                        hh = Math.round(rh / (ch / (ph)));
                        scrollCont.height(ph);
                        rail.height(rh);
                        down.css({ top: (ph - 10) });
                        handle.height(hh);

                        if (ch <= ph) {
                            scrollCont.css({ display: 'none' });
                            self.options._isScrollable = false;
                            child.css({ top: 0 });
                            if (self.options.railAlwaysVisible) {
                                child.width((pw - (10 + self.options.offsetRight)));
                            } else {
                                child.width(pw);
                            }
                        }
                        else if (ch > ph) {
                            scrollCont.css({ display: 'block' });
                            child.width((pw - (10 + self.options.offsetRight)));
                            self.options._isScrollable = true;
                            cmt = ch - ph;
                            mt = (rh - hh) - 2;
                            ct = (mt * (ch / (rh - 2)) - 1);
                            pos = handle.position().top;
                            if (pos > mt) {
                                handle.css({ top: mt });
                                child.css({ top: -(ct) });
                            }
                            if (pos < 0) {
                                handle.css({ top: 0 });
                                child.css({ top: 0 });
                            }
                            if (pos < mt) {
                                ccp = (pos * (ch / (rh - 2)) - 1);
                                mt = (rh - hh) - 2;
                                cp = (ccp >= cmt) ? cmt : ((pos < mt) ? ccp : cmt);
                                child.css({ top: -cp });
                            }
                        }
                    }
                    break;
            }
        }
    });
}(jQuery));