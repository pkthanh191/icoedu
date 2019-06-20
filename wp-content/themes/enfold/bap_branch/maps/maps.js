var layerPoint, sourcePoint, featurePoint = [];
var icon_maps = '';

function addPoint(data) {
    var featureIcon = new ol.Feature({
        geometry: new ol.geom.Point([data.branch_long, data.branch_lat]),  // [long, lat]
        type: 'point',
        branch_address: data.branch_address,
        branch_email: data.branch_email,
        lat: data.branch_lat,
        long: data.branch_long,
        branch_name: data.branch_name,
        branch_phone: data.branch_phone,
        branch_time_work: data.branch_time_work,
        branch_website: data.branch_website
    });
    featurePoint.push(featureIcon);
}

function renderStyles(type) {
    var styles = {
        'point': new ol.style.Style({
            image: new ol.style.Icon(({
                src: icon_maps
            }))
        })
    };
    return styles[type];
}

function closePopup() {
    overlay.setPosition(undefined);
    closer.blur();
    return false;
}

var container = document.getElementById('popup');
var content = document.getElementById('popup-content');
var closer = document.getElementById('popup-closer');

var overlay = new ol.Overlay({
    element: container,
    autoPan: true,
    autoPanMargin: 100,
    autoPanAnimation: {
        duration: 250
    }
});

closer.onclick = function () {
    closePopup();
};

function loadMaps(icon) {
    icon_maps = icon;
    sourcePoint = new ol.source.Vector();
    sourcePoint.addFeatures(featurePoint);
    layerPoint = new ol.layer.Vector({
        source: sourcePoint,
        style: function (feature) {
            return renderStyles(feature.get('type'), feature);
        }
    });

    var googleLayer = new ol.layer.Tile({
        'title': 'Google Maps Uydu',
        'type': 'base',
        'visible': true,
        'opacity': 1.000000,
        'source': new ol.source.XYZ({
            'attributions': [new ol.Attribution({html: '<a href=""></a>'})],
            'url': 'http://mt0.google.com/vt/lyrs=m&hl=en&x={x}&y={y}&z={z}&s=Ga'
        })
    });

    var view = new ol.View({
        'projection': 'EPSG:4326',
        'center': [110, 12.5],
        'zoom': 5
    });

    var map = new ol.Map({
        'layers': [googleLayer, layerPoint],
        'overlays': [overlay],
        'target': document.getElementById('maps_branch'),
        'view': view,
        'controls': ol.control.defaults().extend([
            new ol.control.FullScreen()
        ])
    });

    map.on('singleclick', function (evt) {
        var feature = map.forEachFeatureAtPixel(evt.pixel, function (feature) {
            return feature;
        });
        if (feature) {
            if (feature.get('type') == 'point') {
                var html_email = (feature.get('branch_email') != '') ? '<p><b>Email:</b> ' + feature.get('branch_email') + '</p>' : '';
                var html_phone = (feature.get('branch_phone') != '') ? '<p><b>SĐT:</b> ' + feature.get('branch_phone') + '</p>' : '';
                var html_website = (feature.get('branch_website') != '') ? '<p><b>Website:</b> ' + feature.get('branch_website') + '</p>' : '';
                var html_time_work = (feature.get('branch_time_work') != '') ? '<p><b>Thời gian làm việc:</b> ' + feature.get('branch_time_work') + '</p>' : '';

                var html = '' +
                    '<div class="item-branch item-branch-detail">\n' +
                    '   <h2 class="title-branch">' + feature.get('branch_name') + '</h2>\n' +
                    '   <div class="description-branch">\n' +
                    '       <p><b>Địa chỉ:</b> ' + feature.get('branch_address') + '</p>\n' +
                            html_email +
                            html_phone +
                            html_website +
                            html_time_work +
                    '   </div>\n' +
                    '</div>';

                content.innerHTML = html;
                overlay.setPosition([feature.get('long'), feature.get('lat')]);
            } else {
                closePopup();
            }
        } else {
            closePopup();
        }
    });
}

if (dataBrachList !== undefined) {
    if (dataBrachList.length > 0) {
        for (var i = 0; i < dataBrachList.length; i++) {
            addPoint(dataBrachList[i]);
        }
    }
    loadMaps('/icon.png');
}