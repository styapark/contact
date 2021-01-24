/*
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
*/
/* 
    Created on : Nov 2, 2017, 10:31:01 PM
    Author     : styapark
*/


function empty(str){
    return (!str || 0 === str.length || str === 0);
}
function date_timestamp(string, sparator = '-'){
    var split = string.split(sparator).reverse().join(sparator);
    return (new Date( split )).getTime() / 1000;
}
function timestamp_date(stamp, mode = 'en', sparator = '-'){
    var d = new Date( stamp * 1000 );
    if (mode === 'id'){
        return d.getDate() + sparator + ( d.getMonth() + 1) + sparator + d.getFullYear();
    }
    return d.getFullYear() + sparator + ( d.getMonth() + 1) + sparator + d.getDate();
}
function timestamp_datetime(stamp, mode = 'en', sparator = '-'){
    var d = new Date( stamp * 1000 );
    var time = (d.getHours() <= 9 ? '0': '') + d.getHours() + ':' + (d.getMinutes() <= 9 ? '0': '') + d.getMinutes() + ':' + (d.getSeconds() <= 9 ? '0': '') + d.getSeconds();
    if (mode === 'id'){
        return (d.getDate() <= 9 ? '0': '') + d.getDate() + sparator + ((d.getMonth()+1) <= 9 ? '0': '') + ( d.getMonth() + 1) + sparator + d.getFullYear() + ' ' + time;
    }
    return d.getFullYear() + sparator + ((d.getMonth()+1) <= 9 ? '0': '') + ( d.getMonth() + 1) + sparator + (d.getDate() <= 9 ? '0': '') + d.getDate() + ' ' + time;
}
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
function serialize(obj) {
  var str = [];
  for (var p in obj)
    if (obj.hasOwnProperty(p)) {
      str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
    }
  return str.join("&");
}
function numberFormat(n, c, d = ',', t = '.'){
    c = isNaN(c = Math.abs(c)) ? 2 : c;
    var s = n < 0 ? "-" : "", 
    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
    j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };
