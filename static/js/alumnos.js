var mapa, marcador, centro, latitud, longitud;

function iniciaMapa() {
    centro = {
        lat: 20.65,
        lng: -100.4
    }, mapa = new google.maps.Map(document.getElementById("mapa"), {
        zoom: 13,
        center: centro
    }), navigator.geolocation && navigator.geolocation.getCurrentPosition(function(a) {
        centro = {
            lat: a.coords.latitude,
            lng: a.coords.longitude
        }, setTimeout(function() {
            mapa.panTo(centro)
        }, 1e3)
    }), mapa.addListener("click", function(a) {
        null == marcador ? (marcador = new google.maps.Marker({
            position: a.latLng,
            map: mapa,
            draggable: !0,
            title: "Arrastra hasta el domicilio y suelta para guardar"
        })).addListener("dragend", function(a) {
            confirma_posicion(a.latLng)
        }) : marcador.setPosition(a.latLng)
    })
}

function abre_mapa(a, t) {
    $("#modal-mapa-titulo").html(t), $("#modal-mapa-matricula").html(a), mapa.setCenter(centro), mapa.setZoom(13), null != marcador && marcador.setPosition(null), $.ajax({
        url: base_url + "alumno/getpos",
        type: "post",
        data: {
            matricula: a
        },
        dataType: "json",
        success: function(a) {
            a.resultado && (latitud = null == a.posicion.latitud ? 0 : parseFloat(a.posicion.latitud), longitud = null == a.posicion.longitud ? 0 : parseFloat(a.posicion.longitud)), 0 != latitud && 0 != longitud && (null == marcador ? (marcador = new google.maps.Marker({
                position: {
                    lat: parseFloat(latitud),
                    lng: parseFloat(longitud)
                },
                map: mapa,
                draggable: !0,
                title: "Arrastra hasta el domicilio y suelta para guardar"
            })).addListener("dragend", function(a) {
                confirma_posicion(a.latLng)
            }) : marcador.setPosition({
                lat: parseFloat(latitud),
                lng: parseFloat(longitud)
            }), setTimeout(function() {
                mapa.panTo({
                    lat: parseFloat(latitud),
                    lng: parseFloat(longitud)
                })
            }, 1e3), setTimeout(function() {
                mapa.setZoom(17)
            }, 2e3))
        }
    })
}

function confirma_posicion(a) {
    setTimeout(function() {
        mapa.panTo(a)
    }, 500), confirm("¿Realmente quieres guardar la posición del domicilio de " + $("#modal-mapa-titulo").html() + "?") && $.ajax({
        url: base_url + "alumno/cambiapos",
        type: "post",
        data: {
            matricula: $("#modal-mapa-matricula").html(),
            latitud: a.lat(),
            longitud: a.lng()
        },
        dataType: "json",
        success: function(a) {
            setTimeout(function() {
                //alert(a.mensaje)
                $( "#alerta" ).html( '<DIV class="alert alert-success alert-dismissible fade show col-md-12"><BUTTON type="button" class="close" data-dismiss="alert">&times;</BUTTON><STRONG>CORRECTO:</STRONG> ' +
                a.mensaje + '.</DIV>' );
            }, 1e3)
        }
    })
}