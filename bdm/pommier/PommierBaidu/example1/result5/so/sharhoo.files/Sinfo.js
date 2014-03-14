//(
//function() {
var A = 1, S = document.getElementById("sug"), B = document.getElementById("searchbox"), N,
    Z = null, V = -1, E = false, Q = false, $ = false, F = true, R = null, H = null,
    Y = 0;

function I() {
    B.setAttribute("autocomplete", "on")
}
function c() {//失去焦点时调用此方法
    S.style.display = "none"; G("sugif").style.display = "none"; Y = 0; F = true //G("sugif").style.display = "none";
}
function b() {//获得焦点时调用此方法
    var $ = H.rows;
    for (var _ = 0; _ < $.length; _++)
        $[_].className = "ml"
}

var O = {},
    f = true; //如果去掉将不能把选择的内容填写的文本框

function e(_) {//

    return function() {
        B.blur();
        clearTimeout(Y);
        O.startTime = new Date();
        var A = this, _ = 0;
        while (A && A.tagName == "TR") {
            A = A.previousSibling; _++
        }
        B.value = N.s[_ - 1];
        L = B.value;
        B.focus(); $ = true;
    }
}

function P($) {
    var $ = window.event || $, _ = $.target || $.srcElement;
    if ((new Date() - O.startTime) / 1000 > 0.5 && L != _.innerHTML)
        return;
    else {
        document.getElementById("submit").click();
        B.value = L;c();
    }
}


function K() {
    if (typeof (N) != "object" || typeof (N.s) == "undefined")
        return;
    F = false;
    var tab = C("table");
    with (tab) {
        id = "sug_t";
        style.width = "100%";
        style.backgroundColor = "#fff";
        cellSpacing = 0;
        cellPadding = 2;
        style.cursor = "default"
    }
    var _ = C("tbody");
    G("sugif").style.display = "block";
    tab.appendChild(_);
    for (var I = 0; I < N.s.length; I++) {

        var A = _.insertRow(-1);
        A.onmouseover = function() {
            b();
            this.className = "mo"; Q = true
        };
        A.onmouseout = b;
        A.onmousedown = e(I); 
        A.onmouseup = P;
        var D = A.insertCell(-1), $ = "";
        D.innerHTML = N.s[I];


            D.style.lineHeight = "20px";
            D.style.width = B.clientWidth + "px"
    }

    S.innerHTML = "";
    S.appendChild(tab);
    S.style.width = (B.offsetWidth - 2) + "px";
    S.style.top =  (B.offsetHeight - 1) + "px";
    S.style.display = "block";

    width = S.offsetWidth + "px";
    height = tab.offsetHeight + "px";
    
    G("sugif").style.height = height;
    if (G("sug_t"))
        H = G("sug_t");
    V = -1;
    L = "";
}

function J(A) {
    A = A || window.event;
    E = false;
    var D = null;
    if (A.keyCode == 9) {//keycode 9 = Tab Tab
        c();
        return
    }
    if (A.keyCode == 13) {//keycode 13 = Enter
      // c();  去掉,否则会多一个出来
        return
    }
    if (A.keyCode == 38 || A.keyCode == 40) {
        //keycode 38 = Up，keycode 40 = Down
        Q = false;
        if (S.style.display != "none") {
            var $ = H.rows, C = $.length;
            for (var G = 0; G < C; G++)
            {
                if ($[G].className == "mo") {
                    V = G; break;
                }
            }
            b(); 
            if (A.keyCode == 38)
                if (V == 0) {
                B.value = N.q;
                V = -1;
                E = true;
            }
            else {
                if (V == -1)
                    V = C;
                D = $[--V];
                D.className = "mo";
                var F = D, _ = 0;
                while (F && F.tagName.toUpperCase() == "TR") {
                    F = F.previousSibling;
                    _++
                }
                B.value = N.s[_ - 1];
                L = B.value
            }
            if (A.keyCode == 40)
                if (V == C - 1) {
                B.value = N.q; V = -1; E = true
            }
            else {
                D = $[++V];
                D.className = "mo";
                F = D, _ = 0;
                while (F && F.tagName.toUpperCase() == "TR") {
                    F = F.previousSibling; _++
                }
                B.value = N.s[_ - 1];
                L = B.value
            }
        }
    }

}

var T = "", L = B.value, W = 0;