function setCookie(cname, cvalue, exdays = 1) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function deleteCookie(cname) {
    var expires = "expires=Thu, 01 Jan 1970 00:00:00 UTC";
    document.cookie = cname + "=;" + expires + ";path=/";
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function checkCookie(cname) {
    var user = getCookie(cname);
    return user != "" && user != null;
}
/* start fullscreen */
function toggleFullScreen() {
    var elem = document.documentElement;
    if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
        if (elem.requestFullScreen) {
            elem.requestFullScreen();
        } else if (elem.webkitRequestFullScreen) {
            elem.webkitRequestFullScreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    }
}
/* end fullscreen */

/* start action table */
var startIcon = ['<div class=" text-center">'];
var iconConfirm = ['<span class="badge badge-primary" title="Confirm">','<i class="fa fa-check-square-o fa-1x"></i>','</span>'];
var iconEdit = ['<span class="badge info-color" title="Edit">','<i class="fa fa-edit fa-1x"></i>','</span>'];
var iconDetail = ['<span class="badge badge-success" title="Detail">','<i class="fa fa-list-ul fa-1x"></i>','</span>'];
var iconDelete = ['<span class="badge red lighten-2" title="Delete">','<i class="fa fa-trash-o fa-1x"></i>','</span>'];
var iconPrint = ['<span class="badge badge-default" title="Print">','<i class="fa fa-print fa-1x"></i>','</span>'];
var iconPDF = ['<span class="badge badge-default" title="PDF">','<i class="fa fa-file-pdf-o fa-1x"></i>','</span>'];
var endIcon = ['</div>'];
function actionConfirm(value, row, index) {
    return startIcon.concat(iconConfirm,endIcon).join('');
}
function actionConfirmDetail(value, row, index) {
    return startIcon.concat(iconConfirm,iconDetail,endIcon).join('');
}
function actionConfirmPrint(value, row, index) {
    return startIcon.concat(iconConfirm,iconPrint,endIcon).join('');
}
function actionDelete(value, row, index) {
    return startIcon.concat(iconDelete,endIcon).join('');
}
function actionDeletePDF(value, row, index) {
    return startIcon.concat(iconDelete,iconPDF,endIcon).join('');
}
function actionDetail(value, row, index) {
    return startIcon.concat(iconDetail,endIcon).join('');
}
function actionDetailDelete(value, row, index) {
    return startIcon.concat(iconDetail,iconDelete,endIcon).join('');
}
function actionDetailPDF(value, row, index) {
    return startIcon.concat(iconDetail,iconPDF,endIcon).join('');
}
function actionDetailPrint(value, row, index) {
    return startIcon.concat(iconDetail,iconPrint,endIcon).join('');
}
function actionEdit(value, row, index) {
    return startIcon.concat(iconEdit,endIcon).join('');
}
function actionEditDelete(value, row, index) {
    return startIcon.concat(iconEdit,iconDelete,endIcon).join('');
}
function actionEditDeletePrint(value, row, index) {
    return startIcon.concat(iconEdit,iconDelete,iconPrint,endIcon).join('');
}
function actionEditPDF(value, row, index) {
    return startIcon.concat(iconEdit,iconPDF,endIcon).join('');
}
function actionEditDeletePDF(value, row, index) {
    return startIcon.concat(iconEdit,iconDelete,iconPDF,endIcon).join('');
}
function actionPrintDelete(value, row, index) {
    return startIcon.concat(iconPrint,iconDelete,endIcon).join('');
}
/* end action table */

/* start snarl custom */
if ( Snarl !== undefined ) {
    function snarlDanger( e, id = null ) {
        var html = '<div class="snarl-notification danger-color waves-effect waves-light ' + (id !== null ? id: '') + '"><div class="snarl-icon"></div><h3 class="snarl-title"></h3><p class="snarl-text"></p><div class="snarl-close waves-effect"><svg class="snarl-close-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" height="100px" width="100px"><g><path d="M49.5,5c-24.9,0-45,20.1-45,45s20.1,45,45,45s45-20.1,45-45S74.4,5,49.5,5z M71.3,65.2c0.3,0.3,0.5,0.7,0.5,1.1   s-0.2,0.8-0.5,1.1L67,71.8c-0.3,0.3-0.7,0.5-1.1,0.5s-0.8-0.2-1.1-0.5L49.5,56.6L34.4,71.8c-0.3,0.3-0.7,0.5-1.1,0.5   c-0.4,0-0.8-0.2-1.1-0.5l-4.3-4.4c-0.3-0.3-0.5-0.7-0.5-1.1c0-0.4,0.2-0.8,0.5-1.1L43,49.9L27.8,34.9c-0.6-0.6-0.6-1.6,0-2.3   l4.3-4.4c0.3-0.3,0.7-0.5,1.1-0.5c0.4,0,0.8,0.2,1.1,0.5l15.2,15l15.2-15c0.3-0.3,0.7-0.5,1.1-0.5s0.8,0.2,1.1,0.5l4.3,4.4   c0.6,0.6,0.6,1.6,0,2.3L56.1,49.9L71.3,65.2z"/></g></svg></div></div>';
        Snarl.setNotificationHTML( html );
        return Snarl.addNotification( e );
    }
    function snarlDefault( e, id = null ) {
        var html = '<div class="snarl-notification waves-effect ' + (id !== null ? id: '') + '"><div class="snarl-icon"></div><h3 class="snarl-title"></h3><p class="snarl-text"></p><div class="snarl-close waves-effect"><svg class="snarl-close-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" height="100px" width="100px"><g><path d="M49.5,5c-24.9,0-45,20.1-45,45s20.1,45,45,45s45-20.1,45-45S74.4,5,49.5,5z M71.3,65.2c0.3,0.3,0.5,0.7,0.5,1.1   s-0.2,0.8-0.5,1.1L67,71.8c-0.3,0.3-0.7,0.5-1.1,0.5s-0.8-0.2-1.1-0.5L49.5,56.6L34.4,71.8c-0.3,0.3-0.7,0.5-1.1,0.5   c-0.4,0-0.8-0.2-1.1-0.5l-4.3-4.4c-0.3-0.3-0.5-0.7-0.5-1.1c0-0.4,0.2-0.8,0.5-1.1L43,49.9L27.8,34.9c-0.6-0.6-0.6-1.6,0-2.3   l4.3-4.4c0.3-0.3,0.7-0.5,1.1-0.5c0.4,0,0.8,0.2,1.1,0.5l15.2,15l15.2-15c0.3-0.3,0.7-0.5,1.1-0.5s0.8,0.2,1.1,0.5l4.3,4.4   c0.6,0.6,0.6,1.6,0,2.3L56.1,49.9L71.3,65.2z"/></g></svg></div></div>';
        Snarl.setNotificationHTML( html );
        return Snarl.addNotification( e );
    }
    function snarlInfo( e, id = null ) {
        var html = '<div class="snarl-notification info-color waves-effect waves-light ' + (id !== null ? id: '') + '"><div class="snarl-icon"></div><h3 class="snarl-title"></h3><p class="snarl-text"></p><div class="snarl-close waves-effect"><svg class="snarl-close-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" height="100px" width="100px"><g><path d="M49.5,5c-24.9,0-45,20.1-45,45s20.1,45,45,45s45-20.1,45-45S74.4,5,49.5,5z M71.3,65.2c0.3,0.3,0.5,0.7,0.5,1.1   s-0.2,0.8-0.5,1.1L67,71.8c-0.3,0.3-0.7,0.5-1.1,0.5s-0.8-0.2-1.1-0.5L49.5,56.6L34.4,71.8c-0.3,0.3-0.7,0.5-1.1,0.5   c-0.4,0-0.8-0.2-1.1-0.5l-4.3-4.4c-0.3-0.3-0.5-0.7-0.5-1.1c0-0.4,0.2-0.8,0.5-1.1L43,49.9L27.8,34.9c-0.6-0.6-0.6-1.6,0-2.3   l4.3-4.4c0.3-0.3,0.7-0.5,1.1-0.5c0.4,0,0.8,0.2,1.1,0.5l15.2,15l15.2-15c0.3-0.3,0.7-0.5,1.1-0.5s0.8,0.2,1.1,0.5l4.3,4.4   c0.6,0.6,0.6,1.6,0,2.3L56.1,49.9L71.3,65.2z"/></g></svg></div></div>';
        Snarl.setNotificationHTML( html );
        return Snarl.addNotification( e );
    }
    function snarlSuccess( e, id = null ) {
        var html = '<div class="snarl-notification success-color waves-effect waves-light ' + (id !== null ? id: '') + '"><div class="snarl-icon"></div><h3 class="snarl-title"></h3><p class="snarl-text"></p><div class="snarl-close waves-effect"><svg class="snarl-close-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" height="100px" width="100px"><g><path d="M49.5,5c-24.9,0-45,20.1-45,45s20.1,45,45,45s45-20.1,45-45S74.4,5,49.5,5z M71.3,65.2c0.3,0.3,0.5,0.7,0.5,1.1   s-0.2,0.8-0.5,1.1L67,71.8c-0.3,0.3-0.7,0.5-1.1,0.5s-0.8-0.2-1.1-0.5L49.5,56.6L34.4,71.8c-0.3,0.3-0.7,0.5-1.1,0.5   c-0.4,0-0.8-0.2-1.1-0.5l-4.3-4.4c-0.3-0.3-0.5-0.7-0.5-1.1c0-0.4,0.2-0.8,0.5-1.1L43,49.9L27.8,34.9c-0.6-0.6-0.6-1.6,0-2.3   l4.3-4.4c0.3-0.3,0.7-0.5,1.1-0.5c0.4,0,0.8,0.2,1.1,0.5l15.2,15l15.2-15c0.3-0.3,0.7-0.5,1.1-0.5s0.8,0.2,1.1,0.5l4.3,4.4   c0.6,0.6,0.6,1.6,0,2.3L56.1,49.9L71.3,65.2z"/></g></svg></div></div>';
        Snarl.setNotificationHTML( html );
        return Snarl.addNotification( e );
    }
    function snarlWarning( e, id = null ) {
        var html = '<div class="snarl-notification warning-color waves-effect waves-light ' + (id !== null ? id: '') + '"><div class="snarl-icon"></div><h3 class="snarl-title"></h3><p class="snarl-text"></p><div class="snarl-close waves-effect"><svg class="snarl-close-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" height="100px" width="100px"><g><path d="M49.5,5c-24.9,0-45,20.1-45,45s20.1,45,45,45s45-20.1,45-45S74.4,5,49.5,5z M71.3,65.2c0.3,0.3,0.5,0.7,0.5,1.1   s-0.2,0.8-0.5,1.1L67,71.8c-0.3,0.3-0.7,0.5-1.1,0.5s-0.8-0.2-1.1-0.5L49.5,56.6L34.4,71.8c-0.3,0.3-0.7,0.5-1.1,0.5   c-0.4,0-0.8-0.2-1.1-0.5l-4.3-4.4c-0.3-0.3-0.5-0.7-0.5-1.1c0-0.4,0.2-0.8,0.5-1.1L43,49.9L27.8,34.9c-0.6-0.6-0.6-1.6,0-2.3   l4.3-4.4c0.3-0.3,0.7-0.5,1.1-0.5c0.4,0,0.8,0.2,1.1,0.5l15.2,15l15.2-15c0.3-0.3,0.7-0.5,1.1-0.5s0.8,0.2,1.1,0.5l4.3,4.4   c0.6,0.6,0.6,1.6,0,2.3L56.1,49.9L71.3,65.2z"/></g></svg></div></div>';
        Snarl.setNotificationHTML( html );
        return Snarl.addNotification( e );
    }
}
/* end snarl custom */

if ( $ !== undefined ) {
    function checktelephone(x,e){
        var p = $(x).parent();
        var v = $(x).val();
        if (v.length < 9){
            p.removeClass('has-success');
            p.addClass('has-error');
        }
        else if (v.length >= 9){
            p.removeClass('has-error');
            p.addClass('has-success');
        }
        if (v.length >= 13){
            e.preventDefault();
        }
    }
    
    /* start initial */
    $(document).ready(function(){
        $('[data-tooltip="true"]').tooltip();
        $('input[data-number]').on('keyup keypress', function(e) {
            var keyarr = [46,48,49,50,51,52,53,54,55,56,57];
            var keyCode = e.keyCode || e.which;
            if (jQuery.inArray(keyCode,keyarr) === -1) { 
                e.preventDefault();
                return false;
            }
        });
        $('input[maxlength]').on('keyup keypress', function(e) {
            var max = $(this).attr('maxlength');
            if ($(this).val().length >= max) { 
                e.preventDefault();
                return false;
            }
        });
        $('input[data-parsley-maxlength]').on('keyup keypress', function(e) {
            var max = $(this).attr('data-parsley-maxlength');
            if ($(this).val().length >= max) { 
                e.preventDefault();
                return false;
            }
        });
        $('a[title=Refresh]').on('click',function(){
            $(this).find('.fa').addClass('fa-spin');
            window.location.reload();
        });
        $('a[data-original-title=Refresh]').on('click',function(){
            $(this).find('.fa').addClass('fa-spin');
            window.location.reload();
        });
    });
    /* end initial */
}