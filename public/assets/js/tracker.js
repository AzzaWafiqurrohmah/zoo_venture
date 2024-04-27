const map = L.map('map').setView([-7.296194429972056, 112.73681616791822], 80);

let isPanned = false;
let nearests = [];
let marker;
let sheds;

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

function compareArraysIgnoreOrder(arr1, arr2) {
    if (arr1.length !== arr2.length)
        return false;

    const sortedArr1 = arr1.slice().sort();
    const sortedArr2 = arr2.slice().sort();

    for (let i = 0; i < sortedArr1.length; i++) {
        if (sortedArr1[i] !== sortedArr2[i])
            return false;
    }

    return true;
}

function createNearestArea(details) {
    let elements = '';
    let drds = '';

    if(details.length < 1) {
        $('#nearest-container').html(`
            <div class="flex justify-center items-center gap-2 bg-gray-100 rounded-lg py-6">
                <i class="ti ti-template-off text-4xl"></i>
                <p class="text-base font-semibold">Tidak ada area terdekat</p>
            </div>`);

        return;
    }

    if(compareArraysIgnoreOrder(details, nearests)) return;

    details.map((detail) => {
        const chevron = detail.total_specs < 1 ? '' :
        `<div class="flex-auto">
            <i class="ti ti-chevron-down text-xl float-right dropdown-icon"></i>
        </div>`;

        detail.specs.map((spec) => {
            drds += `<div class="flex gap-3 items-center hover:bg-gray-100 px-4 py-2 rounded-lg cursor-pointer species-item" data-id="${spec.id}">
                    <div class="w-11 h-11 rounded-full }bg-cover bg-center" style="background-image: url(${spec.image})"></div>
                    <div>
                        <h4 class="text-[1rem] font-semibold mb-1 text-gray-800">${spec.name}</h4>
                    </div>
                </div>`;
        });

        elements += `
        <div class="rounded-lg hover:bg-gray-100">
            <div class="flex gap-3 items-center px-4 py-3 cursor-pointer dropdown-btn">
                <div class="w-12 h-12 rounded-full" style="background-color: ${detail.color}"></div>
                <div>
                    <h4 class="text-base font-semibold mb-1 text-gray-800">${detail.name}</h4>
                    <span class="bg-slate-200 px-3 py-0.5 rounded-full text-xs font-semibold">${detail.total_specs} spesies</span>
                </div>
                ${chevron}
            </div>
            <div class="hidden flex-col pl-10 dropdown-menu">
                ${drds}
            </div>
        </div>
        `;
    });

    nearests = details;
    $('#nearest-container').html(elements);
}

function renderNearestArea(distances) {
    const treshold = 0.001;
    const closests = distances.filter((d) => d.distance < treshold || d.isInside == true);

    createNearestArea(closests);
}

function getCurrLocation() {
    navigator.geolocation.getCurrentPosition((position) => {
        const coord = [position.coords.latitude, position.coords.longitude];

        if(marker)
            map.removeLayer(marker);

        marker = L.marker(coord).addTo(map);

        const distances = sheds.map((shed) => {
            const coordinates = shed.coordinates.map((coor) => {
                return coor.map((c) => Number(c));
            });

            const turfPolygon = turf.polygon([[...coordinates]]);
            const vertices = turf.explode(turfPolygon);
            const closestVertex = turf.nearest(coord, vertices);

            shed.isInside = turf.inside(coord, turfPolygon);
            shed.distance = turf.distance(coord, closestVertex, {unit: 'kilometers'});

            return shed;
        });

        if(!isPanned) {
            map.panTo(coord, 25);
            isPanned = true;
        }

        renderNearestArea(distances);
    });
}

$.ajax({
    url: '/api/sheds',
    success(res) {
        sheds = res.data;
        res.data.map((shed) => {
            const polygon = L.polygon(shed.coordinates, { color: shed.color });

            polygon.bindTooltip(shed.name, {permanent: true, direction:"center"});
            polygon.addTo(map);
        });

        if (navigator.geolocation)
            setInterval(() => {
                getCurrLocation();
            }, 200);
    },
});

$('#nearest-container').on('click', '.dropdown-btn', function() {
    const drdMenu = $(this).next();
    const drdIcon = $(this).find('.dropdown-icon');
    const isHidden = drdMenu.hasClass('hidden');

    if(isHidden) {
        drdMenu.removeClass('hidden');
        drdMenu.addClass('flex');

        drdIcon.removeClass('ti-chevron-down');
        drdIcon.addClass('ti-chevron-up')
    } else {
        drdMenu.addClass('hidden');
        drdMenu.removeClass('flex');

        drdIcon.removeClass('ti-chevron-up');
        drdIcon.addClass('ti-chevron-down')
    }
});

$('#nearest-container').on('click', '.species-item', function() {
    const specId = $(this).data('id');

    $.ajax({
        url: `/api/species/${specId}`,
        success(res) {
            showSpeciesModal(res.data);
        }
    });
});
