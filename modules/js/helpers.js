// Helpers
function cleanDisableAreas(player_id) 
{
    for (let i=1; i<7; i++) {
        let elmt = dojo.query('sxt_area_'+player_id+'_'+i);
        if (elmt) {
            dojo.destroy('sxt_area_'+player_id+'_'+i);
        }
    }
}

function cleanSelectionnableArea(player_id, area_size) 
{
    console.log(area_size);
    array_area_size = new Array();
    for (let [key, value] of Object.entries(area_size)) {
        array_area_size.push(value);
    }

    console.log(array_area_size);
    
    for (let i=1; i<7; i++) {
        for (let j=1; j<=array_area_size[i-1]; j++) {
            console.log('sxt_location_'+player_id+'_'+i+'_'+j);
            let elmt = dojo.query('sxt_location_'+player_id+'_'+i+'_'+j);
            if (elmt) {
                dojo.removeClass('sxt_location_'+player_id+'_'+i+'_'+j, 'sxt_location_clickable');
            }
        }
    }
}