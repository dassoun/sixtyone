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