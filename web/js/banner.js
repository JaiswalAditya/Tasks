/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var banner = {
    getListByType: function (type) {
        $.ajax({
            type: 'GET',
            url: '/product/get-list',
            data: {
                'city_id': 'city_id'
            },
            success: function (response) {
                // $(".global-loader").hide();
                // $("#banner-link_id").html(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                window.alert(jqXHR.responseText);
            }
        });
    },
    getListByHide: function () {
        function disable() {
            document.getElementById("mySelect").disabled=true;
        }
        function enable() {
            document.getElementById("mySelect").disabled=false;
        }

        // $.ajax({
        //     type: 'GET',
        //     url: '/city/get-list',
        //     data: {
        //         'id': 'id'
        //     },
        //     success: function (response) {
        //         // $(".global-loader").hide();
        //         // $("#banner-link_id").html(response);
        //     },
        //     error: function (jqXHR, textStatus, errorThrown) {
        //         window.alert(jqXHR.responseText);
        //     }
        // });
    }
}