function _() {
    if (A == 0)
        return;
    B.onbeforedeactivate = function() {//当获得焦点之前调用此方法
        if (F) return;
        window.event.cancelBubble = true; //取消句柄, 为true时, 即取消按键所要预定发生的事务 
        window.event.returnValue = false;
        $ = false;
        return false
    };
    var J = true, K = B.value;
    if (typeof (H) != "undefined" && H != null) {
        var _ = H.rows;
        for (var L = 0; L < _.length; L++)
            if (_[L].className == "mo")
            if (K == _[L].cells[0].innerHTML && !Q) J = false
    }
    if (J && !E) {

        var D = encodeURIComponent(B.value), I = (new Date()).getTime(), G = "";
        (function() {
            var arr = ["zh02", "xw02", "tb", "wd01", "yy02", "pic02", "ys02", "zh01", "zh03", "zh04"];
            var $ = document.getElementById("ycz").value;
            var val = document.getElementById("Tvalue").value;
            var tag = 0;
            for (var i = 0; i < arr.length; i++) {
                if (val == arr[i]) {
                    tag = 1;
                }
            }
            if (tag == 0) return;
            if ($ == null) $ = "web";
            switch ($) {
                case "yy02": G = "http://nssug.baidu.com/su?wd=" + D + "&prod=mp3&sc=3456cc&t=" + I; break;
                case "pic02": G = "http://nssug.baidu.com/su?wd=" + D + "&prod=image&sc=3456cc&t=" + I; break;
                case "ys02": G = "http://nssug.baidu.com/su?wd=" + D + "&prod=video&sc=3456cc&t=" + I; break;
                case "wd01": G = "http://nssug.baidu.com/su?wd=" + D + "&prod=zhidao&sc=3456cc&t=" + I; break;
                default: case "zh02": G = "http://suggestion.baidu.com/su?wd=" + D + "&sc=3456cc&t=" + I; break;
				case "xw02": G = "http://nssug.baidu.com/su?wd=" + D + "&prod=new&sc=3456cc&t=" + I; break;
                case "tb": G = "http://nssug.baidu.com/su?wd=" + D + "&prod=tieba&sc=3456cc&t=" + I; break;
                case "zh01": G = "http://suggestion.baidu.com/su?wd=" + D + "&prod=google&sc=3456cc&t=" + I; break;
				 case "zh03": G = "http://suggestion.baidu.com/su?wd=" + D + "&prod=sogou&sc=3456cc&t=" + I; break;
				  case "zh04": G = "http://suggestion.baidu.com/su?wd=" + D + "&prod=soso&sc=3456cc&t=" + I; break;
            }
        }
            )();
        if (G == null) {
            return false;
        }
        Z = C("script");
        Z.src = G;
        document.body.appendChild(Z);
    }
}

function M() {
    var $ = B.value; 
    if ($ == T && $ != "" && $ != L) {
        if (W == 0) {
            W = setTimeout(_, 100);
        } 
    }
    else {
        clearTimeout(W);
        W = 0;
        T = $;
        if ($ == "") c();
        if (L != B.value) {
            L = "";
        }
    }
}
var U = setInterval(M, 10), a = 0;

window.baidu.sug = function($) {
    if (typeof ($) == "object" && typeof ($.s)
     != "undefined" && typeof ($.s[0]) != "undefined") {
        N = $; K();
    }
    else {
        c(); N = {}
    }
};
//    B.oncontextmenu = function() {
//        E = false
//    };

if (A == 1) {
    B.onkeydown = J;
}
f = false;

window.onblur = function() { c() };
B.onblur = function() {

    if (f) if (Y == 0) {
        Y = setTimeout(c, 200);
        c()
    }
    f = false
};
document.onmousedown = function(_) {
    if ($) {
        $ = false;
        return false
    }
    B.onbeforedeactivate = function() { };
    _ = _ || window.event;
    var A = _.target || _.srcElement;
    if (A == B) return;
    while (A == A.parentNode)
        if (A == S || A == B) {
        f = true;
        return
    }
    if (Y == 0)
        Y = setTimeout(c, 200)
};
function d() {//如果去掉将不能把选择的内容填写的文本框
    if (typeof (Y) != "undefined" && Y != 0)
        clearTimeout(Y);
    X()
}

function X() {
    if (S.style.display != "none")
        setTimeout(function() { c(); if (N != null) { K(N); B.focus() } }, 100)
}

var g = C("IFRAME");
g.src = "javascript:void(0)"; g.id = "sugif"; g.style.zIndex = "20";
with (g.style) { display = "none"; position = "absolute" } S.parentNode.insertBefore(g, S)
    

function D($) {
        $ = $ || window.event;
        if ($.ctrlKey) if ($.keyCode == 61 || $.keyCode == 107 || $.keyCode == 109 || $.keyCode == 96 || $.keyCode == 48)
            X();
    }
//})()